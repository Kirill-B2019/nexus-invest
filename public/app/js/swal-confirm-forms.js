/**
 * Формы с подтверждением через SweetAlert2.
 * Формы с атрибутом data-swal-confirm показывают диалог подтверждения вместо native confirm().
 */
(function() {
    if (typeof Swal === 'undefined') return;

    function getConfirmConfig() {
        var container = document.getElementById('app-container');
        var isDark = container && container.classList.contains('body-theme-dark');
        return isDark
            ? { customClass: { popup: 'swal-lk-theme', confirmButton: 'swal-lk-btn-confirm' }, background: '#191919', color: '#ECEEF2', confirmButtonColor: '#C5FF41', cancelButtonColor: '#6c757d', backdrop: 'rgba(0,0,0,0.75)' }
            : { customClass: { popup: 'swal-lk-theme swal-lk-theme-light', confirmButton: 'swal-lk-btn-confirm' }, background: '#FFFFFF', color: '#1F2937', confirmButtonColor: '#4B7B5B', cancelButtonColor: 'transparent', backdrop: 'rgba(0,0,0,0.4)' };
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
            title: form.getAttribute('data-swal-title') || 'Подтверждение',
            text: msg,
            showCancelButton: true,
            confirmButtonText: 'Да',
            cancelButtonText: 'Отмена',
        }).then(function(r) {
            if (r.isConfirmed) {
                form.removeAttribute('data-swal-confirm');
                form.submit();
            }
        });
    }, true);
})();
