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
        $userModel = new UserModel();
        $role      = trim((string) $this->request->getPost('role'));
        $email     = trim((string) $this->request->getPost('email'));

        if (! in_array($role, ['UMKM', 'Buyer'], true)) {
            return redirect()->back()->withInput()->with('error', 'Pilihan peran tidak valid.');
        }

        if ($userModel->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('error', 'Alamat email sudah terdaftar.');
        }

        // Ambil dan validasi format tautan dokumen legalitas (URL Google Drive / Cloud)
        $dokumenLegal = trim((string) $this->request->getPost('dokumen_legal'));
        if (empty($dokumenLegal) || ! filter_var($dokumenLegal, FILTER_VALIDATE_URL)) {
            return redirect()->back()->withInput()->with('error', 'Tautan dokumen legalitas wajib diisi dengan format URL yang valid (diawali https://).');
        }

        $nomorIzin = ($role === 'UMKM') 
            ? trim((string) $this->request->getPost('nib'))
            : trim((string) $this->request->getPost('tax_id'));

        $data = [
            'nama'              => trim((string) $this->request->getPost('nama')),
            'email'             => $email,
            'password'          => (string) $this->request->getPost('password'),
            'role'              => $role,
            'nomor_izin_usaha'  => $nomorIzin,
            'dokumen_legal'     => $dokumenLegal, // Menyimpan teks URL langsung ke database
            'negara_asal'       => trim((string) $this->request->getPost('negara_asal')),
            'pelabuhan_tujuan'  => trim((string) $this->request->getPost('pelabuhan_tujuan')),
            'status_verifikasi' => 'Pending',
            'trust_score'       => 0,
        ];

        $userModel->save($data);

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
        $url = trim((string) $this->request->getPost('url'));

        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->response->setJSON([
                'status'  => 'invalid',
                'message' => 'Format URL tidak valid. Sertakan https:// diawal tautan.'
            ]);
        }

        // Jalankan cURL untuk memeriksa apakah dokumen dapat diakses tanpa login
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 6,
            CURLOPT_TIMEOUT        => 8,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            CURLOPT_NOBODY         => true, // Cukup ambil header respon agar ringan dan cepat
        ]);

        curl_exec($ch);
        $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $effectiveUrl = (string) curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $curlError    = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return $this->response->setJSON([
                'status'  => 'invalid',
                'message' => 'Tautan tidak dapat dijangkau oleh server. Periksa kembali alamat URL.'
            ]);
        }

        // Jika Google Drive masih privat, tautan akan dialihkan ke halaman login akun Google
        if (str_contains($effectiveUrl, 'accounts.google.com') || str_contains($effectiveUrl, 'ServiceLogin')) {
            return $this->response->setJSON([
                'status'  => 'private',
                'message' => 'Tautan Google Drive masih bersifat privat (memerlukan login). Ubah izin akses menjadi "Siapa saja yang memiliki link" (Anyone with the link).'
            ]);
        }

        if ($httpCode >= 200 && $httpCode < 400) {
            return $this->response->setJSON([
                'status'  => 'valid',
                'message' => 'Tautan publik valid! Dokumen dapat dibuka oleh Administrator.'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'private',
            'message' => "Tautan mengembalikan status HTTP {$httpCode}. Pastikan berkas terbuka untuk umum."
        ]);
    }
}