<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NusaChain</title>

    <link rel="icon" href="<?= base_url('assets/img/icon.png') ?>" type="image/png">
    <!-- Memuat Font Google: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Memuat Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Palet Warna NusaChain */
        :root {
            --royal-blue: #10499D;
            --deep-blue: #0B4599;
            --white: #FFFFFF;
            --ice-blue: #F3F6FB;
            --slate: #334155;
        }

        body, html {
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            color: var(--slate);
            overflow-x: hidden;
        }

        /* SISI KIRI: GAMBAR & BRANDING */
        .login-image-side {
            background: linear-gradient(
                rgba(16, 73, 157, 0.5),
                rgba(11, 69, 153, 0.7)
            ), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            position: relative;
        }

        /* SISI KANAN: FORM LOGIN */
        .login-form-side {
            min-height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            background-color: var(--white);
        }

        .form-wrapper {
            width: 100%;
            max-width: 400px;
        }

        /* Posisi Logo di Pojok Kiri Atas Panel Form */
        .brand-logo-wrapper {
            position: absolute;
            top: 40px;
            left: 50px;
            width: calc(100% - 100px);
        }

        .brand-logo-wrapper img {
            height: 40px;
            width: auto;
            object-fit: contain;
            transform: scale(1.6);
            transform-origin: left center;
        }

        /* Tautan Kembali ke Beranda */
        .btn-back-home {
            position: absolute;
            top: 40px;
            right: 40px;
            color: var(--slate);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back-home:hover {
            color: var(--royal-blue);
        }

        /* Input Form */
        .form-control-custom {
            border-radius: 8px;
            padding: 12px 16px;
            border: 1px solid #CBD5E1;
            font-size: 0.95rem;
            color: var(--slate);
            background-color: #F8FAFC;
        }

        .form-control-custom:focus {
            background-color: var(--white);
            box-shadow: 0 0 0 3px rgba(16, 73, 157, 0.15);
            border-color: var(--royal-blue);
        }

        .form-label {
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--slate);
        }

        /* Tombol Utama */
        .btn-utama {
            background-color: var(--royal-blue) !important;
            color: var(--white) !important;
            border: none !important;
            padding: 12px 24px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-utama:hover {
            background-color: var(--deep-blue) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 73, 157, 0.2);
        }

        /* Responsif untuk HP dan tablet */
        @media (max-width: 991px) {
            .login-form-side {
                min-height: 100vh;
                height: auto;
                padding: 2rem 1.5rem;
            }

            .brand-logo-wrapper {
                position: static;
                width: 100%;
                margin-bottom: 2rem;
                display: flex;
                justify-content: center;
                left: auto;
            }

            .brand-logo-wrapper img {
                transform: scale(1.3);
                transform-origin: center center;
            }

            .btn-back-home {
                display: none;
            }
        }

        /* Animasi Lembut */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-up {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">

            <!-- KOLOM KIRI: GAMBAR & BRANDING (hanya tampil di desktop) -->
            <div class="col-lg-7 d-none d-lg-block p-0">
                <div class="login-image-side d-flex align-items-center justify-content-center">
                    <div class="text-center px-5 animate-up delay-2" style="max-width: 650px;">
                        <h2 class="text-white fw-bold mb-3 display-6">Kolaborasi untuk Skala Global</h2>
                        <p class="text-white opacity-75 fs-5">
                            Konsolidasi kargo mempermudah UMKM mencapai Minimum Order Quantity (MOQ) pembeli internasional dengan efisiensi biaya yang jauh lebih baik.
                        </p>

                        <!-- Badge Informasi -->
                        <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                            <span class="badge bg-white text-dark rounded-pill py-2 px-4 fw-semibold shadow-sm" style="font-size: 0.9rem;">
                                <i class="fas fa-ship me-2" style="color: var(--royal-blue);"></i> Pengiriman FCL
                            </span>
                            <span class="badge bg-white text-dark rounded-pill py-2 px-4 fw-semibold shadow-sm" style="font-size: 0.9rem;">
                                <i class="fas fa-handshake me-2 text-success"></i> B2B Matchmaking
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: FORM LOGIN -->
            <div class="col-12 col-lg-5 login-form-side">
                <!-- Logo NusaChain -->
                <div class="brand-logo-wrapper text-lg-start text-center">
                    <a href="<?= base_url('/') ?>">
                        <img src="<?= base_url('assets/img/logo-horizontal1.png') ?>" alt="Logo NusaChain">
                    </a>
                </div>

                <!-- Tautan kembali ke Beranda -->
                <a href="<?= base_url('/') ?>" class="btn-back-home d-none d-lg-flex">
                    <i class="fas fa-arrow-left"></i> Beranda
                </a>

                <!-- Area Utama Form -->
                <div class="form-wrapper animate-up">
                    <div class="mb-5 text-center text-lg-start">
                        <h2 class="fw-bold mb-2" style="color: #000000;">Selamat Datang!</h2>
                        <p class="text-secondary" style="font-size: 1.05rem;">Silakan masuk menggunakan akun UMKM atau Buyer Anda.</p>
                    </div>

                    <!-- Notifikasi Alert -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" style="border-radius: 8px; font-size: 0.9rem;">
                            <i class="fas fa-exclamation-circle me-1"></i> <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" style="border-radius: 8px; font-size: 0.9rem;">
                            <i class="fas fa-check-circle me-1"></i> <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form Autentikasi -->
                    <form action="<?= base_url('login/process') ?>" method="POST" class="animate-up delay-1">
                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control form-control-custom" id="email" name="email" required placeholder="nama@email.com" autocomplete="email">
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label mb-0">Kata Sandi</label>
                                <!-- MENGARAHKAN KE RUTE LUPA PASSWORD -->
                                <a href="<?= base_url('lupa-password') ?>" class="small text-decoration-none fw-medium" style="color: var(--royal-blue);">Lupa sandi?</a>
                            </div>
                            <input type="password" class="form-control form-control-custom" id="password" name="password" required placeholder="Masukkan kata sandi" autocomplete="current-password">
                        </div>

                        <button type="submit" class="btn btn-utama w-100 mb-4 mt-2 shadow-sm">Masuk Sistem</button>
                    </form>

                    <div class="text-center text-lg-start animate-up delay-2">
                        <span class="text-secondary">Belum memiliki akun?&#x20;
                            <a href="<?= base_url('register') ?>" class="text-decoration-none fw-bold" style="color: var(--royal-blue);">Daftar sekarang</a>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
