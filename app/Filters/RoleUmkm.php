<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleUmkm implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek role menggunakan huruf kecil semua agar tidak salah paham
        if (strtolower(session()->get('role')) !== 'umkm') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Halaman ini khusus UMKM.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Jangan diisi
    }
}