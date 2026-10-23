<?php
$logged = (bool) session()->get('logged_in');
$role   = strtolower((string) session()->get('role'));
$linkDasbor = $role === 'buyer' ? base_url('buyer/dashboard') : ($role === 'admin' ? base_url('admin/dashboard') : base_url('umkm/dashboard'));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Eksplor Katalog Konsorsium - NusaChain</title>

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
            --border: #E2E8F0;
            --shadow: 0 8px 26px rgba(15, 41, 77, 0.06);
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Poppins', sans-serif;
            color: var(--slate);
            background: var(--ice-blue);
        }

        body { overflow-x: hidden; }

        /* --- STYLING NAVBAR PUBLIK --- */
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

        /* --- STYLING KONTEN EKSPLOR (KONSISTEN DENGAN BUYER) --- */
        .page-shell { padding-top: 2rem; padding-bottom: 3rem; flex: 1; }

        .page-hero {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            padding: clamp(1.5rem, 3.5vw, 2.5rem);
            margin-bottom: 2rem;
            color: var(--white);
            background: linear-gradient(115deg, var(--deep-blue) 0%, var(--royal-blue) 65%, #2674C9 100%);
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 20px;
            box-shadow: 0 12px 28px rgba(16, 73, 157, 0.16);
        }

        .page-hero::after {
            position: absolute;
            right: -46px;
            bottom: -118px;
            width: 280px;
            height: 280px;
            content: '';
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-content, .hero-action { position: relative; z-index: 1; }

        .page-title { margin: 0 0 .5rem; color: var(--white); font-size: clamp(1.55rem, 2.8vw, 2.05rem); font-weight: 700; letter-spacing: -.035em; }
        .page-subtitle { max-width: 690px; margin: 0; color: rgba(255, 255, 255, 0.84); font-size: .9rem; line-height: 1.7; }

        .btn-outline-hero {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem; min-height: 44px; padding: .68rem 1rem;
            color: var(--royal-blue); background: #FFFFFF; border: 1px solid #FFFFFF; border-radius: 9px; font-size: .86rem; font-weight: 600;
            text-decoration: none; white-space: nowrap; transition: all .2s ease;
        }
        .btn-outline-hero:hover { color: var(--deep-blue); background: #EAF2FF; border-color: #EAF2FF; }

        .btn-utama {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem; min-height: 44px; padding: .7rem 1.2rem;
            color: var(--white) !important; background: var(--royal-blue) !important; border: 1px solid var(--royal-blue) !important;
            border-radius: 10px; font-size: .88rem; font-weight: 600; text-decoration: none; transition: all .2s ease;
        }
        .btn-utama:hover, .btn-utama:focus-visible { background: var(--deep-blue) !important; border-color: var(--deep-blue) !important; transform: translateY(-1px); box-shadow: 0 5px 14px rgba(16,73,157,.18); }

        .content-card { background: #FFFFFF; border: 1px solid rgba(226, 232, 240, 0.9); border-radius: 17px; box-shadow: var(--shadow); overflow: hidden; }
        
        .search-card { padding: 22px; margin-bottom: 28px; }
        .search-label { display: block; margin: 0 0 8px 4px; color: #334155; font-size: .85rem; font-weight: 600; }
        .search-input-wrap { position: relative; }
        .search-input-wrap .search-icon { position: absolute; top: 50%; left: 16px; z-index: 2; color: #94A3B8; transform: translateY(-50%); }
        .form-control-custom { width: 100%; min-height: 48px; padding: 11px 16px 11px 44px; color: #334155; background: #FAFCFF; border: 1px solid #D7E0EC; border-radius: 10px; font-size: .9rem; font-family: 'Poppins', sans-serif; transition: all .2s ease; }
        .form-control-custom:focus { outline: 0; background: #FFFFFF; border-color: var(--royal-blue); box-shadow: 0 0 0 3px rgba(16, 73, 157, .12); }
        
        .btn-outline-blue { display: inline-flex; align-items: center; justify-content: center; min-height: 48px; width: 48px; color: var(--royal-blue); background: var(--white); border: 1px solid #CBD5E1; border-radius: 10px; font-weight: 600; transition: all .2s ease; }
        .btn-outline-blue:hover, .btn-outline-blue:focus { background: #EAF2FF; border-color: var(--royal-blue); color: var(--deep-blue); }

        .section-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 12px; margin: 1.5rem 0 1rem; }
        .section-title { margin: 0; color: #0F172A; font-size: 1.1rem; font-weight: 700; }
        .results-count { color: var(--royal-blue); font-size: .8rem; font-weight: 600; background: #EAF2FF; padding: 4px 12px; border-radius: 50px; white-space: nowrap; }

        .consortium-card {
            height: 100%; display: flex; flex-direction: column; background: var(--white); 
            border: 1px solid #E8EDF5; border-radius: 15px; box-shadow: var(--shadow); 
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }
        .consortium-card:hover { transform: translateY(-4px); border-color: #C5D5EB; box-shadow: 0 14px 32px rgba(15, 23, 42, .08); }
        .consortium-card-body { display: flex; flex-direction: column; padding: 22px; flex-grow: 1; }

        .status-badge {
            display: inline-flex; align-items: center; gap: 6px; align-self: flex-start;
            padding: 6px 12px; margin-bottom: 14px; color: #166534; background: #DCFCE7; 
            border: 1px solid #BBF7D0; border-radius: 50px; font-size: .75rem; font-weight: 700;
        }
        .hs-badge {
            display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px;
            color: #475569; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px;
            font-size: .78rem; font-weight: 600; font-family: monospace; white-space: nowrap;
        }

        .consortium-title { margin: 0 0 12px; color: #0F172A; font-size: 1.15rem; line-height: 1.4; font-weight: 700; }
        
        .card-divider { margin: 20px 0 16px; border: 0; border-top: 1px solid #EEF2F7; opacity: 1; }
        
        .volume-label { color: var(--muted); font-size: .8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
        .volume-value { color: var(--royal-blue); font-size: 1.1rem; font-weight: 800; white-space: nowrap; }

        .card-action { margin-top: auto; padding-top: 20px; }
        .card-action .btn { width: 100%; min-height: 46px; }

        .empty-state { padding: clamp(40px, 6vw, 60px) 22px; text-align: center; }
        .empty-icon { display: inline-flex; align-items: center; justify-content: center; width: 70px; height: 70px; margin-bottom: 18px; color: var(--royal-blue); background: var(--ice-blue); border-radius: 20px; font-size: 1.65rem; }
        .empty-state h3 { color: #0F172A; font-size: 1.15rem; font-weight: 700; margin-bottom: 8px; }
        .empty-state p { max-width: 560px; margin: 0 auto 24px; color: var(--muted); font-size: .88rem; line-height: 1.7; }

        .footer-custom {
            padding: 1.75rem 0;
            color: var(--muted);
            font-size: .85rem;
            background: var(--white);
            border-top: 1px solid var(--line);
            margin-top: auto;
        }

        @media (max-width: 991.98px) {
            .navbar-inner { min-height: 66px; }
            .navbar-brand img { height: 49px; }
            .navbar-collapse { padding: 0.5rem 0 1rem; border-top: 1px solid #EEF2F7; }
            .nav-main { align-items: stretch; gap: 0.15rem; margin: 0; padding-top: 0.5rem; }
            .nav-link-custom { width: 100%; min-height: 42px; }
            .navbar-actions { align-items: stretch; flex-direction: column; gap: 0.65rem; margin: 0; padding: 0.75rem 0 0; }
            .nav-login { display: block; padding: 0.65rem 0.9rem; }
            .navbar-actions .btn-utama { width: 100%; }
            .page-hero { align-items: flex-start; flex-direction: column; } 
            .hero-action, .hero-action .btn, .hero-action a { width: 100%; }
        }
        @media (max-width: 767.98px) {
            .page-shell { padding-top: 1.25rem; padding-bottom: 2rem; }
            .page-hero { padding: 23px 20px; margin-bottom: 1.15rem; border-radius: 16px; }
            .search-card { padding: 18px; margin-bottom: 24px; }
            .section-heading { align-items: flex-start; flex-direction: column; gap: 8px; }
            .consortium-card-body { padding: 18px; }
            .volume-value { font-size: 1rem; }
        }
    </style>
</head>
<body>

    <!-- Navbar Publik (Konsisten dengan Landing Page) -->
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
                        <a href="<?= base_url('/') ?>" class="nav-link nav-link-custom">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/#tentang') ?>" class="nav-link nav-link-custom">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/#operasional') ?>" class="nav-link nav-link-custom">Operasional</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/#cara-kerja') ?>" class="nav-link nav-link-custom">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('eksplor') ?>" class="nav-link nav-link-custom active" aria-current="page">
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

    <!-- Konten Utama -->
    <main class="container page-shell">

        <section class="page-hero" aria-labelledby="page-title">
            <div class="hero-content">
                <h1 class="page-title" id="page-title">Katalog Konsorsium Siap Ekspor</h1>
                <p class="page-subtitle">Temukan konsorsium UMKM dengan kuota kontainer yang telah terpenuhi (FCL), lalu masuk atau daftar sebagai Buyer untuk mengajukan pesanan ekspor.</p>
            </div>
            <div class="hero-action">
                <a href="<?= base_url('/') ?>" class="btn-outline-hero">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>Kembali ke Beranda
                </a>
            </div>
        </section>

        <section class="content-card search-card" aria-label="Pencarian konsorsium">
            <form method="get" action="<?= base_url('eksplor') ?>" class="row g-3 align-items-end">
                <div class="col-12 col-md-8 col-lg-9">
                    <label for="hs_code" class="search-label">Pencarian Spesifik HS Code (Harmonized System)</label>
                    <div class="search-input-wrap">
                        <i class="fas fa-search search-icon" aria-hidden="true"></i>
                        <input type="text" id="hs_code" name="hs_code" class="form-control form-control-custom"
                               placeholder="Masukkan awalan HS Code (contoh: 0901)..."
                               value="<?= esc($keyword ?? '') ?>" autocomplete="off">
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-utama flex-grow-1" style="min-height: 48px;">
                        <i class="fas fa-filter me-2" aria-hidden="true"></i>Terapkan Filter
                    </button>
                    <?php if (!empty($keyword)): ?>
                        <a href="<?= base_url('eksplor') ?>" class="btn btn-outline-blue flex-shrink-0" aria-label="Hapus filter" title="Hapus Filter">
                            <i class="fas fa-xmark"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </section>

        <section aria-labelledby="consortium-list-title">
            <div class="section-heading">
                <div>
                    <h2 id="consortium-list-title" class="section-title"><i class="fas fa-boxes-stacked me-2 text-primary"></i>Pilihan Konsorsium Tersedia</h2>
                </div>
                <?php if (!empty($daftarKonsorsium)): ?>
                    <span class="results-count"><i class="fas fa-hashtag me-1"></i><?= count($daftarKonsorsium) ?> Konsorsium</span>
                <?php endif; ?>
            </div>

            <div class="row g-3 g-lg-4">
                <?php if (!empty($daftarKonsorsium)): ?>
                    <?php foreach ($daftarKonsorsium as $k): ?>
                        <div class="col-12 col-md-6 col-xl-4">
                            <article class="consortium-card">
                                <div class="consortium-card-body">
                                    <span class="status-badge"><i class="fas fa-circle-check"></i> Siap Ekspor (FCL)</span>
                                    <h3 class="consortium-title"><?= esc($k['nama_konsorsium']) ?></h3>
                                    
                                    <div>
                                        <span class="hs-badge" title="Target HS Code">
                                            <i class="fas fa-barcode text-muted"></i> <?= esc($k['target_hs_code']) ?>
                                        </span>
                                    </div>

                                    <hr class="card-divider">

                                    <div class="d-flex align-items-end justify-content-between gap-3">
                                        <div>
                                            <div class="volume-label">Total Kapasitas</div>
                                        </div>
                                        <div class="volume-value"><?= number_format((float) ($k['total_kapasitas_gabungan'] ?? 0), 0, ',', '.') ?> <span class="text-muted fw-normal" style="font-size: 0.85rem;">Unit</span></div>
                                    </div>

                                    <div class="card-action">
                                        <?php if ($logged && $role === 'buyer'): ?>
                                            <a href="<?= base_url('buyer/pesan/' . $k['id_konsorsium']) ?>" class="btn btn-utama w-100">
                                                <i class="fas fa-cart-shopping me-2" aria-hidden="true"></i>Buat Pesanan Ekspor
                                            </a>
                                        <?php elseif ($logged): ?>
                                            <a href="<?= $linkDasbor ?>" class="btn btn-utama w-100">
                                                <i class="fas fa-gauge me-2" aria-hidden="true"></i>Buka Dasbor Anda
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('login') ?>" class="btn btn-utama w-100">
                                                <i class="fas fa-lock me-2" aria-hidden="true"></i>Masuk untuk Memesan
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="content-card empty-state">
                            <span class="empty-icon"><i class="fas fa-box-open"></i></span>
                            <h3>Tidak ada konsorsium yang ditemukan</h3>
                            <p>Tidak ditemukan konsorsium dengan status FCL yang sesuai dengan pencarian Anda. Coba periksa kembali HS Code atau hapus filter pencarian.</p>
                            <?php if (!empty($keyword)): ?>
                                <a href="<?= base_url('eksplor') ?>" class="btn-utama mt-2" style="width: auto;">
                                    <i class="fas fa-rotate-left me-2" aria-hidden="true"></i>Tampilkan Semua Konsorsium
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    </main>

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