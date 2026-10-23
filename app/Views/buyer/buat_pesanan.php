<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Form Pemesanan Kargo - NusaChain</title>

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
            --border: #E2E8F0;
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
        .btn-outline-hero:hover { color: var(--deep-blue); background: #EAF2FF; border-color: #EAF2FF; transform: translateY(-1px); }

        .btn-utama {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem; min-height: 48px; padding: .7rem 1.2rem;
            color: var(--white) !important; background: var(--royal-blue) !important; border: 1px solid var(--royal-blue) !important;
            border-radius: 10px; font-size: .88rem; font-weight: 600; text-decoration: none; transition: all .2s ease;
        }
        .btn-utama:hover, .btn-utama:focus-visible { background: var(--deep-blue) !important; border-color: var(--deep-blue) !important; transform: translateY(-1px); box-shadow: 0 5px 14px rgba(16,73,157,.18); }

        .btn-secondary-custom {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 48px; padding: .7rem 1.2rem;
            color: #475569; background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 10px; font-size: .88rem; font-weight: 600;
            text-decoration: none; transition: all .2s ease;
        }
        .btn-secondary-custom:hover { color: var(--royal-blue); background: var(--ice-blue); border-color: #B8CBE5; }

        .content-card {
            background: var(--surface);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 17px;
            box-shadow: var(--shadow);
            overflow: hidden;
            height: 100%;
        }

        .card-heading {
            display: flex; align-items: center; gap: 12px; padding: 22px 24px;
            background: transparent; border-bottom: 1px solid #EEF2F7;
        }

        .heading-icon {
            display: inline-flex; align-items: center; justify-content: center; flex: 0 0 auto;
            width: 42px; height: 42px; color: var(--royal-blue); background: var(--ice-blue);
            border-radius: 12px; font-size: 1.05rem;
        }

        .card-heading h2 { margin: 0; color: #0F172A; font-size: 1.05rem; font-weight: 700; }
        .card-heading p { margin: 4px 0 0; color: var(--muted); font-size: 0.8rem; }

        .consortium-body, .form-body { padding: 24px; }

        .summary-label { margin-bottom: 7px; color: var(--muted); font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; }
        .consortium-name { margin: 0 0 20px; color: var(--royal-blue); font-size: 1.2rem; font-weight: 700; line-height: 1.4; }

        .detail-list { display: flex; flex-direction: column; gap: 14px; }
        .detail-row { display: flex; align-items: flex-start; justify-content: space-between; gap: 14px; padding-bottom: 14px; border-bottom: 1px solid #EEF2F7; }
        .detail-row:last-child { padding-bottom: 0; border-bottom: 0; }
        .detail-key { display: inline-flex; align-items: center; gap: 8px; color: var(--muted); font-size: 0.85rem; font-weight: 500; }
        .detail-key i { width: 16px; color: #94A3B8; text-align: center; }
        .detail-value { color: #0F172A; font-size: 0.88rem; font-weight: 600; text-align: right; }

        .status-ready {
            display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px;
            color: #166534; background: #DCFCE7; border: 1px solid #BBF7D0;
            border-radius: 50px; font-size: 0.75rem; font-weight: 700; white-space: nowrap;
        }

        .score-badge {
            display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px;
            color: var(--royal-blue); background: #EAF2FF; border: 1px solid #DFE9F8;
            border-radius: 8px; font-size: 0.75rem; font-weight: 700; white-space: nowrap;
        }

        .hs-badge {
            display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px;
            color: #475569; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px;
            font-size: .8rem; font-weight: 600; font-family: monospace; white-space: nowrap;
        }

        .info-note {
            display: flex; align-items: flex-start; gap: 10px; padding: 14px 16px; margin-top: 24px;
            color: #475569; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px;
            font-size: 0.8rem; line-height: 1.6;
        }
        .info-note i { margin-top: 2px; color: var(--royal-blue); font-size: 1.1rem; }

        .member-name { color: #0F172A; font-size: 0.88rem; font-weight: 600; }
        .member-meta { margin-top: 3px; color: var(--muted); font-size: 0.78rem; }

        .form-label { display: block; margin-bottom: 8px; color: #334155; font-size: 0.85rem; font-weight: 600; }
        .form-control-custom {
            width: 100%; min-height: 48px; padding: 11px 16px; color: #334155; background: #FAFCFF;
            border: 1px solid #D7E0EC; border-radius: 10px; font-family: 'Poppins', sans-serif; font-size: 0.88rem; transition: all 0.2s ease;
        }
        .form-control-custom:focus { outline: 0; background: #FFFFFF; border-color: var(--royal-blue); box-shadow: 0 0 0 3px rgba(16, 73, 157, 0.12); }
        .form-text { margin-top: 6px; color: var(--muted); font-size: 0.75rem; line-height: 1.55; }
        .required-mark { color: #DC3545; }

        .form-actions { display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; margin-top: 24px; border-top: 1px solid #EEF2F7; }

        .nc-action-dialog { max-width: 440px; }
        .nc-action-content { border: 1px solid rgba(226,232,240,.9); border-radius: 18px; overflow: hidden; }
        .nc-action-icon { display: flex; align-items: center; justify-content: center; width: 54px; height: 54px; margin: 0 auto 15px; color: var(--royal-blue); background: #EAF2FF; border-radius: 16px; font-size: 1.35rem; }
        .nc-action-icon.save { color: #166534; background: #DCFCE7; }
        .nc-action-title { margin: 0 0 8px; color: #0F172A; font-size: 1.08rem; font-weight: 700; text-align: center; }
        .nc-action-message { margin: 0 auto 22px; max-width: 350px; color: #64748B; font-size: .84rem; line-height: 1.7; text-align: center; }
        .nc-action-actions { display: flex; gap: 10px; }
        .nc-action-actions .btn { min-height: 43px; flex: 1; border-radius: 9px; font-family: 'Poppins', sans-serif; font-size: .84rem; font-weight: 600; }
        .nc-action-cancel { color: #475569; background: #FFFFFF; border: 1px solid #CBD5E1; }
        .nc-action-cancel:hover { color: #0F172A; background: #F8FAFC; border-color: #94A3B8; }
        .nc-action-accept { color: #FFFFFF; background: #10499D; border: 1px solid #10499D; }
        .nc-action-accept:hover { color: #FFFFFF; background: #0B4599; border-color: #0B4599; }
        .modal-backdrop.show { opacity: 0 !important; background: transparent !important; }

        @media (max-width: 991.98px) {
            .page-hero { align-items: flex-start; flex-direction: column; }
            .hero-action { width: 100%; margin-top: 10px;}
            .hero-action .btn, .hero-action a { width: 100%; }
        }
        @media (max-width: 767.98px) {
            .page-shell { padding-top: 1.25rem; padding-bottom: 2rem; }
            .page-hero { padding: 23px 20px; margin-bottom: 1.25rem; border-radius: 16px; }
            .card-heading { padding: 18px; }
            .consortium-body, .form-body { padding: 20px; }
            .form-actions { flex-direction: column-reverse; }
            .form-actions .btn, .form-actions a { width: 100%; }
        }
    </style>
</head>
<body>

<?= $this->include('layout/navbar') ?>
<?= $this->include('layout/flash_toast') ?>

<?php
    $namaKonsorsium = (string) ($konsorsium['nama_konsorsium'] ?? 'Konsorsium tidak diketahui');
    $hsCode         = (string) ($konsorsium['target_hs_code'] ?? '-');
    $kapasitas      = (int) ($konsorsium['total_kapasitas_gabungan'] ?? 0);
    $idKonsorsium   = (int) ($konsorsium['id_konsorsium'] ?? 0);
    $statusKuota    = (string) ($konsorsium['status_kuota'] ?? '');
    $anggota        = $anggota ?? [];
    $besok          = date('Y-m-d', strtotime('+1 day'));
    $estimasiUsd    = (float) $kapasitas * 2.50;
?>

<main class="container page-shell">

    <section class="page-hero" aria-labelledby="page-title">
        <div class="hero-content">
            <h1 class="page-title" id="page-title">Form Pemesanan Pengiriman Ekspor</h1>
            <p class="page-subtitle">Tentukan volume pesanan sesuai kebutuhan Anda, periksa estimasi tagihan Escrow dalam USD, lalu ajukan pesanan kargo konsorsium.</p>
        </div>
        <div class="hero-action d-flex justify-content-lg-end">
            <a href="<?= base_url('buyer/cari') ?>" class="btn-outline-hero">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>Kembali ke Katalog
            </a>
        </div>
    </section>

    <div class="row g-4 align-items-stretch">
        <div class="col-12 col-lg-5 d-flex flex-column gap-4">

            <!-- Ringkasan Konsorsium -->
            <section class="content-card" aria-labelledby="consortium-detail-title">
                <div class="card-heading">
                    <span class="heading-icon"><i class="fas fa-boxes-stacked" aria-hidden="true"></i></span>
                    <div>
                        <h2 id="consortium-detail-title">Ringkasan Konsorsium</h2>
                        <p>Pastikan konsorsium yang dipilih sudah sesuai.</p>
                    </div>
                </div>

                <div class="consortium-body">
                    <div class="summary-label">Nama Konsorsium</div>
                    <h3 class="consortium-name"><?= esc($namaKonsorsium) ?></h3>

                    <div class="detail-list">
                        <div class="detail-row">
                            <span class="detail-key"><i class="fas fa-barcode" aria-hidden="true"></i> HS Code Target</span>
                            <span class="hs-badge"><?= esc($hsCode) ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key"><i class="fas fa-cubes" aria-hidden="true"></i> Volume Terkumpul</span>
                            <span class="detail-value text-primary fs-6"><?= number_format($kapasitas, 0, ',', '.') ?> <span class="text-muted fw-normal" style="font-size: 0.8rem">Kg</span></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key"><i class="fas fa-circle-info" aria-hidden="true"></i> Status Kuota</span>
                            <span class="detail-value">
                                <?php if (strtolower($statusKuota) === 'penuh'): ?>
                                    <span class="status-ready"><i class="fas fa-circle-check" aria-hidden="true"></i> Siap Ekspor</span>
                                <?php else: ?>
                                    <span class="status-ready" style="background:#F1F5F9; color:#475569; border-color:#E2E8F0;"><?= esc($statusKuota !== '' ? $statusKuota : 'Belum tersedia') ?></span>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>

                    <div class="info-note">
                        <i class="fas fa-lightbulb" aria-hidden="true"></i>
                        <span>Anda dapat memesan sebagian volume atau memborong seluruh kapasitas kontainer (maksimal <strong><?= number_format($kapasitas, 0, ',', '.') ?> Kg</strong>).</span>
                    </div>
                </div>
            </section>

            <!-- UMKM Pengisi Konsorsium -->
            <section class="content-card flex-grow-1" aria-labelledby="member-title">
                <div class="card-heading">
                    <span class="heading-icon"><i class="fas fa-users-gear" aria-hidden="true"></i></span>
                    <div>
                        <h2 id="member-title">UMKM Tergabung</h2>
                        <p>Mitra dalam konsorsium ini beserta skor kepercayaan.</p>
                    </div>
                </div>

                <div class="consortium-body">
                    <?php if (! empty($anggota)): ?>
                        <div class="detail-list">
                            <?php foreach ($anggota as $a): ?>
                                <div class="detail-row align-items-center">
                                    <div>
                                        <div class="member-name"><?= esc($a['nama']) ?></div>
                                        <div class="member-meta">
                                            Kontribusi <strong><?= number_format((int) $a['kontribusi_kapasitas'], 0, ',', '.') ?></strong> Kg
                                        </div>
                                    </div>
                                    <span class="score-badge" title="Skor Kepercayaan Sistem">
                                        <i class="fas fa-shield-halved" aria-hidden="true"></i> <?= (int) $a['trust_score'] ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="d-flex flex-column align-items-center text-center p-4">
                            <i class="fas fa-users-slash text-muted fs-1 mb-3 opacity-50"></i>
                            <p class="mb-0 text-muted" style="font-size: .85rem;">Data UMKM belum tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <!-- Form Pesanan -->
        <div class="col-12 col-lg-7">
            <section class="content-card h-100" aria-labelledby="order-form-title">
                <div class="card-heading">
                    <span class="heading-icon"><i class="fas fa-file-signature" aria-hidden="true"></i></span>
                    <div>
                        <h2 id="order-form-title">Formulir Pesanan</h2>
                        <p>Tentukan volume muatan yang Anda inginkan dan pilih jadwal pengiriman.</p>
                    </div>
                </div>

                <div class="form-body">
                    <form method="post" action="<?= base_url('buyer/simpan-pesanan') ?>"
                          data-confirm-submit="true"
                          data-confirm-title="Ajukan Pesanan Ekspor?"
                          data-confirm-message="Pastikan tanggal pengiriman dan volume pesanan Anda sudah sesuai."
                          data-confirm-text="Ya, Ajukan Order"
                          data-confirm-variant="save">
                        
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_konsorsium" value="<?= $idKonsorsium ?>">

                        <!-- Input Volume MOQ (Bebas Diketik / Fleksibel) -->
                        <div class="mb-3">
                            <label for="total_moq" class="form-label">
                                Volume Pemesanan yang Diajukan (Kg) <span class="required-mark">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    id="total_moq"
                                    name="total_moq"
                                    class="form-control form-control-custom fw-bold font-monospace"
                                    value="<?= esc(old('total_moq', $kapasitas)) ?>"
                                    min="1"
                                    max="<?= $kapasitas ?>"
                                    step="1"
                                    required
                                    style="border-top-right-radius: 0; border-bottom-right-radius: 0;"
                                >
                                <span class="input-group-text bg-light text-muted fw-semibold border-start-0" style="border-radius: 0 10px 10px 0; border-color: #D7E0EC;">Kg</span>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1 text-primary"></i>Kapasitas maksimal yang tersedia di konsorsium ini: <strong><?= number_format($kapasitas, 0, ',', '.') ?></strong> Kg.
                            </div>
                        </div>

                        <!-- Estimasi Tagihan Escrow dalam USD (Live Update) -->
                        <div class="p-3 mb-4 rounded-3 border" style="background: #F8FAFC; border-color: #E2E8F0 !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.04em;">Estimasi Tagihan Escrow (USD)</div>
                                    <div class="fw-bold text-primary font-monospace fs-4 mt-1" id="labelTotalUsd">
                                        USD <?= number_format($estimasiUsd, 2, '.', ',') ?>
                                    </div>
                                </div>
                                <div class="text-end text-muted small">
                                    Tarif Ekspor:<br>
                                    <span class="fw-bold text-dark font-monospace">$2.50 / Kg</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pengiriman" class="form-label">Rencana Tanggal Pengiriman <span class="required-mark">*</span></label>
                            <input
                                type="date"
                                id="tanggal_pengiriman"
                                name="tanggal_pengiriman"
                                class="form-control-custom"
                                value="<?= esc(old('tanggal_pengiriman')) ?>"
                                min="<?= esc($besok) ?>"
                                required
                            >
                            <div class="form-text"><i class="far fa-calendar-check me-1"></i>Estimasi jadwal muat kargo pelabuhan. Tanggal paling awal adalah besok.</div>
                        </div>

                        <div class="form-actions mt-5">
                            <a href="<?= base_url('buyer/cari') ?>" class="btn-secondary-custom">
                                <i class="fas fa-xmark" aria-hidden="true"></i>Batal
                            </a>
                            <button type="submit" class="btn-utama">
                                <i class="fas fa-paper-plane" aria-hidden="true"></i>Konfirmasi &amp; Ajukan Order
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Popup Konfirmasi -->
<div class="modal fade" id="ncActionConfirmModal" tabindex="-1" aria-labelledby="ncActionConfirmTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered nc-action-dialog">
        <div class="modal-content nc-action-content shadow-lg">
            <div class="modal-body p-4 p-md-5">
                <div class="nc-action-icon save" id="ncActionConfirmIcon" aria-hidden="true">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <h2 class="nc-action-title" id="ncActionConfirmTitle">Konfirmasi Pengajuan</h2>
                <p class="nc-action-message" id="ncActionConfirmMessage">Apakah Anda yakin ingin mengajukan pesanan ini?</p>
                <div class="nc-action-actions">
                    <button type="button" class="btn nc-action-cancel" data-bs-dismiss="modal">Cek Kembali</button>
                    <button type="button" class="btn nc-action-accept" id="ncActionConfirmAccept">Ya, Ajukan Order</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputMoq = document.getElementById('total_moq');
    const labelTotal = document.getElementById('labelTotalUsd');
    const tarifPerKg = 2.50;

    // Kalkulator Live USD saat volume diubah
    if (inputMoq && labelTotal) {
        inputMoq.addEventListener('input', function () {
            let val = parseFloat(this.value) || 0;
            let total = val * tarifPerKg;
            labelTotal.textContent = 'USD ' + total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        });
    }

    // Modal Konfirmasi
    const modalElement = document.getElementById('ncActionConfirmModal');
    if (!modalElement || typeof bootstrap === 'undefined') return;

    const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    const titleElement = document.getElementById('ncActionConfirmTitle');
    const messageElement = document.getElementById('ncActionConfirmMessage');
    const acceptButton = document.getElementById('ncActionConfirmAccept');
    let pendingAction = null;

    function showConfirmation(options) {
        pendingAction = options;
        titleElement.textContent = options.title || 'Konfirmasi tindakan';
        messageElement.textContent = options.message || 'Apakah Anda yakin ingin melanjutkan?';
        acceptButton.textContent = options.confirmText || 'Ya, Lanjutkan';
        modal.show();
    }

    document.querySelectorAll('form[data-confirm-submit="true"]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (form.dataset.confirmBypass === 'true') {
                delete form.dataset.confirmBypass;
                return;
            }
            event.preventDefault();
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const currentVolume = inputMoq ? (parseFloat(inputMoq.value) || 0) : 0;
            const currentTotalUsd = (currentVolume * tarifPerKg).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            showConfirmation({
                type: 'submit',
                form,
                title: form.dataset.confirmTitle,
                message: 'Total pesanan: ' + currentVolume.toLocaleString('id-ID') + ' Kg dengan estimasi tagihan USD ' + currentTotalUsd + '. Lanjutkan pengajuan?',
                confirmText: form.dataset.confirmText
            });
        });
    });

    acceptButton.addEventListener('click', () => {
        if (!pendingAction) return;
        const action = pendingAction;
        pendingAction = null;
        modal.hide();

        if (action.type === 'submit' && action.form) {
            action.form.dataset.confirmBypass = 'true';
            action.form.requestSubmit();
        }
    });

    modalElement.addEventListener('hidden.bs.modal', () => {
        pendingAction = null;
    });
});
</script>
</body>
</html>