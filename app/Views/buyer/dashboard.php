<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Dasbor Buyer - NusaChain</title>

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
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
        }
        .btn-utama:hover {
            background: var(--deep-blue) !important;
            border-color: var(--deep-blue) !important;
            box-shadow: 0 5px 14px rgba(16, 73, 157, 0.18);
            transform: translateY(-1px);
        }

        .page-shell { padding-top: 2rem; padding-bottom: 3rem; }

        .welcome-panel {
            position: relative;
            overflow: hidden;
            padding: clamp(1.35rem, 3vw, 2.15rem);
            color: var(--white);
            background: linear-gradient(115deg, var(--deep-blue) 0%, var(--royal-blue) 65%, #2674C9 100%);
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 20px;
            box-shadow: 0 12px 28px rgba(16, 73, 157, 0.16);
        }
        .welcome-panel::after {
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
        .welcome-content { position: relative; z-index: 1; }
        
        .welcome-title { margin: 0 0 0.5rem; color: var(--white); font-size: clamp(1.45rem, 2.3vw, 2rem); font-weight: 700; letter-spacing: -0.035em; }
        .welcome-description { max-width: 650px; margin: 0; color: rgba(255, 255, 255, 0.84); font-size: 0.93rem; line-height: 1.75; }
        .welcome-panel .btn-utama { position: relative; z-index: 1; color: var(--royal-blue) !important; background: var(--white) !important; border-color: var(--white) !important; white-space: nowrap; }
        .welcome-panel .btn-utama:hover { color: var(--deep-blue) !important; background: #EAF2FF !important; border-color: #EAF2FF !important; }

        .section-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 1rem; margin: 1.9rem 0 1rem; }
        .section-title { margin: 0; color: #0F172A; font-size: 1.08rem; font-weight: 700; }
        .section-subtitle { margin: 0.3rem 0 0; color: var(--muted); font-size: 0.82rem; }

        .stat-card { display: flex; align-items: center; gap: 1rem; height: 100%; padding: 1.15rem; background: var(--surface); border: 1px solid #E8EDF5; border-radius: 15px; box-shadow: var(--shadow); transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(15, 41, 77, 0.085); }
        .stat-icon { display: inline-flex; align-items: center; justify-content: center; width: 46px; height: 46px; flex-shrink: 0; font-size: 1.05rem; border-radius: 12px; }
        .stat-icon.blue { color: var(--royal-blue); background: #EAF2FF; }
        .stat-icon.amber { color: #A16207; background: #FEF3C7; }
        .stat-icon.cyan { color: #0E7490; background: #CFFAFE; }
        .stat-icon.green { color: #15803D; background: #DCFCE7; }
        .stat-label { margin-bottom: 0.25rem; color: var(--muted); font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em;}
        .stat-number { color: #0F172A; font-size: 1.55rem; font-weight: 700; line-height: 1.1; }

        /* TABEL PESANAN */
        .orders-panel { overflow: hidden; background: var(--surface); border: 1px solid #E8EDF5; border-radius: 17px; box-shadow: var(--shadow); }
        .orders-panel-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 1.25rem 1.4rem; border-bottom: 1px solid #EEF2F7; }
        .orders-panel-title { display: flex; align-items: center; gap: 0.65rem; margin: 0; color: #0F172A; font-size: 1rem; font-weight: 700; }
        .orders-panel-title-icon { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; color: var(--royal-blue); background: var(--ice-blue); border-radius: 10px; }
        .orders-count { padding: 0.35rem 0.65rem; color: var(--royal-blue); font-size: 0.75rem; font-weight: 600; background: #EAF2FF; border-radius: 50px; white-space: nowrap; }

        .table-responsive { width: 100%; }
        .table-custom { width: 100%; margin: 0; border-collapse: separate; border-spacing: 0; }
        .table-custom thead th { padding: 14px 16px; color: #64748B; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.035em; white-space: nowrap; text-transform: uppercase; background: #F8FAFC; border-bottom: 1px solid #E8EDF5; }
        .table-custom tbody td { padding: 16px; color: var(--slate); font-size: 0.85rem; vertical-align: middle; background: #FFFFFF; border-bottom: 1px solid #EEF2F7; }
        .table-custom tbody tr:last-child td { border-bottom: 0; }
        .table-custom tbody tr:hover td { background: #FBFDFF; }

        .order-id { color: var(--royal-blue); font-weight: 700; white-space: nowrap; font-family: monospace; font-size: 0.95rem; }
        .consortium-name { min-width: 150px; color: #0F172A; font-weight: 600; }
        
        .hs-badge {
            display: inline-block;
            padding: 0.35rem 0.65rem;
            color: #475569;
            font-size: 0.75rem;
            font-weight: 700;
            background: #F1F5F9;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            white-space: nowrap;
            font-family: monospace;
        }
        
        /* WARNA BADGE & STATUS */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 50px;
            white-space: nowrap;
        }
        .status-badge::before { width: 6px; height: 6px; content: ''; background: currentColor; border-radius: 50%; }
        .status-pending { color: #92400E; background: #FEF3C7; border: 1px solid #FDE68A; }
        .status-diproses { color: #0369A1; background: #E0F2FE; border: 1px solid #BAE6FD; }
        .status-dikirim { color: #1E40AF; background: #DBEAFE; border: 1px solid #BFDBFE; }
        .status-selesai { color: #166534; background: #DCFCE7; border: 1px solid #BBF7D0; }
        .status-default { color: #475569; background: #F1F5F9; border: 1px solid #E2E8F0; }

        /* KOLOM AKSI BUYER */
        .order-action-heading, .order-action-cell { width: 220px; min-width: 220px; text-align: center !important; }
        .order-status-button { 
            display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; 
            padding: 0.55rem 0.85rem; border-radius: 8px; font-size: 0.78rem; font-weight: 600; 
            line-height: 1.2; white-space: nowrap; box-shadow: 0 2px 6px rgba(15, 41, 77, 0.08); 
            text-decoration: none; cursor: pointer;
        }
        .order-status-finish { background: #166534; border-color: #166534; color: white; }
        .order-status-finish:hover { background: #14532D; border-color: #14532D; color: white; }

        .empty-state { padding: 3.2rem 1.5rem; text-align: center; }
        .empty-state-icon { display: inline-flex; align-items: center; justify-content: center; width: 66px; height: 66px; margin-bottom: 1rem; color: var(--royal-blue); font-size: 1.55rem; background: var(--ice-blue); border-radius: 18px; }
        .empty-state h3 { margin-bottom: 0.45rem; color: #0F172A; font-size: 1.15rem; font-weight: 700; }
        .empty-state p { max-width: 420px; margin: 0 auto 1.2rem; color: var(--muted); font-size: 0.85rem; line-height: 1.7; }

        .mobile-order-list { display: none; padding: 0.9rem; }
        .mobile-order-card { padding: 1rem; background: #FFFFFF; border: 1px solid #E8EDF5; border-radius: 13px; }
        .mobile-order-card + .mobile-order-card { margin-top: 0.75rem; }
        .mobile-order-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 0.7rem; padding-bottom: 0.85rem; border-bottom: 1px solid #EEF2F7; }
        .mobile-order-label { margin-bottom: 0.2rem; color: var(--muted); font-size: 0.69rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
        .mobile-order-value { color: #0F172A; font-size: 0.85rem; font-weight: 600; overflow-wrap: anywhere; }
        .mobile-order-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem; padding-top: 0.85rem; }
        .mobile-meta-item { min-width: 0; }

        @media (max-width: 767.98px) {
            .page-shell { padding-top: 1.15rem; padding-bottom: 2rem; }
            .welcome-panel { border-radius: 16px; }
            .welcome-description { font-size: 0.84rem; }
            .welcome-panel .btn-utama { width: 100%; margin-top: 1rem; }
            .section-heading { align-items: flex-start; margin-top: 1.5rem; }
            .stat-card { gap: 0.75rem; padding: 0.9rem; border-radius: 13px; }
            .stat-icon { width: 39px; height: 39px; font-size: 0.92rem; border-radius: 10px; }
            .stat-label { font-size: 0.7rem; }
            .stat-number { font-size: 1.3rem; }
            .orders-panel { border-radius: 14px; }
            .orders-panel-header { padding: 1rem; }
            .orders-panel-title { font-size: 0.9rem; }
            .orders-panel-title-icon { width: 32px; height: 32px; }
            .desktop-order-table { display: none; }
            .mobile-order-list { display: block; }
        }

        @media (max-width: 420px) {
            .stat-card { align-items: flex-start; flex-direction: column; gap: 0.55rem; min-height: 120px; }
            .stat-icon { width: 34px; height: 34px; }
            .stat-number { font-size: 1.2rem; }
            .orders-count { font-size: 0.68rem; }
            .mobile-order-meta { gap: 0.8rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition: none !important; }
        }
    </style>
</head>
<body>
<?php
    $user = is_array($user ?? null) ? $user : [];
    $daftarPesanan = (isset($pesanan) && is_iterable($pesanan)) ? $pesanan : [];
    $jumlahPesanan = is_countable($daftarPesanan) ? count($daftarPesanan) : 0;
    
    $jumlahPending = 0;
    $jumlahDiproses = 0;
    $jumlahDikirim = 0;
    $jumlahSelesai = 0;

    // Kalkulasi Status Pesanan
    foreach ($daftarPesanan as $itemPesanan) {
        $statusRingkasan = strtolower(trim((string) ($itemPesanan['status_pemesanan'] ?? '')));
        if ($statusRingkasan === 'pending') {
            $jumlahPending++;
        } elseif ($statusRingkasan === 'diproses') {
            $jumlahDiproses++;
        } elseif ($statusRingkasan === 'dikirim') {
            $jumlahDikirim++;
        } elseif ($statusRingkasan === 'selesai') {
            $jumlahSelesai++;
        }
    }

    $isTerverifikasi = (($user['status_verifikasi'] ?? 'Pending') === 'Terverifikasi');

    $getStatusClass = static function ($status) {
        return match (strtolower(trim((string) $status))) {
            'pending'  => 'status-pending',
            'diproses' => 'status-diproses',
            'dikirim'  => 'status-dikirim',
            'selesai'  => 'status-selesai',
            default    => 'status-default',
        };
    };

    // Label status sesuai alur Opsi 2 (Konsolidator Ketat)
    $getStatusLabel = static function ($status) {
        return match (strtolower(trim((string) $status))) {
            'pending'  => 'Menunggu UMKM',
            'diproses' => 'Inspeksi Kargo (Admin)',
            'dikirim'  => 'Kargo Berlayar',
            'selesai'  => 'Selesai',
            default    => 'Tidak diketahui',
        };
    };
?>

<?= $this->include('layout/navbar') ?>
<?= $this->include('layout/flash_toast') ?>

<main class="container page-shell">

    <!-- BANNER PERINGATAN VERIFIKASI LEGALITAS (KYB) -->
    <?php if (! $isTerverifikasi): ?>
        <?php if (($user['status_verifikasi'] ?? 'Pending') === 'Ditolak'): ?>
            <div class="alert alert-danger mb-4 d-flex align-items-center gap-3 border-start border-danger border-4" role="alert" style="background-color: #FEF2F2; border-radius: 14px; border: 0; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.08);">
                <i class="fas fa-circle-xmark fs-2 text-danger" aria-hidden="true"></i>
                <div>
                    <h4 class="alert-heading mb-1" style="font-size: 1rem; font-weight: 700; color: #991B1B;">Verifikasi Entitas Bisnis Ditolak</h4>
                    <p class="mb-0" style="font-size: 0.85rem; color: #991B1B;">
                        Administrator menolak berkas izin usaha/Tax ID Anda. Silakan periksa kembali atau unggah dokumen legalitas resmi pada menu profil.
                    </p>
                </div>
                <a href="<?= base_url('buyer/profil') ?>" class="btn btn-danger btn-sm ms-auto fw-bold px-3 py-2 text-nowrap" style="border-radius: 8px;">
                    <i class="fas fa-file-upload me-1"></i> Perbarui Profil
                </a>
            </div>
        <?php else: ?>
            <div class="alert alert-warning mb-4 d-flex align-items-center gap-3 border-start border-warning border-4" role="alert" style="background-color: #FFFBEB; border-radius: 14px; border: 0; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.08);">
                <i class="fas fa-user-shield fs-2 text-warning" aria-hidden="true"></i>
                <div>
                    <h4 class="alert-heading mb-1" style="font-size: 1rem; font-weight: 700; color: #92400E;">Status Akun: Menunggu Verifikasi Legalitas (KYB)</h4>
                    <p class="mb-0" style="font-size: 0.85rem; color: #92400E;">
                        Dokumen legalitas bisnis Anda sedang ditinjau oleh Administrator. Anda tetap dapat meninjau katalog kargo, tetapi pemesanan FCL akan aktif setelah akun disetujui.
                    </p>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- BANNER PERINGATAN KELENGKAPAN LOKASI / PELABUHAN TUJUAN -->
    <?php if (empty($user['koordinat_lokasi']) || $user['koordinat_lokasi'] === 'Belum diatur' || $user['koordinat_lokasi'] === null) : ?>
        <div class="alert alert-warning mb-4 d-flex align-items-center gap-3 border-start border-warning border-4" role="alert" style="background-color: #FFFBEB; border-radius: 14px; border: 0; box-shadow: 0 4px 12px rgba(16, 73, 157, 0.05);">
            <i class="fas fa-map-location-dot fs-3 text-warning" aria-hidden="true"></i>
            <div>
                <h4 class="alert-heading mb-1" style="font-size: 1rem; font-weight: 700; color: #92400E;">Lengkapi Titik Lokasi Pengiriman!</h4>
                <p class="mb-0" style="font-size: 0.85rem; color: #92400E;">
                    Silakan atur titik koordinat lokasi kantor atau pelabuhan tujuan akhir Anda untuk memastikan ketepatan manifest pengiriman kargo.
                </p>
            </div>
            <a href="<?= base_url('buyer/profil') ?>" class="btn btn-warning btn-sm ms-auto fw-bold px-3 py-2 text-nowrap" style="color: #92400E; background-color: #FCD34D; border: none; border-radius: 8px;">
                <i class="fas fa-user-edit me-1"></i> Atur Profil
            </a>
        </div>
    <?php endif; ?>

    <!-- HERO PANEL DASBOR -->
    <section class="welcome-panel mb-4" aria-labelledby="page-title">
        <div class="welcome-content d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h1 id="page-title" class="welcome-title">Pantau Pengadaan Ekspor Anda</h1>
                <p class="welcome-description">Pantau status pesanan, kuota tonase kontainer, dan jadwal keberangkatan kargo laut Anda secara real-time melalui sistem konsolidator NusaChain.</p>
            </div>
            <a href="<?= base_url('buyer/cari') ?>" class="btn btn-utama">
                <i class="fas fa-compass" aria-hidden="true"></i> Eksplorasi Konsorsium
            </a>
        </div>
    </section>

    <!-- METRIK RINGKASAN PESANAN -->
    <section aria-labelledby="summary-title">
        <div class="section-heading">
            <div>
                <h2 id="summary-title" class="section-title">Ringkasan Pesanan</h2>
                <p class="section-subtitle">Ikhtisar aktivitas pengadaan kargo laut Anda saat ini.</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <span class="stat-icon blue"><i class="fas fa-boxes-stacked" aria-hidden="true"></i></span>
                    <div>
                        <div class="stat-label">Total Pesanan</div>
                        <div class="stat-number"><?= number_format($jumlahPesanan) ?></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <span class="stat-icon amber"><i class="fas fa-clock" aria-hidden="true"></i></span>
                    <div>
                        <div class="stat-label">Persiapan UMKM</div>
                        <div class="stat-number"><?= number_format($jumlahPending) ?></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <span class="stat-icon cyan"><i class="fas fa-ship" aria-hidden="true"></i></span>
                    <div>
                        <div class="stat-label">Kargo Berjalan</div>
                        <div class="stat-number"><?= number_format($jumlahDiproses + $jumlahDikirim) ?></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <span class="stat-icon green"><i class="fas fa-circle-check" aria-hidden="true"></i></span>
                    <div>
                        <div class="stat-label">Telah Diterima</div>
                        <div class="stat-number"><?= number_format($jumlahSelesai) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TABEL DAFTAR PESANAN -->
    <section aria-labelledby="orders-title">
        <div class="section-heading">
            <div>
                <h2 class="section-title">Riwayat & Status Transaksi</h2>
                <p class="section-subtitle">Pantau posisi kontainer dan konfirmasi penerimaan kargo setelah tiba di pelabuhan tujuan.</p>
            </div>
        </div>

        <div class="orders-panel">
            <div class="orders-panel-header">
                <h2 id="orders-title" class="orders-panel-title">
                    <span class="orders-panel-title-icon"><i class="fas fa-list-check" aria-hidden="true"></i></span>
                    Daftar Pesanan Ekspor
                </h2>
                <span class="orders-count"><?= number_format($jumlahPesanan) ?> pesanan</span>
            </div>

            <?php if ($jumlahPesanan > 0): ?>
                <!-- TAMPILAN TABEL DESKTOP -->
                <div class="table-responsive desktop-order-table">
                    <table class="table table-custom table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID Pesanan</th>
                                <th scope="col">Konsorsium</th>
                                <th scope="col">HS Code</th>
                                <th scope="col">Volume MOQ</th>
                                <th scope="col">Tgl. Pengiriman</th>
                                <th scope="col">Status Kargo</th>
                                <th scope="col" class="order-action-heading">Aksi Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftarPesanan as $p): ?>
                                <?php
                                    $statusPesanan = strtolower(trim((string) ($p['status_pemesanan'] ?? '')));
                                    $tanggalRaw = $p['tanggal_pengiriman'] ?? '';
                                    $tanggalPengiriman = $tanggalRaw && strtotime($tanggalRaw) !== false
                                        ? date('d M Y', strtotime($tanggalRaw))
                                        : 'Belum ditentukan';
                                ?>
                                <tr>
                                    <td><span class="order-id">#ORD-<?= str_pad((string) ($p['id_pesanan'] ?? ''), 4, '0', STR_PAD_LEFT) ?></span></td>
                                    <td><div class="consortium-name"><?= esc($p['nama_konsorsium'] ?? '-') ?></div></td>
                                    <td><span class="hs-badge"><i class="fas fa-barcode text-muted me-1"></i><?= esc($p['target_hs_code'] ?? '-') ?></span></td>
                                    <td><span style="font-weight: 600; color: #334155;"><?= number_format((float) ($p['total_moq'] ?? 0)) ?></span> <span class="text-muted" style="font-size: 0.8rem;">Kg</span></td>
                                    <td><span class="text-nowrap" style="color: #64748B;"><i class="far fa-calendar-alt me-2" aria-hidden="true"></i><?= esc($tanggalPengiriman) ?></span></td>
                                    <td><span class="status-badge <?= $getStatusClass($statusPesanan) ?>"><?= esc($getStatusLabel($statusPesanan)) ?></span></td>
                                    
                                    <!-- AKSI BUYER (OPSI 2: HANYA AKTIF SAAT STATUS 'DIKIRIM') -->
                                    <td class="order-action-cell">
                                        <?php if ($statusPesanan === 'dikirim'): ?>
                                            <a href="<?= base_url('buyer/pesananDiterima/' . $p['id_pesanan']) ?>" 
                                               class="btn order-status-button order-status-finish"
                                               onclick="return confirm('Konfirmasi bahwa kontainer/kargo telah tiba di pelabuhan tujuan dengan baik? Transaksi akan diselesaikan dan reputasi mitra UMKM akan bertambah.')">
                                               <i class="fas fa-box-open" aria-hidden="true"></i> Pesanan Diterima
                                            </a>
                                        <?php elseif ($statusPesanan === 'diproses'): ?>
                                            <span class="badge bg-light text-primary border p-2 px-3" title="Komoditas berada di gudang konsolidasi pelabuhan menunggu izin layar Admin">
                                                <i class="fas fa-clipboard-check me-1"></i> Inspeksi Admin
                                            </span>
                                        <?php elseif ($statusPesanan === 'selesai'): ?>
                                            <span class="badge bg-success p-2 px-3">
                                                <i class="fas fa-check-circle me-1"></i> Transaksi Selesai
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border p-2 px-3">
                                                <i class="fas fa-hourglass-half me-1"></i> Persiapan UMKM
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- TAMPILAN MOBILE BUYER -->
                <div class="mobile-order-list">
                    <?php foreach ($daftarPesanan as $p): ?>
                        <?php
                            $statusPesanan = strtolower(trim((string) ($p['status_pemesanan'] ?? '')));
                            $tanggalRaw = $p['tanggal_pengiriman'] ?? '';
                            $tanggalPengiriman = $tanggalRaw && strtotime($tanggalRaw) !== false
                                ? date('d M Y', strtotime($tanggalRaw))
                                : 'Belum ditentukan';
                        ?>
                        <article class="mobile-order-card shadow-sm">
                            <div class="mobile-order-top">
                                <div>
                                    <div class="mobile-order-label">ID Pesanan</div>
                                    <div class="order-id">#ORD-<?= str_pad((string) ($p['id_pesanan'] ?? ''), 4, '0', STR_PAD_LEFT) ?></div>
                                </div>
                                <span class="status-badge <?= $getStatusClass($statusPesanan) ?>"><?= esc($getStatusLabel($statusPesanan)) ?></span>
                            </div>
                            <div class="pt-3">
                                <div class="mobile-order-label">Konsorsium</div>
                                <div class="mobile-order-value" style="font-size: 0.95rem; color: #10499D;"><?= esc($p['nama_konsorsium'] ?? '-') ?></div>
                            </div>
                            <div class="mobile-order-meta">
                                <div class="mobile-meta-item">
                                    <div class="mobile-order-label">HS Code</div>
                                    <div><span class="hs-badge" style="font-size: 0.7rem;"><i class="fas fa-barcode text-muted me-1"></i><?= esc($p['target_hs_code'] ?? '-') ?></span></div>
                                </div>
                                <div class="mobile-meta-item">
                                    <div class="mobile-order-label">Volume MOQ</div>
                                    <div class="mobile-order-value"><?= number_format((float) ($p['total_moq'] ?? 0)) ?> <span class="text-muted fw-normal" style="font-size: 0.75rem;">Kg</span></div>
                                </div>
                                <div class="mobile-meta-item" style="grid-column: 1 / -1;">
                                    <div class="mobile-order-label">Tanggal Pengiriman</div>
                                    <div class="mobile-order-value" style="color: #64748B;"><i class="far fa-calendar-alt me-1" aria-hidden="true"></i><?= esc($tanggalPengiriman) ?></div>
                                </div>
                                
                                <div class="mobile-meta-item" style="grid-column: 1 / -1; padding-top: .5rem;">
                                    <div class="mobile-order-label mb-2">Aksi Konfirmasi</div>
                                    <?php if ($statusPesanan === 'dikirim'): ?>
                                        <a href="<?= base_url('buyer/pesananDiterima/' . $p['id_pesanan']) ?>" 
                                           class="btn btn-sm btn-success w-100 fw-bold py-2" style="border-radius: 8px;"
                                           onclick="return confirm('Konfirmasi bahwa kontainer/kargo telah tiba di pelabuhan tujuan dengan baik?')">
                                            <i class="fas fa-box-open me-1"></i> Konfirmasi Pesanan Diterima
                                        </a>
                                    <?php elseif ($statusPesanan === 'diproses'): ?>
                                        <div class="text-center w-100 p-2" style="background: #E0F2FE; border: 1px solid #BAE6FD; border-radius: 8px; color: #0369A1; font-weight: 700; font-size: .8rem;">
                                            <i class="fas fa-clipboard-check me-1"></i> Kargo Menunggu Inspeksi Admin
                                        </div>
                                    <?php elseif ($statusPesanan === 'selesai'): ?>
                                        <div class="text-center w-100 p-2" style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 8px; color: #15803D; font-weight: 700; font-size: .8rem;">
                                            <i class="fas fa-check-circle me-1"></i> Transaksi Selesai
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center w-100 p-2" style="background: #FFFBEB; border: 1px solid #FEF3C7; border-radius: 8px; color: #92400E; font-weight: 700; font-size: .8rem;">
                                            <i class="fas fa-hourglass-half me-1"></i> Sedang Dipersiapkan oleh UMKM
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <span class="empty-state-icon"><i class="fas fa-box-open" aria-hidden="true"></i></span>
                    <h3>Belum ada transaksi pesanan</h3>
                    <p>Pesanan ekspor yang Anda ajukan akan muncul di sini. Mulai dengan menjelajahi konsorsium kontainer yang siap diberangkatkan.</p>
                    <a href="<?= base_url('buyer/cari') ?>" class="btn-utama mt-2">
                        <i class="fas fa-compass" aria-hidden="true"></i> Cari Konsorsium Sekarang
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>