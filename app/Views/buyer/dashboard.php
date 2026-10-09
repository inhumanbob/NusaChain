<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Buyer - NusaChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Dasbor Pengadaan Buyer</h2>
            <span class="text-muted">Pantau status pengiriman pesanan dan ketersediaan kargo FCL.</span>
        </div>
        <a href="/buyer/cari" class="btn btn-danger fw-semibold">+ Eksplorasi Konsorsium Siap Ekspor</a>
    </div>

    <!-- Tabel Status Pesanan Berjalan -->
    <div class="card shadow-sm border-0 p-4">
        <h5 class="fw-bold mb-3">Daftar Transaksi Pesanan Ekspor</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Konsorsium</th>
                        <th>HS Code</th>
                        <th>Volume MOQ</th>
                        <th>Tgl Pengiriman</th>
                        <th>Status Order</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pesanan)): ?>
                        <?php foreach ($pesanan as $p): ?>
                            <tr>
                                <td>#ORD-<?= str_pad($p['id_pesanan'], 4, '0', STR_PAD_LEFT) ?></td>
                                <td class="fw-semibold"><?= esc($p['nama_konsorsium']) ?></td>
                                <td><?= esc($p['target_hs_code']) ?></td>
                                <td><?= number_format($p['total_moq']) ?> Unit</td>
                                <td><?= esc($p['tanggal_pengiriman']) ?></td>
                                <td>
                                    <?php
                                        $badge = match($p['status_pemesanan']) {
                                            'Pending'  => 'bg-warning text-dark',
                                            'Diproses' => 'bg-info text-dark',
                                            'Selesai'  => 'bg-success',
                                            default    => 'bg-secondary'
                                        };
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= esc($p['status_pemesanan']) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi pesanan yang diajukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>