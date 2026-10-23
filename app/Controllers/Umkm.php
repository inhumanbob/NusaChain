<?php

namespace App\Controllers;

use App\Libraries\MatchmakingService;
use App\Models\KonsorsiumModel;
use App\Models\PesananEksporModel;
use App\Models\ProdukModel;
use App\Models\UserModel;

class Umkm extends BaseController
{
    /**
     * Dashboard UMKM
     */
    public function dashboard()
    {
        $idUser = (int) session()->get('id_user');
        $db     = \Config\Database::connect();

        // Data pengguna dan produk
        $user = (new UserModel())->find($idUser);

        // Sinkronisasi status verifikasi terbaru ke sesi pengguna
        if (! empty($user['status_verifikasi'])) {
            session()->set('status_verifikasi', $user['status_verifikasi']);
        }

        $daftarProduk = (new ProdukModel())
            ->where('id_user', $idUser)
            ->findAll();

        // Hitung kapasitas seluruh produk milik UMKM dalam kg
        $kapasitasProduk = 0;

        foreach ($daftarProduk as $produk) {
            $kapasitasProduk += MatchmakingService::keKg(
                (int) $produk['kapasitas_bulanan'],
                (string) $produk['satuan']
            );
        }

        /*
         * Detail konsorsium yang ditampilkan pada panel utama.
         * Fungsi ini tetap digunakan untuk informasi konsorsium,
         * anggota, kapasitas, serta persentase FCL.
         */
        $detail = (new KonsorsiumModel())->getDetailByUser($idUser);

        /*
         * Ambil semua pesanan kargo konsorsium yang diikuti UMKM ini
         */
        $semuaPesanan = [];

        if ($idUser > 0) {
            $semuaPesanan = $db->table('pesanan_ekspor')
                ->select('pesanan_ekspor.*, konsorsium.nama_konsorsium, konsorsium.target_hs_code')
                ->join(
                    'konsorsium',
                    'konsorsium.id_konsorsium = pesanan_ekspor.id_konsorsium'
                )
                ->join(
                    'anggota_konsorsium',
                    'anggota_konsorsium.id_konsorsium = pesanan_ekspor.id_konsorsium'
                )
                ->where('anggota_konsorsium.id_user', $idUser)
                ->distinct()
                ->orderBy('pesanan_ekspor.id_pesanan', 'DESC')
                ->get()
                ->getResultArray();
        }

        /*
         * Pisahkan pesanan aktif dan pesanan riwayat selesai.
         */
        $pesananAktif   = [];
        $riwayatPesanan = [];

        foreach ($semuaPesanan as $pesanan) {
            $status = strtolower(
                trim((string) ($pesanan['status_pemesanan'] ?? ''))
            );

            if ($status === 'selesai') {
                $riwayatPesanan[] = $pesanan;
            } else {
                $pesananAktif[] = $pesanan;
            }
        }

        /*
         * Kirim data ke dashboard view
         */
        return view('umkm/dashboard', [
            'user'                   => $user,

            // Data produk
            'daftarProduk'           => $daftarProduk,
            'totalProduk'            => count($daftarProduk),
            'kapasitasProduk'        => $kapasitasProduk,

            // Informasi konsorsium untuk panel utama
            'konsorsium'             => $detail['konsorsium'] ?? null,
            'anggota'                => $detail['anggota'] ?? [],
            'totalAnggota'           => $detail['totalAnggota'] ?? 0,
            'totalKapasitas'         => $detail['totalKapasitas'] ?? 0,
            'targetFcl'              => $detail['targetFcl'] ?? MatchmakingService::TARGET_KG,
            'sisaKuota'              => $detail['sisaKuota'] ?? MatchmakingService::TARGET_KG,
            'persentase'             => $detail['persentase'] ?? 0,

            // Data pesanan untuk dashboard
            'pesananKonsorsium'      => $pesananAktif,
            'riwayatPesanan'         => $riwayatPesanan,
            'semuaPesananKonsorsium' => $semuaPesanan,
        ]);
    }

