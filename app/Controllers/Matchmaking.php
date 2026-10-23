// <?php
// 
// namespace App\Controllers;
// 
// use App\Controllers\BaseController;
// use App\Models\KonsorsiumModel;
// use App\Models\AnggotaKonsorsiumModel;
// use App\Models\ProdukModel;
// 
// class Matchmaking extends BaseController
// {
//     protected $konsorsiumModel;
//     protected $anggotaModel;
//     protected $produkModel;
// 
//     // Disamakan dengan standar sistem yang lain
//     const TARGET_FCL = 20000; 
// 
//     public function __construct()
//     {
//         $this->konsorsiumModel = new KonsorsiumModel();
//         $this->anggotaModel    = new AnggotaKonsorsiumModel();
//         $this->produkModel     = new ProdukModel();
//     }
// 
//     public function prosesClustering($idProduk)
//     {
//         $produk = $this->produkModel->find($idProduk);
// 
//         if (!$produk) {
//             return redirect()->back()->with('error', 'Data produk tidak ditemukan.');
//         }
// 
//         $kapasitas = (int) $produk['kapasitas_bulanan'];
//         $hsCode    = $produk['hs_code'];
//         $idUser    = $produk['id_user'];
// 
//         // Kondisi 1: Jika kapasitas >= MOQ -> arahkan ke Dasbor Mandiri
//         if ($kapasitas >= self::TARGET_FCL) {
//             return redirect()->to('/umkm/dashboard-mandiri')->with('info', 'Kapasitas Anda mencukupi untuk ekspor mandiri.');
//         }
// 
//         // Kondisi 2: Jika kapasitas < MOQ -> cari konsorsium aktif (HS Code sama & kuota terbuka)
//         $grupCocok = $this->konsorsiumModel
//             ->where('target_hs_code', $hsCode)
//             ->where('status_kuota', 'Terbuka')
//             ->first();
// 
//         $db = \Config\Database::connect();
//         $db->transStart();
// 
//         if ($grupCocok) {
//             // Gunakan konsorsium yang cocok berdasarkan HS Code.
//             $idKonsorsium = (int) $grupCocok['id_konsorsium'];
// 
//         } else {
//             // Buat konsorsium baru jika belum ada yang cocok.
//             // Trigger MySQL akan menghitung kapasitas setelah anggota ditambahkan.
//             $idKonsorsium = $this->konsorsiumModel->insert([
//                 'nama_konsorsium' => 'Konsorsium '
//                     . $produk['nama_produk']
//                     . ' #'
//                     . rand(100, 999),
// 
//                 'target_hs_code'           => $hsCode,
//                 'total_kapasitas_gabungan' => 0,
//                 'status_kuota'             => 'Terbuka',
//             ]);
// 
//             if (!$idKonsorsium) {
//                 $db->transRollback();
// 
//                 return redirect()->back()->with(
//                     'error',
//                     'Gagal membuat konsorsium baru.'
//                 );
//             }
//         }
// 
//         // Catat UMKM ke tabel anggota konsorsium
//         // Momen insert inilah yang akan membangunkan Trigger after_insert_anggota di MySQL
//         // Masukkan UMKM ke dalam konsorsium.
//         // Trigger MySQL memperbarui total_kapasitas_gabungan.
//         $hasilInsert = $this->anggotaModel->insert([
//             'id_konsorsium' => $idKonsorsium,
//             'id_user' => $idUser,
//             'kontribusi_kapasitas' => $kapasitas,
//             'tanggal_bergabung' => date('Y-m-d'),
//         ]);
// 
//         if ($hasilInsert === false) {
//             $db->transRollback();
// 
//             return redirect()->back()->with(
//                 'error',
//                 'Gagal menambahkan UMKM ke konsorsium.'
//             );
//         }
// 
//         // PENTING: letakkan setelah insert anggota,
//         // ketika trigger MySQL sudah memperbarui kapasitas.
//         $this->konsorsiumModel->sinkronkanStatusKuota(
//             (int) $idKonsorsium,
//             self::TARGET_FCL
//         );
// 
//         $db->transComplete();
// 
//         return redirect()->to('/umkm/dashboard')->with('success', 'Kargo berhasil dikonsolidasikan ke grup.');
//     }
// }