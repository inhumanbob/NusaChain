<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Pusat Kendali Administrator - NusaChain</title>

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

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--ice-blue);
            color: var(--slate);
            overflow-x: hidden;
        }

        .page-shell {
            padding-top: 1.75rem;
            padding-bottom: 3rem;
        }

        .header-panel {
            background: linear-gradient(115deg, var(--deep-blue) 0%, var(--royal-blue) 65%, #2674C9 100%);
            border-radius: 20px;
            color: var(--white);
            padding: clamp(1.4rem, 3vw, 2.2rem);
            margin-bottom: 1.6rem;
            box-shadow: 0 12px 28px rgba(16, 73, 157, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-custom {
            border-radius: 16px;
            border: 1px solid #E8EDF5;
            background: var(--surface);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem;
            background: var(--white);
            border: 1px solid #E8EDF5;
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(15, 41, 77, 0.085);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .stat-icon.warning { background: #FEF3C7; color: #D97706; }
        .stat-icon.primary { background: #E0F2FE; color: #0284C7; }
        .stat-icon.success { background: #DCFCE7; color: #16A34A; }
        .stat-icon.dark { background: #F1F5F9; color: #475569; }

        .table-custom thead th {
            padding: 12px 16px;
            color: var(--muted);
            font-size: 0.74rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.035em;
            background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
        }
        .table-custom tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 0.84rem;
            border-bottom: 1px solid #EEF2F7;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 0.45rem 0.75rem;
            border-radius: 8px;
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-pills .nav-link {
            color: var(--slate);
            font-size: 0.84rem;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }
        .nav-pills .nav-link:hover {
            background-color: #F1F5F9;
        }
        .nav-pills .nav-link.active {
            background-color: var(--royal-blue) !important;
            color: var(--white) !important;
        }
        .nav-pills .nav-link.active .badge {
            background-color: var(--white) !important;
            color: var(--royal-blue) !important;
        }

        @media (max-width: 767.98px) {
            .page-shell { padding-top: 1.15rem; }
            .header-panel { border-radius: 16px; }
            .stat-card { padding: 0.95rem; }
            .stat-icon { width: 40px; height: 40px; font-size: 1rem; }
        }
    </style>
</head>
<body>

<!-- Inclusion Navbar Global NusaChain -->
<?= $this->include('layout/navbar') ?>

<main class="container page-shell">

    <!-- HEADER OPERASIONAL ADMIN -->
    <div class="header-panel">
        <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-white text-primary fw-bold px-2 py-1" style="font-size: 0.75rem;">ADMINISTRATOR GATEWAY</span>
        </div>
        <h2 class="fw-bold mb-1 text-white">Pusat Kendali Operasional NusaChain</h2>
        <p class="mb-0 text-white-50 small">Otoritas verifikasi legalitas bisnis (KYB) dan inspeksi kargo konsolidasi FCL di pelabuhan hub.</p>
    </div>

    <!-- NOTIFIKASI FLASH ALERT -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success d-flex align-items-center gap-2 border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <i class="fas fa-circle-check fs-5 text-success"></i>
            <div><?= esc(session()->getFlashdata('success')) ?></div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <i class="fas fa-triangle-exclamation fs-5 text-danger"></i>
            <div><?= esc(session()->getFlashdata('error')) ?></div>
        </div>
    <?php endif; ?>

    <!-- 4 KARTU STATISTIK METRIK -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon warning"><i class="fas fa-user-clock"></i></div>
                <div>
                    <div class="text-muted small fw-bold">ANTREAN KYB</div>
                    <div class="fw-bold text-dark fs-5 mb-0"><?= number_format($verifikasiPending ?? 0) ?> Akun</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon primary"><i class="fas fa-ship"></i></div>
                <div>
                    <div class="text-muted small fw-bold">SIAP INSPEKSI</div>
                    <div class="fw-bold text-primary fs-5 mb-0"><?= number_format($kargoSiapKirim ?? 0) ?> Kontainer</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon success"><i class="fas fa-warehouse"></i></div>
                <div>
                    <div class="text-muted small fw-bold">MITRA UMKM</div>
                    <div class="fw-bold text-dark fs-5 mb-0"><?= number_format($totalUmkm ?? 0) ?> Usaha</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon dark"><i class="fas fa-globe"></i></div>
                <div>
                    <div class="text-muted small fw-bold">IMPORTIR BUYER</div>
                    <div class="fw-bold text-dark fs-5 mb-0"><?= number_format($totalBuyer ?? 0) ?> Mitra</div>
                </div>
            </div>
        </div>
    </div>

    <?php
        $pendingList       = $listPending ?? array_filter($daftarUser ?? $pengajuanUsers ?? [], fn($u) => ($u['status_verifikasi'] ?? 'Pending') === 'Pending');
        $terverifikasiList = $listTerverifikasi ?? array_filter($daftarUser ?? [], fn($u) => ($u['status_verifikasi'] ?? '') === 'Terverifikasi');
        $ditolakList       = $listDitolak ?? array_filter($daftarUser ?? [], fn($u) => ($u['status_verifikasi'] ?? '') === 'Ditolak');
    ?>

    <!-- TABEL 1: VERIFIKASI ENTITAS BISNIS (KYB DENGAN SISTEM TAB) -->
    <div class="card card-custom mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2" style="font-size: 1rem;">
                    <i class="fas fa-id-card text-primary"></i> Manajemen & Validasi Entitas Bisnis (KYB)
                </h5>
                <span class="text-muted small">Total: <?= count($daftarUser ?? array_merge($pendingList, $terverifikasiList, $ditolakList)) ?> Pengguna</span>
            </div>

            <!-- Tab Navigasi -->
            <ul class="nav nav-pills card-header-pills" id="kybTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active fw-bold small me-2" id="tab-pending" data-bs-toggle="tab" data-bs-target="#pane-pending" type="button" role="tab" aria-selected="true">
                        <i class="fas fa-clock me-1 text-warning"></i> Menunggu Verifikasi
                        <span class="badge bg-warning text-dark ms-1"><?= count($pendingList) ?></span>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold small me-2" id="tab-terverifikasi" data-bs-toggle="tab" data-bs-target="#pane-terverifikasi" type="button" role="tab" aria-selected="false">
                        <i class="fas fa-circle-check me-1 text-success"></i> Terverifikasi
                        <span class="badge bg-success ms-1"><?= count($terverifikasiList) ?></span>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold small" id="tab-ditolak" data-bs-toggle="tab" data-bs-target="#pane-ditolak" type="button" role="tab" aria-selected="false">
                        <i class="fas fa-circle-xmark me-1 text-danger"></i> Ditolak
                        <span class="badge bg-danger ms-1"><?= count($ditolakList) ?></span>
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="kybTabContent">

            <!-- 1. TAB PENDING -->
            <div class="tab-pane fade show active" id="pane-pending" role="tabpanel" aria-labelledby="tab-pending">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Identitas Entitas</th>
                                <th>Peran</th>
                                <th>Email Kontak</th>
                                <th>Nomor Izin / Tax ID</th>
                                <th>Negara & Pelabuhan</th>
                                <th class="text-center">Berkas & Aksi Validasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pendingList)): ?>
                                <?php foreach ($pendingList as $u): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark"><?= esc($u['nama']) ?></div>
                                            <small class="text-muted">Terdaftar: <?= date('d M Y', strtotime($u['created_at'] ?? 'now')) ?></small>
                                        </td>
                                        <td>
                                            <span class="badge <?= $u['role'] === 'UMKM' ? 'bg-primary' : 'bg-success' ?>"><?= esc($u['role']) ?></span>
                                        </td>
                                        <td><?= esc($u['email']) ?></td>
                                        <td>
                                            <span class="font-monospace text-dark fw-bold"><?= esc($u['nomor_izin_usaha'] ?? '-') ?></span>
                                        </td>
                                        <td>
                                            <?php if ($u['role'] === 'Buyer'): ?>
                                                <div class="small fw-semibold"><?= esc($u['negara_asal'] ?? 'Global') ?></div>
                                                <div class="text-muted small"><?= esc($u['pelabuhan_tujuan'] ?? 'Belum ditentukan') ?></div>
                                            <?php else: ?>
                                                <span class="text-muted small">Indonesia (Eksportir)</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex gap-1">
                                                <?php if (!empty($u['dokumen_legal'])): ?>
                                                    <a href="<?= esc($u['dokumen_legal']) ?>" target="_blank" class="btn-action btn btn-sm btn-outline-primary" title="Buka tautan dokumen">
                                                        <i class="fas fa-external-link-alt"></i> Buka Dokumen
                                                    </a>
                                                <?php else: ?>
                                                    <span class="btn-action btn btn-sm btn-light border text-muted disabled">Tanpa Tautan</span>
                                                <?php endif; ?>

                                                <a href="<?= base_url('admin/verifikasi/' . $u['id_user'] . '/Terverifikasi') ?>" class="btn-action btn btn-sm btn-success" onclick="return confirm('Setujui entitas <?= esc($u['nama']) ?>?')">
                                                    <i class="fas fa-check"></i> Setujui
                                                </a>

                                                <a href="<?= base_url('admin/verifikasi/' . $u['id_user'] . '/Ditolak') ?>" class="btn-action btn btn-sm btn-outline-danger" onclick="return confirm('Tolak permohonan entitas <?= esc($u['nama']) ?>?')">
                                                    <i class="fas fa-times"></i> Tolak
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-clipboard-check fs-3 d-block mb-2 text-secondary opacity-50"></i>
                                        Tidak ada antrean pengajuan akun baru yang perlu diverifikasi.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 2. TAB TERVERIFIKASI -->
            <div class="tab-pane fade" id="pane-terverifikasi" role="tabpanel" aria-labelledby="tab-terverifikasi">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Identitas Entitas</th>
                                <th>Peran</th>
                                <th>Email Kontak</th>
                                <th>Nomor Izin / Tax ID</th>
                                <th>Status Akses</th>
                                <th class="text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($terverifikasiList)): ?>
                                <?php foreach ($terverifikasiList as $u): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark"><?= esc($u['nama']) ?></div>
                                            <small class="text-muted">Trust Score: <?= esc($u['trust_score'] ?? 0) ?> Poin</small>
                                        </td>
                                        <td>
                                            <span class="badge <?= $u['role'] === 'UMKM' ? 'bg-primary' : 'bg-success' ?>"><?= esc($u['role']) ?></span>
                                        </td>
                                        <td><?= esc($u['email']) ?></td>
                                        <td>
                                            <span class="font-monospace text-dark"><?= esc($u['nomor_izin_usaha'] ?? '-') ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: 0.74rem;">
                                                <i class="fas fa-check-circle me-1"></i> Terverifikasi
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex gap-1">
                                                <?php if (!empty($u['dokumen_legal'])): ?>
                                                    <a href="<?= esc($u['dokumen_legal']) ?>" target="_blank" class="btn-action btn btn-sm btn-outline-secondary" title="Lihat dokumen">
                                                        <i class="fas fa-external-link-alt"></i> Dokumen
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?= base_url('admin/verifikasi/' . $u['id_user'] . '/Ditolak') ?>" class="btn-action btn btn-sm btn-outline-danger" onclick="return confirm('Cabut izin entitas <?= esc($u['nama']) ?>?')">
                                                    <i class="fas fa-ban me-1"></i> Cabut Izin
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada akun yang terverifikasi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 3. TAB DITOLAK -->
            <div class="tab-pane fade" id="pane-ditolak" role="tabpanel" aria-labelledby="tab-ditolak">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Identitas Entitas</th>
                                <th>Peran</th>
                                <th>Email Kontak</th>
                                <th>Nomor Izin / Tax ID</th>
                                <th>Status</th>
                                <th class="text-center">Tindakan Pemulihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ditolakList)): ?>
                                <?php foreach ($ditolakList as $u): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark"><?= esc($u['nama']) ?></div>
                                            <small class="text-muted"><?= esc($u['email']) ?></small>
                                        </td>
                                        <td>
                                            <span class="badge <?= $u['role'] === 'UMKM' ? 'bg-primary' : 'bg-success' ?>"><?= esc($u['role']) ?></span>
                                        </td>
                                        <td><?= esc($u['email']) ?></td>
                                        <td>
                                            <span class="font-monospace text-muted"><?= esc($u['nomor_izin_usaha'] ?? '-') ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger" style="font-size: 0.74rem;">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex gap-1">
                                                <?php if (!empty($u['dokumen_legal'])): ?>
                                                    <a href="<?= esc($u['dokumen_legal']) ?>" target="_blank" class="btn-action btn btn-sm btn-outline-secondary" title="Lihat berkas">
                                                        <i class="fas fa-external-link-alt"></i> Berkas
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?= base_url('admin/verifikasi/' . $u['id_user'] . '/Terverifikasi') ?>" class="btn-action btn btn-sm btn-outline-success" onclick="return confirm('Pulihkan dan setujui entitas <?= esc($u['nama']) ?>?')">
                                                    <i class="fas fa-rotate-left me-1"></i> Pulihkan
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Tidak ada akun dengan status ditolak.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- TABEL 2: PENGAWASAN & MONITORING SEMUA KARGO LAUT FCL -->
    <div class="card card-custom">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2" style="font-size: 1rem;">
                <i class="fas fa-ship text-primary"></i> Pengawasan Hub Pelabuhan & Keberangkatan Kargo FCL
            </h5>
            <span class="badge bg-primary"><?= count($daftarKargo ?? []) ?> total kargo</span>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Konsorsium</th>
                        <th>HS Code</th>
                        <th>Tonase Kargo</th>
                        <th>Status / Posisi Kargo</th>
                        <th class="text-center">Inspeksi & Izin Layar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($daftarKargo)): ?>
                        <?php foreach ($daftarKargo as $k): ?>
                            <?php $statusKargo = strtolower(trim((string)($k['status_pemesanan'] ?? ''))); ?>
                            <tr>
                                <td>
                                    <span class="fw-bold text-primary font-monospace">#ORD-<?= str_pad((string)$k['id_pesanan'], 4, '0', STR_PAD_LEFT) ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($k['nama_konsorsium']) ?></div>
                                    <small class="text-muted">Target Pelabuhan: Internasional</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border font-monospace"><?= esc($k['target_hs_code']) ?></span>
                                </td>
                                <td class="fw-bold text-dark">
                                    <?= number_format((float)$k['total_moq'], 0, ',', '.') ?> Kg
                                </td>
                                <td>
                                    <?php if ($statusKargo === 'pending'): ?>
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i> Persiapan UMKM
                                        </span>
                                    <?php elseif ($statusKargo === 'diproses'): ?>
                                        <span class="badge bg-info text-dark">
                                            <i class="fas fa-boxes-packing me-1"></i> Gudang Hub (Siap Inspeksi)
                                        </span>
                                    <?php elseif ($statusKargo === 'dikirim'): ?>
                                        <span class="badge bg-primary">
                                            <i class="fas fa-ship me-1"></i> Dalam Pelayaran
                                        </span>
                                    <?php elseif ($statusKargo === 'selesai'): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Tiba di Tujuan (Selesai)
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= esc($k['status_pemesanan']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($statusKargo === 'diproses'): ?>
                                        <!-- Tombol aktif untuk menerbitkan izin layar kargo yang ada di gudang hub -->
                                        <a href="<?= base_url('admin/kargo/kirim/' . $k['id_pesanan']) ?>" 
                                           class="btn-action btn btn-sm btn-primary px-3 shadow-sm" 
                                           onclick="return confirm('Pastikan kontainer telah memenuhi syarat 100% FCL dan clearance bea cukai telah lengkap. Terbitkan izin layar?')">
                                            <i class="fas fa-anchor me-1"></i> Izin Layar (Dikirim)
                                        </a>
                                    <?php elseif ($statusKargo === 'pending'): ?>
                                        <span class="badge bg-light text-muted border py-2 px-3">
                                            <i class="fas fa-hourglass-start me-1"></i> Menunggu UMKM
                                        </span>
                                    <?php elseif ($statusKargo === 'dikirim'): ?>
                                        <span class="badge bg-light text-primary border py-2 px-3">
                                            <i class="fas fa-compass fa-spin me-1"></i> Menuju Buyer
                                        </span>
                                    <?php elseif ($statusKargo === 'selesai'): ?>
                                        <span class="badge bg-light text-success border py-2 px-3">
                                            <i class="fas fa-clipboard-check me-1"></i> Transaksi Tuntas
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-box-open fs-3 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada pesanan kargo yang tercatat di dalam sistem.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>