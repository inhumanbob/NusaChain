<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan MOQ - NusaChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 p-4">
                <h3 class="fw-bold mb-1">Form Pemesanan Kontainer (MOQ)</h3>
                <p class="text-muted small mb-4">Konsorsium: <strong><?= esc($konsorsium['nama_konsorsium']) ?></strong> (HS Code: <?= esc($konsorsium['target_hs_code']) ?>)</p>

                <form method="post" action="/buyer/simpan-pesanan">
                    <input type="hidden" name="id_konsorsium" value="<?= $konsorsium['id_konsorsium'] ?>">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Total Target MOQ (Unit / Pcs)</label>
                        <input type="number" name="total_moq" class="form-control" value="<?= esc($konsorsium['total_kapasitas_gabungan']) ?>" required>
                        <div class="form-text">Beban kuota kargo gabungan yang siap diambil dari konsorsium ini.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Target Tanggal Pengiriman Logistik</label>
                        <input type="date" name="tanggal_pengiriman" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/buyer/cari" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-danger px-4 fw-semibold">Konfirmasi & Ajukan Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>