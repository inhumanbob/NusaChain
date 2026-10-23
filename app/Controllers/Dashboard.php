<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProdukModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $id_user = session()->get('id_user');

        // Pastikan user sudah login
        if (!$id_user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel   = new UserModel();
        $produkModel = new ProdukModel();
        $db          = \Config\Database::connect();

        // ==========================================
        // 1. AMBIL DATA PROFIL & PRODUK UMKM
        // ==========================================
        $user = $userModel->find($id_user);
        $daftarProduk = $produkModel->where('id_user', $id_user)->findAll();
        $totalProduk = count($daftarProduk);

        // ==========================================
        // 2. AMBIL DATA KONSORSIUM GRUP
        // ==========================================
        $targetFcl = 20000; // Standar target 1 Kontainer FCL

        $keanggotaan = $db->table('Anggota_Konsorsium')
            ->where('id_user', $id_user)
            ->get()
            ->getRowArray();

        if ($keanggotaan) {
            $id_konsorsium = $keanggotaan['id_konsorsium'];

            $konsorsium = $db->table('Konsorsium')
                ->where('id_konsorsium', $id_konsorsium)
                ->get()
                ->getRowArray();

            $anggota = $db->table('Anggota_Konsorsium')
                ->select('Anggota_Konsorsium.*, Users.nama as nama_umkm, Users.email')
                ->join('Users', 'Users.id_user = Anggota_Konsorsium.id_user')
                ->where('Anggota_Konsorsium.id_konsorsium', $id_konsorsium)
                ->get()
                ->getResultArray();

            $totalAnggota   = count($anggota);
            $totalKapasitas = (int) ($konsorsium['total_kapasitas_gabungan'] ?? 0);
            $sisaKuota      = max(0, $targetFcl - $totalKapasitas);
            $persentase     = $targetFcl > 0 ? min(100, round(($totalKapasitas / $targetFcl) * 100)) : 0;
        } else {
            // Fallback jika UMKM belum tergabung konsorsium manapun
            $konsorsium = [
                'nama_konsorsium' => 'Belum Tergabung Konsorsium',
                'target_hs_code'  => '-',
                'status_kuota'    => 'Terbuka'
            ];
            $totalAnggota   = 0;
            $totalKapasitas = 0;
            $sisaKuota      = $targetFcl;
            $persentase     = 0;
            $anggota        = [];
        }

        // ==========================================
        // 3. BUNGKUS DAN KIRIM KE VIEW
        // ==========================================
        $data = [
            'user'           => $user,
            'daftarProduk'   => $daftarProduk,
            'totalProduk'    => $totalProduk,
            'konsorsium'     => $konsorsium,
            'totalAnggota'   => $totalAnggota,
            'totalKapasitas' => $totalKapasitas,
            'targetFcl'      => $targetFcl,
            'sisaKuota'      => $sisaKuota,
            'persentase'     => $persentase,
            'anggota'        => $anggota
        ];

        return view('umkm/dashboard', $data);
    }
}