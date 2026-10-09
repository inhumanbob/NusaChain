<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        
        // Ambil data produk yang HANYA milik UMKM yang sedang login
        $id_user = session()->get('id_user');
        $data['produk'] = $produkModel->where('id_user', $id_user)->findAll();

        return view('umkm/input_barang', $data);
    }

    public function simpan()
    {
        $produkModel = new ProdukModel();
        $data = [
            'id_user'           => session()->get('id_user'), 
            'nama_produk'       => $this->request->getPost('nama_produk'),
            'hs_code'           => $this->request->getPost('hs_code'),
            'kapasitas_bulanan' => $this->request->getPost('kapasitas_bulanan'),
            'satuan'            => $this->request->getPost('satuan'),
        ];
        $produkModel->insert($data);

        return redirect()->to('/umkm/produk')->with('success', 'Data barang berhasil ditambahkan ke sistem!');
    }

    // FUNGSI UNTUK MENGHAPUS DATA
    public function hapus($id)
    {
        $produkModel = new ProdukModel();
        
        // Keamanan ekstra: Pastikan UMKM hanya bisa menghapus barangnya sendiri
        $produkModel->where('id_user', session()->get('id_user'))->delete($id);
        
        return redirect()->to('/umkm/produk')->with('success', 'Data barang berhasil dihapus!');
    }

    // FUNGSI UNTUK MENAMPILKAN FORM EDIT
    public function edit($id)
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->where('id_user', session()->get('id_user'))->find($id);

        // Jika user mencoba iseng mengganti ID di URL dengan barang milik orang lain
        if (!$data['produk']) {
            return redirect()->to('/umkm/produk')->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
        }

        return view('umkm/edit_barang', $data);
    }

    // FUNGSI UNTUK MENYIMPAN PERUBAHAN EDIT
    public function update($id)
    {
        $produkModel = new ProdukModel();
        $data = [
            'nama_produk'       => $this->request->getPost('nama_produk'),
            'hs_code'           => $this->request->getPost('hs_code'),
            'kapasitas_bulanan' => $this->request->getPost('kapasitas_bulanan'),
            'satuan'            => $this->request->getPost('satuan'),
        ];
        
        $produkModel->where('id_user', session()->get('id_user'))->update($id, $data);
        return redirect()->to('/umkm/produk')->with('success', 'Data barang berhasil diperbarui!');
    }
}