    /**
     * Halaman profil UMKM
     */
    public function profil()
    {
        return view('umkm/profil', [
            'user' => (new UserModel())->find((int) session()->get('id_user')),
        ]);
    }

    /**
     * Perbarui profil UMKM & Dokumen Legalitas Usaha (KYB)
     */
    public function updateProfile()
    {
        $rules = [
            'nama'             => 'required|max_length[255]',
            'email'            => 'required|valid_email|max_length[255]',
            'nomor_izin_usaha' => 'permit_empty|max_length[100]',
            'dokumen_legal'    => 'permit_empty|max_size[dokumen_legal,2048]|ext_in[dokumen_legal,pdf,jpg,jpeg,png]',
            'koordinat_lokasi' => 'permit_empty|regex_match[/^-?\d{1,3}(\.\d+)?\s*,\s*-?\d{1,3}(\.\d+)?$/]',
            'password'         => 'permit_empty|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $userModel = new UserModel();
        $idUser    = (int) session()->get('id_user');
        $email     = trim((string) $this->request->getPost('email'));

        // Email tidak boleh digunakan akun lain
        $dipakai = $userModel
            ->where('email', $email)
            ->where('id_user !=', $idUser)
            ->first();

        if ($dipakai) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email sudah digunakan akun lain.');
        }

        $data = [
            'nama'             => trim((string) $this->request->getPost('nama')),
            'email'            => $email,
            'koordinat_lokasi' => trim((string) $this->request->getPost('koordinat_lokasi')),
        ];

        // Kelola NIB / Nomor Izin Usaha jika diinputkan
        if ($this->request->getPost('nomor_izin_usaha') !== null) {
            $data['nomor_izin_usaha'] = trim((string) $this->request->getPost('nomor_izin_usaha'));
        }

        // Kelola Berkas Dokumen Legalitas Fisik (Upload PDF/Gambar)
        $fileDokumen = $this->request->getFile('dokumen_legal');
        if ($fileDokumen && $fileDokumen->isValid() && ! $fileDokumen->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/dokumen_legal';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $namaBerkasBaru = $fileDokumen->getRandomName();
            $fileDokumen->move($uploadDir, $namaBerkasBaru);
            $data['dokumen_legal']      = $namaBerkasBaru;
            $data['status_verifikasi']  = 'Pending'; // Reset status ke pending saat dokumen diperbarui
        }

        $passwordBaru = (string) $this->request->getPost('password');
        if ($passwordBaru !== '') {
            $data['password'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $userModel->update($idUser, $data);

        session()->set('nama', $data['nama']);

        return redirect()->to('/umkm/dashboard')
            ->with('success', 'Profil dan informasi legalitas usaha berhasil diperbarui.');
    }

    /**
     * Perubahan status pesanan oleh UMKM.
     * Sesuai Opsi 2 (Strict Admin): UMKM HANYA boleh mengubah status menjadi "Diproses"
     * (tanda kargo sedang disiapkan & diserahkan ke hub konsolidasi pelabuhan).
     */
    public function updateStatusPesananUmkm(int $idPesanan, string $statusBaru)
    {
        $pesananModel = new PesananEksporModel();
        $statusBaru   = ucfirst(strtolower($statusBaru));

        // Validasi ketat wewenang UMKM
        if ($statusBaru !== 'Diproses') {
            return redirect()->back()->with(
                'error',
                'Akses ditolak. Keberangkatan kargo (Dikirim) mutlak menjadi wewenang Administrator setelah inspeksi pelabuhan.'
            );
        }

        $success = $pesananModel->updateStatusPesanan($idPesanan, 'Diproses');

        if ($success) {
            return redirect()->back()->with(
                'success',
                'Status kargo berhasil diubah menjadi Diproses. Silakan kirim komoditas ke gudang konsolidasi untuk inspeksi Admin.'
            );
        }

        return redirect()->back()->with('error', 'Gagal memperbarui status kargo.');
    }
}