<?php
/**
 * Partial navbar bersama NusaChain.
 * Digunakan via: <?= $this->include('layout/navbar') ?>
 */

$role = session()->get('role') ?? '';
$nama = session()->get('nama') ?? 'Pengguna';
$uri  = trim(uri_string(), '/');

$isAdmin = ($role === 'Admin');
$isBuyer = ($role === 'Buyer');
$isUmkm  = ($role === 'UMKM');

// Penentuan tautan profil sesuai peran
if ($isAdmin) {
    $linkProfil = base_url('admin/dashboard');
} elseif ($isBuyer) {
    $linkProfil = base_url('buyer/profil');
} elseif ($isUmkm) {
    $linkProfil = base_url('umkm/profil');
} else {
    $linkProfil = base_url('login');
}

$profilAktif = in_array($uri, ['umkm/profil', 'buyer/profil'], true);
?>

<style>
    :root {
        --nc-royal-blue: #10499D;
        --nc-deep-blue: #0B4599;
        --nc-white: #FFFFFF;
        --nc-ice-blue: #F3F6FB;
        --nc-slate: #334155;
        --nc-muted: #64748B;
        --nc-border: #E2E8F0;
    }

    .nc-navbar-wrapper {
        position: sticky;
        top: 0;
        z-index: 1020;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .nc-navbar {
        width: 100%;
        background: rgba(255, 255, 255, 0.98);
        border-bottom: 1px solid var(--nc-border);
        box-shadow: 0 3px 14px rgba(15, 41, 77, 0.03);
        backdrop-filter: blur(12px);
        font-family: 'Poppins', sans-serif;
    }

    .nc-navbar-inner {
        min-height: 74px;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .nc-navbar-brand {
        display: inline-flex;
        align-items: center;
        flex: 0 0 auto;
        order: 1;
        padding: 0;
        margin: 0;
    }

    .nc-navbar-brand img {
        display: block;
        width: auto;
        height: 40px;
        object-fit: contain;
        transform: scale(1.5);
        transform-origin: left center;
    }

    .nc-navbar-collapse {
        order: 2;
        flex: 1 1 auto;
        min-width: 0;
    }

    .nc-navbar-menu {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-left: clamp(1.5rem, 3.5vw, 3.5rem);
    }

    .nc-navbar-menu .nav-link {
        padding: 0.5rem 0.9rem;
        color: var(--nc-slate);
        font-size: 0.88rem;
        font-weight: 500;
        white-space: nowrap;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .nc-navbar-menu .nav-link:hover,
    .nc-navbar-menu .nav-link:focus {
        color: var(--nc-royal-blue);
        background: var(--nc-ice-blue);
    }

    .nc-navbar-menu .nav-link.active {
        color: var(--nc-royal-blue);
        background: #EAF2FF;
        font-weight: 600;
    }

    .nc-navbar-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex: 0 0 auto;
        order: 3;
        gap: 0.85rem;
        margin-left: auto;
    }

    .nc-navbar-account {
        text-decoration: none;
        cursor: pointer;
    }

    .profile-pill {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 4px 14px 4px 4px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 50px;
        transition: all 0.2s ease;
        max-width: 260px;
    }

    .nc-navbar-account:hover .profile-pill,
    .nc-navbar-account.active .profile-pill {
        background: #FFFFFF;
        border-color: #CBD5E1;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
    }

    .nc-user-avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        width: 36px;
        height: 36px;
        color: var(--nc-white);
        background: var(--nc-royal-blue);
        border-radius: 50%;
        font-size: 0.85rem;
    }

    .nc-user-copy {
        min-width: 0;
        flex: 1 1 auto;
        line-height: 1.25;
        overflow: hidden;
    }

    .nc-user-name {
        color: #0F172A;
        font-size: 0.82rem;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .nc-user-role {
        color: var(--nc-muted);
        font-size: 0.68rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        white-space: nowrap;
    }

    .nc-btn-logout {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        color: #DC3545 !important;
        background: #FFF1F2;
        border: 1px solid #FFE0E3;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .nc-btn-logout:hover {
        color: #FFFFFF !important;
        background: #DC3545;
        border-color: #DC3545;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
    }

    .nc-navbar-toggler {
        display: none;
        padding: 0.4rem 0.55rem;
        color: var(--nc-royal-blue);
        background: #FFFFFF;
        border: 1px solid #D7E3F3;
        border-radius: 9px;
    }

    @media (max-width: 991.98px) {
        .nc-navbar-inner { min-height: 68px; }
        .nc-navbar-toggler { display: inline-flex; }
        .nc-navbar-actions { order: 2; gap: 0.6rem; }
        .nc-navbar-collapse {
            order: 3;
            flex: 0 0 100%;
            width: 100%;
            margin: 0.35rem 0 0.8rem;
        }
        .nc-navbar-menu {
            display: block;
            margin: 0;
            padding-top: 0.55rem;
            border-top: 1px solid var(--nc-border);
        }
        .nc-navbar-menu .nav-link { padding: 0.65rem 0.8rem; }
    }

    @media (max-width: 767.98px) {
        .nc-navbar-inner { min-height: 64px; }
        .nc-navbar-brand img { height: 32px; transform: scale(1.3); }
        .profile-pill { padding: 3px 10px 3px 3px; max-width: 180px; }
        .nc-user-avatar { width: 32px; height: 32px; font-size: 0.75rem; }
        .nc-btn-logout { width: 36px; height: 36px; border-radius: 10px; }
    }

    /* Modal Konfirmasi Logout */
    .nc-modal-open { overflow: hidden; }
    .nc-confirm-backdrop {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        padding: 1.25rem;
        background: rgba(15, 23, 42, 0.52);
        backdrop-filter: blur(4px);
    }
    .nc-confirm-backdrop[hidden] { display: none !important; }
    .nc-confirm-dialog {
        width: min(100%, 420px);
        padding: 1.75rem;
        background: var(--nc-white);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 18px;
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.22);
    }
    .nc-confirm-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        margin-bottom: 1rem;
        color: #DC3545;
        background: #FFF1F2;
        border-radius: 14px;
        font-size: 1.2rem;
    }
    .nc-confirm-title { margin: 0 0 0.5rem; color: #0F172A; font-size: 1.15rem; font-weight: 700; }
    .nc-confirm-copy { margin: 0; color: var(--nc-muted); font-size: 0.88rem; line-height: 1.6; }
    .nc-confirm-actions { display: flex; justify-content: flex-end; gap: 0.65rem; margin-top: 1.5rem; }
    .nc-confirm-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }
    .nc-confirm-cancel { color: var(--nc-slate); background: #FFFFFF; border: 1px solid #CBD5E1; }
    .nc-confirm-yes { color: #FFFFFF !important; background: #DC3545; border: 1px solid #DC3545; }
</style>

<div class="nc-navbar-wrapper">
    <nav class="navbar navbar-expand-lg nc-navbar" id="ncMainNavbar" aria-label="Navigasi utama NusaChain">
        <div class="container nc-navbar-inner d-flex align-items-center justify-content-between">
            
            <div class="nc-navbar-brand">
                <?php if ($isAdmin || $isUmkm || $isBuyer): ?>
                    <!-- Logo statis tanpa tautan untuk pengguna yang sedang login -->
                    <span class="d-inline-flex align-items-center" style="cursor: default; user-select: none; pointer-events: none;">
                        <img src="<?= base_url('assets/img/logo-horizontal1.png') ?>" alt="Logo NusaChain">
                    </span>
                <?php else: ?>
                    <!-- Tautan aktif hanya untuk pengunjung umum / tamu -->
                    <a href="<?= base_url('/') ?>">
                        <img src="<?= base_url('assets/img/logo-horizontal1png') ?>" alt="Logo NusaChain">
                    </a>
                <?php endif; ?>
            </div>

            <div class="nc-navbar-actions">
                <!-- Profil Akun Pengguna -->
                <a href="<?= $linkProfil ?>" class="nc-navbar-account <?= $profilAktif ? 'active' : '' ?>" title="<?= esc($nama) ?>">
                    <div class="profile-pill">
                        <span class="nc-user-avatar" aria-hidden="true"><i class="fas fa-user-shield"></i></span>
                        <div class="nc-user-copy text-start">
                            <div class="nc-user-name"><?= esc($nama) ?></div>
                            <div class="nc-user-role"><?= esc($role !== '' ? $role : 'User') ?></div>
                        </div>
                    </div>
                </a>

                <!-- Tombol Logout -->
                <a href="<?= base_url('logout') ?>" class="nc-btn-logout" id="ncLogoutTrigger" aria-label="Keluar dari akun" title="Keluar">
                    <i class="fas fa-power-off" aria-hidden="true"></i>
                </a>

                <button class="navbar-toggler nc-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ncGlobalNavbar" aria-controls="ncGlobalNavbar" aria-expanded="false" aria-label="Menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse nc-navbar-collapse" id="ncGlobalNavbar">
                <ul class="navbar-nav nc-navbar-menu">
                    <?php if ($isAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= str_starts_with($uri, 'admin') ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                                <i class="fas fa-gauge-high me-2" aria-hidden="true"></i>Pusat Kendali
                            </a>
                        </li>
                    <?php elseif ($isUmkm): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri === 'umkm/dashboard' || $uri === 'umkm') ? 'active' : '' ?>" href="<?= base_url('umkm/dashboard') ?>">
                                <i class="fas fa-house me-2" aria-hidden="true"></i>Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= str_starts_with($uri, 'konsorsium') ? 'active' : '' ?>" href="<?= base_url('konsorsium/detail') ?>">
                                <i class="fas fa-ship me-2" aria-hidden="true"></i>Detail Konsorsium
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= str_starts_with($uri, 'umkm/produk') ? 'active' : '' ?>" href="<?= base_url('umkm/produk') ?>">
                                <i class="fas fa-boxes-stacked me-2" aria-hidden="true"></i>Kelola Produk
                            </a>
                        </li>
                    <?php elseif ($isBuyer): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri === 'buyer/dashboard' || $uri === 'buyer') ? 'active' : '' ?>" href="<?= base_url('buyer/dashboard') ?>">
                                <i class="fas fa-clipboard-list me-2" aria-hidden="true"></i>Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (str_starts_with($uri, 'buyer/cari') || str_starts_with($uri, 'buyer/pesan')) ? 'active' : '' ?>" href="<?= base_url('buyer/cari') ?>">
                                <i class="fas fa-compass me-2" aria-hidden="true"></i>Katalog Konsorsium
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </nav>
</div>

<!-- Modal Konfirmasi Keluar -->
<div class="nc-confirm-backdrop" id="ncLogoutModal" hidden>
    <section class="nc-confirm-dialog" role="dialog" aria-modal="true" aria-labelledby="ncLogoutTitle">
        <div class="nc-confirm-icon" aria-hidden="true">
            <i class="fas fa-right-from-bracket"></i>
        </div>
        <h2 class="nc-confirm-title" id="ncLogoutTitle">Keluar dari NusaChain?</h2>
        <p class="nc-confirm-copy">Apakah Anda yakin ingin mengakhiri sesi akun <?= esc($role !== '' ? $role : '') ?> ini?</p>
        <div class="nc-confirm-actions">
            <button type="button" class="nc-confirm-btn nc-confirm-cancel" id="ncCancelLogout">Batal</button>
            <a href="<?= base_url('logout') ?>" class="nc-confirm-btn nc-confirm-yes" id="ncConfirmLogout">
                <i class="fas fa-right-from-bracket me-1" aria-hidden="true"></i> Ya, Keluar
            </a>
        </div>
    </section>
</div>

<script>
(function () {
    const trigger = document.getElementById('ncLogoutTrigger');
    const modal = document.getElementById('ncLogoutModal');
    const cancelButton = document.getElementById('ncCancelLogout');
    const confirmLink = document.getElementById('ncConfirmLogout');
    if (!trigger || !modal || !cancelButton || !confirmLink) return;

    function openModal(e) {
        e.preventDefault();
        modal.hidden = false;
        document.body.classList.add('nc-modal-open');
        cancelButton.focus();
    }

    function closeModal() {
        modal.hidden = true;
        document.body.classList.remove('nc-modal-open');
        trigger.focus();
    }

    trigger.addEventListener('click', openModal);
    cancelButton.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', function (e) {
        if (modal.hidden) return;
        if (e.key === 'Escape') closeModal();
        if (e.key === 'Tab') {
            const focusable = [cancelButton, confirmLink];
            const first = focusable[0];
            const last = focusable[focusable.length - 1]; // Perbaikan indeks array

            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });
})();
</script>