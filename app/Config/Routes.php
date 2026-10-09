<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Rute Landing Page
$routes->get('/', 'Home::index');

// ---------------------------------------------------------
// 1. Rute Autentikasi (Publik)
// ---------------------------------------------------------
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::processLogin');
$routes->get('register', 'Auth::register');
$routes->post('register/process', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');

// ---------------------------------------------------------
// 2. Rute Khusus UMKM (Fokus Backend 1)
// Dilindungi oleh filter 'roleUmkm'
// ---------------------------------------------------------
$routes->group('umkm', ['filter' => 'roleUmkm'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('produk', 'Produk::index');
    // Tambahkan rute CRUD produk UMKM di sini nanti
});

// ---------------------------------------------------------
// 3. Rute Khusus Buyer (Fokus Backend 2)
// Dilindungi oleh filter 'roleBuyer'
// ---------------------------------------------------------
$routes->group('buyer', ['filter' => 'roleBuyer'], static function ($routes) {
    $routes->get('', 'Buyer::dashboard');
    $routes->get('cari', 'Buyer::cariKonsorsium');
    $routes->get('pesan/(:num)', 'Buyer::buatPesanan/$1');
    $routes->post('simpan-pesanan', 'Buyer::simpanPesanan');
});

// ---------------------------------------------------------
// 4. Rute Sistem Engine / Matchmaking
// ---------------------------------------------------------
$routes->get('matchmaking/proses/(:num)', 'Matchmaking::prosesClustering/$1');
$routes->get('konsorsium/dashboard/(:num)', 'Konsorsium::dashboard/$1');