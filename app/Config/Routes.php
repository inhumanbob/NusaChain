<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Rute Landing Page
$routes->get('/', 'Home::index');

// Rute Publik Eksplorasi Konsorsium (public)
$routes->get('eksplor', 'Home::eksplor');

// ---------------------------------------------------------
// 1. Rute Autentikasi (Publik)
// ---------------------------------------------------------
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::processLogin');
$routes->get('register', 'Auth::register');
$routes->post('register/process', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');

// Rute AJAX Validasi Tautan Dokumen Publik (Google Drive / Cloud)
$routes->post('auth/cek-dokumen', 'Auth::cekLinkDokumen');

// Rute Lupa Password
$routes->get('lupa-password', 'Auth::forgotPassword');
$routes->post('lupa-password/process', 'Auth::processForgotPassword');

// Rute Reset Password (dibuka via link email)
$routes->get('reset-password/(:any)', 'Auth::resetPassword/$1');
$routes->post('reset-password/process', 'Auth::processResetPassword');


// ---------------------------------------------------------
// 2. Rute Khusus UMKM (Fokus Backend 1)
// Dilindungi oleh filter 'roleUmkm'
// ---------------------------------------------------------
$routes->group('umkm', ['filter' => 'roleUmkm'], static function ($routes) {
    $routes->get('dashboard', 'Umkm::dashboard');

    // Profil & Peta Lokasi
    $routes->get('profil', 'Umkm::profil');
    $routes->post('updateProfile', 'Umkm::updateProfile');

    // Rute Produk
    $routes->get('produk', 'Produk::index');
    $routes->post('produk/simpan', 'Produk::simpan');
    $routes->post('produk/hapus/(:num)', 'Produk::hapus/$1');
    $routes->get('produk/edit/(:num)', 'Produk::edit/$1');
    $routes->post('produk/update/(:num)', 'Produk::update/$1');

    // Rute Status Pesanan oleh UMKM (Izin ubah ke Diproses)
    $routes->get('pesanan/status/(:num)/(:alpha)', 'Umkm::updateStatusPesananUmkm/$1/$2');
});

// Halaman konsorsium milik UMKM (URL tetap /konsorsium/detail)
$routes->group('konsorsium', ['filter' => 'roleUmkm'], static function ($routes) {
    $routes->get('detail', 'Konsorsium::detail');
});


// ---------------------------------------------------------
// 3. Rute Khusus Buyer (Fokus Backend 2)
// Dilindungi oleh filter 'roleBuyer'
// ---------------------------------------------------------
$routes->group('buyer', ['filter' => 'roleBuyer'], static function ($routes) {
    $routes->get('', 'Buyer::dashboard');
    $routes->get('dashboard', 'Buyer::dashboard');

    // Profil Buyer
    $routes->get('profil', 'Buyer::profil');
    $routes->post('updateProfile', 'Buyer::updateProfile');

    $routes->get('cari', 'Buyer::cariKonsorsium');
    $routes->get('pesan/(:num)', 'Buyer::buatPesanan/$1');
    $routes->post('simpan-pesanan', 'Buyer::simpanPesanan');

    // RUTE BARU: Pembayaran Escrow (Kirim Tautan Bukti Transfer)
    $routes->post('pesanan/bayar', 'Buyer::unggahBuktiBayar');
    
    // Rute Konfirmasi Pesanan Diterima oleh Buyer (Selesai & Tambah Trust Score)
    $routes->get('pesananDiterima/(:num)', 'Buyer::pesananDiterima/$1');
});


// ---------------------------------------------------------
// 4. Rute Khusus Administrator
// Dilindungi oleh filter 'roleAdmin'
// ---------------------------------------------------------
$routes->group('admin', ['filter' => 'roleAdmin'], static function ($routes) {
    $routes->get('', 'Admin::dashboard');
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('verifikasi/(:num)/(:alpha)', 'Admin::prosesVerifikasi/$1/$2');
    $routes->get('kargo/kirim/(:num)', 'Admin::berangkatkanKargo/$1');

    // RUTE BARU: Verifikasi Dana Rekening Bersama (Escrow) Konsolidator
    $routes->get('pembayaran/verifikasi/(:num)', 'Admin::verifikasiPembayaran/$1');
});