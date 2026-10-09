<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusaChain - Platform Logistik B2B</title>
    <!-- Memuat Bootstrap 5 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body class="text-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold text-primary mb-3">NusaChain</h1>
                <p class="lead text-secondary mb-5">
                    Platform Konsolidasi Logistik B2B. Solusi pintar bagi UMKM untuk memenuhi Minimum Order Quantity (MOQ) pembeli global dan menekan ongkos kirim melalui pengiriman Full Container Load (FCL).
                </p>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                    <!-- Tombol diarahkan ke route /login dan /register -->
                    <a href="<?= base_url('login') ?>" class="btn btn-primary btn-lg px-4 gap-3">Login</a>
                    <a href="<?= base_url('register') ?>" class="btn btn-outline-primary btn-lg px-4">Daftar Akun</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>