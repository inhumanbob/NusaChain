<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang - NusaChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-warning mb-4">Edit Data Barang</h4>

                    <form action="<?= base_url('umkm/produk/update/'.$produk['id_produk']) ?>" method="POST">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= esc($produk['nama_produk']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="hs_code" class="form-label">HS Code (Kode Kepabeanan)</label>
                            <input type="text" class="form-control" id="hs_code" name="hs_code" value="<?= esc($produk['hs_code']) ?>" required>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label for="kapasitas_bulanan" class="form-label">Kapasitas Produksi Bulanan</label>
                                <input type="number" class="form-control" id="kapasitas_bulanan" name="kapasitas_bulanan" value="<?= esc($produk['kapasitas_bulanan']) ?>" required min="1">
                            </div>
                            <div class="col-md-4">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    <option value="Kg" <?= $produk['satuan'] == 'Kg' ? 'selected' : '' ?>>Kg</option>
                                    <option value="Ton" <?= $produk['satuan'] == 'Ton' ? 'selected' : '' ?>>Ton</option>
                                    <option value="Pcs" <?= $produk['satuan'] == 'Pcs' ? 'selected' : '' ?>>Pcs</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('umkm/produk') ?>" class="btn btn-outline-secondary">Batal Edit</a>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>