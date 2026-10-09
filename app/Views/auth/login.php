<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NusaChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4 text-primary fw-bold">Login NusaChain</h3>

                        <!-- Menampilkan Pesan Error atau Success dari Controller -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('login/process') ?>" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Masuk</button>
                        </form>

                        <div class="text-center">
                            <small>Belum punya akun? <a href="<?= base_url('register') ?>" class="text-decoration-none">Daftar di sini</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>