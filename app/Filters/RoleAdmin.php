<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Wajib sudah login
        if (! session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Wajib ber-role Admin
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Halaman khusus Administrator.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosongkan
    }
}