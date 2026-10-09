<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NusaChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm mt-4 mb-4">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4 text-primary fw-bold">Daftar Akun</h3>

                        <form action="<?= base_url('register/process') ?>" method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap / Perusahaan</label>
                                <input type="text" class="form-control" id="nama" name="nama" required placeholder="Contoh: PT. Danantara">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email aktif">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Buat password">
                            </div>
                            <div class="mb-4">
                                <label for="role" class="form-label">Daftar Sebagai</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" disabled selected>Pilih peran...</option>
                                    <option value="UMKM">UMKM (Pengirim Barang)</option>
                                    <option value="Buyer">Buyer (Pembeli Global)</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary w-100 mb-3">Daftar Sekarang</button>
                        </form>

                        <div class="text-center">
                            <small>Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-decoration-none">Login di sini</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>