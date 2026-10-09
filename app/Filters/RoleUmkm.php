<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleUmkm implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'UMKM') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Halaman ini khusus UMKM.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}