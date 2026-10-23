<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Sandi Baru - NusaChain</title>
    
    <link rel="icon" href="<?= base_url('assets/img/icon.png') ?>" type="image/png">
    <!-- Memuat Font Google: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Memuat Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Palet Warna NusaChain */
        :root {
            --royal-blue: #10499D;
            --deep-blue: #0B4599;
            --white: #FFFFFF;
            --ice-blue: #F3F6FB;
            --slate: #334155;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            color: var(--slate);
            overflow-x: hidden;
        }

        /* -------------------------------------------
           SISI KANAN: GAMBAR & BRANDING
           ------------------------------------------- */
        .login-image-side {
            background: linear-gradient(
                rgba(16, 73, 157, 0.5), 
                rgba(11, 69, 153, 0.7)
            ), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            position: relative;
        }

        /* -------------------------------------------
           SISI KIRI: FORM 
           ------------------------------------------- */
        .login-form-side {
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            background-color: var(--white);
        }

        .form-wrapper {
            width: 100%;
            max-width: 400px;
        }

        /* Posisi Logo */
        .brand-logo-wrapper {
            position: absolute;
            top: 40px;
            left: 50px;
        }

        .brand-logo-wrapper img {
            height: 40px;
            object-fit: contain;
            transform: scale(1.6);
            transform-origin: left center;
        }

        /* Input Form */
        .form-control-custom {
            border-radius: 8px;
            padding: 12px 16px;
            border: 1px solid #CBD5E1;
            font-size: 0.95rem;
            color: var(--slate);
            background-color: #F8FAFC;
        }

        .form-control-custom:focus {
            background-color: var(--white);
            box-shadow: 0 0 0 3px rgba(16, 73, 157, 0.15);
            border-color: var(--royal-blue);
        }

        .form-label {
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--slate);
        }

        /* Tombol Utama */
        .btn-utama {
            background-color: var(--royal-blue) !important;
            color: var(--white) !important;
            border: none !important;
            padding: 12px 24px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-utama:hover {
            background-color: var(--deep-blue) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 73, 157, 0.2);
        }

        /* Responsif HP */
        @media (max-width: 991px) {
            .brand-logo-wrapper {
                position: static;
                margin-bottom: 2rem;
                display: flex;
                justify-content: center;
                margin-left: 0 !important;
                left: auto;
            }
            .brand-logo-wrapper img {
                transform: scale(1.3);
                transform-origin: center center;
            }
        }

        /* Animasi Lembut */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-up { opacity: 0; animation: fadeInUp 0.8s ease-out forwards; }
        .delay-1 { animation-delay: 0.1s; }
    </style>
</head>
<body>

    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <!-- KOLOM KIRI: FORM RESET SANDI -->
            <div class="col-12 col-lg-5 login-form-side">
                
                <!-- Logo NusaChain -->
                <div class="brand-logo-wrapper w-100 text-lg-start text-center">
                    <a href="<?= base_url('/') ?>">
                        <img src="<?= base_url('assets/img/logo-horizontal.png') ?>" alt="Logo NusaChain">
                    </a>
                </div>
                
                <!-- Area Utama Form: RESET SANDI -->
                <div class="form-wrapper animate-up">
                    
                    <div class="mb-4 text-center text-lg-start">
                        <h2 class="fw-bold mb-2" style="color: #000000;">Buat Sandi Baru</h2>
                        <p class="text-secondary" style="font-size: 1rem;">Pastikan kata sandi baru Anda kuat, aman, dan mudah diingat.</p>
                    </div>

                    <!-- Notifikasi Alert jika ada error validasi -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" style="border-radius: 8px; font-size: 0.9rem;">
                            <i class="fas fa-exclamation-circle me-1"></i> <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('reset-password/process') ?>" method="POST" class="animate-up delay-1">
                        
                        <!-- Input tersembunyi untuk membawa token dari URL -->
                        <input type="hidden" name="token" value="<?= esc($token) ?>">
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi Baru</label>
                            <input type="password" class="form-control form-control-custom" id="password" name="password" required placeholder="Buat kata sandi baru">
                        </div>

                        <div class="mb-4">
                            <label for="password_confirm" class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" class="form-control form-control-custom" id="password_confirm" name="password_confirm" required placeholder="Ulangi kata sandi baru">
                        </div>
                        
                        <button type="submit" class="btn btn-utama w-100 mb-4 shadow-sm py-3">
                            <i class="fas fa-save me-2"></i> Simpan Sandi Baru
                        </button>
                    </form>
                </div>
            </div>

            <!-- KOLOM KANAN: GAMBAR & BRANDING -->
            <div class="col-lg-7 d-none d-lg-block p-0">
                <div class="login-image-side d-flex align-items-center justify-content-center">
                    
                    <div class="text-center px-5 animate-up delay-1" style="max-width: 650px;">
                        <h2 class="text-white fw-bold mb-3 display-6">Langkah Terakhir</h2>
                        <p class="text-white opacity-75 fs-5">
                            Perbarui kata sandi Anda dan bersiaplah untuk kembali menjalankan aktivitas ekspor bersama konsorsium UMKM Indonesia.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>