<?php
$logged = (bool) session()->get('logged_in');
$role   = strtolower((string) session()->get('role'));
$linkDasbor = $role === 'buyer' ? base_url('buyer/dashboard') : base_url('umkm/dashboard');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>NusaChain - Menghubungkan UMKM ke Pasar Global</title>

    <link rel="icon" href="<?= base_url('assets/img/icon.png') ?>" type="image/png">
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
            --muted: #64748B;
            --line: #E2E8F0;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            color: var(--slate);
            scroll-behavior: smooth;
        }

        body { overflow-x: hidden; }
        section[id] { scroll-margin-top: 90px; }

        .navbar-custom {
            position: sticky;
            top: 0;
            z-index: 1020;
            padding: 0;
            background: rgba(255, 255, 255, 0.97);
            border-bottom: 1px solid var(--line);
            box-shadow: 0 3px 14px rgba(15, 41, 77, 0.035);
            backdrop-filter: blur(12px);
        }

        .navbar-inner { min-height: 76px; gap: 1rem; }

        .navbar-brand {
            display: inline-flex;
            align-items: center;
            flex-shrink: 0;
            padding: 0 !important;
            margin: 0 !important;
        }

        .navbar-brand img {
            display: block;
            width: auto;
            height: 76px;
            max-height: 76px;
            object-fit: contain;
        }

        .navbar-toggler {
            padding: 0.4rem 0.55rem;
            border: 1px solid #D7E3F4;
            border-radius: 9px;
            box-shadow: none !important;
        }

        .navbar-toggler:focus { box-shadow: 0 0 0 3px rgba(16, 73, 157, 0.12) !important; }

        .nav-main {
            align-items: center;
            gap: 0.25rem;
            margin-left: 2rem;
        }

        .nav-link-custom {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            padding: 0.65rem 0.9rem !important;
            color: var(--slate) !important;
            font-size: 0.9rem;
            font-weight: 500;
            white-space: nowrap;
            border-radius: 9px;
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        .nav-link-custom:hover,
        .nav-link-custom:focus-visible {
            color: var(--royal-blue) !important;
            background: #F3F6FB;
        }

        .nav-link-custom.active {
            color: var(--royal-blue) !important;
            background: #EAF2FF;
            font-weight: 600;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: auto;
            padding-left: 1rem;
        }

        .nav-login {
            color: #0F172A;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: color 0.2s ease;
        }

        .nav-login:hover { color: var(--royal-blue); }

        .btn-utama {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.72rem 1.15rem;
            color: var(--white) !important;
            font-size: 0.88rem;
            font-weight: 500;
            background: var(--royal-blue) !important;
            border: 1px solid var(--royal-blue) !important;
            border-radius: 9px;
            text-decoration: none;
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-utama:hover,
        .btn-utama:focus-visible {
            color: var(--white) !important;
            background: var(--deep-blue) !important;
            border-color: var(--deep-blue) !important;
            box-shadow: 0 5px 14px rgba(16, 73, 157, 0.18);
            transform: translateY(-1px);
        }

        .btn-sekunder {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.72rem 1.15rem;
            color: var(--royal-blue) !important;
            background: var(--white) !important;
            border: 1px solid var(--royal-blue) !important;
            border-radius: 9px;
            font-size: 0.88rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-sekunder:hover {
            background: var(--ice-blue) !important;
            transform: translateY(-1px);
        }

        .hero-section {
            padding-top: 40px;
            padding-bottom: 60px;
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-weight: 700;
            font-size: 3.5rem;
            line-height: 1.15;
            color: #000000;
            margin-bottom: 20px;
        }

        .text-highlight { color: var(--royal-blue); }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--slate);
            line-height: 1.6;
            margin-bottom: 40px;
            font-weight: 400;
        }

        .hero-image-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            aspect-ratio: 3 / 2;
            height: auto;
            background: var(--ice-blue);
        }

        .hero-image { width: 100%; height: 100%; object-fit: cover; display: block; }

        .section-eyebrow {
            color: var(--royal-blue);
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .feature-card {
            background-color: #FAFAFA;
            border: 1px solid var(--line);
            border-radius: 1.25rem;
            padding: 2.5rem 2rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background-color: var(--white);
            border-color: #D7E3F4;
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(16, 73, 157, 0.08);
        }

        .icon-box {
            width: 64px;
            height: 64px;
            background-color: #EAF2FF;
            color: var(--royal-blue);
            border-radius: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        /* Galeri operasional: satu baris, tinggi sama, lebar mengikuti rasio foto */
        .gallery-row {
            display: flex;
            gap: 1.25rem;
        }

        .gallery-item {
            position: relative;
            flex: var(--r) 1 0;
            min-width: 0;
            aspect-ratio: var(--r);
            margin: 0;
            overflow: hidden;
            border-radius: 1.25rem;
            background: var(--ice-blue);
            border: 1px solid var(--line);
        }

        .gallery-item img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img { transform: scale(1.04); }

        .gallery-caption {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 2.2rem 1rem 0.9rem;
            color: var(--white);
            font-size: .8rem;
            font-weight: 600;
            background: linear-gradient(to top, rgba(11, 69, 153, .88), rgba(11, 69, 153, 0));
        }

        /* Cara kerja */
        .step-card {
            position: relative;
            height: 100%;
            padding: 2rem 1.75rem;
            background: var(--ice-blue);
            border: 1px solid var(--line);
            border-radius: 1.25rem;
        }

        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            margin-bottom: 1.1rem;
            color: var(--white);
            background: var(--royal-blue);
            border-radius: 12px;
            font-weight: 700;
        }

        /* Footer */
        .footer-custom {
            padding: 2rem 0;
            color: var(--muted);
            font-size: .85rem;
            background: var(--white);
            border-top: 1px solid var(--line);
        }

        @media (max-width: 991.98px) {
            .navbar-inner { min-height: 66px; }
            .navbar-brand img { height: 49px; }

            .navbar-collapse {
                padding: 0.5rem 0 1rem;
                border-top: 1px solid #EEF2F7;
            }

            .nav-main {
                align-items: stretch;
                gap: 0.15rem;
                margin: 0;
                padding-top: 0.5rem;
            }

            .nav-link-custom { width: 100%; min-height: 42px; }

            .navbar-actions {
                align-items: stretch;
                flex-direction: column;
                gap: 0.65rem;
                margin: 0;
                padding: 0.75rem 0 0;
            }

            .nav-login { display: block; padding: 0.65rem 0.9rem; }
            .navbar-actions .btn-utama { width: 100%; }
            .hero-title { font-size: 2.5rem; }
            .hero-image-wrapper { margin-top: 40px; }
            .hero-section { padding-top: 30px; }

            /* Tablet dan HP: grid 2 kolom, rasio seragam */
            .gallery-row {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            .gallery-item { aspect-ratio: 3 / 4; }
        }

        @media (max-width: 480px) {
            .gallery-row { grid-template-columns: 1fr; }
            .gallery-item { aspect-ratio: 4 / 5; }
        }

        @media (max-width: 420px) {
            .navbar-inner { gap: 0.6rem; }
            .navbar-brand img { height: 40px; }
            .hero-title { font-size: clamp(2rem, 9vw, 2.35rem); }
            .hero-desc { font-size: 1rem; margin-bottom: 28px; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-up { opacity: 0; animation: fadeInUp 0.8s ease-out forwards; }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container navbar-inner d-flex align-items-center">
            <a class="navbar-brand" href="<?= base_url('/') ?>" aria-label="NusaChain Beranda">
                <img src="<?= base_url('assets/img/logo-horizontal1.png') ?>" alt="Logo NusaChain">
            </a>

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Buka menu navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="publicNavbar">
                <ul class="navbar-nav nav-main">
                    <li class="nav-item">
                        <a href="<?= base_url('/') ?>" class="nav-link nav-link-custom active" aria-current="page">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tentang" class="nav-link nav-link-custom">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a href="#operasional" class="nav-link nav-link-custom">Operasional</a>
                    </li>
                    <li class="nav-item">
                        <a href="#cara-kerja" class="nav-link nav-link-custom">Cara Kerja</a>
                    </li>
                                        <li class="nav-item">
                        <a href="<?= base_url('eksplor') ?>" class="nav-link nav-link-custom">
                            <i style="color: var(--royal-blue);"></i> Eksplor
                        </a>
                    </li>
                </ul>

                <div class="navbar-actions">
                    <?php if ($logged) : ?>
                        <a href="<?= $linkDasbor ?>" class="btn-utama">
                            <i class="fas fa-gauge" aria-hidden="true"></i> Ke Dasbor
                        </a>
                    <?php else : ?>
                        <a href="<?= base_url('login') ?>" class="nav-login">Masuk</a>
                        <a href="<?= base_url('register') ?>" class="btn-utama">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <main class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start animate-up">
                    <h1 class="hero-title mt-lg-4">
                        Menghubungkan <br class="d-none d-md-block">
                        UMKM Indonesia <br class="d-none d-md-block">
                        ke <span class="text-highlight">Pasar Global</span>
                    </h1>

                    <p class="hero-desc pe-lg-4 animate-up delay-1">
                        NusaChain membantu UMKM bergabung dalam konsorsium digital untuk pengiriman ekspor yang lebih efisien dan terstandarisasi.
                    </p>

                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3 animate-up delay-2">
                        <?php if ($logged) : ?>
                            <a href="<?= $linkDasbor ?>" class="btn-utama">
                                Ke Dasbor <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                            </a>
                        <?php else : ?>
                            <a href="<?= base_url('register') ?>" class="btn-utama">
                                Mulai Sekarang <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                        <a href="#tentang" class="btn-sekunder">Pelajari Lebih Lanjut</a>
                    </div>
                </div>

                <div class="col-lg-6 animate-up delay-2">
                    <div class="hero-image-wrapper ms-lg-4 mt-5 mt-lg-0">
                        <img src="<?= base_url('assets/img/hero.png') ?>" alt="Tim NusaChain memuat barang ke truk di gudang logistik" class="hero-image" loading="eager">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Tentang -->
    <section id="tentang" class="py-5 bg-white">
        <div class="container py-lg-5">
            <div class="text-center mb-5">
                <span class="section-eyebrow">Tentang Platform</span>
                <h2 class="mt-2 fw-bolder text-dark fs-1">Membawa UMKM Lokal ke Kancah Global</h2>
                <p class="mt-3 text-muted fs-5 mx-auto" style="max-width: 700px;">
                    Ongkos kirim eceran (LCL) yang mahal dan syarat pesanan minimum (MOQ) pembeli global membuat UMKM sulit mengekspor sendirian. NusaChain menggabungkan kapasitas beberapa UMKM menjadi satu kontainer penuh (FCL).
                </p>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="icon-box"><i class="fas fa-box-open" aria-hidden="true"></i></div>
                        <h4 class="fw-bold text-dark mb-3">Konsolidasi Cerdas</h4>
                        <p class="text-muted mb-0 lh-lg">
                            Sistem mencocokkan produk UMKM berdasarkan HS Code dan kuota kontainer, lalu menggabungkannya ke konsorsium yang sama sehingga berpotensi menekan biaya kirim.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="icon-box"><i class="fas fa-globe-asia" aria-hidden="true"></i></div>
                        <h4 class="fw-bold text-dark mb-3">Terhubung ke Buyer</h4>
                        <p class="text-muted mb-0 lh-lg">
                            Buyer melihat katalog konsorsium yang kuotanya sudah terpenuhi (siap ekspor), memeriksa UMKM pengisinya, lalu mengajukan pesanan sesuai kebutuhan.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="icon-box"><i class="fas fa-shield-halved" aria-hidden="true"></i></div>
                        <h4 class="fw-bold text-dark mb-3">Transparan &amp; Terpantau</h4>
                        <p class="text-muted mb-0 lh-lg">
                            Pantau kuota konsorsium, status pesanan, dan skor kepercayaan UMKM dari satu dasbor sesuai peran Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri operasional (Diperbarui dengan CSS custom var(--r)) -->
    <section id="operasional" class="py-5" style="background: var(--ice-blue);">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <span class="section-eyebrow">Gambaran Operasional</span>
                <h2 class="mt-2 fw-bolder text-dark fs-1">Dari Gudang UMKM hingga Pengiriman</h2>
                <p class="mt-3 text-muted fs-5 mx-auto" style="max-width: 700px;">
                    Ilustrasi alur fisik barang yang dikonsolidasikan melalui NusaChain, mulai dari penyimpanan, penyusunan, hingga pengangkutan.
                </p>
            </div>

            <div class="gallery-row">
                <figure class="gallery-item" style="--r: 0.549;">
                    <img src="<?= base_url('assets/img/galeri-truk.png') ?>" alt="Dua truk NusaChain melaju di jalan layang" style="object-position: center bottom;" loading="lazy">
                    <figcaption class="gallery-caption">Pengangkutan darat menuju pelabuhan</figcaption>
                </figure>

                <figure class="gallery-item" style="--r: 0.667;">
                    <img src="<?= base_url('assets/img/galeri-logistik.png') ?>" alt="Pusat logistik NusaChain dengan rak palet dan konveyor" loading="lazy">
                    <figcaption class="gallery-caption">Pusat konsolidasi barang</figcaption>
                </figure>

                <figure class="gallery-item" style="--r: 0.75;">
                    <img src="<?= base_url('assets/img/galeri-kopi.png') ?>" alt="Karung kopi bertumpuk di gudang" loading="lazy">
                    <figcaption class="gallery-caption">Komoditas UMKM, contoh kopi</figcaption>
                </figure>

                <figure class="gallery-item" style="--r: 0.667;">
                    <img src="<?= base_url('assets/img/galeri-paket.png') ?>" alt="Dua petugas menyusun kardus di atas palet" loading="lazy">
                    <figcaption class="gallery-caption">Penyusunan barang per palet</figcaption>
                </figure>
            </div>

            <p class="text-center text-muted small mt-4 mb-0">Gambar bersifat ilustrasi.</p>
        </div>
    </section>

    <!-- Cara kerja -->
    <section id="cara-kerja" class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <span class="section-eyebrow">Cara Kerja</span>
                <h2 class="mt-2 fw-bolder text-dark fs-1">Tiga Langkah Menuju Ekspor</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h4 class="fw-bold text-dark mb-2">UMKM Input Produk</h4>
                        <p class="text-muted mb-0 lh-lg">UMKM mendaftarkan produk beserta HS Code dan kapasitas produksi bulanan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h4 class="fw-bold text-dark mb-2">Sistem Mencocokkan</h4>
                        <p class="text-muted mb-0 lh-lg">Produk digabungkan ke konsorsium dengan HS Code yang sama, atau konsorsium baru dibuat bila belum ada yang cocok, sampai kuota kontainer terpenuhi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h4 class="fw-bold text-dark mb-2">Buyer Memesan</h4>
                        <p class="text-muted mb-0 lh-lg">Buyer memilih konsorsium yang siap ekspor dan mengajukan pesanan beserta target tanggal pengiriman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 text-center text-md-start">
            <span>&copy; <?= date('Y') ?> NusaChain. Capstone Project Kelompok 6 &ndash; Kelas 4E.</span>
            <span>Platform konsolidasi logistik B2B untuk UMKM.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>