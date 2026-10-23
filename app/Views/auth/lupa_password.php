<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Lupa Kata Sandi - NusaChain</title>

    <link rel="icon" href="<?= base_url('assets/img/icon.png') ?>" type="image/png">
    <!-- Font dan library disamakan dengan halaman Register NusaChain -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --royal-blue: #10499D;
            --deep-blue: #0B4599;
            --white: #FFFFFF;
            --ice-blue: #F3F6FB;
            --slate: #334155;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--white);
            color: var(--slate);
            overflow-x: hidden;
        }

        /* Panel gambar di kanan, mengikuti halaman Register */
        .forgot-image-side {
            min-height: 100vh;
            position: relative;
            background:
                linear-gradient(rgba(16, 73, 157, 0.50), rgba(11, 69, 153, 0.72)),
                url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Panel form di kiri, dengan tata letak sederhana seperti halaman Register */
        .forgot-form-side {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 100px 2rem 42px;
            position: relative;
            background: var(--white);
        }

        .form-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .brand-logo-wrapper {
            position: absolute;
            top: 32px;
            left: 50px;
        }

        .brand-logo-wrapper a {
            display: inline-flex;
            align-items: center;
        }

        .brand-logo-wrapper img {
            display: block;
            width: auto;
            height: 40px;
            object-fit: contain;
            transform: scale(1.6);
            transform-origin: left center;
        }

        /* Link Kembali ke Login ditempatkan di kanan atas, seperti link Beranda di Register */
        .btn-back-login {
            position: absolute;
            top: 38px;
            right: 36px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--slate);
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .btn-back-login:hover { color: var(--royal-blue); }

        .form-heading {
            margin-bottom: 0.55rem;
            color: #000000;
            font-size: clamp(1.65rem, 2.2vw, 2rem);
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .form-description {
            margin-bottom: 1.6rem;
            color: #64748B;
            font-size: 0.92rem;
            line-height: 1.7;
        }

        .form-label {
            margin-bottom: 0.45rem;
            color: var(--slate);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-control-custom {
            width: 100%;
            min-height: 48px;
            padding: 12px 15px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            background: #F8FAFC;
            color: var(--slate);
            font-size: 0.9rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .form-control-custom:focus {
            background: var(--white);
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 3px rgba(16, 73, 157, 0.15);
            outline: none;
        }

        .btn-utama {
            padding: 12px 24px;
            border: 1px solid var(--royal-blue);
            border-radius: 8px;
            background: var(--royal-blue);
            color: var(--white);
            font-size: 0.95rem;
            font-weight: 600;
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-utama:hover {
            background: var(--deep-blue);
            border-color: var(--deep-blue);
            color: var(--white);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 73, 157, 0.18);
        }

        .form-alert {
            border-radius: 8px;
            font-size: 0.86rem;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-up { animation: fadeInUp 0.65s ease-out both; }
        .delay-1 { animation-delay: 0.1s; }

        @media (max-width: 991px) {
            .forgot-form-side {
                min-height: 100vh;
                padding: 32px 1.25rem 40px;
            }

            .brand-logo-wrapper {
                position: static;
                display: flex;
                justify-content: center;
                margin-bottom: 1.8rem;
            }

            .brand-logo-wrapper img {
                height: 36px;
                transform: scale(1.35);
                transform-origin: center center;
            }

            .btn-back-login {
                position: static;
                width: 100%;
                max-width: 420px;
                align-self: center;
                margin-bottom: 1.5rem;
                justify-content: flex-start;
            }

            .form-wrapper { max-width: 420px; }
        }

        @media (max-width: 575px) {
            .forgot-form-side { padding-right: 1.1rem; padding-left: 1.1rem; }
            .form-heading { font-size: 1.7rem; }
            .form-description { font-size: 0.88rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            <!-- Panel kiri: logo, tautan kembali, dan form -->
            <div class="col-12 col-lg-5 forgot-form-side order-lg-1">
                <div class="brand-logo-wrapper w-100 text-lg-start text-center">
                    <a href="<?= base_url('/') ?>" aria-label="Kembali ke halaman utama NusaChain">
                        <img src="<?= base_url('assets/img/logo-horizontal.png') ?>" alt="Logo NusaChain">
                    </a>
                </div>

                <a href="<?= base_url('login') ?>" class="btn-back-login">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Kembali ke Login
                </a>

                <main class="form-wrapper animate-up">
                    <div class="mb-4">
                        <h1 class="form-heading">Lupa Kata Sandi?</h1>
                        <p class="form-description mb-0">Masukkan alamat email yang terdaftar pada akun Anda. Kami akan mengirimkan instruksi untuk mengatur ulang kata sandi.</p>
                    </div>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger form-alert" role="alert">
                            <i class="fas fa-exclamation-circle me-1" aria-hidden="true"></i>
                            <?= esc(session()->getFlashdata('error')) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success form-alert" role="alert">
                            <i class="fas fa-check-circle me-1" aria-hidden="true"></i>
                            <?= esc(session()->getFlashdata('success')) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('lupa-password/process') ?>" method="POST" class="animate-up delay-1">
                        <?= csrf_field() ?>
                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email Terdaftar</label>
                            <input
                                type="email"
                                class="form-control form-control-custom"
                                id="email"
                                name="email"
                                value="<?= esc(old('email') ?? '') ?>"
                                required
                                autocomplete="email"
                                placeholder="nama@email.com"
                            >
                        </div>

                        <button type="submit" class="btn btn-utama w-100">
                            <i class="fas fa-envelope me-2" aria-hidden="true"></i>Kirim Tautan Reset
                        </button>
                    </form>
                </main>
            </div>

            <!-- Panel kanan: branding dengan gambar yang sama seperti halaman Register -->
            <div class="col-lg-7 d-none d-lg-block p-0 order-lg-2">
                <div class="forgot-image-side d-flex align-items-center justify-content-center">
                    <div class="text-center px-5 animate-up delay-1" style="max-width: 650px;">
                        <h2 class="text-white fw-bold mb-3 display-6">Keamanan Akun Prioritas Kami</h2>
                        <p class="text-white opacity-75 fs-5 mb-0">
                            Kami memastikan akses akun dan informasi bisnis Anda tetap terlindungi. Gunakan email yang terdaftar untuk memulihkan kata sandi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
