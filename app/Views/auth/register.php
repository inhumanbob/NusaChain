<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NusaChain</title>

    <link rel="icon" href="<?= base_url('assets/img/icon.png') ?>" type="image/png">
    <!-- Font dan library yang sama dengan landing page serta halaman login -->
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

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            color: var(--slate);
            overflow-x: hidden;
        }

        /* Sisi kanan: gambar kargo dan pesan branding */
        .register-image-side {
            background:
                linear-gradient(
                    rgba(16, 73, 157, 0.50),
                    rgba(11, 69, 153, 0.72)
                ),
                url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            position: relative;
        }

        /* Sisi kiri: form pendaftaran */
        .register-form-side {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 100px 2rem 42px;
            position: relative;
            background-color: var(--white);
        }

        .form-wrapper {
            width: 100%;
            max-width: 440px;
        }

        /* Logo horizontal biru yang digunakan pada landing page dan login */
        .brand-logo-wrapper {
            position: absolute;
            top: 32px;
            left: 50px;
        }

        .brand-logo-wrapper img {
            height: 40px;
            width: auto;
            object-fit: contain;
            transform: scale(1.6);
            transform-origin: left center;
        }

        .btn-back-home {
            position: absolute;
            top: 38px;
            right: 36px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--slate);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .btn-back-home:hover {
            color: var(--royal-blue);
        }

        .form-heading {
            color: #000000;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .form-description {
            color: #64748B;
            font-size: 0.92rem;
            line-height: 1.65;
        }

        .form-label {
            margin-bottom: 0.45rem;
            color: var(--slate);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-control-custom,
        .form-select-custom {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            background-color: #F8FAFC;
            color: var(--slate);
            font-size: 0.9rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            background-color: var(--white);
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 3px rgba(16, 73, 157, 0.15);
            outline: none;
        }

        .btn-utama {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            background-color: var(--royal-blue) !important;
            color: var(--white) !important;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-utama:hover {
            background-color: var(--deep-blue) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 73, 157, 0.20);
        }

        .link-biru {
            color: var(--royal-blue);
            font-weight: 600;
        }

        .link-biru:hover {
            color: var(--deep-blue);
        }

        .alert {
            border-radius: 8px;
            font-size: 0.86rem;
        }

        /* Box Verifikasi KYB */
        .kyb-box {
            background-color: #F8FAFC;
            border: 1px dashed #CBD5E1;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 1.25rem;
        }

        /* Animasi ringan */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-up {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }

        @media (max-width: 991px) {
            .register-form-side {
                min-height: 100vh;
                padding: 32px 1.25rem 40px;
            }

            .brand-logo-wrapper {
                position: static;
                display: flex;
                justify-content: center;
                margin-bottom: 2.5rem;
            }

            .brand-logo-wrapper img {
                height: 36px;
                transform: scale(1.35);
                transform-origin: center center;
            }

            .btn-back-home {
                display: none;
            }

            .form-wrapper {
                max-width: 440px;
            }
        }

        @media (max-width: 575px) {
            .register-form-side {
                padding-right: 1.1rem;
                padding-left: 1.1rem;
            }

            .brand-logo-wrapper {
                margin-bottom: 2rem;
            }

            .form-heading {
                font-size: 1.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">

            <!-- KOLOM KANAN: BRANDING DAN GAMBAR KARGO -->
            <div class="col-lg-7 d-none d-lg-block p-0 order-lg-2">
                <div class="register-image-side d-flex align-items-center justify-content-center">
                    <div class="text-center px-5 animate-up delay-2" style="max-width: 650px;">
                        <h2 class="text-white fw-bold mb-3 display-6">Kolaborasi untuk Skala Global</h2>
                        <p class="text-white opacity-75 fs-5">
                            Konsolidasi kargo membantu UMKM menjangkau pembeli internasional melalui pengiriman kontainer FCL yang aman dan diawasi ketat.
                        </p>

                        <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
                            <span class="badge bg-white text-dark rounded-pill py-2 px-4 fw-semibold shadow-sm" style="font-size: 0.9rem;">
                                <i class="fas fa-ship me-2" style="color: var(--royal-blue);" aria-hidden="true"></i>
                                Pengiriman Kapal FCL
                            </span>
                            <span class="badge bg-white text-dark rounded-pill py-2 px-4 fw-semibold shadow-sm" style="font-size: 0.9rem;">
                                <i class="fas fa-user-shield me-2 text-primary" aria-hidden="true"></i>
                                Verifikasi KYB Terintegrasi
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KIRI: FORM PENDAFTARAN -->
            <div class="col-12 col-lg-5 register-form-side order-lg-1">

                <div class="brand-logo-wrapper w-100 text-lg-start text-center">
                    <a href="<?= base_url('/') ?>" aria-label="Kembali ke halaman utama NusaChain">
                        <img src="<?= base_url('assets/img/logo-horizontal.png') ?>" alt="Logo NusaChain">
                    </a>
                </div>

                <a href="<?= base_url('/') ?>" class="btn-back-home d-none d-lg-flex">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Beranda
                </a>

                <div class="form-wrapper animate-up">
                    <div class="mb-4">
                        <h2 class="form-heading mb-2">Buat Akun Anda</h2>
                        <p class="form-description mb-0">Bergabung dengan ekosistem B2B NusaChain. Isi data bisnis Anda untuk verifikasi identitas (KYB).</p>
                    </div>

                    <!-- Notifikasi Pesan Flash -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-1" aria-hidden="true"></i>
                            <?= esc(session()->getFlashdata('error')) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle me-1" aria-hidden="true"></i>
                            <?= esc(session()->getFlashdata('success')) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form dengan enctype multipart untuk upload file dokumen legalitas -->
                    <form action="<?= base_url('register/process') ?>" method="POST" enctype="multipart/form-data" class="animate-up delay-1">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap / Nama Bisnis</label>
                            <input
                                type="text"
                                class="form-control form-control-custom"
                                id="nama"
                                name="nama"
                                value="<?= old('nama') ?>"
                                required
                                autocomplete="name"
                                placeholder="Contoh: CV Kopi Java Lestari"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email Perusahaan</label>
                            <input
                                type="email"
                                class="form-control form-control-custom"
                                id="email"
                                name="email"
                                value="<?= old('email') ?>"
                                required
                                autocomplete="email"
                                placeholder="nama@perusahaan.com"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input
                                type="password"
                                class="form-control form-control-custom"
                                id="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Masukkan Password"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Daftar Sebagai</label>
                            <select class="form-select form-select-custom" id="role" name="role" required onchange="toggleKybFields()">
                                <option value="" disabled <?= old('role') ? '' : 'selected' ?>>Pilih peran bisnis Anda</option>
                                <option value="UMKM" <?= old('role') === 'UMKM' ? 'selected' : '' ?>>UMKM (Produsen / Eksportir)</option>
                                <option value="Buyer" <?= old('role') === 'Buyer' ? 'selected' : '' ?>>Buyer (Importir Luar Negeri)</option>
                            </select>
                        </div>

                        <!-- BIDANG VALIDASI BISNIS (KYB) -->
                        <div id="sectionKyb" class="kyb-box" style="display: none;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-file-contract text-primary me-2"></i>
                                <span class="fw-semibold text-dark small">Data Legalitas Bisnis (KYB)</span>
                            </div>

                            <!-- Khusus UMKM: NIB / Izin Usaha -->
                            <div id="fieldUmkm" style="display: none;">
                                <div class="mb-3">
                                    <label for="nib" class="form-label">Nomor Induk Berusaha (NIB)</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-custom"
                                        id="nib"
                                        name="nib"
                                        value="<?= old('nib') ?>"
                                        placeholder="Contoh: 13 digit nomor NIB"
                                    >
                                </div>
                            </div>

                            <!-- Khusus Buyer: Tax ID, Negara, & Pelabuhan -->
                            <div id="fieldBuyer" style="display: none;">
                                <div class="mb-3">
                                    <label for="negara_asal" class="form-label">Negara Asal Perusahaan</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-custom"
                                        id="negara_asal"
                                        name="negara_asal"
                                        value="<?= old('negara_asal') ?>"
                                        placeholder="Contoh: Japan / Germany / USA"
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="tax_id" class="form-label">Business Tax ID / Registration No.</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-custom"
                                        id="tax_id"
                                        name="tax_id"
                                        value="<?= old('tax_id') ?>"
                                        placeholder="Nomor identitas pajak entitas bisnis"
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="pelabuhan_tujuan" class="form-label">Pelabuhan Tujuan (Port of Destination)</label>
                                    <input
                                        type="text"
                                        class="form-control form-control-custom"
                                        id="pelabuhan_tujuan"
                                        name="pelabuhan_tujuan"
                                        value="<?= old('pelabuhan_tujuan') ?>"
                                        placeholder="Contoh: Port of Yokohama"
                                    >
                                </div>
                            </div>

                            <!-- Input Tautan Dokumen Legalitas (Pengganti Upload Berkas) -->
                            <div class="mb-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="dokumen_legal" class="form-label mb-0">Tautan Dokumen Legalitas Usaha</label>
                                    <span id="badgeCek" class="badge bg-light text-muted border small" style="display: none;"></span>
                                </div>
                                
                                <div class="position-relative">
                                    <input
                                        type="url"
                                        class="form-control form-control-custom"
                                        id="dokumen_legal"
                                        name="dokumen_legal"
                                        value="<?= old('dokumen_legal') ?>"
                                        placeholder="https://drive.google.com/file/d/.../view?usp=sharing"
                                        autocomplete="off"
                                        required
                                    >
                                    <!-- Icon animasi di ujung kanan input -->
                                    <span id="cekSpinner" class="position-absolute end-0 top-50 translate-middle-y me-3 text-primary" style="display: none;">
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </span>
                                </div>

                                <!-- Kotak pesan status animasi -->
                                <div id="pesanFeedback" class="mt-2 small" style="display: none; border-radius: 8px; padding: 8px 12px; font-size: 0.8rem; transition: all 0.3s ease;"></div>

                                <div class="form-text text-muted" style="font-size: 0.78rem;">
                                    Salin tautan Google Drive / Cloud storage berkas legalitas (NIB/Tax ID). Pastikan setelan akses publik aktif.
                                </div>
                            </div>

                            <script>
                            function cekFormatDrive(url) {
                                const iconWrap = document.getElementById('iconStatus');
                                const icon = document.getElementById('iconCheck');
                                const help = document.getElementById('driveHelp');

                                if (url.trim() === '') {
                                    iconWrap.style.display = 'none';
                                    return;
                                }

                                iconWrap.style.display = 'flex';
                                
                                // Cek apakah format URL berasal dari Google Drive
                                if (url.includes('drive.google.com')) {
                                    icon.className = 'fas fa-check-circle text-success';
                                    help.innerHTML = '<span class="text-success fw-semibold"><i class="fas fa-check me-1"></i>Format tautan Google Drive terdeteksi. Pastikan aksesnya sudah dibuka untuk publik.</span>';
                                } else {
                                    icon.className = 'fas fa-exclamation-circle text-warning';
                                    help.innerHTML = '<span class="text-warning fw-semibold"><i class="fas fa-info-circle me-1"></i>Gunakan tautan resmi berkas dari Google Drive.</span>';
                                }
                            }
                            </script>
                        </div>

                        <button type="submit" class="btn btn-utama w-100 mt-2 mb-4 shadow-sm">
                            Daftar & Ajukan Verifikasi <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                        </button>
                    </form>

                    <div class="text-center animate-up delay-2">
                        <span class="text-secondary" style="font-size: 0.9rem;">
                            Sudah memiliki akun?
                            <a href="<?= base_url('login') ?>" class="text-decoration-none link-biru">Masuk di sini</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 1. Logika Tampilan Dinamis Form Sesuai Peran (UMKM vs Buyer)
        function toggleKybFields() {
            const roleSelect = document.getElementById('role');
            if (!roleSelect) return;

            const role = roleSelect.value;
            const sectionKyb = document.getElementById('sectionKyb');
            const fieldUmkm = document.getElementById('fieldUmkm');
            const fieldBuyer = document.getElementById('fieldBuyer');

            if (role === 'UMKM') {
                if (sectionKyb) sectionKyb.style.display = 'block';
                if (fieldUmkm) fieldUmkm.style.display = 'block';
                if (fieldBuyer) fieldBuyer.style.display = 'none';
            } else if (role === 'Buyer') {
                if (sectionKyb) sectionKyb.style.display = 'block';
                if (fieldUmkm) fieldUmkm.style.display = 'none';
                if (fieldBuyer) fieldBuyer.style.display = 'block';
            } else {
                if (sectionKyb) sectionKyb.style.display = 'none';
                if (fieldUmkm) fieldUmkm.style.display = 'none';
                if (fieldBuyer) fieldBuyer.style.display = 'none';
            }
        }

        // 2. Logika AJAX Pengecekan Izin Publik Tautan Dokumen (Google Drive/Cloud)
        let debounceTimer;

        function inisialisasiVerifikasiTautan() {
            const inputDokumen = document.getElementById('dokumen_legal');
            if (!inputDokumen) return;

            inputDokumen.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                const url = this.value.trim();

                if (url.length === 0) {
                    resetIndikator();
                    return;
                }

                // Beri jeda 600ms setelah user selesai mengetik / menempelkan link
                debounceTimer = setTimeout(() => {
                    verifikasiTautan(url);
                }, 600);
            });
        }

        function verifikasiTautan(url) {
            const spinner = document.getElementById('cekSpinner');
            const badge = document.getElementById('badgeCek');
            const feedback = document.getElementById('pesanFeedback');
            const inputField = document.getElementById('dokumen_legal');

            // Tampilkan animasi status pemeriksaan
            if (spinner) spinner.style.display = 'block';
            if (badge) {
                badge.style.display = 'inline-block';
                badge.className = 'badge bg-primary text-white small';
                badge.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Memeriksa izin akses...';
            }
            if (feedback) feedback.style.display = 'none';

            // Ambil token CSRF CodeIgniter 4 dari form
            const csrfInput = document.querySelector('input[name="<?= csrf_token() ?>"]');
            const csrfToken = csrfInput ? csrfInput.value : '';

            const formData = new FormData();
            formData.append('link_dokumen', url); // HARUS link_dokumen sesuai nama di backend
            formData.append('<?= csrf_token() ?>', csrfToken);

            fetch('<?= base_url('auth/cek-dokumen') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network error');
                }
                return response.json();
            })
            .then(data => {
                if (spinner) spinner.style.display = 'none';
                if (!feedback || !badge || !inputField) return;
                
                // Pembaruan Token CSRF
                if (data.csrf_token && csrfInput) {
                    csrfInput.value = data.csrf_token;
                }

                feedback.style.display = 'block';
                const pesanTeks = data.pesan || data.message || 'Status tautan tidak diketahui.';

                // Backend Auth.php mengembalikan 'success' atau 'error'
                if (data.status === 'success') {
                    // Tautan berstatus publik (Valid)
                    inputField.style.borderColor = '#16A34A';
                    badge.className = 'badge bg-success text-white small';
                    badge.innerHTML = '<i class="fas fa-check-circle me-1"></i> Publik (Siap)';

                    feedback.style.backgroundColor = '#DCFCE7';
                    feedback.style.color = '#15803D';
                    feedback.style.border = '1px solid #BBF7D0';
                    feedback.innerHTML = '<i class="fas fa-circle-check me-1"></i> ' + pesanTeks;
                } else {
                    // Jika teks pesan mengandung kata Private/Dibatasi
                    if (pesanTeks.toLowerCase().includes('private') || pesanTeks.toLowerCase().includes('dibatasi')) {
                        inputField.style.borderColor = '#DC2626';
                        badge.className = 'badge bg-danger text-white small';
                        badge.innerHTML = '<i class="fas fa-lock me-1"></i> Terkunci / Privat';

                        feedback.style.backgroundColor = '#FEF2F2';
                        feedback.style.color = '#991B1B';
                        feedback.style.border = '1px solid #FECACA';
                        feedback.innerHTML = '<i class="fas fa-triangle-exclamation me-1"></i> ' + pesanTeks;
                    } else {
                        // Format bukan URL atau domain tidak terjangkau
                        inputField.style.borderColor = '#D97706';
                        badge.className = 'badge bg-warning text-dark small';
                        badge.innerHTML = '<i class="fas fa-circle-question me-1"></i> URL Bermasalah';

                        feedback.style.backgroundColor = '#FFFBEB';
                        feedback.style.color = '#92400E';
                        feedback.style.border = '1px solid #FDE68A';
                        feedback.innerHTML = '<i class="fas fa-info-circle me-1"></i> ' + pesanTeks;
                    }
                }
            })
            .catch(() => {
                if (spinner) spinner.style.display = 'none';
                if (badge) badge.style.display = 'none';
                if (feedback) feedback.style.display = 'none';
            });
        }

        function resetIndikator() {
            const spinner = document.getElementById('cekSpinner');
            const badge = document.getElementById('badgeCek');
            const feedback = document.getElementById('pesanFeedback');
            const inputField = document.getElementById('dokumen_legal');

            if (spinner) spinner.style.display = 'none';
            if (badge) badge.style.display = 'none';
            if (feedback) feedback.style.display = 'none';
            if (inputField) inputField.style.borderColor = '#CBD5E1';
        }

        // Jalankan saat DOM halaman siap
        document.addEventListener('DOMContentLoaded', function() {
            toggleKybFields();
            inisialisasiVerifikasiTautan();
        });
    </script>
</body>
</html>