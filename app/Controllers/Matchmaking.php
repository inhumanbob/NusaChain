<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KonsorsiumModel;
use App\Models\AnggotaKonsorsiumModel;
use App\Models\ProdukModel;

class Matchmaking extends BaseController
{
    protected $konsorsiumModel;
    protected $anggotaModel;
    protected $produkModel;

    // Patokan batas kapasitas 1 kontainer penuh (FCL)
    const TARGET_FCL = 10000; 

    public function __construct()
    {
        $this->konsorsiumModel = new KonsorsiumModel();
        $this->anggotaModel    = new AnggotaKonsorsiumModel();
        $this->produkModel     = new ProdukModel();
    }

    public function prosesClustering($idProduk)
    {
        $produk = $this->produkModel->find($idProduk);

        if (!$produk) {
            return redirect()->back()->with('error', 'Data produk tidak ditemukan.');
        }

        $kapasitas = (int) $produk['kapasitas_bulanan'];
        $hsCode    = $produk['hs_code'];
        $idUser    = $produk['id_user'];

        // Kondisi 1: Jika kapasitas >= MOQ -> arahkan ke Dasbor Mandiri
        if ($kapasitas >= self::TARGET_FCL) {
            return redirect()->to('/umkm/dashboard-mandiri')->with('info', 'Kapasitas Anda mencukupi untuk ekspor mandiri.');
        }

        // Kondisi 2: Jika kapasitas < MOQ -> cari konsorsium aktif (HS Code sama & kuota terbuka)
        $grupCocok = $this->konsorsiumModel
            ->where('target_hs_code', $hsCode)
            ->where('status_kuota', 'Terbuka')
            ->first();

        $db = \Config\Database::connect();
        $db->transStart();

        if ($grupCocok) {
            // Gabung ke grup yang sudah ada
            $idKonsorsium = $grupCocok['id_konsorsium'];
            $totalBaru    = (int) $grupCocok['total_kapasitas_gabungan'] + $kapasitas;
            $statusBaru   = ($totalBaru >= self::TARGET_FCL) ? 'Penuh' : 'Terbuka';

            $this->konsorsiumModel->update($idKonsorsium, [
                'total_kapasitas_gabungan' => $totalBaru,
                'status_kuota'             => $statusBaru,
            ]);
        } else {
            // Jika tidak ada yang cocok -> buat grup konsorsium baru
            $idKonsorsium = $this->konsorsiumModel->insert([
                'nama_konsorsium'          => 'Konsorsium ' . $produk['nama_produk'] . ' #' . rand(100, 999),
                'target_hs_code'           => $hsCode,
                'total_kapasitas_gabungan' => $kapasitas,
                'status_kuota'             => ($kapasitas >= self::TARGET_FCL) ? 'Penuh' : 'Terbuka',
            ]);
        }

        // Catat UMKM ke tabel anggota konsorsium
        $this->anggotaModel->insert([
            'id_konsorsium'        => $idKonsorsium,
            'id_user'              => $idUser,
            'kontribusi_kapasitas' => $kapasitas,
            'tanggal_bergabung'    => date('Y-m-d'),
        ]);

        $db->transComplete();

        return redirect()->to('/konsorsium/dashboard/' . $idKonsorsium)->with('success', 'Kargo berhasil dikonsolidasikan ke grup.');
    }
}