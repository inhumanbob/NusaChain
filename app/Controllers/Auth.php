<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login'); // Nanti kita buat view-nya
    }

    public function processLogin()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && $password === $user['password']) {
            $sessionData = [
                'id_user'    => $user['id_user'],
                'nama'       => $user['nama'],
                'role'       => $user['role'],
                'isLoggedIn' => true
            ];
            session()->set($sessionData);

            // Redirect sesuai role
            if ($user['role'] === 'UMKM') {
                return redirect()->to('/umkm/dashboard');
            } elseif ($user['role'] === 'Buyer') {
                return redirect()->to('/buyer/dashboard');
            } else {
                return redirect()->to('/admin/dashboard');
            }
        }

        return redirect()->back()->with('error', 'Email atau Password salah.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $userModel = new UserModel();

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'), // Pilihan UMKM atau Buyer
        ];

        $userModel->save($data);
        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}