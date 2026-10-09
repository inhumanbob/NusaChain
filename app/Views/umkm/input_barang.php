<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Barang - NusaChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-primary mb-4">Input Data Barang Ekspor</h4>

                    <!-- Notifikasi Sukses -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('umkm/produk/simpan') ?>" method="POST">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required placeholder="Contoh: Kopi Robusta Sangrai">
                        </div>

                        <div class="mb-3">
                            <label for="hs_code" class="form-label">HS Code (Kode Kepabeanan)</label>
                            <input type="text" class="form-control" id="hs_code" name="hs_code" required placeholder="Contoh: 09012120">
                            <div class="form-text">Pastikan HS Code valid agar lolos verifikasi Bea Cukai.</div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label for="kapasitas_bulanan" class="form-label">Kapasitas Produksi Bulanan</label>
                                <input type="number" class="form-control" id="kapasitas_bulanan" name="kapasitas_bulanan" required min="1">
                            </div>
                            <div class="col-md-4">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    <option value="Kg">Kilogram (Kg)</option>
                                    <option value="Ton">Ton</option>
                                    <option value="Pcs">Pcs</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('umkm/dashboard') ?>" class="btn btn-outline-secondary">Kembali ke Dasbor</a>
                            <button type="submit" class="btn btn-primary">Simpan Data Barang</button>
                        </div>
                    </form>
                    <!-- ... Kode Form Input sebelumnya ... -->
                    </form>

                    <!-- BATAS TAMBAHAN TABEL DAFTAR BARANG (READ, UPDATE, DELETE) -->
                    <hr class="my-5">
                    <h5 class="fw-bold text-primary mb-3">Daftar Barang Saya</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>HS Code</th>
                                    <th>Kapasitas Bulanan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($produk)): ?>
                                    <?php $i = 1; foreach ($produk as $row): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td class="fw-semibold"><?= esc($row['nama_produk']) ?></td>
                                        <td><code><?= esc($row['hs_code']) ?></code></td>
                                        <td><?= number_format($row['kapasitas_bulanan']) ?> <?= esc($row['satuan']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('umkm/produk/edit/'.$row['id_produk']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <!-- Fitur Konfirmasi Hapus via Javascript -->
                                            <a href="<?= base_url('umkm/produk/hapus/'.$row['id_produk']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada barang yang didaftarkan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>