<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login'); 
    }

    public function processLogin()
    {
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->where('email', $email)->first();

        if ($user) {
            // Mendukung password bcrypt hash ($2y$10$...) maupun plaintext biasa
            $passwordCocok = password_verify($password, $user['password']) || ($password === $user['password']);

            if ($passwordCocok) {
                // Masukkan data lengkap pengguna ke sesi
                session()->set([
                    'id_user'           => (int) $user['id_user'],
                    'nama'              => $user['nama'],
                    'email'             => $user['email'],
                    'role'              => $user['role'],
                    'status_verifikasi' => $user['status_verifikasi'] ?? 'Pending',
                    'logged_in'         => true,
                ]);

                // Normalisasi role ke huruf kecil untuk penentuan redirect
                $role = strtolower(trim((string) $user['role']));

                if ($role === 'umkm') {
                    return redirect()->to('/umkm/dashboard');
                } elseif ($role === 'buyer') {
                    return redirect()->to('/buyer/dashboard');
                } elseif ($role === 'admin') {
                    return redirect()->to('/admin/dashboard');
                }

                return redirect()->to('/'); 
            }
        }

        session()->setFlashdata('error', 'Alamat email atau kata sandi salah.');
        return redirect()->to('/login')->withInput();
    }

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        // 1. Aturan validasi yang lebih komprehensif
        $rules = [
            'nama'             => [
                'rules'  => 'required|max_length[255]',
                'errors' => ['required' => 'Nama lengkap wajib diisi.']
            ],
            'email'            => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Alamat email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique'   => 'Alamat email ini sudah terdaftar. Silakan gunakan email lain.'
                ]
            ],
            'password'         => [
                'rules'  => 'required|min_length[8]',
                'errors' => ['min_length' => 'Kata sandi minimal 8 karakter.']
            ],
            'role'             => [
                'rules'  => 'required|in_list[UMKM,Buyer]',
                'errors' => ['in_list' => 'Peran (Role) tidak valid.']
            ],
            'nomor_izin_usaha' => 'permit_empty|max_length[100]',
            'dokumen_legal'    => [
                'rules'  => 'required|valid_url',
                'errors' => [
                    'required'  => 'Tautan dokumen legalitas (Google Drive) wajib diisi.',
                    'valid_url' => 'Format tautan dokumen tidak valid (harus berupa URL lengkap diawali https://).'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            // Ambil semua pesan error dari validator, lalu gabungkan jadi satu kalimat
            $errors = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errors);
        }

        $userModel = new UserModel();
        $role      = trim((string) $this->request->getPost('role'));

        $nomorIzin = ($role === 'UMKM') 
            ? trim((string) $this->request->getPost('nib'))
            : trim((string) $this->request->getPost('tax_id'));

        // 2. Simpan Data ke Database
        $data = [
            'nama'              => trim((string) $this->request->getPost('nama')),
            'email'             => trim((string) $this->request->getPost('email')),
            'password'          => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'              => $role,
            'nomor_izin_usaha'  => $nomorIzin,
            'dokumen_legal'     => trim((string) $this->request->getPost('dokumen_legal')),
            'negara_asal'       => trim((string) $this->request->getPost('negara_asal') ?? ''),
            'pelabuhan_tujuan'  => trim((string) $this->request->getPost('pelabuhan_tujuan') ?? ''),
            'status_verifikasi' => 'Pending',
            'trust_score'       => ($role === 'UMKM') ? 50 : 0, // Inisialisasi awal Trust Score (UMKM modal awal 50)
        ];

        $userModel->insert($data);

        return redirect()->to('/login')->with(
            'success', 
            'Registrasi berhasil! Dokumen legalitas Anda telah dikirim dan sedang menunggu verifikasi Administrator.'
        );
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // 1. Menampilkan Form Lupa Sandi (Input Email)
    public function forgotPassword()
    {
        return view('auth/lupa_password');
    }

    // 2. Memproses Pengiriman Email Link Reset
    public function processForgotPassword()
    {
        $email     = trim((string) $this->request->getPost('email'));
        $userModel = new UserModel();
        $user      = $userModel->where('email', $email)->first();

        if ($user) {
            // Generate token acak yang aman
            $token = bin2hex(random_bytes(32));
            // Set kedaluwarsa 30 menit dari sekarang
            $expiresAt = date('Y-m-d H:i:s', strtotime('+30 minutes'));

            // Update user dengan token dan waktu expired
            $userModel->update($user['id_user'], [
                'reset_token'      => $token,
                'reset_expires_at' => $expiresAt,
            ]);

            // --- PROSES KIRIM EMAIL (KONFIGURASI LANGSUNG TLS & TEXT) ---
            $config = [
                'protocol'   => 'smtp',
                'SMTPHost'   => 'smtp.gmail.com',
                'SMTPUser'   => 'rasyaramdan55@gmail.com', 
                'SMTPPass'   => 'lvegefqohkflsevg', 
                'SMTPPort'   => 587,   
                'SMTPCrypto' => 'tls', 
                'mailType'   => 'text', 
                'charset'    => 'utf-8',
                'newline'    => "\r\n",
                'CRLF'       => "\r\n",
            ];

            $emailService = \Config\Services::email();
            $emailService->initialize($config);
            
            $emailService->setFrom('rasyaramdan55@gmail.com', 'NusaChain Support');
            $emailService->setTo($email);
            $emailService->setSubject('Reset Password NusaChain');

            $resetLink = base_url('reset-password/' . $token);
            
            $pesan  = "Halo,\r\n\r\n";
            $pesan .= "Kami menerima permintaan untuk mengatur ulang kata sandi akun NusaChain Anda.\r\n\r\n";
            $pesan .= "Untuk membuat kata sandi baru, silakan salin tautan di bawah ini dan buka di aplikasi browser Anda:\r\n\r\n";
            $pesan .= $resetLink . "\r\n\r\n";
            $pesan .= "Catatan: Tautan ini akan kedaluwarsa dalam waktu 30 menit demi keamanan akun Anda. Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.\r\n\r\n";
            $pesan .= "Hormat kami,\r\nTim Dukungan NusaChain";

            $emailService->setMessage($pesan);

            // Eksekusi pengiriman
            if (! $emailService->send()) {
                $error = $emailService->printDebugger(['headers']);
                die($error); 
            }
        }

        // Tampilkan pesan sukses
        session()->setFlashdata('success', 'Silakan cek di SPAM atau inbox email.');
        return redirect()->to('/lupa-password');
    }

    // 3. Menampilkan Form Input Sandi Baru (Dari Link Email)
    public function resetPassword($token = null)
    {
        $userModel = new UserModel();
        // Cari user yang punya token ini dan waktunya belum expired
        $user = $userModel->where('reset_token', $token)
                          ->where('reset_expires_at >=', date('Y-m-d H:i:s'))
                          ->first();

        if (! $user) {
            session()->setFlashdata('error', 'Tautan reset sandi tidak valid atau telah kedaluwarsa.');
            return redirect()->to('/login');
        }

        return view('auth/reset_password', ['token' => $token]);
    }

    // 4. Memproses Perubahan Sandi ke Database
    public function processResetPassword()
    {
        $token        = $this->request->getPost('token');
        $passwordBaru = (string) $this->request->getPost('password');
        
        $userModel = new UserModel();
        $user      = $userModel->where('reset_token', $token)
                               ->where('reset_expires_at >=', date('Y-m-d H:i:s'))
                               ->first();

        if ($user) {
            $userModel->update($user['id_user'], [
                'password'         => $passwordBaru,
                'reset_token'      => null,
                'reset_expires_at' => null,
            ]);

            session()->setFlashdata('success', 'Kata sandi berhasil diubah! Silakan masuk dengan kata sandi baru Anda.');
            return redirect()->to('/login');
        }

        session()->setFlashdata('error', 'Gagal mereset kata sandi. Silakan coba lagi.');
        return redirect()->to('/lupa-password');
    }

    // Endpoint AJAX untuk validasi akses publik dokumen (Google Drive / URL Dokumen)
    public function cekLinkDokumen()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'     => 'error',
                'pesan'      => 'Permintaan tidak valid.',
                'message'    => 'Permintaan tidak valid.',
                'csrf_token' => csrf_hash(),
            ]);
        }

        $url = trim((string) $this->request->getPost('link_dokumen'));

        if (empty($url) || ! filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->response->setJSON([
                'status'     => 'error',
                'pesan'      => 'Format URL tidak valid (wajib diawali https://).',
                'message'    => 'Format URL tidak valid (wajib diawali https://).',
                'csrf_token' => csrf_hash(),
            ]);
        }

        // Validasi host cloud storage
        $parsed = parse_url($url);
        $host   = strtolower($parsed['host'] ?? '');
        $allowedHosts = ['drive.google.com', 'onedrive.live.com', '1drv.ms', 'dropbox.com'];
        $isValidHost  = false;

        foreach ($allowedHosts as $allowed) {
            if (str_ends_with($host, $allowed) || $host === $allowed) {
                $isValidHost = true;
                break;
            }
        }

        if (! $isValidHost) {
            return $this->response->setJSON([
                'status'     => 'error',
                'pesan'      => 'Tautan harus berasal dari Google Drive, OneDrive, atau Dropbox.',
                'message'    => 'Tautan harus berasal dari Google Drive, OneDrive, atau Dropbox.',
                'csrf_token' => csrf_hash(),
            ]);
        }

        // Pengecekan via cURL yang ramah Google Drive & Localhost
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 7);
        // Bypass sertifikat SSL untuk lingkungan lokal / XAMPP
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // Header User-Agent agar tidak diblokir proteksi bot Google
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36');

        $response     = curl_exec($ch);
        $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);

        // Jika tautan dialihkan ke halaman login akun, berarti izin akses masih privat
        if (str_contains($effectiveUrl, 'accounts.google.com/ServiceLogin') || str_contains($effectiveUrl, 'accounts.google.com/v3/signin')) {
            return $this->response->setJSON([
                'status'     => 'error',
                'pesan'      => 'Tautan masih dibatasi (Private). Ubah akses file ke "Siapa saja yang memiliki link".',
                'message'    => 'Tautan masih dibatasi (Private). Ubah akses file ke "Siapa saja yang memiliki link".',
                'csrf_token' => csrf_hash(),
            ]);
        }

        // Tautan berhasil dijangkau dan berstatus publik
        if ($httpCode >= 200 && $httpCode < 400) {
            return $this->response->setJSON([
                'status'     => 'success',
                'pesan'      => 'Tautan Google Drive valid dan dapat diakses publik.',
                'message'    => 'Tautan Google Drive valid dan dapat diakses publik.',
                'csrf_token' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'status'     => 'error',
            'pesan'      => 'Pastikan link public dan aktif.',
            'message'    => 'Pastikan link public dan aktif.',
            'csrf_token' => csrf_hash(),
        ]);
    }
}