<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor UMKM - NusaChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-stat { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('umkm/dashboard') ?>">NusaChain</a>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white">Halo, <strong><?= esc($user['nama']) ?></strong></span>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Keluar</a>
        </div>
    </div>
</nav>

<div class="container py-2">

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Bagian 1: Profil UMKM & Status Konsorsium -->
    <div class="row g-4 mb-4">
        <!-- Kartu Profil -->
        <div class="col-md-6">
            <div class="card card-stat p-4 bg-white h-100">
                <h5 class="fw-bold text-primary mb-3">Profil Pelaku Usaha</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><strong>Nama Usaha / Perusahaan:</strong> <?= esc($user['nama']) ?></li>
                    <li class="mb-2"><strong>Email Kontak:</strong> <?= esc($user['email']) ?></li>
                    <li class="mb-2"><strong>Peran Akses:</strong> <span class="badge bg-secondary"><?= esc($user['role']) ?></span></li>
                    <li class="mb-2"><strong>Lokasi / Koordinat:</strong> <?= esc($user['koordinat_lokasi'] ?? 'Belum diatur') ?></li>
                    <li>
                        <strong>Trust Score:</strong> 
                        <span class="badge bg-success fs-6"><?= esc($user['trust_score']) ?> Poin</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Kartu Status Konsorsium Logistik -->
        <div class="col-md-6">
            <div class="card card-stat p-4 bg-white h-100">
                <h5 class="fw-bold text-primary mb-3">Status Konsorsium Digital</h5>
                <?php if ($konsorsium) : ?>
                    <div class="alert alert-info mb-3">
                        Anda telah tergabung dalam konsorsium ekspor!
                    </div>
                    <ul class="list-unstyled mb-3">
                        <li class="mb-2"><strong>Nama Konsorsium:</strong> <?= esc($konsorsium['nama_konsorsium']) ?></li>
                        <li class="mb-2"><strong>Target HS Code:</strong> <code><?= esc($konsorsium['target_hs_code']) ?></code></li>
                        <li class="mb-2"><strong>Kontribusi Anda:</strong> <?= number_format($konsorsium['kontribusi_kapasitas']) ?> Unit</li>
                        <li><strong>Status Kuota Kontainer:</strong> <span class="badge bg-warning text-dark"><?= esc($konsorsium['status_kuota']) ?></span></li>
                    </ul>
                    <a href="<?= base_url('konsorsium/dashboard/' . $konsorsium['id_konsorsium']) ?>" class="btn btn-outline-primary btn-sm">Lihat Detail Pengisian Kontainer</a>
                <?php else : ?>
                    <div class="text-center py-4">
                        <p class="text-muted mb-3">Anda belum tergabung dalam konsorsium pengiriman mana pun.</p>
                        <a href="<?= base_url('umkm/produk') ?>" class="btn btn-primary btn-sm">Input & Ajukan Produk Sekarang</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bagian 2: Ringkasan Produk (Statistik Data Real) -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card card-stat p-3 text-center bg-white">
                <span class="text-muted">Total Varian Produk Terdaftar</span>
                <h2 class="fw-bold text-primary mb-0"><?= $totalProduk ?> Produk</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-stat p-3 text-center bg-white">
                <span class="text-muted">Akumulasi Kapasitas Produksi Bulanan</span>
                <h2 class="fw-bold text-success mb-0"><?= number_format($totalKapasitas) ?> Unit</h2>
            </div>
        </div>
    </div>

    <!-- Bagian 3: Tabel Ringkasan Produk yang Telah Diinput -->
    <div class="card card-stat p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Ringkasan Produk Terdaftar</h5>
            <a href="<?= base_url('umkm/produk') ?>" class="btn btn-primary btn-sm">+ Tambah / Kelola Produk</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>HS Code</th>
                        <th>Kapasitas Bulanan</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($daftarProduk)) : ?>
                        <?php $no = 1; foreach ($daftarProduk as $item) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-semibold"><?= esc($item['nama_produk']) ?></td>
                                <td><code><?= esc($item['hs_code']) ?></code></td>
                                <td><?= number_format($item['kapasitas_bulanan']) ?></td>
                                <td><span class="badge bg-secondary"><?= esc($item['satuan']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada data produk yang diinput. Silakan klik tombol <strong>+ Tambah / Kelola Produk</strong> di atas.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>