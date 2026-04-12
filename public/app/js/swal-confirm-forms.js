/**
 * Формы с подтверждением через SweetAlert2.
 * Формы с атрибутом data-swal-confirm показывают диалог подтверждения вместо native confirm().
 */
(function() {
    if (typeof Swal === 'undefined') return;

    function getConfirmConfig() {
        var palette = typeof window.getLkSwalThemePalette === 'function' ? window.getLkSwalThemePalette() : null;
        var isDark = typeof window.isLkDarkTheme === 'function' ? window.isLkDarkTheme() : !!(document.getElementById('app-container') && document.getElementById('app-container').classList.contains('theme-dark'));
        var accent = palette ? palette.accent : (isDark ? '#C5FF41' : '#4B7B5B');
        return isDark
            ? { customClass: { popup: 'swal-lk-theme', confirmButton: 'swal-lk-btn-confirm' }, background: '#191919', color: '#ECEEF2', confirmButtonColor: accent, cancelButtonColor: '#6c757d', backdrop: 'rgba(0,0,0,0.75)', iconColor: palette ? palette.question : accent }
            : { customClass: { popup: 'swal-lk-theme swal-lk-theme-light', confirmButton: 'swal-lk-btn-confirm' }, background: '#FFFFFF', color: '#1F2937', confirmButtonColor: accent, cancelButtonColor: 'transparent', backdrop: 'rgba(0,0,0,0.4)', iconColor: palette ? palette.question : accent };
    }

    document.addEventListener('submit', function(e) {
        var form = e.target;
        var msg = form.getAttribute && form.getAttribute('data-swal-confirm');
        if (!msg) return;
        e.preventDefault();
        e.stopPropagation();
        var cfg = getConfirmConfig();
        Swal.fire({
            customClass: cfg.customClass,
            background: cfg.background,
            color: cfg.color,
            confirmButtonColor: cfg.confirmButtonColor,
            cancelButtonColor: cfg.cancelButtonColor,
            backdrop: cfg.backdrop,
            icon: 'question',
            iconColor: cfg.iconColor,
            title: form.getAttribute('data-swal-title') || 'Подтверждение',
            text: msg,
            showCancelButton: true,
            confirmButtonText: 'Да',
            cancelButtonText: 'Отмена',
            didOpen: function () {
                if (typeof window.scheduleSyncLkSwalPopupTheme === 'function') {
                    window.scheduleSyncLkSwalPopupTheme();
                } else if (typeof window.syncLkSwalPopupTheme === 'function') {
                    window.syncLkSwalPopupTheme();
                }
            },
        }).then(function(r) {
            if (r.isConfirmed) {
                form.removeAttribute('data-swal-confirm');
                form.submit();
            }
        });
    }, true);
})();
