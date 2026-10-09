<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KonsorsiumModel;
use App\Models\PesananEksporModel;

class Buyer extends BaseController
{
    protected $konsorsiumModel;
    protected $pesananModel;

    public function __construct()
    {
        $this->konsorsiumModel = new KonsorsiumModel();
        $this->pesananModel    = new PesananEksporModel();
    }

    // 1. Dasbor Utama Buyer: Menampilkan ringkasan riwayat pesanan aktif
    public function dashboard()
    {
        $idUser = session()->get('id_user') ?? 1; // Fallback ID jika sesi belum aktif

        $db = \Config\Database::connect();
        $pesanan = $db->table('pesanan_ekspor')
            ->select('pesanan_ekspor.*, konsorsium.nama_konsorsium, konsorsium.target_hs_code')
            ->join('konsorsium', 'konsorsium.id_konsorsium = pesanan_ekspor.id_konsorsium')
            ->where('pesanan_ekspor.id_user', $idUser)
            ->orderBy('pesanan_ekspor.id_pesanan', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'pesanan' => $pesanan,
        ];

        return view('buyer/dashboard', $data);
    }

    // 2. Katalog: Menampilkan konsorsium yang kuotanya sudah 'Penuh' (Siap Ekspor)
    public function cariKonsorsium()
    {
        $keyword = $this->request->getGet('hs_code');

        $builder = $this->konsorsiumModel->where('status_kuota', 'Penuh');
        if (!empty($keyword)) {
            $builder->like('target_hs_code', $keyword);
        }

        $data = [
            'daftarKonsorsium' => $builder->findAll(),
            'keyword'          => $keyword,
        ];

        return view('buyer/cari_konsorsium', $data);
    }

    // 3. Form Order: Menampilkan detail konsorsium yang dipilih sebelum checkout
    public function buatPesanan($idKonsorsium)
    {
        $konsorsium = $this->konsorsiumModel->find($idKonsorsium);

        if (!$konsorsium) {
            return redirect()->to('/buyer/cari')->with('error', 'Konsorsium tidak ditemukan.');
        }

        $data = [
            'konsorsium' => $konsorsium,
        ];

        return view('buyer/buat_pesanan', $data);
    }

    // 4. Proses Simpan Pesanan Ekspor
    public function simpanPesanan()
    {
        $idUser        = session()->get('id_user') ?? 1;
        $idKonsorsium  = $this->request->getPost('id_konsorsium');
        $totalMoq      = $this->request->getPost('total_moq');
        $tglPengiriman = $this->request->getPost('tanggal_pengiriman');

        if (!$idKonsorsium || !$totalMoq || !$tglPengiriman) {
            return redirect()->back()->with('error', 'Semua data formulir wajib diisi.');
        }

        $this->pesananModel->insert([
            'id_user'            => $idUser,
            'id_konsorsium'      => $idKonsorsium,
            'total_moq'          => $totalMoq,
            'tanggal_pengiriman' => $tglPengiriman,
            'status_pemesanan'   => 'Pending',
            'trust_score'        => 85, // Nilai acuan default awal
        ]);

        return redirect()->to('/buyer')->with('success', 'Pesanan ekspor berhasil dibuat dan menunggu konfirmasi pengiriman.');
    }
}