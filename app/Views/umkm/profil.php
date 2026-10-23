<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Pengaturan Profil - NusaChain</title>

    <link rel="icon" href="<?= base_url('assets/img/icon.png') ?>" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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

        /* KARTU FORM KONSISTEN */
        .content-card {
            height: 100%;
            background: #FFFFFF;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 17px;
            box-shadow: var(--shadow);
            overflow: hidden;
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
        .card-content { padding: 24px 22px; }

        /* FORM ELEMENTS */
        .form-label { display: block; margin-bottom: 7px; color: #334155; font-size: .84rem; font-weight: 600; }
        .form-control {
            width: 100%;
            min-height: 48px;
            padding: 10px 15px;
            color: #334155;
            background: #FAFCFF;
            border: 1px solid #D7E0EC;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: .88rem;
            transition: all .2s ease;
        }
        .form-control:focus {
            outline: 0;
            background: #FFFFFF;
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 3px rgba(16,73,157,.12);
        }
        .form-text { margin-top: 6px; color: var(--muted); font-size: .75rem; line-height: 1.55; }
        
        /* KOMPONEN SPESIFIK PROFIL */
        .profile-summary-card {
            text-align: center;
            padding: 30px 20px;
        }
        .profile-avatar-large {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 90px;
            height: 90px;
            background: #EAF2FF;
            color: var(--royal-blue);
            border: 2px solid #DBEAFE;
            border-radius: 50%;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        .profile-name-large { font-size: 1.25rem; font-weight: 700; color: #0F172A; margin-bottom: 5px; }
        .profile-role-badge { 
            display: inline-block; padding: 5px 12px; background: #F1F5F9; 
            border: 1px solid #E2E8F0; border-radius: 6px; color: #475569; 
            font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;
        }

        .map-wrapper {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 6px;
            background: #F8FAFC;
            margin-bottom: 15px;
        }
        #map {
            height: 320px;
            border-radius: 8px;
            border: 1px solid #D7E0EC;
            z-index: 1;
        }

        .btn-utama {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 48px;
            padding: 10px 18px;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            text-decoration: none;
            color: #FFFFFF !important;
            background: var(--royal-blue) !important;
            border: 1px solid var(--royal-blue) !important;
            transition: all .2s ease;
        }
        .btn-utama:hover, .btn-utama:focus-visible {
            background: var(--deep-blue) !important;
            border-color: var(--deep-blue) !important;
            box-shadow: 0 6px 16px rgba(16,73,157,.2);
            transform: translateY(-2px);
        }

        /* Popup Konfirmasi (Sama dengan halaman lain) */
        .nc-action-dialog { max-width: 440px; }
        .nc-action-content { border: 1px solid rgba(226,232,240,.9); border-radius: 18px; overflow: hidden; }
        .nc-action-icon { display: flex; align-items: center; justify-content: center; width: 54px; height: 54px; margin: 0 auto 15px; color: var(--royal-blue); background: #EAF2FF; border-radius: 16px; font-size: 1.35rem; }
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
            .card-header-custom { padding: 17px; }
            .card-content { padding: 18px 17px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>

<?= $this->include('layout/navbar') ?>
<?= $this->include('layout/flash_toast') ?>

<main class="container page-shell">
    <!-- Hero Banner -->
    <section class="page-hero" aria-labelledby="page-title">
        <div class="hero-content">
            <h1 class="page-title" id="page-title">Pengaturan Profil & Lokasi</h1>
            <p class="page-subtitle">Kelola informasi identitas usaha, pembaruan kata sandi, dan titik koordinat untuk keperluan logistik ekspor.</p>
        </div>
        <div class="hero-action">
            <a href="<?= base_url('umkm/dashboard') ?>" class="btn-outline-hero"
               data-confirm-action="navigate" data-confirm-title="Kembali ke Beranda?"
               data-confirm-message="Perubahan profil yang belum disimpan akan hilang. Yakin ingin membatalkan dan kembali?"
               data-confirm-text="Ya, Kembali" data-confirm-variant="warning">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>Kembali ke Beranda
            </a>
        </div>
    </section>

    <div class="row g-3 g-lg-4 align-items-start">
        
        <!-- Kolom Kiri: Kartu Identitas Profil -->
        <aside class="col-12 col-lg-4">
            <div class="content-card">
                <div class="profile-summary-card">
                    <div class="profile-avatar-large">
                        <i class="fas fa-building-user"></i>
                    </div>
                    <h2 class="profile-name-large"><?= esc($user['nama'] ?? 'Pelaku Usaha') ?></h2>
                    <div class="profile-role-badge mb-3">Akun <?= esc(session()->get('role') ?? 'UMKM') ?></div>
                    
                    <hr class="my-3" style="border-color: #E2E8F0;">
                    
                    <div class="d-flex flex-column gap-2 text-start px-2">
                        <div class="d-flex align-items-center gap-2 text-muted" style="font-size: 0.85rem;">
                            <i class="fas fa-envelope text-primary opacity-75" style="width: 16px;"></i>
                            <span class="text-truncate"><?= esc($user['email'] ?? '-') ?></span>
                        </div>
                        <div class="d-flex align-items-start gap-2 text-muted" style="font-size: 0.85rem;">
                            <i class="fas fa-location-dot text-primary opacity-75 mt-1" style="width: 16px;"></i>
                            <span style="line-height: 1.4;"><?= !empty($user['koordinat_lokasi']) ? esc($user['koordinat_lokasi']) : 'Lokasi belum diatur' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Kolom Kanan: Form Edit -->
        <section class="col-12 col-lg-8">
            <div class="content-card">
                <div class="card-header-custom">
                    <span class="section-icon"><i class="fas fa-user-edit" aria-hidden="true"></i></span>
                    <div>
                        <h2 class="section-title">Edit Data Profil</h2>
                        <p class="section-subtitle">Pastikan data perusahaan dan titik penjemputan akurat.</p>
                    </div>
                </div>

                <div class="card-content">
                    <form action="<?= base_url('umkm/updateProfile') ?>" method="POST"
                          data-confirm-submit="true"
                          data-confirm-title="Simpan perubahan profil?"
                          data-confirm-message="Pastikan informasi dasar dan titik koordinat sudah benar. Simpan perubahan ke sistem?"
                          data-confirm-text="Ya, Simpan Perubahan"
                          data-confirm-variant="save">
                        <?= csrf_field() ?>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Usaha / Perusahaan</label>
                                <input type="text" class="form-control" id="nama" name="nama" maxlength="255"
                                       value="<?= esc(old('nama', $user['nama'] ?? '')) ?>" required autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Kontak</label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="255"
                                       value="<?= esc(old('email', $user['email'] ?? '')) ?>" required autocomplete="off">
                            </div>
                        </div>

                        <hr class="my-4" style="border-color: #E2E8F0;">

                        <h5 class="fw-bold text-dark" style="font-size: 1rem;"><i class="fas fa-map-location-dot text-primary me-2"></i>Titik Lokasi (Koordinat)</h5>
                        <p class="text-muted small mb-3">Geser pin pada peta di bawah ini untuk menentukan titik lokasi akurat gudang atau pabrik Anda untuk keperluan logistik.</p>

                        <div class="map-wrapper">
                            <div id="map"></div>
                        </div>

                        <div class="mb-4">
                            <label for="koordinat_lokasi" class="form-label">Data Koordinat Penjemputan</label>
                            <input type="text" class="form-control font-monospace" id="koordinat_lokasi" name="koordinat_lokasi"
                                   value="<?= esc(old('koordinat_lokasi', $user['koordinat_lokasi'] ?? '')) ?>"
                                   pattern="^-?\d{1,3}(\.\d+)?\s*,\s*-?\d{1,3}(\.\d+)?$"
                                   title="Format: lintang, bujur. Contoh: -7.250445, 112.768845"
                                   placeholder="Contoh: -0.789275, 113.921327 atau geser pin di peta" autocomplete="off">
                            <div class="form-text">Ketik koordinat manual (lintang, bujur) atau biarkan sistem mengisi otomatis dengan menggeser pin pada peta interaktif di atas.</div>
                        </div>

                        <hr class="my-4" style="border-color: #E2E8F0;">

                        <h5 class="fw-bold text-dark mb-3" style="font-size: 1rem;"><i class="fas fa-shield-halved text-primary me-2"></i>Keamanan Akun</h5>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Perbarui Kata Sandi <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                   minlength="8" autocomplete="new-password"
                                   placeholder="Kosongkan jika tidak ingin mengubah sandi">
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1" aria-hidden="true"></i>Abaikan kolom ini jika Anda hanya ingin memperbarui informasi profil atau lokasi. Minimal 8 karakter jika diisi.
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn-utama w-100">
                                <i class="fas fa-floppy-disk me-2" aria-hidden="true"></i>Simpan Perubahan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>
</main>

<!-- Popup Konfirmasi -->
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

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // === LEAFLET MAP LOGIC ===
    var input = document.getElementById('koordinat_lokasi');

    function parseKoordinat(teks) {
        var bagian = String(teks).split(',');
        if (bagian.length !== 2) return null;
        var lat = parseFloat(bagian[0]);
        var lng = parseFloat(bagian[1]);
        if (isNaN(lat) || isNaN(lng) || lat < -90 || lat > 90 || lng < -180 || lng > 180) return null;
        return { lat: lat, lng: lng };
    }

    var awal = parseKoordinat(input.value);
    var startLat = awal ? awal.lat : -0.789275;
    var startLng = awal ? awal.lng : 113.921327;
    var zoomLevel = awal ? 15 : 5;

    var map = L.map('map').setView([startLat, startLng], zoomLevel);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker = L.marker([startLat, startLng], { draggable: true }).addTo(map);

    function isiInput(latlng) {
        input.value = latlng.lat.toFixed(6) + ', ' + latlng.lng.toFixed(6);
    }

    marker.on('dragend', function () { isiInput(marker.getLatLng()); });

    map.on('click', function (event) {
        marker.setLatLng(event.latlng);
        isiInput(event.latlng);
    });

    input.addEventListener('change', function () {
        var titik = parseKoordinat(this.value);
        if (titik) {
            marker.setLatLng([titik.lat, titik.lng]);
            map.flyTo([titik.lat, titik.lng], 15);
        }
    });

    // === MODAL KONFIRMASI LOGIC ===
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
        acceptButton.classList.remove('warning', 'danger');
        iconElement.classList.remove('warning', 'save', 'danger');

        if (variant === 'warning') {
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
});
</script>

</body>
</html>