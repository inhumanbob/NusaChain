<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Dasbor UMKM - NusaChain</title>
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
            --surface: #FFFFFF;
            --shadow: 0 8px 26px rgba(15, 41, 77, 0.06);
        }
        *, *::before, *::after { box-sizing: border-box; }
        html, body {
            min-height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: var(--slate);
            background: var(--ice-blue);
        }
        body { overflow-x: hidden; }
        .page-shell { padding-top: 2rem; padding-bottom: 3rem; }
        
        /* Banner judul UMKM */
        .page-heading {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            overflow: hidden;
            padding: clamp(1.5rem, 3.5vw, 2.5rem);
            margin-bottom: 1.5rem;
            color: var(--white);
            background: linear-gradient(115deg, var(--deep-blue) 0%, var(--royal-blue) 65%, #2674C9 100%);
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 20px;
            box-shadow: 0 12px 28px rgba(16, 73, 157, 0.16);
        }
        .page-heading::after {
            position: absolute;
            right: -46px;
            bottom: -118px;
            width: 280px;
            height: 280px;
            content: '';
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            box-shadow: 0 0 0 28px rgba(255, 255, 255, 0.045), 0 0 0 58px rgba(255, 255, 255, 0.035);
            pointer-events: none;
        }
        .page-heading > div,
        .page-heading > .btn-utama,
        .page-heading > .btn-locked {
            position: relative;
            z-index: 1;
        }
        .page-title {
            margin: 0 0 .5rem;
            color: var(--white);
            font-size: clamp(1.55rem, 2.8vw, 2.05rem);
            font-weight: 700;
            letter-spacing: -.035em;
        }
        .page-description {
            max-width: 690px;
            margin: 0;
            color: rgba(255, 255, 255, 0.84);
            font-size: .9rem;
            line-height: 1.7;
        }
        .page-heading .btn-utama {
            flex-shrink: 0;
            color: var(--royal-blue) !important;
            background: var(--white);
            border-color: var(--white);
        }
        .page-heading .btn-utama:hover,
        .page-heading .btn-utama:focus-visible {
            color: var(--deep-blue) !important;
            background: #EAF2FF;
            border-color: #EAF2FF;
        }
        .btn-utama {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            min-height: 44px;
            padding: .7rem 1rem;
            color: var(--white) !important;
            font-size: .86rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            background: var(--royal-blue);
            border: 1px solid var(--royal-blue);
            border-radius: 9px;
            transition: background-color .2s ease, transform .2s ease, box-shadow .2s ease;
        }
        .btn-utama:hover, .btn-utama:focus-visible {
            color: var(--white) !important;
            background: var(--deep-blue);
            border-color: var(--deep-blue);
            box-shadow: 0 5px 14px rgba(16, 73, 157, .18);
            transform: translateY(-1px);
        }
        .btn-locked {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            min-height: 44px;
            padding: .7rem 1rem;
            color: #64748B !important;
            font-size: .86rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            background: #E2E8F0 !important;
            border: 1px solid #CBD5E1 !important;
            border-radius: 9px;
            cursor: not-allowed;
            opacity: 0.9;
        }
        .alert-custom { border: 0; border-radius: 12px; box-shadow: 0 3px 12px rgba(15, 41, 77, .035); }
        .dashboard-card {
            height: 100%;
            background: var(--surface);
            border: 1px solid #E8EDF5;
            border-radius: 17px;
            box-shadow: var(--shadow);
        }
        .card-heading {
            display: flex;
            align-items: center;
            gap: .7rem;
            margin: 0 0 1.15rem;
            color: #0F172A;
            font-size: 1rem;
            font-weight: 700;
        }
        .card-heading-icon {
            display: inline-flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            color: var(--royal-blue);
            background: var(--ice-blue);
            border-radius: 11px;
        }
        .info-list { display: grid; gap: .9rem; margin: 0; }
        .info-row { display: grid; grid-template-columns: minmax(135px, .85fr) minmax(0, 1.15fr); gap: .8rem; align-items: start; }
        .info-label { color: var(--muted); font-size: .8rem; }
        .info-value { min-width: 0; color: #0F172A; font-size: .84rem; font-weight: 600; overflow-wrap: anywhere; }
        .consortium-notice {
            display: flex;
            align-items: flex-start;
            gap: .7rem;
            padding: .85rem 1rem;
            margin-bottom: 1rem;
            color: #075985;
            background: #E0F2FE;
            border: 1px solid #BAE6FD;
            border-radius: 11px;
            font-size: .82rem;
            line-height: 1.6;
        }
        .progress-meta { display: flex; justify-content: space-between; gap: .75rem; margin-bottom: .55rem; color: var(--muted); font-size: .76rem; }
        .progress-meta strong { color: #0F172A; font-weight: 700; text-align: right; }
        .progress-custom { height: 11px; overflow: hidden; background: #E8EEF7; border-radius: 50px; }
        .progress-custom .progress-bar { border-radius: 50px; }
        .progress-note { display: flex; justify-content: space-between; gap: .75rem; margin-top: .65rem; color: var(--muted); font-size: .75rem; }
        .progress-note strong { color: #334155; }
        .member-list { display: flex; flex-wrap: wrap; gap: .45rem; }
        .member-chip { display: inline-flex; align-items: center; gap: .35rem; max-width: 100%; padding: .42rem .6rem; color: #475569; background: #F8FAFC; border: 1px solid var(--line); border-radius: 8px; font-size: .73rem; overflow-wrap: anywhere; }
        .empty-consortium {
            padding: 1.2rem;
            text-align: center;
            background: #F8FAFC;
            border: 1px dashed #CBD5E1;
            border-radius: 12px;
        }
        .empty-consortium-icon { display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; margin-bottom: .7rem; color: var(--royal-blue); background: #EAF2FF; border-radius: 14px; }
        .empty-consortium p { margin: 0 0 1rem; color: var(--muted); font-size: .83rem; line-height: 1.65; }
        .stat-card {
            display: flex;
            align-items: center;
            gap: .95rem;
            height: 100%;
            padding: 1.15rem;
            background: var(--white);
            border: 1px solid #E8EDF5;
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(15, 41, 77, .085); }
        .stat-icon { display: inline-flex; flex-shrink: 0; align-items: center; justify-content: center; width: 46px; height: 46px; font-size: 1.05rem; border-radius: 12px; }
        .stat-icon.blue { color: var(--royal-blue); background: #EAF2FF; }
        .stat-icon.green { color: #15803D; background: #DCFCE7; }
        .stat-label { margin-bottom: .3rem; color: var(--muted); font-size: .76rem; line-height: 1.45; }
        .stat-number { color: #0F172A; font-size: clamp(1.18rem, 2vw, 1.55rem); font-weight: 700; line-height: 1.25; overflow-wrap: anywhere; }
        .section-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 1rem; margin: 2rem 0 1rem; }
        .section-title { margin: 0; color: #0F172A; font-size: 1.08rem; font-weight: 700; }
        .section-subtitle { margin: .3rem 0 0; color: var(--muted); font-size: .82rem; line-height: 1.6; }
        .product-panel { overflow: hidden; background: var(--white); border: 1px solid #E8EDF5; border-radius: 17px; box-shadow: var(--shadow); }
        .product-panel-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 1.2rem 1.35rem; border-bottom: 1px solid #EEF2F7; }
        .product-panel-title { display: flex; align-items: center; gap: .65rem; margin: 0; color: #0F172A; font-size: .98rem; font-weight: 700; }
        .product-panel-icon { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; color: var(--royal-blue); background: var(--ice-blue); border-radius: 10px; }
        .table-responsive { width: 100%; }
        .table-custom { width: 100%; margin: 0; border-collapse: separate; border-spacing: 0; }
        .table-custom thead th { padding: .9rem 1rem; color: #64748B; font-size: .72rem; font-weight: 600; letter-spacing: .035em; white-space: nowrap; text-transform: uppercase; background: #F8FAFC; border-bottom: 1px solid #E8EDF5; }
        .table-custom tbody td { padding: .95rem 1rem; color: var(--slate); font-size: .82rem; vertical-align: middle; background: #FFFFFF; border-bottom: 1px solid #EEF2F7; }
        .table-custom tbody tr:last-child td { border-bottom: 0; }
        .table-custom tbody tr:hover td { background: #FBFDFF; }
        
        .order-action-heading,
        .order-action-cell { width: 190px; min-width: 190px; text-align: center !important; }
        .order-action-wrap { display: flex; align-items: center; justify-content: center; width: 100%; min-height: 38px; }
        .order-status-button { display: inline-flex; align-items: center; justify-content: center; gap: .4rem; width: 135px; min-height: 36px; padding: .45rem .65rem !important; border-radius: 8px; font-size: .76rem; font-weight: 600; line-height: 1.2; white-space: nowrap; box-shadow: 0 2px 6px rgba(15, 41, 77, .08); }
        .order-status-button i { margin: 0 !important; }
        .order-status-process { background: var(--royal-blue); border-color: var(--royal-blue); color: white; }
        .order-status-process:hover { background: var(--deep-blue); border-color: var(--deep-blue); color: white; }
        
        /* Label Status Khusus Opsi 2 */
        .order-admin-inspect-label { display: inline-flex; align-items: center; justify-content: center; gap: .35rem; width: 165px; min-height: 36px; padding: .45rem .6rem; color: #0369A1; background: #E0F2FE; border: 1px solid #BAE6FD; border-radius: 8px; font-size: .73rem; font-weight: 700; line-height: 1.2; white-space: nowrap; }
        .order-wait-label { display: inline-flex; align-items: center; justify-content: center; gap: .35rem; width: 165px; min-height: 36px; padding: .45rem .6rem; color: #B45309; background: #FFFBEB; border: 1px solid #FDE68A; border-radius: 8px; font-size: .73rem; font-weight: 700; line-height: 1.2; white-space: nowrap; }
        .order-complete-label { display: inline-flex; align-items: center; justify-content: center; gap: .35rem; width: 155px; min-height: 36px; padding: .45rem .6rem; color: #15803D; background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 8px; font-size: .74rem; font-weight: 700; line-height: 1.2; white-space: nowrap; }
        .product-name { color: #0F172A; font-weight: 600; }
        
        .mobile-product-list, .mobile-order-list { display: none; padding: .85rem; }
        .mobile-product-card { padding: 1rem; background: #FFFFFF; border: 1px solid #E8EDF5; border-radius: 12px; }
        .mobile-product-card + .mobile-product-card { margin-top: .7rem; }
        .mobile-product-top { display: flex; align-items: flex-start; justify-content: space-between; gap: .7rem; padding-bottom: .75rem; border-bottom: 1px solid #EEF2F7; }
        .mobile-label { margin-bottom: .2rem; color: var(--muted); font-size: .69rem; }
        .mobile-value { color: #0F172A; font-size: .83rem; font-weight: 600; overflow-wrap: anywhere; }
        .mobile-product-meta { display: grid; grid-template-columns: 1fr 1fr; gap: .8rem; padding-top: .8rem; }
        
        .empty-products { padding: 3rem 1.25rem; text-align: center; }
        .empty-products-icon { display: inline-flex; align-items: center; justify-content: center; width: 62px; height: 62px; margin-bottom: .9rem; color: #64748B; background: #F1F5F9; border-radius: 17px; font-size: 1.45rem; }
        .empty-products h3 { margin-bottom: .4rem; color: #0F172A; font-size: 1rem; font-weight: 700; }
        .empty-products p { max-width: 470px; margin: 0 auto 1rem; color: var(--muted); font-size: .82rem; line-height: 1.7; }
        
        @media (max-width: 767.98px) {
            .page-shell { padding-top: 1.25rem; padding-bottom: 2rem; }
            .page-heading { align-items: stretch; flex-direction: column; gap: 1rem; margin-bottom: 1.15rem; border-radius: 16px; }
            .page-heading .btn-utama, .page-heading .btn-locked { width: 100%; }
            .page-description { font-size: .84rem; }
            .dashboard-card { border-radius: 14px; }
            .dashboard-card.p-4 { padding: 1.15rem !important; }
            .info-row { grid-template-columns: minmax(110px, .8fr) minmax(0, 1.2fr); gap: .55rem; }
            .info-label, .info-value { font-size: .77rem; }
            .stat-card { gap: .75rem; padding: .9rem; border-radius: 13px; }
            .stat-icon { width: 39px; height: 39px; font-size: .92rem; border-radius: 10px; }
            .stat-label { font-size: .69rem; }
            .section-heading { align-items: flex-start; }
            .product-panel { border-radius: 14px; }
            .product-panel-header { padding: 1rem; }
            .desktop-product-table, .desktop-order-table { display: none; }
            .mobile-product-list, .mobile-order-list { display: block; }
        }
        @media (max-width: 420px) {
            .container { padding-right: 1rem; padding-left: 1rem; }
            .info-row { grid-template-columns: 1fr; gap: .15rem; }
            .stat-card { align-items: flex-start; flex-direction: column; gap: .55rem; min-height: 125px; }
            .stat-icon { width: 35px; height: 35px; }
            .stat-number { font-size: 1.1rem; }
            .product-panel-title { font-size: .86rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition: none !important; animation: none !important; }
        }
    </style>
</head>
<body>
<?= $this->include('layout/navbar') ?>
<?= $this->include('layout/flash_toast') ?>
<?php
    $user = is_array($user ?? null) ? $user : [];
    $konsorsium = is_array($konsorsium ?? null) ? $konsorsium : null;
    $anggota = (isset($anggota) && is_iterable($anggota)) ? $anggota : [];
    $daftarProduk = (isset($daftarProduk) && is_iterable($daftarProduk)) ? $daftarProduk : [];
    $totalProdukView = (int) ($totalProduk ?? 0);
    $totalKapasitasView = (float) ($totalKapasitas ?? 0);
    $kapasitasProdukView = (float) ($kapasitasProduk ?? 0);
    $targetFclView = (float) ($targetFcl ?? 0);
    $sisaKuotaView = (float) ($sisaKuota ?? 0);
    $totalAnggotaView = (int) ($totalAnggota ?? 0);
    $persentaseView = min(100, max(0, (float) ($persentase ?? 0)));
    $hasKonsorsium = !empty($konsorsium) && ($konsorsium['nama_konsorsium'] ?? '') !== 'Belum Tergabung Konsorsium';
    $kapasitasProgress = $persentaseView >= 100 ? 'bg-success' : 'bg-primary';
    $isTerverifikasi = (($user['status_verifikasi'] ?? 'Pending') === 'Terverifikasi');
?>
<main class="container page-shell">
    
    <!-- BANNER PERINGATAN VERIFIKASI LEGALITAS (KYB) -->
    <?php if (! $isTerverifikasi): ?>
        <?php if (($user['status_verifikasi'] ?? 'Pending') === 'Ditolak'): ?>
            <div class="alert alert-danger alert-custom mb-4 d-flex align-items-center gap-3 border-start border-danger border-4" role="alert" style="background-color: #FEF2F2;">
                <i class="fas fa-circle-xmark fs-2 text-danger" aria-hidden="true"></i>
                <div>
                    <h4 class="alert-heading mb-1" style="font-size: 1rem; font-weight: 700; color: #991B1B;">Pengajuan Legalitas Usaha Ditolak</h4>
                    <p class="mb-0" style="font-size: 0.85rem; color: #991B1B;">
                        Administrator menolak berkas izin usaha Anda. Silakan lengkapi atau unggah ulang dokumen legalitas yang sah di menu profil.
                    </p>
                </div>
                <a href="<?= base_url('umkm/profil') ?>" class="btn btn-danger btn-sm ms-auto fw-bold px-3 py-2 text-nowrap">
                    <i class="fas fa-file-upload me-1"></i> Perbarui Dokumen
                </a>
            </div>
        <?php else: ?>
            <div class="alert alert-warning alert-custom mb-4 d-flex align-items-center gap-3 border-start border-warning border-4" role="alert" style="background-color: #FFFBEB;">
                <i class="fas fa-user-shield fs-2 text-warning" aria-hidden="true"></i>
                <div>
                    <h4 class="alert-heading mb-1" style="font-size: 1rem; font-weight: 700; color: #92400E;">Status Akun: Menunggu Verifikasi Legalitas (KYB)</h4>
                    <p class="mb-0" style="font-size: 0.85rem; color: #92400E;">
                        Dokumen legalitas usaha Anda sedang ditinjau oleh Administrator. Fitur input barang dikunci sementara untuk menjamin keamanan konsorsium ekspor.
                    </p>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- BANNER PERINGATAN KELENGKAPAN LOKASI -->
    <?php if (empty($user['koordinat_lokasi']) || $user['koordinat_lokasi'] === 'Belum diatur' || $user['koordinat_lokasi'] === null) : ?>
        <div class="alert alert-warning alert-custom mb-4 d-flex align-items-center gap-3 border-start border-warning border-4" role="alert" style="background-color: #FFFBEB;">
            <i class="fas fa-map-location-dot fs-3 text-warning" aria-hidden="true"></i>
            <div>
                <h4 class="alert-heading mb-1" style="font-size: 1rem; font-weight: 700; color: #92400E;">Lengkapi Titik Lokasi Usaha!</h4>
                <p class="mb-0" style="font-size: 0.85rem; color: #92400E;">
                    Silakan tentukan titik koordinat gudang/usaha Anda agar algoritma clustering dapat memperhitungkan rute konsolidasi kargo.
                </p>
            </div>
            <a href="<?= base_url('umkm/profil') ?>" class="btn btn-warning btn-sm ms-auto fw-bold px-3 py-2 text-nowrap" style="color: #92400E; background-color: #FCD34D; border: none;">
                <i class="fas fa-user-edit me-1"></i> Atur Lokasi
            </a>
        </div>
    <?php endif; ?>

    <!-- HEADER UTAMA DASBOR -->
    <section class="page-heading" aria-labelledby="page-title">
        <div>
            <h1 id="page-title" class="page-title mt-2">Dasbor UMKM</h1>
            <p class="page-description">Pantau profil usaha, perkembangan konsorsium, kapasitas produksi, dan kargo ekspor Anda dalam satu sistem terintegrasi.</p>
        </div>
        <?php if ($isTerverifikasi): ?>
            <a href="<?= base_url('umkm/produk') ?>" class="btn-utama">
                <i class="fas fa-plus" aria-hidden="true"></i> Input & Kelola Produk
            </a>
        <?php else: ?>
            <button class="btn-locked" disabled title="Fitur terkunci: Menunggu verifikasi legalitas (KYB) oleh Admin">
                <i class="fas fa-lock" aria-hidden="true"></i> Input Produk (Terkunci)
            </button>
        <?php endif; ?>
    </section>

    <!-- KARTU PROFIL & STATUS KONSORSIUM -->
    <section class="row g-3 g-lg-4 mb-4" aria-label="Profil dan status konsorsium">
        <div class="col-12 col-lg-6">
            <article class="dashboard-card p-4">
                <h2 class="card-heading">
                    <span class="card-heading-icon"><i class="fas fa-building" aria-hidden="true"></i></span>
                    Profil Pelaku Usaha
                </h2>
                <div class="info-list">
                    <div class="info-row">
                        <div class="info-label">Nama Usaha / PT / CV</div>
                        <div class="info-value"><?= esc($user['nama'] ?? '-') ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email Kontak</div>
                        <div class="info-value"><?= esc($user['email'] ?? '-') ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Nomor Izin Usaha / NIB</div>
                        <div class="info-value font-monospace"><?= esc($user['nomor_izin_usaha'] ?? 'Belum dilampirkan') ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Status Verifikasi (KYB)</div>
                        <div class="info-value">
                            <?php if ($isTerverifikasi): ?>
                                <span class="badge bg-success"><i class="fas fa-circle-check me-1"></i>Terverifikasi</span>
                            <?php elseif (($user['status_verifikasi'] ?? '') === 'Ditolak'): ?>
                                <span class="badge bg-danger"><i class="fas fa-circle-xmark me-1"></i>Ditolak</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Menunggu Verifikasi</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Lokasi / Koordinat</div>
                        <div class="info-value font-monospace text-secondary"><?= esc($user['koordinat_lokasi'] ?? 'Belum diatur') ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Trust Score</div>
                        <div class="info-value"><span class="fw-bolder text-success fs-6"><i class="fas fa-shield-halved me-1" aria-hidden="true"></i><?= esc($user['trust_score'] ?? 0) ?> Poin</span></div>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-12 col-lg-6">
            <article class="dashboard-card p-4">
                <h2 class="card-heading">
                    <span class="card-heading-icon"><i class="fas fa-people-group" aria-hidden="true"></i></span>
                    Status Konsorsium Digital
                </h2>
                <?php if ($hasKonsorsium) : ?>
                    <div class="consortium-notice">
                        <i class="fas fa-circle-check mt-1" aria-hidden="true"></i>
                        <div>Anda telah tergabung dalam konsorsium ekspor. Pantau kuota dan anggota yang berkolaborasi di bawah ini.</div>
                    </div>
                    <div class="info-list mb-3">
                        <div class="info-row">
                            <div class="info-label">Nama Konsorsium</div>
                            <div class="info-value"><?= esc($konsorsium['nama_konsorsium'] ?? '-') ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Target HS Code</div>
                            <div class="info-value"><span class="fw-bold font-monospace text-dark"><?= esc($konsorsium['target_hs_code'] ?? '-') ?></span></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Status Kuota Kontainer</div>
                            <div class="info-value">
                                <?php if (($konsorsium['status_kuota'] ?? '') === 'Penuh') : ?>
                                    <span class="fw-bold text-success"><i class="fas fa-circle-check me-1" aria-hidden="true"></i> Siap Berangkat (FCL)</span>
                                <?php else : ?>
                                    <span class="fw-bold text-warning" style="color: #92400E !important;"><i class="fas fa-clock me-1" aria-hidden="true"></i> Terbuka (LCL)</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="border-top pt-3 mt-3">
                        <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
                            <div>
                                <h3 class="mb-1" style="font-size:.88rem;font-weight:700;color:#0F172A;">Progres Keterisian Kontainer</h3>
                                <p class="mb-0 text-muted" style="font-size:.74rem;">Target: <?= number_format($targetFclView, 0, ',', '.') ?> Kg</p>
                            </div>
                            <span class="fw-bold text-primary fs-5"><?= number_format($persentaseView, 1, ',', '.') ?>%</span>
                        </div>
                        <div class="progress progress-custom" role="progressbar" aria-label="Progres keterisian kontainer" aria-valuenow="<?= $persentaseView ?>" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar <?= $kapasitasProgress ?>" style="width: <?= $persentaseView ?>%;"></div>
                        </div>
                        <div class="progress-note">
                            <span>Terkumpul: <strong><?= number_format($totalKapasitasView, 0, ',', '.') ?> Kg</strong></span>
                            <span class="text-end">Sisa kuota: <strong><?= number_format($sisaKuotaView, 0, ',', '.') ?> Kg</strong></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                            <h3 class="mb-0" style="font-size:.82rem;font-weight:700;color:#334155;">Anggota Tergabung</h3>
                            <span class="text-muted fw-bold" style="font-size:.74rem;"><?= $totalAnggotaView ?> UMKM</span>
                        </div>
                        <?php if (!empty($anggota)) : ?>
                            <div class="member-list">
                                <?php foreach ($anggota as $umkm) : ?>
                                    <span class="member-chip"><i class="fas fa-user-group" aria-hidden="true"></i><?= esc($umkm['nama_umkm'] ?? 'UMKM') ?> · <?= number_format((float) ($umkm['kontribusi_kapasitas'] ?? 0), 0, ',', '.') ?> Kg</span>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <p class="text-muted mb-0" style="font-size:.78rem;">Informasi anggota belum tersedia.</p>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="empty-consortium">
                        <span class="empty-consortium-icon"><i class="fas fa-boxes-stacked" aria-hidden="true"></i></span>
                        <p>Anda belum tergabung dalam konsorsium pengiriman. Daftarkan komoditas Anda agar algoritma clustering dapat mencarikan konsorsium yang tepat.</p>
                        <?php if ($isTerverifikasi): ?>
                            <a href="<?= base_url('umkm/produk') ?>" class="btn-utama"><i class="fas fa-plus" aria-hidden="true"></i> Input & Ajukan Produk</a>
                        <?php else: ?>
                            <button class="btn-locked" disabled><i class="fas fa-lock" aria-hidden="true"></i> Input Produk (Terkunci)</button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </article>
        </div>
    </section>

    <?php
        $daftarPesananView = [];

        if (isset($semuaPesananKonsorsium) && is_iterable($semuaPesananKonsorsium)) {
            foreach ($semuaPesananKonsorsium as $pesananSumber) {
                if (is_array($pesananSumber)) {
                    $daftarPesananView[] = $pesananSumber;
                }
            }
        } else {
            foreach ([$pesananKonsorsium ?? [], $riwayatPesanan ?? []] as $sumberPesanan) {
                if (!is_iterable($sumberPesanan)) {
                    continue;
                }

                foreach ($sumberPesanan as $pesananSumber) {
                    if (is_array($pesananSumber)) {
                        $daftarPesananView[] = $pesananSumber;
                    }
                }
            }
        }

        $pesananMasuk = [];
        $riwayatPesananView = [];
        $idPesananSudahAda = [];

        foreach ($daftarPesananView as $pesananSumber) {
            $idPesanan = $pesananSumber['id_pesanan'] ?? null;
            $kunciPesanan = $idPesanan !== null ? (string) $idPesanan : null;

            if ($kunciPesanan !== null && isset($idPesananSudahAda[$kunciPesanan])) {
                continue;
            }

            if ($kunciPesanan !== null) {
                $idPesananSudahAda[$kunciPesanan] = true;
            }

            $statusSumber = strtolower(trim((string) ($pesananSumber['status_pemesanan'] ?? '')));

            if ($statusSumber === 'selesai') {
                $riwayatPesananView[] = $pesananSumber;
            } else {
                $pesananMasuk[] = $pesananSumber;
            }
        }
    ?>

    <!-- PESANAN AKTIF UMKM (ALUR OPSI 2) -->
    <section aria-labelledby="pesanan-umkm-title" class="mb-4">
        <div class="section-heading">
            <div>
                <h2 id="pesanan-umkm-title" class="section-title">Pesanan Aktif</h2>
                <p class="section-subtitle">Kelola pesanan yang masih berjalan dari seluruh konsorsium yang pernah Anda ikuti.</p>
            </div>
        </div>
        <div class="product-panel">
            <div class="product-panel-header">
                <h3 class="product-panel-title">
                    <span class="product-panel-icon"><i class="fas fa-shipping-fast" aria-hidden="true"></i></span>
                    Daftar Kargo & Status Pesanan Aktif
                </h3>
                <span class="badge bg-primary"><?= count($pesananMasuk) ?> aktif</span>
            </div>

            <?php if (!empty($pesananMasuk)) : ?>
                <!-- TAMPILAN TABEL DESKTOP -->
                <div class="table-responsive desktop-order-table">
                    <table class="table table-custom table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID Pesanan</th>
                                <th scope="col">Konsorsium</th>
                                <th scope="col">Volume MOQ</th>
                                <th scope="col">Tgl. Pengiriman</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="order-action-heading">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pesananMasuk as $pk) : ?>
                                <?php
                                    $statusPesan = strtolower(trim((string) ($pk['status_pemesanan'] ?? '')));
                                    $bgBadge = 'secondary';

                                    if ($statusPesan === 'dikirim') {
                                        $bgBadge = 'primary';
                                    } elseif ($statusPesan === 'diproses') {
                                        $bgBadge = 'info text-dark';
                                    } elseif ($statusPesan === 'pending') {
                                        $bgBadge = 'warning text-dark';
                                    }
                                ?>
                                <tr>
                                    <td><span class="order-id" style="color: #10499D; font-weight: 700;">#ORD-<?= str_pad((string) ($pk['id_pesanan'] ?? ''), 4, '0', STR_PAD_LEFT) ?></span></td>
                                    <td><span class="product-name"><?= esc($pk['nama_konsorsium'] ?? '-') ?></span></td>
                                    <td><?= number_format((float) ($pk['total_moq'] ?? 0), 0, ',', '.') ?> Kg</td>
                                    <td><span class="text-secondary"><?= esc($pk['tanggal_pengiriman'] ?? '-') ?></span></td>
                                    <td><span class="badge bg-<?= $bgBadge ?>"><?= esc($pk['status_pemesanan'] ?? 'Pending') ?></span></td>
                                    <td class="order-action-cell">
                                        <div class="order-action-wrap">
                                            <?php if ($statusPesan === 'pending') : ?>
                                                <a href="<?= base_url('umkm/pesanan/status/' . (int) $pk['id_pesanan'] . '/Diproses') ?>"
                                                   class="btn btn-sm order-status-button order-status-process"
                                                   onclick="return confirm('Proses kargo ini? Anda menandakan bahwa barang mulai disiapkan dan dikirim ke gudang hub pelabuhan.')">
                                                    <i class="fas fa-dolly" aria-hidden="true"></i><span>Proses Kargo</span>
                                                </a>
                                            <?php elseif ($statusPesan === 'diproses') : ?>
                                                <!-- Opsi 2: UMKM Menunggu Inspeksi & Izin Layar Administrator -->
                                                <span class="order-admin-inspect-label">
                                                    <i class="fas fa-clipboard-check" aria-hidden="true"></i><span>Menunggu Inspeksi Admin</span>
                                                </span>
                                            <?php elseif ($statusPesan === 'dikirim') : ?>
                                                <!-- Kargo sudah berlayar, menunggu konfirmasi penerimaan oleh Buyer -->
                                                <span class="order-wait-label">
                                                    <i class="fas fa-ship" aria-hidden="true"></i><span>Kargo Berlayar (Buyer)</span>
                                                </span>
                                            <?php else : ?>
                                                <span class="text-muted small">Status perlu diperiksa</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- TAMPILAN KARTU MOBILE -->
                <div class="mobile-order-list">
                    <?php foreach ($pesananMasuk as $pk) : ?>
                        <?php
                            $statusPesan = strtolower(trim((string) ($pk['status_pemesanan'] ?? '')));
                            $bgBadge = 'secondary';

                            if ($statusPesan === 'dikirim') {
                                $bgBadge = 'primary';
                            } elseif ($statusPesan === 'diproses') {
                                $bgBadge = 'info text-dark';
                            } elseif ($statusPesan === 'pending') {
                                $bgBadge = 'warning text-dark';
                            }
                        ?>
                        <article class="mobile-product-card shadow-sm">
                            <div class="mobile-product-top">
                                <div>
                                    <div class="mobile-label">ID Pesanan</div>
                                    <div class="order-id" style="color: #10499D; font-weight: 700;">#ORD-<?= str_pad((string) ($pk['id_pesanan'] ?? ''), 4, '0', STR_PAD_LEFT) ?></div>
                                </div>
                                <span class="badge bg-<?= $bgBadge ?>"><?= esc($pk['status_pemesanan'] ?? 'Pending') ?></span>
                            </div>
                            <div class="pt-3">
                                <div class="mobile-label">Konsorsium</div>
                                <div class="mobile-value"><?= esc($pk['nama_konsorsium'] ?? '-') ?></div>
                            </div>
                            <div class="mobile-product-meta">
                                <div>
                                    <div class="mobile-label">Volume MOQ</div>
                                    <div class="mobile-value"><?= number_format((float) ($pk['total_moq'] ?? 0), 0, ',', '.') ?> Kg</div>
                                </div>
                                <div>
                                    <div class="mobile-label">Tgl. Pengiriman</div>
                                    <div class="mobile-value text-secondary"><?= esc($pk['tanggal_pengiriman'] ?? '-') ?></div>
                                </div>
                                <div style="grid-column: 1 / -1; padding-top: .5rem;">
                                    <div class="mobile-label mb-2">Aksi Operasional</div>
                                    <?php if ($statusPesan === 'pending') : ?>
                                        <a href="<?= base_url('umkm/pesanan/status/' . (int) $pk['id_pesanan'] . '/Diproses') ?>"
                                           class="btn btn-sm btn-primary w-100 fw-bold" style="border-radius: 8px;"
                                           onclick="return confirm('Proses kargo ini? Anda menandakan bahwa barang mulai disiapkan dan dikirim ke gudang hub pelabuhan.')">
                                            <i class="fas fa-dolly me-1"></i> Proses Kargo
                                        </a>
                                    <?php elseif ($statusPesan === 'diproses') : ?>
                                        <div class="text-center w-100 p-2" style="background: #E0F2FE; border: 1px solid #BAE6FD; border-radius: 8px; color: #0369A1; font-weight: 700; font-size: .8rem;">
                                            <i class="fas fa-clipboard-check me-1"></i> Menunggu Inspeksi Admin
                                        </div>
                                    <?php elseif ($statusPesan === 'dikirim') : ?>
                                        <div class="text-center w-100 p-2" style="background: #FFFBEB; border: 1px solid #FEF3C7; border-radius: 8px; color: #B45309; font-weight: 700; font-size: .8rem;">
                                            <i class="fas fa-ship me-1"></i> Kargo Berlayar (Menunggu Buyer)
                                        </div>
                                    <?php else : ?>
                                        <div class="text-center w-100 p-2 text-muted" style="border: 1px solid #E2E8F0; border-radius: 8px; font-weight: 600; font-size: .8rem;">
                                            Status perlu diperiksa
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-products">
                    <span class="empty-products-icon"><i class="fas fa-box-open" aria-hidden="true"></i></span>
                    <h3>Tidak ada pesanan aktif</h3>
                    <p>Pesanan yang masih diproses akan muncul di sini. Pesanan yang sudah selesai dapat dilihat pada bagian Riwayat Pesanan.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- RIWAYAT PESANAN SELESAI -->
    <section aria-labelledby="riwayat-pesanan-title" class="mb-4">
        <div class="section-heading">
            <div>
                <h2 id="riwayat-pesanan-title" class="section-title">Riwayat Pesanan</h2>
                <p class="section-subtitle">Pesanan berstatus Selesai dari seluruh konsorsium yang pernah Anda ikuti.</p>
            </div>
        </div>
        <div class="product-panel">
            <div class="product-panel-header">
                <h3 class="product-panel-title">
                    <span class="product-panel-icon"><i class="fas fa-clipboard-check" aria-hidden="true"></i></span>
                    Transaksi yang Telah Selesai
                </h3>
                <span class="badge bg-success"><?= count($riwayatPesananView) ?> selesai</span>
            </div>

            <?php if (!empty($riwayatPesananView)) : ?>
                <div class="table-responsive desktop-order-table">
                    <table class="table table-custom table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID Pesanan</th>
                                <th scope="col">Konsorsium</th>
                                <th scope="col">Volume MOQ</th>
                                <th scope="col">Tgl. Pengiriman</th>
                                <th scope="col">Status Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($riwayatPesananView as $pk) : ?>
                                <tr>
                                    <td><span class="order-id" style="color: #10499D; font-weight: 700;">#ORD-<?= str_pad((string) ($pk['id_pesanan'] ?? ''), 4, '0', STR_PAD_LEFT) ?></span></td>
                                    <td><span class="product-name"><?= esc($pk['nama_konsorsium'] ?? '-') ?></span></td>
                                    <td><?= number_format((float) ($pk['total_moq'] ?? 0), 0, ',', '.') ?> Kg</td>
                                    <td><span class="text-secondary"><?= esc($pk['tanggal_pengiriman'] ?? '-') ?></span></td>
                                    <td>
                                        <span class="order-complete-label">
                                            <i class="fas fa-check-circle" aria-hidden="true"></i><span>Selesai (+10 Skor)</span>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mobile-order-list">
                    <?php foreach ($riwayatPesananView as $pk) : ?>
                        <article class="mobile-product-card shadow-sm">
                            <div class="mobile-product-top">
                                <div>
                                    <div class="mobile-label">ID Pesanan</div>
                                    <div class="order-id" style="color: #10499D; font-weight: 700;">#ORD-<?= str_pad((string) ($pk['id_pesanan'] ?? ''), 4, '0', STR_PAD_LEFT) ?></div>
                                </div>
                                <span class="badge bg-success">Selesai (+10 Skor)</span>
                            </div>
                            <div class="pt-3">
                                <div class="mobile-label">Konsorsium</div>
                                <div class="mobile-value"><?= esc($pk['nama_konsorsium'] ?? '-') ?></div>
                            </div>
                            <div class="mobile-product-meta">
                                <div>
                                    <div class="mobile-label">Volume MOQ</div>
                                    <div class="mobile-value"><?= number_format((float) ($pk['total_moq'] ?? 0), 0, ',', '.') ?> Kg</div>
                                </div>
                                <div>
                                    <div class="mobile-label">Tgl. Pengiriman</div>
                                    <div class="mobile-value text-secondary"><?= esc($pk['tanggal_pengiriman'] ?? '-') ?></div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-products">
                    <span class="empty-products-icon"><i class="fas fa-clipboard-list" aria-hidden="true"></i></span>
                    <h3>Belum ada riwayat pesanan</h3>
                    <p>Pesanan akan tercatat di sini setelah Buyer mengonfirmasi penerimaan kontainer dan transaksi diselesaikan.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- RINGKASAN PRODUK & KAPASITAS -->
    <section aria-labelledby="stats-title">
        <div class="section-heading">
            <div>
                <h2 id="stats-title" class="section-title">Ringkasan Produk</h2>
                <p class="section-subtitle">Ikhtisar varian produk dan kapasitas produksi bulanan dari usaha Anda.</p>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-6">
                <article class="stat-card">
                    <span class="stat-icon blue"><i class="fas fa-boxes-stacked" aria-hidden="true"></i></span>
                    <div>
                        <div class="stat-label">Total Varian Produk Terdaftar</div>
                        <div class="stat-number"><?= number_format($totalProdukView) ?> Produk</div>
                    </div>
                </article>
            </div>
            <div class="col-6 col-xl-6">
                <article class="stat-card">
                    <span class="stat-icon green"><i class="fas fa-chart-column" aria-hidden="true"></i></span>
                    <div>
                        <div class="stat-label">Akumulasi Kapasitas Produksi Bulanan</div>
                        <div class="stat-number"><?= number_format($kapasitasProdukView, 0, ',', '.') ?> Kg</div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- TABEL DAFTAR PRODUK TERDAFTAR -->
    <section aria-labelledby="products-title">
        <div class="section-heading">
            <div>
                <h2 id="products-title" class="section-title">Produk Terdaftar</h2>
                <p class="section-subtitle">Daftar komoditas ekspor yang telah Anda inputkan ke sistem NusaChain.</p>
            </div>
            <span class="text-muted fw-bold small"><?= is_countable($daftarProduk) ? count($daftarProduk) : 0 ?> produk terdaftar</span>
        </div>
        <div class="product-panel">
            <div class="product-panel-header">
                <h3 class="product-panel-title"><span class="product-panel-icon"><i class="fas fa-list-check" aria-hidden="true"></i></span> Ringkasan Produk Terdaftar</h3>
                <?php if ($isTerverifikasi): ?>
                    <a href="<?= base_url('umkm/produk') ?>" class="btn-utama"><i class="fas fa-plus" aria-hidden="true"></i><span>Tambah / Kelola Produk</span></a>
                <?php else: ?>
                    <button class="btn-locked" disabled><i class="fas fa-lock" aria-hidden="true"></i><span>Tambah Produk (Terkunci)</span></button>
                <?php endif; ?>
            </div>
            <?php if (!empty($daftarProduk)) : ?>
                <div class="table-responsive desktop-product-table">
                    <table class="table table-custom table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">HS Code</th>
                                <th scope="col">Kapasitas Bulanan</th>
                                <th scope="col">Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($daftarProduk as $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><span class="product-name"><?= esc($item['nama_produk'] ?? '-') ?></span></td>
                                    <td><span class="font-monospace fw-bold text-secondary"><?= esc($item['hs_code'] ?? '-') ?></span></td>
                                    <td><?= number_format((float) ($item['kapasitas_bulanan'] ?? 0), 0, ',', '.') ?></td>
                                    <td><span class="fw-bold text-secondary"><?= esc($item['satuan'] ?? '-') ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mobile-product-list">
                    <?php foreach ($daftarProduk as $item) : ?>
                        <article class="mobile-product-card">
                            <div class="mobile-product-top">
                                <div>
                                    <div class="mobile-label">Nama Produk</div>
                                    <div class="mobile-value"><?= esc($item['nama_produk'] ?? '-') ?></div>
                                </div>
                                <span class="fw-bold text-secondary small"><?= esc($item['satuan'] ?? '-') ?></span>
                            </div>
                            <div class="mobile-product-meta">
                                <div>
                                    <div class="mobile-label">HS Code</div>
                                    <span class="font-monospace fw-bold text-secondary"><?= esc($item['hs_code'] ?? '-') ?></span>
                                </div>
                                <div>
                                    <div class="mobile-label">Kapasitas Bulanan</div>
                                    <div class="mobile-value"><?= number_format((float) ($item['kapasitas_bulanan'] ?? 0), 0, ',', '.') ?></div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-products">
                    <span class="empty-products-icon"><i class="fas fa-box-open" aria-hidden="true"></i></span>
                    <h3>Belum ada produk terdaftar</h3>
                    <p>Produk yang Anda tambahkan akan otomatis dicocokkan dengan konsorsium ber-HS Code sama.</p>
                    <?php if ($isTerverifikasi): ?>
                        <a href="<?= base_url('umkm/produk') ?>" class="btn-utama"><i class="fas fa-plus" aria-hidden="true"></i> Tambah Produk Pertama</a>
                    <?php else: ?>
                        <button class="btn-locked" disabled><i class="fas fa-lock" aria-hidden="true"></i> Tambah Produk (Terkunci)</button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>