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

        // 1. Ambil Profil UMKM dari database
        $user = $userModel->find($id_user);

        // 2. Ambil seluruh produk milik UMKM ini
        $daftarProduk = $produkModel->where('id_user', $id_user)->findAll();

        // 3. Hitung ringkasan statistik produk
        $totalProduk    = count($daftarProduk);
        $totalKapasitas = 0;
        foreach ($daftarProduk as $p) {
            $totalKapasitas += (int) $p['kapasitas_bulanan'];
        }

        // 4. Cek apakah UMKM sudah tergabung dalam suatu konsorsium
        $konsorsiumUser = $db->table('Anggota_Konsorsium')
            ->select('Anggota_Konsorsium.*, Konsorsium.nama_konsorsium, Konsorsium.target_hs_code, Konsorsium.status_kuota, Konsorsium.total_kapasitas_gabungan')
            ->join('Konsorsium', 'Konsorsium.id_konsorsium = Anggota_Konsorsium.id_konsorsium')
            ->where('Anggota_Konsorsium.id_user', $id_user)
            ->get()
            ->getRowArray();

        // 5. Bungkus data untuk dikirim ke View
        $data = [
            'user'           => $user,
            'daftarProduk'   => $daftarProduk,
            'totalProduk'    => $totalProduk,
            'totalKapasitas' => $totalKapasitas,
            'konsorsium'     => $konsorsiumUser,
        ];

        return view('umkm/dashboard_grup', $data);
    }
}