<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Konsorsium Siap Ekspor - NusaChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Katalog Konsorsium Siap Ekspor</h2>
            <p class="text-muted mb-0">Daftar konsorsium UMKM yang kuota kontainernya sudah terpenuhi (FCL).</p>
        </div>
        <a href="/buyer" class="btn btn-outline-secondary">Kembali ke Dasbor</a>
    </div>

    <!-- Pencarian berdasarkan HS Code -->
    <div class="card p-3 mb-4 shadow-sm border-0">
        <form method="get" action="/buyer/cari" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="hs_code" class="form-control" placeholder="Cari berdasarkan HS Code (contoh: 6204)..." value="<?= esc($keyword ?? '') ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Filter Pencarian</button>
            </div>
        </form>
    </div>

    <!-- Grid Konsorsium Siap Ekspor -->
    <div class="row g-4">
        <?php if (!empty($daftarKonsorsium)): ?>
            <?php foreach ($daftarKonsorsium as $k): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <span class="badge bg-success mb-2">Siap Ekspor (FCL)</span>
                            <h5 class="card-title fw-bold"><?= esc($k['nama_konsorsium']) ?></h5>
                            <p class="text-muted small mb-2">HS Code Target: <strong><?= esc($k['target_hs_code']) ?></strong></p>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between mb-3 small">
                                <span>Volume Terkumpul:</span>
                                <strong class="text-primary"><?= number_format($k['total_kapasitas_gabungan']) ?> Unit</strong>
                            </div>
                            <a href="/buyer/pesan/<?= $k['id_konsorsium'] ?>" class="btn btn-danger w-100 fw-semibold">
                                Buat Pesanan Ekspor
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-4">
                    Belum ada grup konsorsium dengan status siap ekspor yang sesuai kriteria pencarian.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>