<?php

namespace App\Controllers;

use App\Libraries\MatchmakingService;
use App\Models\KonsorsiumModel;
use App\Models\ProdukModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Produk extends BaseController
{
    private const RULES = [
        'nama_produk'       => 'required|max_length[255]',
        'hs_code'           => 'required|regex_match[/^[0-9]{4,10}$/]',
        'kapasitas_bulanan' => 'required|is_natural_no_zero|less_than_equal_to[1000000]',
        'satuan'            => 'required|in_list[Kg,Ton]',
    ];

    private const MESSAGES = [
        'hs_code' => ['regex_match' => 'HS Code harus berupa angka 4 sampai 10 digit tanpa simbol/titik.'],
    ];

    private function idUser(): int
    {
        return (int) session()->get('id_user'); // Dijamin ada oleh filter roleUmkm
    }

    /**
     * Gerbang Validasi Bisnis (KYB - Know Your Business)
     * Memastikan akun UMKM sudah disetujui Admin sebelum diizinkan mendaftarkan produk.
     */
    private function cekVerifikasi(): ?RedirectResponse
    {
        $user   = (new UserModel())->find($this->idUser());
        $status = $user['status_verifikasi'] ?? 'Pending';

        // Sinkronisasi status verifikasi terbaru ke session
        session()->set('status_verifikasi', $status);

        if ($status !== 'Terverifikasi') {
            $pesan = ($status === 'Ditolak')
                ? 'Pengajuan legalitas usaha Anda ditolak oleh Administrator. Silakan perbarui dokumen legal pada menu profil.'
                : 'Akun Anda sedang dalam proses verifikasi legalitas (KYB). Anda belum dapat mendaftarkan produk ekspor sampai disetujui Administrator.';

            return redirect()->to('/umkm/dashboard')->with('error', $pesan);
        }

        return null;
    }

    private function dataForm(): array
    {
        return [
            'nama_produk'       => trim((string) $this->request->getPost('nama_produk')),
            'hs_code'           => trim((string) $this->request->getPost('hs_code')),
            'kapasitas_bulanan' => (int) $this->request->getPost('kapasitas_bulanan'),
            'satuan'            => (string) $this->request->getPost('satuan'),
        ];
    }

    public function index()
    {
        // Proteksi KYB: Kunci akses formulir jika belum terverifikasi
        if ($redirect = $this->cekVerifikasi()) {
            return $redirect;
        }

        $produkModel = new ProdukModel();

        return view('umkm/input_barang', [
            'produk' => $produkModel->where('id_user', $this->idUser())->findAll(),
        ]);
    }

    public function simpan()
    {
        // Proteksi KYB: Cegah manipulasi POST request tanpa verifikasi
        if ($redirect = $this->cekVerifikasi()) {
            return $redirect;
        }

        if (! $this->validate(self::RULES, self::MESSAGES)) {
            return redirect()->back()->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $db          = \Config\Database::connect();
        $produkModel = new ProdukModel();

        try {
            $db->transBegin();

            $idProduk = $produkModel->insert($this->dataForm() + ['id_user' => $this->idUser()]);
            
            // Memanggil Sistem Engine untuk otomatisasi Clustering
            $hasil = (new MatchmakingService())->tempatkan($produkModel->find($idProduk));

            if (! $hasil['ok']) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('error', $hasil['pesan']);
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Produk::simpan - ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem, data tidak disimpan.');
        }

        return redirect()->to('/umkm/dashboard')->with('success', $hasil['pesan']);
    }

    public function edit($id)
    {
        if ($redirect = $this->cekVerifikasi()) {
            return $redirect;
        }

        $produk = (new ProdukModel())->where('id_user', $this->idUser())->find($id);

        if (! $produk) {
            return redirect()->to('/umkm/produk')->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
        }

        return view('umkm/edit_barang', ['produk' => $produk]);
    }

    public function update($id)
    {
        if ($redirect = $this->cekVerifikasi()) {
            return $redirect;
        }

        if (! $this->validate(self::RULES, self::MESSAGES)) {
            return redirect()->back()->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $db          = \Config\Database::connect();
        $produkModel = new ProdukModel();
        $konsModel   = new KonsorsiumModel();

        $produk = $produkModel->where('id_user', $this->idUser())->find($id);
        if (! $produk) {
            return redirect()->to('/umkm/produk')->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $baru       = $this->dataForm();
        $kontribusi = MatchmakingService::keKg($baru['kapasitas_bulanan'], $baru['satuan']);

        try {
            $db->transBegin();

            $anggota = $db->table('anggota_konsorsium')->where('id_produk', (int) $id)->get()->getRowArray();

            if ($anggota) {
                // Produk sudah tergabung: kunci grup lalu cek aturan logistik
                $k = $db->query(
                    'SELECT * FROM konsorsium WHERE id_konsorsium = ? FOR UPDATE',
                    [(int) $anggota['id_konsorsium']]
                )->getRowArray();

                $error = null;
                if (! in_array($k['status_kuota'], ['Terbuka', 'Penuh'], true)) {
                    $error = 'Produk ini sudah menjadi bagian dari kargo ekspor (Dipesan) dan tidak dapat diubah.';
                } elseif ($baru['hs_code'] !== $k['target_hs_code']) {
                    $error = 'HS Code produk yang sudah tergabung ke konsorsium tidak dapat diubah. Hapus produk lalu input ulang.';
                } elseif ((int) $k['total_kapasitas_gabungan'] - (int) $anggota['kontribusi_kapasitas'] + $kontribusi
                          > (int) $k['target_kapasitas_gabungan']) {
                    $error = 'Kapasitas baru ditolak karena melebihi batasan sisa kuota kontainer konsorsium.';
                }

                if ($error) {
                    $db->transRollback();
                    return redirect()->back()->withInput()->with('error', $error);
                }

                $db->table('anggota_konsorsium')
                    ->where('id_anggota', $anggota['id_anggota'])
                    ->update(['kontribusi_kapasitas' => $kontribusi]);
            }

            $produkModel->update((int) $id, $baru);

            if ($anggota) {
                $konsModel->sinkronkan((int) $anggota['id_konsorsium']);
            } else {
                // Belum punya grup: cocokkan ulang
                $hasil = (new MatchmakingService())->tempatkan($produkModel->find((int) $id));
                if (! $hasil['ok']) {
                    $db->transRollback();
                    return redirect()->back()->withInput()->with('error', $hasil['pesan']);
                }
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Produk::update - ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem, perubahan tidak disimpan.');
        }

        return redirect()->to('/umkm/produk')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function hapus($id)
    {
        if ($redirect = $this->cekVerifikasi()) {
            return $redirect;
        }

        $db          = \Config\Database::connect();
        $produkModel = new ProdukModel();
        $konsModel   = new KonsorsiumModel();

        $produk = $produkModel->where('id_user', $this->idUser())->find($id);
        if (! $produk) {
            return redirect()->to('/umkm/produk')->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $idGrup = array_column(
            $db->table('anggota_konsorsium')->select('id_konsorsium')->where('id_produk', (int) $id)->get()->getResultArray(),
            'id_konsorsium'
        );

        try {
            $db->transBegin();

            foreach ($idGrup as $g) {
                $k = $db->query('SELECT status_kuota FROM konsorsium WHERE id_konsorsium = ? FOR UPDATE', [(int) $g])->getRowArray();
                
                // Mencegah penghapusan jika kargo sedang dikirim / dipesan Buyer
                if ($k && ! in_array($k['status_kuota'], ['Terbuka', 'Penuh'], true)) {
                    $db->transRollback();
                    return redirect()->to('/umkm/produk')
                        ->with('error', 'Produk ini sudah menjadi bagian dari pesanan Buyer (Kargo berjalan) dan tidak dapat dihapus.');
                }
            }

            $db->table('anggota_konsorsium')->where('id_produk', (int) $id)->delete();
            $produkModel->delete((int) $id);

            foreach ($idGrup as $g) {
                $konsModel->sinkronkan((int) $g);
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Produk::hapus - ' . $e->getMessage());
            return redirect()->to('/umkm/produk')->with('error', 'Terjadi kesalahan, data tidak dihapus.');
        }

        return redirect()->to('/umkm/produk')->with('success', 'Data komoditas berhasil dihapus dari sistem!');
    }
}