<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Edit Data Barang - NusaChain</title>

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
            color: var(--slate);
            background: var(--ice-blue);
            font-family: 'Poppins', sans-serif;
        }

        body { overflow-x: hidden; }

        /* Mengikuti padding dashboard.php */
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
            max-width: 700px;
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

        .content-card {
            height: 100%;
            background: #FFFFFF;
            border: 1px solid #E8EDF5;
            border-radius: 17px;
            box-shadow: var(--shadow);
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 22px 16px;
            background: transparent;
            border-bottom: 1px solid #EEF2F7;
        }

        .section-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            width: 42px;
            height: 42px;
            color: var(--royal-blue);
            background: var(--ice-blue);
            border-radius: 12px;
            font-size: 1rem;
        }

        .section-title { margin: 0; color: #0F172A; font-size: 1rem; font-weight: 700; }
        .section-subtitle { margin: 4px 0 0; color: var(--muted); font-size: .78rem; line-height: 1.6; }
        .card-content { padding: 22px 23px 24px; }

        .form-label { display: block; margin-bottom: 7px; color: #334155; font-size: .82rem; font-weight: 600; }
        .form-control, .form-select {
            width: 100%;
            min-height: 46px;
            padding: 10px 13px;
            color: #334155;
            background: #FAFCFF;
            border: 1px solid #D7E0EC;
            border-radius: 9px;
            font-family: 'Poppins', sans-serif;
            font-size: .85rem;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }
        .form-control:focus, .form-select:focus {
            outline: 0;
            background: #FFFFFF;
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 3px rgba(16,73,157,.12);
        }
        .form-text { margin-top: 6px; color: var(--muted); font-size: .73rem; line-height: 1.55; }

        .form-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 26px; }
        .btn-utama, .btn-secondary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 45px;
            padding: 10px 16px;
            border-radius: 9px;
            font-family: 'Poppins', sans-serif;
            font-size: .86rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
        }
        .btn-utama {
            flex: 1;
            color: #FFFFFF !important;
            background: var(--royal-blue) !important;
            border: 1px solid var(--royal-blue) !important;
        }
        .btn-utama:hover, .btn-utama:focus-visible {
            color: #FFFFFF !important;
            background: var(--deep-blue) !important;
            border-color: var(--deep-blue) !important;
            box-shadow: 0 5px 14px rgba(16,73,157,.18);
            transform: translateY(-1px);
        }
        .btn-secondary-custom { color: #475569; background: #FFFFFF; border: 1px solid #CBD5E1; }
        .btn-secondary-custom:hover { color: var(--royal-blue); background: #F8FAFC; border-color: #9FB5D3; }

        .preview-label { margin-bottom: 5px; color: var(--muted); font-size: .72rem; font-weight: 500; }
        .preview-value { margin-bottom: 17px; color: #0F172A; font-size: .9rem; font-weight: 600; line-height: 1.55; overflow-wrap: anywhere; }
        .preview-value:last-child { margin-bottom: 0; }
        .info-note {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 14px; margin-top: 16px; color: #1E40AF;
            background: #EFF6FF; border: 1px solid #DBEAFE;
            border-radius: 11px; font-size: .77rem; line-height: 1.65;
        }
        .info-note i { margin-top: 3px; }

        /* Popup Konfirmasi */
        .nc-action-dialog { max-width: 440px; }
        .nc-action-content { border: 1px solid rgba(226,232,240,.9); border-radius: 18px; overflow: hidden; }
        .nc-action-icon { display: flex; align-items: center; justify-content: center; width: 54px; height: 54px; margin: 0 auto 15px; color: var(--royal-blue); background: #EAF2FF; border-radius: 16px; font-size: 1.35rem; }
        .nc-action-icon.danger { color: #B42332; background: #FFF1F2; }
        .nc-action-icon.warning { color: #A16207; background: #FEF3C7; }
        .nc-action-icon.save { color: #10499D; background: #EAF2FF; }
        .nc-action-title { margin: 0 0 8px; color: #0F172A; font-size: 1.08rem; font-weight: 700; text-align: center; }
        .nc-action-message { margin: 0 auto 22px; max-width: 350px; color: #64748B; font-size: .84rem; line-height: 1.7; text-align: center; }
        .nc-action-actions { display: flex; gap: 10px; }
        .nc-action-actions .btn { min-height: 43px; flex: 1; border-radius: 9px; font-family: 'Poppins', sans-serif; font-size: .84rem; font-weight: 600; }
        .nc-action-cancel { color: #475569; background: #FFFFFF; border: 1px solid #CBD5E1; }
        .nc-action-cancel:hover { color: #0F172A; background: #F8FAFC; border-color: #94A3B8; }
        .nc-action-accept { color: #FFFFFF; background: #10499D; border: 1px solid #10499D; }
        .nc-action-accept:hover { color: #FFFFFF; background: #0B4599; border-color: #0B4599; }
        .nc-action-accept.danger { background: #DC3545; border-color: #DC3545; }
        .nc-action-accept.danger:hover { background: #BB2D3B; border-color: #BB2D3B; }
        .nc-action-accept.warning { color: #78350F; background: #FBBF24; border-color: #FBBF24; }
        .nc-action-accept.warning:hover { color: #78350F; background: #F59E0B; border-color: #F59E0B; }
        .modal-backdrop.show { opacity: 0 !important; background: transparent !important; }
        
        @media (max-width: 991.98px) {
            .page-hero { align-items: flex-start; flex-direction: column; }
            .hero-action { width: 100%; }
            .hero-action .btn, .hero-action a { width: 100%; }
        }
        @media (max-width: 767.98px) {
            .page-shell { padding-top: 1.25rem; padding-bottom: 2rem; }
            .page-hero { padding: 23px 20px; margin-bottom: 1.15rem; border-radius: 16px; }
            .page-subtitle { font-size: .84rem; }
            .card-header-custom { padding: 17px 17px 14px; }
            .card-content { padding: 18px 17px; }
            .form-actions { flex-direction: column-reverse; }
            .form-actions a, .form-actions button { width: 100%; }
        }
        @media (max-width: 420px) {
            .container { padding-right: 1rem; padding-left: 1rem; }
            .page-hero { padding: 21px 17px; }
            .card-header-custom { padding-left: 15px; padding-right: 15px; }
            .card-content { padding-left: 15px; padding-right: 15px; }
            .section-icon { width: 38px; height: 38px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>

<?= $this->include('layout/navbar') ?>
<?= $this->include('layout/flash_toast') ?>

<!-- Ditambahkan class "container" agar sejajar dengan dashboard -->
<main class="container page-shell">
    <section class="page-hero" aria-labelledby="page-title">
        <div class="hero-content">
            <h1 class="page-title" id="page-title">Edit Data Barang</h1>
            <p class="page-subtitle">Perbarui informasi produk dan kapasitas produksi bulanan agar data ekspor usaha tetap akurat.</p>
        </div>
        <div class="hero-action">
            <a href="<?= base_url('umkm/produk') ?>" class="btn-outline-hero"
               data-confirm-action="navigate" data-confirm-title="Batalkan edit?"
               data-confirm-message="Perubahan yang belum disimpan akan dibuang. Yakin ingin kembali ke daftar produk?"
               data-confirm-text="Ya, Kembali" data-confirm-variant="warning">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>Kembali ke Daftar Produk
            </a>
        </div>
    </section>

    <div class="row g-3 g-lg-4 align-items-start">
        <section class="col-12 col-lg-7" aria-labelledby="form-title">
            <div class="content-card">
                <div class="card-header-custom">
                    <span class="section-icon"><i class="fas fa-pen-to-square" aria-hidden="true"></i></span>
                    <div>
                        <h2 class="section-title" id="form-title">Informasi Produk</h2>
                        <p class="section-subtitle">Pastikan seluruh data sudah benar sebelum menyimpan perubahan.</p>
                    </div>
                </div>

                <div class="card-content">
                    <form action="<?= base_url('umkm/produk/update/' . $produk['id_produk']) ?>" method="POST"
                          data-confirm-submit="true"
                          data-confirm-title="Simpan perubahan produk?"
                          data-confirm-message="Pastikan seluruh data produk sudah benar. Perubahan akan disimpan ke database."
                          data-confirm-text="Ya, Simpan Perubahan"
                          data-confirm-variant="save">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nama_produk"
                                name="nama_produk"
                                value="<?= esc($produk['nama_produk'] ?? '') ?>"
                                maxlength="255"
                                required
                                autocomplete="off"
                                placeholder="Contoh: Kopi Robusta Sangrai"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="hs_code" class="form-label">HS Code (Kode Kepabeanan)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="hs_code"
                                name="hs_code"
                                value="<?= esc($produk['hs_code'] ?? '') ?>"
                                required
                                inputmode="numeric"
                                autocomplete="off"
                                placeholder="Contoh: 09012120"
                            >
                            <div class="form-text">Pastikan HS Code sesuai dengan klasifikasi barang yang akan diekspor.</div>
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-sm-8">
                                <label for="kapasitas_bulanan" class="form-label">Kapasitas Produksi Bulanan</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="kapasitas_bulanan"
                                    name="kapasitas_bulanan"
                                    value="<?= esc($produk['kapasitas_bulanan'] ?? '') ?>"
                                    min="1"
                                    step="1"
                                    required
                                >
                                <div class="form-text">Masukkan jumlah produksi yang dapat dipenuhi setiap bulan.</div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    <option value="Kg" <?= ($produk['satuan'] ?? '') === 'Kg' ? 'selected' : '' ?>>Kilogram (Kg)</option>
                                    <option value="Ton" <?= ($produk['satuan'] ?? '') === 'Ton' ? 'selected' : '' ?>>Ton</option>
                                    <option value="Pcs" <?= ($produk['satuan'] ?? '') === 'Pcs' ? 'selected' : '' ?>>Pcs</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="<?= base_url('umkm/produk') ?>" class="btn-secondary-custom"
                               data-confirm-action="navigate" data-confirm-title="Batalkan edit?"
                               data-confirm-message="Perubahan yang belum disimpan akan dibuang. Yakin ingin membatalkan edit dan kembali ke daftar produk?"
                               data-confirm-text="Ya, Batalkan" data-confirm-variant="warning">
                                <i class="fas fa-xmark" aria-hidden="true"></i>Batal
                            </a>
                            <button type="submit" class="btn-utama">
                                <i class="fas fa-floppy-disk" aria-hidden="true"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <aside class="col-12 col-lg-5" aria-labelledby="preview-title">
            <section class="content-card">
                <div class="card-header-custom">
                    <span class="section-icon"><i class="fas fa-eye" aria-hidden="true"></i></span>
                    <div>
                        <h2 class="section-title" id="preview-title">Ringkasan Saat Ini</h2>
                        <p class="section-subtitle">Informasi produk sebelum perubahan disimpan.</p>
                    </div>
                </div>
                <div class="card-content">
                    <div class="preview-label">Nama Produk</div>
                    <div class="preview-value fw-bold text-dark"><?= esc($produk['nama_produk'] ?? '-') ?></div>

                    <div class="preview-label">HS Code</div>
                    <div class="preview-value"><span class="font-monospace fw-bold text-secondary"><?= esc($produk['hs_code'] ?? '-') ?></span></div>

                    <div class="preview-label">Kapasitas Produksi Bulanan</div>
                    <div class="preview-value fw-bold text-dark">
                        <?= number_format((float) ($produk['kapasitas_bulanan'] ?? 0), 0, ',', '.') ?>
                        <span class="text-secondary ms-1"><?= esc($produk['satuan'] ?? '') ?></span>
                    </div>

                    <div class="info-note">
                        <i class="fas fa-circle-info" aria-hidden="true"></i>
                        <span>Perubahan kapasitas atau HS Code dapat memengaruhi pengelompokan produk dan proses konsolidasi ekspor.</span>
                    </div>
                </div>
            </section>
        </aside>
    </div>
</main>

<div class="modal fade" id="ncActionConfirmModal" tabindex="-1" aria-labelledby="ncActionConfirmTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered nc-action-dialog">
        <div class="modal-content nc-action-content shadow-lg">
            <div class="modal-body p-4 p-md-5">
                <div class="nc-action-icon" id="ncActionConfirmIcon" aria-hidden="true">
                    <i class="fas fa-circle-question"></i>
                </div>
                <h2 class="nc-action-title" id="ncActionConfirmTitle">Konfirmasi tindakan</h2>
                <p class="nc-action-message" id="ncActionConfirmMessage">Apakah kamu yakin ingin melanjutkan?</p>
                <div class="nc-action-actions">
                    <button type="button" class="btn nc-action-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn nc-action-accept" id="ncActionConfirmAccept">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(() => {
    const modalElement = document.getElementById('ncActionConfirmModal');
    if (!modalElement || typeof bootstrap === 'undefined') return;

    const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    const titleElement = document.getElementById('ncActionConfirmTitle');
    const messageElement = document.getElementById('ncActionConfirmMessage');
    const iconElement = document.getElementById('ncActionConfirmIcon');
    const acceptButton = document.getElementById('ncActionConfirmAccept');
    let pendingAction = null;

    function showConfirmation(options) {
        pendingAction = options;
        const variant = options.variant || 'primary';
        titleElement.textContent = options.title || 'Konfirmasi tindakan';
        messageElement.textContent = options.message || 'Apakah kamu yakin ingin melanjutkan?';
        acceptButton.textContent = options.confirmText || 'Ya, Lanjutkan';
        acceptButton.classList.remove('danger', 'warning');
        iconElement.classList.remove('danger', 'warning', 'save');

        if (variant === 'danger') {
            acceptButton.classList.add('danger');
            iconElement.classList.add('danger');
            iconElement.innerHTML = '<i class="fas fa-trash-can"></i>';
        } else if (variant === 'warning') {
            acceptButton.classList.add('warning');
            iconElement.classList.add('warning');
            iconElement.innerHTML = '<i class="fas fa-triangle-exclamation"></i>';
        } else if (variant === 'save') {
            iconElement.classList.add('save');
            iconElement.innerHTML = '<i class="fas fa-floppy-disk"></i>';
        } else {
            iconElement.innerHTML = '<i class="fas fa-circle-question"></i>';
        }
        modal.show();
    }

    document.querySelectorAll('[data-confirm-action="navigate"]').forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            showConfirmation({
                type: 'navigate',
                url: link.href,
                title: link.dataset.confirmTitle,
                message: link.dataset.confirmMessage,
                confirmText: link.dataset.confirmText,
                variant: link.dataset.confirmVariant
            });
        });
    });

    document.querySelectorAll('form[data-confirm-submit="true"]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (form.dataset.confirmBypass === 'true') {
                delete form.dataset.confirmBypass;
                return;
            }
            event.preventDefault();
            showConfirmation({
                type: 'submit',
                form,
                title: form.dataset.confirmTitle,
                message: form.dataset.confirmMessage,
                confirmText: form.dataset.confirmText,
                variant: form.dataset.confirmVariant
            });
        });
    });

    acceptButton.addEventListener('click', () => {
        if (!pendingAction) return;
        const action = pendingAction;
        pendingAction = null;
        modal.hide();

        if (action.type === 'navigate' && action.url) {
            window.location.href = action.url;
        } else if (action.type === 'submit' && action.form) {
            action.form.dataset.confirmBypass = 'true';
            action.form.requestSubmit();
        }
    });

    modalElement.addEventListener('hidden.bs.modal', () => {
        pendingAction = null;
    });
})();
</script>
</body>
</html>