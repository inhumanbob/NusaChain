<?php
$flashSuccess = session()->getFlashdata('success');
$flashError = session()->getFlashdata('error');
?>

<?php if ($flashSuccess || $flashError): ?>
<style>
    .nc-flash-toast-wrap {
        position: fixed;
        top: 92px;
        right: max(18px, calc((100vw - 1320px) / 2));
        z-index: 2100;
        width: min(430px, calc(100vw - 36px));
        pointer-events: none;
    }

    .nc-flash-toast {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 15px 15px 15px 14px;
        background: #FFFFFF;
        color: #334155;
        border: 1px solid #E2E8F0;
        border-left: 4px solid #10499D;
        border-radius: 15px;
        box-shadow: 0 18px 42px rgba(15, 41, 77, 0.16);
        pointer-events: auto;
        animation: ncToastEnter .24s ease-out both;
    }

    .nc-flash-toast--error { border-left-color: #DC3545; }

    .nc-flash-toast__icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        color: #10499D;
        background: #EAF2FF;
        border-radius: 11px;
        font-size: 1rem;
    }

    .nc-flash-toast--error .nc-flash-toast__icon {
        color: #B42332;
        background: #FFF1F2;
    }

    .nc-flash-toast__content { flex: 1; min-width: 0; padding-top: 1px; }
    .nc-flash-toast__title {
        margin: 0 0 3px;
        color: #0F172A;
        font-family: 'Poppins', sans-serif;
        font-size: .88rem;
        font-weight: 700;
        line-height: 1.4;
    }
    .nc-flash-toast__message {
        margin: 0;
        color: #64748B;
        font-family: 'Poppins', sans-serif;
        font-size: .81rem;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }
    .nc-flash-toast__close {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 30px;
        width: 30px;
        height: 30px;
        margin: -4px -5px 0 0;
        color: #64748B;
        background: transparent;
        border: 0;
        border-radius: 8px;
        cursor: pointer;
        transition: background .18s ease, color .18s ease;
    }
    .nc-flash-toast__close:hover { color: #0F172A; background: #F1F5F9; }
    .nc-flash-toast.nc-is-leaving { animation: ncToastExit .2s ease-in forwards; }

    @keyframes ncToastEnter {
        from { opacity: 0; transform: translateY(-8px) scale(.99); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes ncToastExit {
        to { opacity: 0; transform: translateY(-6px) scale(.99); }
    }

    @media (max-width: 767.98px) {
        .nc-flash-toast-wrap {
            top: 78px;
            right: 12px;
            width: calc(100vw - 24px);
        }
        .nc-flash-toast { padding: 13px 12px; gap: 10px; border-radius: 13px; }
        .nc-flash-toast__icon { flex-basis: 35px; width: 35px; height: 35px; }
        .nc-flash-toast__title { font-size: .84rem; }
        .nc-flash-toast__message { font-size: .78rem; }
    }

    @media (prefers-reduced-motion: reduce) {
        .nc-flash-toast, .nc-flash-toast.nc-is-leaving { animation: none; }
    }
</style>

<div class="nc-flash-toast-wrap" aria-live="polite" aria-atomic="true">
    <?php if ($flashSuccess): ?>
        <div class="nc-flash-toast" role="status" data-nc-flash-toast>
            <span class="nc-flash-toast__icon" aria-hidden="true"><i class="fas fa-circle-check"></i></span>
            <div class="nc-flash-toast__content">
                <p class="nc-flash-toast__title">Berhasil</p>
                <p class="nc-flash-toast__message"><?= esc($flashSuccess) ?></p>
            </div>
            <button type="button" class="nc-flash-toast__close" data-nc-toast-close aria-label="Tutup notifikasi">
                <i class="fas fa-xmark" aria-hidden="true"></i>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($flashError): ?>
        <div class="nc-flash-toast nc-flash-toast--error" role="alert" data-nc-flash-toast>
            <span class="nc-flash-toast__icon" aria-hidden="true"><i class="fas fa-circle-exclamation"></i></span>
            <div class="nc-flash-toast__content">
                <p class="nc-flash-toast__title">Perlu diperiksa</p>
                <p class="nc-flash-toast__message"><?= esc($flashError) ?></p>
            </div>
            <button type="button" class="nc-flash-toast__close" data-nc-toast-close aria-label="Tutup notifikasi">
                <i class="fas fa-xmark" aria-hidden="true"></i>
            </button>
        </div>
    <?php endif; ?>
</div>

<script>
(function () {
    const toasts = document.querySelectorAll('[data-nc-flash-toast]');

    function dismissToast(toast) {
        if (!toast || toast.classList.contains('nc-is-leaving')) return;
        toast.classList.add('nc-is-leaving');
        window.setTimeout(() => toast.remove(), 220);
    }

    toasts.forEach((toast) => {
        const closeButton = toast.querySelector('[data-nc-toast-close]');
        if (closeButton) closeButton.addEventListener('click', () => dismissToast(toast));
        window.setTimeout(() => dismissToast(toast), 5000);
    });
})();
</script>
<?php endif; ?>
