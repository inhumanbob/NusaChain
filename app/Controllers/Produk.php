<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    public function index()
    {
        return view('umkm/input_barang');
    }

    public function simpan()
    {
        $produkModel = new ProdukModel();
        
        // Menangkap data dari form
        $data = [
            // id_user diambil otomatis dari session orang yang sedang login
            'id_user'           => session()->get('id_user'), 
            'nama_produk'       => $this->request->getPost('nama_produk'),
            'hs_code'           => $this->request->getPost('hs_code'),
            'kapasitas_bulanan' => $this->request->getPost('kapasitas_bulanan'),
            'satuan'            => $this->request->getPost('satuan'),
        ];

        // Simpan ke database
        $produkModel->insert($data);

        // Kembalikan ke halaman form dengan pesan sukses
        return redirect()->to('/umkm/produk')->with('success', 'Data barang berhasil ditambahkan ke sistem!');
    }
}