<?php

namespace App\Controllers;

use App\Models\KonsorsiumModel;
use App\Models\PesananEksporModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Buyer extends BaseController
{
    protected KonsorsiumModel $konsorsiumModel;
    protected PesananEksporModel $pesananModel;

    public function __construct()
    {
        $this->konsorsiumModel = new KonsorsiumModel();
        $this->pesananModel    = new PesananEksporModel();
    }

    private function idBuyer(): int
    {
        return (int) session()->get('id_user');
    }

    /**
     * Gerbang Validasi Bisnis (KYB - Know Your Business)
     * Memastikan entitas Buyer sudah diverifikasi legalitasnya oleh Admin sebelum bertransaksi.
     */
    private function cekVerifikasi(): ?RedirectResponse
    {
        $user   = (new UserModel())->find($this->idBuyer());
        $status = $user['status_verifikasi'] ?? 'Pending';

        // Sinkronisasi status verifikasi terbaru ke sesi
        session()->set('status_verifikasi', $status);

        if ($status !== 'Terverifikasi') {
            $pesan = ($status === 'Ditolak')
                ? 'Pengajuan legalitas bisnis Anda ditolak oleh Administrator. Silakan periksa atau perbarui dokumen legal pada menu profil.'
                : 'Akun Buyer Anda sedang dalam proses verifikasi legalitas bisnis (KYB). Anda belum dapat melakukan pemesanan kontainer ekspor sampai disetujui Administrator.';

            return redirect()->to('/buyer/dashboard')->with('error', $pesan);
        }

        return null;
    }

    // 1. Dasbor: riwayat pesanan milik Buyer yang login
    public function dashboard()
    {
        $userModel = new UserModel();
        $user      = $userModel->find($this->idBuyer());

        if (! empty($user['status_verifikasi'])) {
            session()->set('status_verifikasi', $user['status_verifikasi']);
        }

        return view('buyer/dashboard', [
            'user'    => $user,
            'pesanan' => $this->pesananModel->getByBuyer($this->idBuyer()),
        ]);
    }

    // 2. Form profil Buyer
    public function profil()
    {
        $userModel = new UserModel();

        return view('buyer/profil', [
            'user' => $userModel->find($this->idBuyer()),
        ]);
    }

    // 3. Simpan perubahan profil Buyer & Dokumen Legalitas (Migrasi URL Cloud)
    public function updateProfile()
    {
        $rules = [
            'nama'             => 'required|max_length[255]',
            'email'            => 'required|valid_email|max_length[255]',
            'nomor_izin_usaha' => 'permit_empty|max_length[100]',
            'dokumen_legal'    => 'permit_empty|valid_url',
            'koordinat_lokasi' => 'permit_empty|regex_match[/^-?\d{1,3}(\.\d+)?\s*,\s*-?\d{1,3}(\.\d+)?$/]',
            'password'         => 'permit_empty|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $userModel = new UserModel();
        $idUser    = $this->idBuyer();
        $email     = trim((string) $this->request->getPost('email'));

        // Cek duplikasi email
        $dipakai = $userModel->where('email', $email)->where('id_user !=', $idUser)->first();
        if ($dipakai) {
            return redirect()->back()->withInput()->with('error', 'Email sudah digunakan akun lain.');
        }

        $data = [
            'nama'             => trim((string) $this->request->getPost('nama')),
            'email'            => $email,
            'koordinat_lokasi' => trim((string) $this->request->getPost('koordinat_lokasi')),
        ];

        if ($this->request->getPost('nomor_izin_usaha') !== null) {
            $data['nomor_izin_usaha'] = trim((string) $this->request->getPost('nomor_izin_usaha'));
        }

        // Tautan Cloud Dokumen Legalitas (Aman dari mkdir server)
        $dokumenLegalBaru = trim((string) $this->request->getPost('dokumen_legal'));
        if ($dokumenLegalBaru !== '') {
            $data['dokumen_legal']     = $dokumenLegalBaru;
            $data['status_verifikasi'] = 'Pending'; // Reset status ke pending saat dokumen diperbarui
        }

        $passwordBaru = (string) $this->request->getPost('password');
        if ($passwordBaru !== '') {
            $data['password'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $userModel->update($idUser, $data);
        session()->set('nama', $data['nama']);

        return redirect()->to('/buyer/dashboard')
            ->with('success', 'Profil dan informasi legalitas bisnis berhasil diperbarui.');
    }

    // 4. Katalog: hanya konsorsium berstatus Penuh (siap ekspor)
    public function cariKonsorsium()
    {
        $keyword = trim((string) $this->request->getGet('hs_code'));

        $builder = $this->konsorsiumModel->where('status_kuota', 'Penuh');
        if ($keyword !== '') {
            $builder->like('target_hs_code', $keyword, 'after');
        }

        return view('buyer/cari_konsorsium', [
            'daftarKonsorsium' => $builder->findAll(),
            'keyword'          => $keyword,
        ]);
    }

    // 5. Form order: detail konsorsium + daftar UMKM pengisinya
    public function buatPesanan($idKonsorsium)
    {
        if ($redirect = $this->cekVerifikasi()) {
            return $redirect;
        }

        $konsorsium = $this->konsorsiumModel->find($idKonsorsium);

        if (! $konsorsium || $konsorsium['status_kuota'] !== 'Penuh') {
            return redirect()->to('/buyer/cari')
                ->with('error', 'Konsorsium tidak tersedia untuk dipesan.');
        }

        return view('buyer/buat_pesanan', [
            'konsorsium' => $konsorsium,
            'anggota'    => $this->konsorsiumModel->getAnggota((int) $idKonsorsium),
        ]);
    }

    // 6. Simpan pesanan & inisialisasi tagihan Escrow
    public function simpanPesanan()
    {
        if ($redirect = $this->cekVerifikasi()) {
            return $redirect;
        }

        $rules = [
            'id_konsorsium'      => 'required|is_natural_no_zero',
            'total_moq'          => 'required|is_natural_no_zero',
            'tanggal_pengiriman' => 'required|valid_date[Y-m-d]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $idKonsorsium  = (int) $this->request->getPost('id_konsorsium');
        $totalMoq      = (int) $this->request->getPost('total_moq');
        $tglPengiriman = (string) $this->request->getPost('tanggal_pengiriman');

        if (strtotime($tglPengiriman) <= strtotime('today')) {
            return redirect()->back()->withInput()
                ->with('error', 'Tanggal pengiriman harus setelah hari ini.');
        }

        $db    = \Config\Database::connect();
        $error = null;

        $db->transStart();

        // Kunci baris agar dua Buyer tidak memesan konsorsium yang sama secara bersamaan
        $k = $db->query(
            'SELECT * FROM konsorsium WHERE id_konsorsium = ? FOR UPDATE',
            [$idKonsorsium]
        )->getRowArray();

        if (! $k || $k['status_kuota'] !== 'Penuh') {
            $error = 'Konsorsium tidak tersedia atau sudah dipesan.';
        } elseif ($totalMoq > (int) $k['total_kapasitas_gabungan']) {
            $error = 'Jumlah pesanan melebihi kapasitas konsorsium ('
                   . (int) $k['total_kapasitas_gabungan'] . ').';
        } else {
            // Kalkulasi tagihan Escrow: Volume MOQ x Estimasi tarif ekspor Rp 25.000/Kg
            $tarifPerKg   = (int) ($k['harga_per_kg'] ?? 25000);
            $totalTagihan = $totalMoq * $tarifPerKg;

            $this->pesananModel->insert([
                'id_user'            => $this->idBuyer(),
                'id_konsorsium'      => $idKonsorsium,
                'total_moq'          => $totalMoq,
                'total_tagihan'      => $totalTagihan,
                'tanggal_pengiriman' => $tglPengiriman,
                'status_pemesanan'   => 'Pending',
                'status_pembayaran'  => 'Belum Bayar',
                'bukti_bayar'        => null,
            ]);

            $this->konsorsiumModel->update($idKonsorsium, ['status_kuota' => 'Dipesan']);
        }

        $db->transComplete();

        if ($error) {
            return redirect()->back()->withInput()->with('error', $error);
        }

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()
                ->with('error', 'Gagal menyimpan pesanan, coba lagi.');
        }

        return redirect()->to('/buyer/dashboard')
            ->with('success', 'Pesanan kargo berhasil dibuat! Silakan lakukan penyetoran dana ke rekening bersama (Escrow).');
    }

    // 7. Unggah Bukti Pembayaran Escrow (Rekening Bersama Konsolidator)
    public function unggahBuktiBayar()
    {
        $idPesanan  = (int) $this->request->getPost('id_pesanan');
        $buktiBayar = trim((string) $this->request->getPost('bukti_bayar'));

        if (empty($buktiBayar) || ! filter_var($buktiBayar, FILTER_VALIDATE_URL)) {
            return redirect()->back()->with('error', 'Tautan bukti bayar wajib berupa format URL yang valid (diawali https://).');
        }

        $pesanan = $this->pesananModel->find($idPesanan);

        if (! $pesanan || (int) $pesanan['id_user'] !== $this->idBuyer()) {
            return redirect()->back()->with('error', 'Data pesanan tidak ditemukan atau akses ditolak.');
        }

        $this->pesananModel->update($idPesanan, [
            'bukti_bayar'       => $buktiBayar,
            'status_pembayaran' => 'Menunggu Verifikasi',
        ]);

        return redirect()->back()->with('success', 'Tautan bukti setor dana Escrow berhasil dikirim! Menunggu konfirmasi verifikasi dari Administrator.');
    }

    // 8. Konfirmasi penerimaan kargo (Menyelesaikan pesanan & akumulasi Trust Score)
    public function pesananDiterima($idPesanan)
    {
        $pesanan = $this->pesananModel->find($idPesanan);
        if (! $pesanan) {
            return redirect()->back()->with('error', 'Data pesanan tidak ditemukan.');
        }

        // Proteksi Anti-IDOR
        if ((int) $pesanan['id_user'] !== $this->idBuyer()) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda tidak memiliki otoritas atas pesanan ini.');
        }

        // Wajib berstatus Dikirim (sudah lolos inspeksi pelabuhan FCL)
        if ($pesanan['status_pemesanan'] !== 'Dikirim') {
            return redirect()->back()->with(
                'error',
                'Pesanan belum berstatus Dikirim (masih dalam tahap persiapan atau menunggu izin layar Admin).'
            );
        }

        // Eksekusi perubahan status menjadi 'Selesai'
        // (PesananEksporModel secara otomatis mendongkrak Trust Score seluruh anggota konsorsium)
        $berhasil = $this->pesananModel->updateStatusPesanan((int) $idPesanan, 'Selesai');

        if (! $berhasil) {
            return redirect()->back()->with('error', 'Gagal memperbarui status penerimaan.');
        }

        return redirect()->to('/buyer/dashboard')
            ->with('success', 'Kargo ekspor berhasil dikonfirmasi diterima! Transaksi selesai dan skor reputasi mitra konsorsium telah bertambah.');
    }
}