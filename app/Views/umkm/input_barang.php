<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10499D">
    <title>Kelola Produk - NusaChain</title>

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
            max-width: 690px;
            margin: 0;
            color: rgba(255, 255, 255, 0.84);
            font-size: .9rem;
            line-height: 1.7;
        }

        .btn-utama {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            min-height: 44px;
            padding: .7rem 1rem;
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
            color: var(--white) !important;
            background: var(--deep-blue) !important;
            border-color: var(--deep-blue) !important;
            transform: translateY(-1px);
            box-shadow: 0 5px 14px rgba(16,73,157,.18);
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
            border: 0;
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
        .section-title { margin: 0; color: #0F172A; font-size: 1rem; font-weight: 700; }
        .section-subtitle { margin: 4px 0 0; color: var(--muted); font-size: .78rem; line-height: 1.6; }
        .card-content { padding: 0 22px 24px; }

        .form-label { margin-bottom: 7px; color: #334155; font-size: .82rem; font-weight: 600; }
        .form-control, .form-select {
            min-height: 46px;
            padding: 10px 13px;
            border: 1px solid #D7E0EC;
            border-radius: 9px;
            color: #334155;
            background-color: #FAFCFF;
            font-family: 'Poppins', sans-serif;
            font-size: .85rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--royal-blue);
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(16,73,157,.12);
        }
        
        /* Tambahan styling untuk optgroup agar lebih rapi */
        select optgroup { font-weight: 700; color: var(--royal-blue); font-style: normal; }
        select option { font-weight: 500; color: #334155; padding: 5px; }

        .form-text { margin-top: 6px; color: var(--muted); font-size: .73rem; line-height: 1.55; }
        .form-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 24px; }
        .btn-secondary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 10px 15px;
            color: #475569;
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 9px;
            font-size: .84rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
        }
        .btn-secondary-custom:hover { color: var(--royal-blue); background: #F8FAFC; border-color: #9FB5D3; }
        .form-actions .btn-utama { flex: 1; }

        .product-count { display: inline-flex; align-items: center; gap: 6px; color: var(--slate); font-size: .85rem; font-weight: 600; }
        .product-table-wrap { overflow: hidden; border: 1px solid #E8EDF5; border-radius: 12px; }
        .product-table { width: 100%; margin: 0; border-collapse: separate; border-spacing: 0; }
        .product-table thead th { padding: 13px 12px; color: #64748B; background: #F8FAFC; border-bottom: 1px solid #E8EDF5; font-size: .7rem; font-weight: 600; letter-spacing: .035em; text-transform: uppercase; white-space: nowrap; }
        .product-table tbody td { padding: 14px 12px; color: #334155; background: #FFFFFF; border-bottom: 1px solid #EEF2F7; font-size: .79rem; vertical-align: middle; }
        .product-table tbody tr:last-child td { border-bottom: 0; }
        .product-table tbody tr:hover td { background: #FBFDFF; }
        .product-name { min-width: 130px; }
        
        .action-buttons { display: flex; justify-content: center; gap: 6px; }
        .btn-action { display: inline-flex; align-items: center; justify-content: center; gap: 5px; min-height: 32px; padding: 5px 9px; border-radius: 7px; font-size: .73rem; font-weight: 600; text-decoration: none; white-space: nowrap; }
        .btn-edit { color: #92400E; background: #FEF3C7; border: 1px solid #FDE68A; }
        .btn-edit:hover { color: #78350F; background: #FDE68A; }
        .btn-delete { color: #B42332; background: #FFF1F2; border: 1px solid #FECDD3; }
        .btn-delete:hover { color: #991B1B; background: #FECDD3; }

        .empty-state { padding: 42px 20px; text-align: center; }
        .empty-state-icon { display: inline-flex; align-items: center; justify-content: center; width: 58px; height: 58px; margin-bottom: 13px; color: var(--royal-blue); background: var(--ice-blue); border-radius: 16px; font-size: 1.35rem; }
        .empty-state h3 { margin-bottom: 6px; color: #0F172A; font-size: .96rem; font-weight: 700; }
        .empty-state p { margin: 0; color: var(--muted); font-size: .8rem; line-height: 1.65; }

        .mobile-product-list { display: none; padding: 14px; }
        .mobile-product-card { padding: 15px; background: #FFFFFF; border: 1px solid #E8EDF5; border-radius: 12px; }
        .mobile-product-card + .mobile-product-card { margin-top: 10px; }
        .mobile-product-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; padding-bottom: 11px; border-bottom: 1px solid #EEF2F7; }
        .mobile-product-title { color: #0F172A; font-size: .86rem; font-weight: 700; overflow-wrap: anywhere; }
        .mobile-label { margin-bottom: 3px; color: var(--muted); font-size: .69rem; }
        .mobile-value { color: #334155; font-size: .8rem; font-weight: 600; overflow-wrap: anywhere; }
        .mobile-product-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 13px; padding-top: 12px; }
        .mobile-product-actions { display: flex; gap: 8px; margin-top: 14px; }
        .mobile-product-actions .btn-action { flex: 1; }

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
            .card-header-custom { padding: 17px 17px 13px; }
            .card-content { padding: 0 17px 18px; }
            .form-actions { flex-direction: column-reverse; }
            .form-actions .btn, .form-actions a { width: 100%; }
            .desktop-product-table { display: none; }
            .mobile-product-list { display: block; }
            .product-table-wrap { border: 0; }
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

<?php
    $daftarProduk = (isset($produk) && is_iterable($produk)) ? $produk : [];
    $jumlahProduk = is_countable($daftarProduk) ? count($daftarProduk) : 0;
?>

<!-- Ditambahkan class "container" agar padding kiri-kanan sama persis dengan dashboard -->
<main class="container page-shell">
    <section class="page-hero" aria-labelledby="page-title">
        <div class="hero-content">
            <h1 class="page-title" id="page-title">Kelola Produk Ekspor</h1>
            <p class="page-subtitle">Daftarkan produk, perbarui kapasitas produksi bulanan, dan siapkan data barang untuk proses konsolidasi ekspor.</p>
        </div>
        <div class="hero-action">
            <a href="<?= base_url('umkm/dashboard') ?>" class="btn-outline-hero"
               data-confirm-action="navigate" data-confirm-title="Kembali ke Dashboard?"
               data-confirm-message="Perubahan yang belum disimpan pada formulir input akan hilang. Yakin ingin kembali ke dashboard?"
               data-confirm-text="Ya, Kembali" data-confirm-variant="warning">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>Kembali ke Dasbor
            </a>
        </div>
    </section>

    <div class="row g-3 g-lg-4 align-items-start">
        <section class="col-12 col-lg-5" aria-labelledby="form-title">
            <div class="content-card">
                <div class="card-header-custom">
                    <span class="section-icon"><i class="fas fa-plus" aria-hidden="true"></i></span>
                    <div>
                        <h2 class="section-title" id="form-title">Input Data Barang</h2>
                        <p class="section-subtitle">Isi detail produk yang akan ditawarkan.</p>
                    </div>
                </div>
                <div class="card-content">
                    <form action="<?= base_url('umkm/produk/simpan') ?>" method="POST"
                          data-confirm-submit="true"
                          data-confirm-title="Simpan data produk?"
                          data-confirm-message="Pastikan nama produk, HS Code, kapasitas, dan satuan sudah benar. Produk akan disimpan ke daftar barang Anda."
                          data-confirm-text="Ya, Simpan"
                          data-confirm-variant="save">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required maxlength="255" placeholder="Contoh: Kopi Robusta Sangrai">
                        </div>

                        <!-- PERBAIKAN: Input Teks diubah menjadi Select/Dropdown -->
                        <div class="mb-3">
                            <label for="hs_code" class="form-label">Kategori Komoditas (HS Code) <span class="text-danger">*</span></label>
                            <select class="form-select" id="hs_code" name="hs_code" required>
                                <option value="" selected disabled>-- Pilih Kategori Produk Ekspor --</option>
                                
                                <optgroup label="Pertanian & Perkebunan">
                                    <option value="09011110">09011110 - Biji Kopi Arabika</option>
                                    <option value="09011120">09011120 - Biji Kopi Robusta</option>
                                    <option value="18010000">18010000 - Biji Kakao / Cokelat</option>
                                    <option value="09041110">09041110 - Lada Hitam Belum Dihancurkan</option>
                                    <option value="09050000">09050000 - Vanili</option>
                                </optgroup>
                                
                                <optgroup label="Olahan Kayu & Kerajinan">
                                    <option value="44029010">44029010 - Briket Arang Batok Kelapa</option>
                                    <option value="94036000">94036000 - Furnitur / Perabotan Kayu</option>
                                    <option value="46021900">46021900 - Kerajinan Anyaman (Rotan/Bambu)</option>
                                </optgroup>

                                <optgroup label="Tekstil, Pakaian & Alas Kaki">
                                    <option value="62052000">62052000 - Kemeja Pria dari Kapas</option>
                                    <option value="61091010">61091010 - T-shirt / Kaos Katun</option>
                                    <option value="64039900">64039900 - Sepatu Kulit</option>
                                </optgroup>
                                
                                <optgroup label="Makanan & Minuman Olahan">
                                    <option value="19059090">19059090 - Makanan Ringan / Keripik</option>
                                    <option value="20098900">20098900 - Jus Buah-buahan Lainnya</option>
                                </optgroup>
                            </select>
                            <div class="form-text">Pilih kategori yang paling sesuai agar sistem (Smart Clustering) dapat menggabungkan barang Anda ke dalam kontainer yang tepat secara akurat.</div>
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-sm-8">
                                <label for="kapasitas_bulanan" class="form-label">Kapasitas Produksi Bulanan</label>
                                <input type="number" class="form-control" id="kapasitas_bulanan" name="kapasitas_bulanan" min="1" step="1" required placeholder="Contoh: 5000">
                            </div>
                            <div class="col-12 col-sm-4">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    <option value="Kg">Kilogram (Kg)</option>
                                    <option value="Ton">Ton</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="<?= base_url('umkm/dashboard') ?>" class="btn-secondary-custom"
                               data-confirm-action="navigate" data-confirm-title="Kembali ke Dashboard?"
                               data-confirm-message="Data yang sudah diketik tetapi belum disimpan akan hilang. Yakin ingin kembali ke dashboard?"
                               data-confirm-text="Ya, Kembali" data-confirm-variant="warning">
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>Kembali ke Dasbor
                            </a>
                            <button type="submit" class="btn-utama">
                                <i class="fas fa-floppy-disk" aria-hidden="true"></i>Simpan Data Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="col-12 col-lg-7" aria-labelledby="products-title">
            <div class="content-card">
                <div class="card-header-custom justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <span class="section-icon"><i class="fas fa-box-open" aria-hidden="true"></i></span>
                        <div>
                            <h2 class="section-title" id="products-title">Daftar Barang Saya</h2>
                            <p class="section-subtitle">Kelola produk yang sudah terdaftar.</p>
                        </div>
                    </div>
                    <span class="product-count"><i class="fas fa-box me-1" aria-hidden="true"></i><?= number_format($jumlahProduk) ?> produk</span>
                </div>

                <?php if ($jumlahProduk > 0) : ?>
                    <div class="desktop-product-table px-3 pb-3">
                        <div class="product-table-wrap table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>HS Code</th>
                                        <th>Kapasitas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach ($daftarProduk as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><div class="product-name fw-bold text-dark"><?= esc($row['nama_produk'] ?? '-') ?></div></td>
                                            <td><span class="badge bg-secondary font-monospace"><?= esc($row['hs_code'] ?? '-') ?></span></td>
                                            <td class="text-nowrap fw-bold text-dark">
                                                <?= number_format((float) ($row['kapasitas_bulanan'] ?? 0)) ?> 
                                                <span class="text-secondary fw-normal"><?= esc($row['satuan'] ?? '') ?></span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="<?= base_url('umkm/produk/edit/' . $row['id_produk']) ?>" class="btn-action btn-edit"
                                                       data-confirm-action="navigate" data-confirm-title="Edit produk ini?"
                                                       data-confirm-message="Anda akan membuka formulir edit untuk produk ‘<?= esc($row['nama_produk'] ?? 'produk ini', 'attr') ?>’. Lanjutkan?"
                                                       data-confirm-text="Ya, Edit" data-confirm-variant="primary">
                                                        <i class="fas fa-pen" aria-hidden="true"></i>Edit
                                                    </a>
                                                    <form action="<?= base_url('umkm/produk/hapus/' . $row['id_produk']) ?>" method="POST" class="m-0"
                                                          data-confirm-submit="true"
                                                          data-confirm-title="Hapus produk?"
                                                          data-confirm-message="Produk ‘<?= esc($row['nama_produk'] ?? 'ini', 'attr') ?>’ akan dihapus dari daftar dan dari konsorsium. Tindakan ini tidak dapat dibatalkan."
                                                          data-confirm-text="Ya, Hapus" data-confirm-variant="danger">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn-action btn-delete">
                                                            <i class="fas fa-trash" aria-hidden="true"></i>Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mobile-product-list">
                        <?php foreach ($daftarProduk as $row) : ?>
                            <article class="mobile-product-card">
                                <div class="mobile-product-top">
                                    <div class="mobile-product-title"><?= esc($row['nama_produk'] ?? '-') ?></div>
                                    <span class="badge bg-secondary font-monospace"><?= esc($row['hs_code'] ?? '-') ?></span>
                                </div>
                                <div class="mobile-product-meta">
                                    <div>
                                        <div class="mobile-label">Kapasitas Bulanan</div>
                                        <div class="mobile-value fw-bold text-dark">
                                            <?= number_format((float) ($row['kapasitas_bulanan'] ?? 0)) ?> 
                                            <span class="text-secondary fw-normal"><?= esc($row['satuan'] ?? '') ?></span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-label">ID Produk</div>
                                        <div class="mobile-value text-secondary">#<?= esc($row['id_produk'] ?? '-') ?></div>
                                    </div>
                                </div>
                                <div class="mobile-product-actions">
                                    <a href="<?= base_url('umkm/produk/edit/' . $row['id_produk']) ?>" class="btn-action btn-edit"
                                       data-confirm-action="navigate" data-confirm-title="Edit produk ini?"
                                       data-confirm-message="Anda akan membuka formulir edit untuk produk ‘<?= esc($row['nama_produk'] ?? 'produk ini', 'attr') ?>’. Lanjutkan?"
                                       data-confirm-text="Ya, Edit" data-confirm-variant="primary">
                                        <i class="fas fa-pen" aria-hidden="true"></i>Edit
                                    </a>
                                    <form action="<?= base_url('umkm/produk/hapus/' . $row['id_produk']) ?>" method="POST" class="w-50 m-0"
                                          data-confirm-submit="true"
                                          data-confirm-title="Hapus produk?"
                                          data-confirm-message="Produk ‘<?= esc($row['nama_produk'] ?? 'ini', 'attr') ?>’ akan dihapus dari daftar. Tindakan ini tidak dapat dibatalkan."
                                          data-confirm-text="Ya, Hapus" data-confirm-variant="danger">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn-action btn-delete w-100">
                                            <i class="fas fa-trash" aria-hidden="true"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="empty-state">
                        <span class="empty-state-icon"><i class="fas fa-box-open" aria-hidden="true"></i></span>
                        <h3>Belum ada produk terdaftar</h3>
                        <p>Produk yang kamu tambahkan melalui formulir di sebelah ini akan tampil di daftar barang.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
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