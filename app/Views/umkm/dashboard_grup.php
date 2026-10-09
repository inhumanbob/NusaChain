<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Konsorsium - <?= esc($konsorsium['nama_konsorsium']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-stat { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .progress-fcl { height: 26px; border-radius: 13px; }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0"><?= esc($konsorsium['nama_konsorsium']) ?></h2>
            <span class="text-muted">Target HS Code: <strong><?= esc($konsorsium['target_hs_code']) ?></strong></span>
        </div>
        <span class="badge <?= $konsorsium['status_kuota'] === 'Penuh' ? 'bg-success' : 'bg-warning text-dark' ?> fs-6 px-3 py-2">
            Status: <?= esc($konsorsium['status_kuota']) ?>
        </span>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-stat p-3 text-center bg-white">
                <span class="text-muted">Total Anggota</span>
                <h2 class="fw-bold text-primary mb-0"><?= $totalAnggota ?> UMKM</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat p-3 text-center bg-white">
                <span class="text-muted">Volume Terkumpul</span>
                <h2 class="fw-bold text-success mb-0"><?= number_format($totalKapasitas) ?> <small class="fs-6 text-muted">/ <?= number_format($targetFcl) ?></small></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat p-3 text-center bg-white">
                <span class="text-muted">Sisa Kuota Kurang</span>
                <h2 class="fw-bold text-danger mb-0"><?= number_format($sisaKuota) ?> Unit</h2>
            </div>
        </div>
    </div>

    <!-- Progress Bar Keterisian Kontainer (FCL) -->
    <div class="card card-stat p-4 mb-4 bg-white">
        <div class="d-flex justify-content-between mb-2">
            <strong class="text-secondary">Progress Pengisian Kontainer (FCL)</strong>
            <strong class="text-primary"><?= $persentase ?>% Terpenuhi</strong>
        </div>
        <div class="progress progress-fcl mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated <?= $persentase >= 100 ? 'bg-success' : 'bg-primary' ?>" 
                 role="progressbar" 
                 style="width: <?= $persentase ?>%;">
                 <?= $persentase ?>%
            </div>
        </div>
        <small class="text-muted">
            <?= $persentase >= 100 
                ? 'Kontainer penuh! Konsorsium siap diajukan ke katalog pemesanan Buyer.' 
                : 'Menunggu penambahan kuota dari UMKM lain untuk mencapai standar ekspor 1 kontainer penuh.' ?>
        </small>
    </div>

    <!-- Tabel Anggota Tergabung -->
    <div class="card card-stat p-4 bg-white">
        <h5 class="fw-bold mb-3">Daftar Anggota Konsorsium</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama UMKM</th>
                        <th>Email Kontak</th>
                        <th>Kontribusi Kapasitas</th>
                        <th>Tanggal Gabung</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($anggota)): ?>
                        <?php foreach ($anggota as $index => $row): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="fw-semibold"><?= esc($row['nama_umkm']) ?></td>
                                <td><?= esc($row['email']) ?></td>
                                <td><span class="badge bg-info text-dark"><?= number_format($row['kontribusi_kapasitas']) ?> Unit</span></td>
                                <td><?= esc($row['tanggal_bergabung']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Belum ada anggota di konsorsium ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>