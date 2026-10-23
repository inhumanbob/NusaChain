<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Detail Konsorsium - NusaChain</title>

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

        /* KONSISTENSI UKURAN CONTAINER & LAYOUT */
        .page-shell { padding-top: 2rem; padding-bottom: 3rem; }

        .page-hero {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            padding: clamp(1.5rem, 3.5vw, 2.5rem);
            margin-bottom: 1.5rem;
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
            box-shadow: 0 0 0 28px rgba(255, 255, 255, 0.045), 0 0 0 58px rgba(255, 255, 255, 0.035);
            pointer-events: none;
        }

        .hero-content, .hero-action { position: relative; z-index: 1; }

        .page-title {
            margin: 0 0 .5rem;
            color: var(--white);
            font-size: clamp(1.55rem, 2.8vw, 2.05rem);
            font-weight: 700;
            letter-spacing: -.035em;
        }

        .page-subtitle {
            max-width: 690px;
            margin: 0;
            color: rgba(255, 255, 255, 0.84);
            font-size: .9rem;
            line-height: 1.7;
        }

        .btn-outline-hero {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            min-height: 44px;
            padding: .68rem 1rem;
            color: var(--royal-blue);
            background: #FFFFFF;
            border: 1px solid #FFFFFF;
            border-radius: 9px;
            font-size: .86rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: all .2s ease;
        }
        .btn-outline-hero:hover { color: var(--deep-blue); background: #EAF2FF; border-color: #EAF2FF; }

        .btn-utama {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            min-height: 44px;
            padding: .7rem 1.2rem;
            color: var(--white) !important;
            background: var(--royal-blue) !important;
            border: 1px solid var(--royal-blue) !important;
            border-radius: 9px;
            font-size: .86rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color .2s ease, transform .2s ease, box-shadow .2s ease;
        }
        .btn-utama:hover, .btn-utama:focus-visible {
            background: var(--deep-blue) !important;
            border-color: var(--deep-blue) !important;
            transform: translateY(-1px);
            box-shadow: 0 5px 14px rgba(16,73,157,.18);
        }

        /* CARD STYLES KONSISTEN */
        .content-card {
            height: 100%;
            background: #FFFFFF;
            border: 1px solid #E8EDF5;
            border-radius: 17px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        
        .card-header-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 20px 22px 16px;
            background: transparent;
            border-bottom: 1px solid #EEF2F7;
        }

        .header-title-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            flex: 0 0 auto;
            color: var(--royal-blue);
            background: var(--ice-blue);
            border-radius: 12px;
            font-size: 1rem;
        }
        .section-title { margin: 0; color: #0F172A; font-size: 1.05rem; font-weight: 700; }
        .section-subtitle { margin: 4px 0 0; color: var(--muted); font-size: .78rem; line-height: 1.6; }
        .card-content { padding: 22px; }

        /* Elemen Khusus Detail Konsorsium */
        .consortium-name { color: var(--royal-blue); font-size: 1.4rem; font-weight: 800; margin-bottom: 0.5rem; }
        .hs-badge-large { 
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; background: #F8FAFC; border: 1px solid #CBD5E1; 
            border-radius: 8px; font-weight: 700; font-family: monospace; color: #334155; font-size: 0.9rem;
        }
        
        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 50px; font-weight: 700; font-size: 0.85rem;
        }
        .status-fcl { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
        .status-lcl { background: #FEF9C3; color: #854D0E; border: 1px solid #FEF08A; }
        .status-dipesan { background: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE; }
        .status-dikirim { background: #E0E7FF; color: #3730A3; border: 1px solid #C7D2FE; }
        .status-selesai { background: #F1F5F9; color: #475569; border: 1px solid #E2E8F0; }

        .progress-title { font-size: 0.9rem; font-weight: 700; color: #0F172A; margin-bottom: 0; }
        .progress-percentage { font-size: 1.4rem; font-weight: 800; }
        
        .progress-custom { height: 16px; background: #E8EEF7; border-radius: 50px; overflow: hidden; box-shadow: inset 0 1px 3px rgba(0,0,0,0.05); }
        .progress-custom .progress-bar { border-radius: 50px; }
        
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 1.5rem;
        }
        .stat-box {
            padding: 15px;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            text-align: center;
        }
        .stat-label { color: var(--muted); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 5px; }
        .stat-value { color: #0F172A; font-size: 1.15rem; font-weight: 700; }
        .stat-value.danger { color: #DC3545; }

        /* Tabel Anggota */
        .table-custom { width: 100%; margin: 0; border-collapse: separate; border-spacing: 0; }
        .table-custom thead th { padding: 14px 16px; color: #64748B; background: #F8FAFC; border-bottom: 1px solid #E8EDF5; font-size: .75rem; font-weight: 600; letter-spacing: .035em; text-transform: uppercase; white-space: nowrap; }
        .table-custom tbody td { padding: 16px; color: #334155; background: #FFFFFF; border-bottom: 1px solid #EEF2F7; font-size: .85rem; vertical-align: middle; }
        .table-custom tbody tr:last-child td { border-bottom: 0; }
        .table-custom tbody tr:hover td { background: #FBFDFF; }
        
        .member-name { display: flex; align-items: center; gap: 10px; font-weight: 600; color: #0F172A; }
        .member-icon { display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #EAF2FF; color: var(--royal-blue); border-radius: 8px; font-size: 0.8rem; }

        /* Empty State */
        .empty-state { padding: 60px 20px; text-align: center; }
        .empty-state-icon { display: inline-flex; align-items: center; justify-content: center; width: 72px; height: 72px; margin-bottom: 18px; color: var(--royal-blue); background: var(--ice-blue); border-radius: 20px; font-size: 1.8rem; }
        .empty-state h3 { margin-bottom: 8px; color: #0F172A; font-size: 1.15rem; font-weight: 700; }
        .empty-state p { max-width: 500px; margin: 0 auto 20px; color: var(--muted); font-size: .85rem; line-height: 1.65; }

        @media (max-width: 991.98px) {
            .page-hero { align-items: flex-start; flex-direction: column; }
            .hero-action { width: 100%; }
            .hero-action .btn, .hero-action a { width: 100%; }
        }
        @media (max-width: 767.98px) {
            .page-shell { padding-top: 1.25rem; padding-bottom: 2rem; }
            .page-hero { padding: 23px 20px; margin-bottom: 1.15rem; border-radius: 16px; }
            .page-subtitle { font-size: .84rem; }
            .stat-grid { grid-template-columns: 1fr; gap: 10px; }
            .card-header-custom { flex-direction: column; align-items: flex-start; gap: 15px; }
            .card-content { padding: 18px; }
            .table-responsive { border: 0; }
        }
    </style>
</head>
<body>

<?= $this->include('layout/navbar') ?>
<?= $this->include('layout/flash_toast') ?>

<?php
    // Inisialisasi variabel agar aman dari error
    $hasKonsorsium  = $hasKonsorsium ?? false;
    $konsorsium     = is_array($konsorsium ?? null) ? $konsorsium : [];
    $anggota        = (isset($anggota) && is_iterable($anggota)) ? $anggota : [];
    $persentase     = (float) ($persentase ?? 0);
    $targetFcl      = (float) ($targetFcl ?? 0);
    $totalKapasitas = (float) ($totalKapasitas ?? 0);
    $sisaKuota      = (float) ($sisaKuota ?? 0);
    $totalAnggota   = (int) ($totalAnggota ?? 0);
    $statusKuota    = (string) ($konsorsium['status_kuota'] ?? '');
    
    // Penentuan warna bar
    $warnaProgres = $persentase >= 100 ? 'bg-success' : 'bg-primary';
?>

<main class="container page-shell">
    <!-- Hero Banner -->
    <section class="page-hero" aria-labelledby="page-title">
        <div class="hero-content">
            <h1 class="page-title" id="page-title">Ruang Konsorsium Digital</h1>
            <p class="page-subtitle">Pantau status kuota pengiriman kontainer (FCL), kumpulkan kapasitas produk, dan lihat mitra kolaborasi Anda dalam satu wadah.</p>
        </div>
        <div class="hero-action">
            <a href="<?= base_url('umkm/dashboard') ?>" class="btn-outline-hero">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>Kembali ke Beranda
            </a>
        </div>
    </section>

    <?php if (! $hasKonsorsium) : ?>
        <!-- Tampilan Saat Belum Bergabung Konsorsium -->
        <div class="content-card text-center mb-4">
            <div class="empty-state">
                <span class="empty-state-icon"><i class="fas fa-boxes-stacked"></i></span>
                <h3>Anda belum tergabung dalam konsorsium</h3>
                <p>Input produk Anda melalui halaman kelola, lalu kecerdasan sistem NusaChain akan otomatis mencarikan atau membuatkan ruang konsorsium berdasarkan kecocokan HS Code.</p>
                <a href="<?= base_url('umkm/produk') ?>" class="btn-utama mt-2">
                    <i class="fas fa-plus me-1"></i> Input Produk Sekarang
                </a>
            </div>
        </div>
    <?php else : ?>
        <!-- Tampilan Detail Konsorsium Aktif -->
        <div class="row g-3 g-lg-4 mb-4">
            <!-- Kolom Info & Status Utama -->
            <div class="col-12 col-xl-5">
                <div class="content-card">
                    <div class="card-header-custom">
                        <div class="header-title-group">
                            <span class="section-icon"><i class="fas fa-circle-info"></i></span>
                            <div>
                                <h2 class="section-title">Informasi Konsorsium</h2>
                                <p class="section-subtitle">Identitas dan status keberangkatan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <p class="text-muted text-uppercase fw-bold small mb-1" style="letter-spacing: 0.05em;">Nama Kelompok Ekspor</p>
                        <h3 class="consortium-name"><?= esc($konsorsium['nama_konsorsium'] ?? '-') ?></h3>
                        
                        <div class="mt-3 mb-4">
                            <span class="hs-badge-large" title="Kode Kepabeanan">
                                <i class="fas fa-barcode text-muted"></i> HS Code: <?= esc($konsorsium['target_hs_code'] ?? '-') ?>
                            </span>
                        </div>
                        
                        <hr class="my-4" style="border-color: #E2E8F0;">
                        
                        <p class="text-muted text-uppercase fw-bold small mb-2" style="letter-spacing: 0.05em;">Status Keberangkatan</p>
                        <?php if ($statusKuota === 'Penuh') : ?>
                            <span class="status-badge status-fcl"><i class="fas fa-circle-check"></i> Siap Berangkat (FCL)</span>
                        <?php elseif ($statusKuota === 'Dipesan') : ?>
                            <span class="status-badge status-dipesan"><i class="fas fa-box"></i> Sudah Dipesan Buyer</span>
                        <?php elseif ($statusKuota === 'Dikirim') : ?>
                            <span class="status-badge status-dikirim"><i class="fas fa-truck-fast"></i> Dalam Pengiriman</span>
                        <?php elseif ($statusKuota === 'Selesai') : ?>
                            <span class="status-badge status-selesai"><i class="fas fa-flag-checkered"></i> Selesai</span>
                        <?php else : ?>
                            <span class="status-badge status-lcl"><i class="fas fa-clock"></i> Terbuka (LCL)</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Kolom Progress Bar -->
            <div class="col-12 col-xl-7">
                <div class="content-card">
                    <div class="card-header-custom">
                        <div class="header-title-group">
                            <span class="section-icon"><i class="fas fa-chart-pie"></i></span>
                            <div>
                                <h2 class="section-title">Keterisian Kontainer</h2>
                                <p class="section-subtitle">Pantau pemenuhan target kuota ekspor.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-end mb-3">
                            <h5 class="progress-title">Progres Pemenuhan</h5>
                            <span class="progress-percentage <?= $persentase >= 100 ? 'text-success' : 'text-primary' ?>">
                                <?= number_format($persentase, 1, ',', '.') ?>%
                            </span>
                        </div>
                        
                        <div class="progress progress-custom shadow-sm" role="progressbar" aria-label="Progres keterisian" aria-valuenow="<?= $persentase ?>" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated <?= $warnaProgres ?>" style="width: <?= $persentase ?>%;"></div>
                        </div>
                        
                        <div class="stat-grid">
                            <div class="stat-box">
                                <div class="stat-label">Target (FCL)</div>
                                <div class="stat-value"><?= number_format($targetFcl, 0, ',', '.') ?> Kg</div>
                            </div>
                            <div class="stat-box" style="background: #F0F9FF; border-color: #E0F2FE;">
                                <div class="stat-label">Terkumpul</div>
                                <div class="stat-value text-primary"><?= number_format($totalKapasitas, 0, ',', '.') ?> Kg</div>
                            </div>
                            <div class="stat-box <?= $sisaKuota > 0 ? 'bg-white' : '' ?>">
                                <div class="stat-label">Kekurangan</div>
                                <div class="stat-value <?= $sisaKuota > 0 ? 'danger' : 'text-success' ?>">
                                    <?= $sisaKuota > 0 ? number_format($sisaKuota, 0, ',', '.') . ' Kg' : '<i class="fas fa-check"></i> Terpenuhi' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Anggota -->
        <div class="content-card">
            <div class="card-header-custom">
                <div class="header-title-group">
                    <span class="section-icon"><i class="fas fa-people-carry-box"></i></span>
                    <div>
                        <h2 class="section-title">Mitra Tergabung (Konsolidator)</h2>
                        <p class="section-subtitle">Daftar UMKM yang berkolaborasi dalam satu pengiriman kontainer.</p>
                    </div>
                </div>
                <span class="badge bg-secondary p-2 px-3 rounded-pill" style="font-size: 0.85rem;"><i class="fas fa-user-group me-1"></i> <?= $totalAnggota ?> UMKM</span>
            </div>
            
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelaku Usaha (UMKM)</th>
                            <th>Kontribusi Kapasitas</th>
                            <th>Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (! empty($anggota)) : ?>
                            <?php $no = 1; foreach ($anggota as $umkm) : ?>
                                <tr>
                                    <td class="text-muted fw-bold"><?= $no++ ?></td>
                                    <td>
                                        <div class="member-name">
                                            <span class="member-icon"><i class="fas fa-store"></i></span>
                                            <?= esc($umkm['nama_umkm'] ?? '-') ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2" style="font-size: 0.8rem;">
                                            <?= number_format((float) ($umkm['kontribusi_kapasitas'] ?? 0), 0, ',', '.') ?> Kg
                                        </span>
                                    </td>
                                    <td class="text-muted" style="font-size: 0.8rem;">
                                        <i class="far fa-calendar-alt me-1"></i> <?= esc($umkm['tanggal_bergabung'] ?? '-') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    <i class="fas fa-inbox fs-2 mb-3 d-block text-secondary opacity-50"></i>
                                    Belum ada anggota UMKM lain yang tergabung.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>