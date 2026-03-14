/**
 * SweetAlert2 — flash-сообщения в теме закрытой части (ЛК).
 * Цвета зависят от темы: светлая (#FFFFFF, #4B7B5B) или тёмная (#191919, #C5FF41).
 */
(function () {
    "use strict";

    var flash = window.laravelFlashLk || {};
    var hasMessage = flash.success || flash.error || flash.warning || flash.info || (flash.errors && Object.keys(flash.errors).length > 0);

    if (typeof Swal === "undefined") return;

    function getSwalConfig() {
        var container = document.getElementById("app-container");
        var isDark = container && container.classList.contains("body-theme-dark");
        return isDark
            ? {
                customClass: { popup: "swal-lk-theme", confirmButton: "swal-lk-btn-confirm" },
                background: "#191919",
                color: "#ECEEF2",
                confirmButtonColor: "#C5FF41",
                confirmButtonText: "OK",
                timer: 5000,
                timerProgressBar: true,
                backdrop: "rgba(0,0,0,0.75)",
            }
            : {
                customClass: { popup: "swal-lk-theme swal-lk-theme-light", confirmButton: "swal-lk-btn-confirm" },
                background: "#FFFFFF",
                color: "#1F2937",
                confirmButtonColor: "#4B7B5B",
                confirmButtonText: "OK",
                timer: 5000,
                timerProgressBar: true,
                backdrop: "rgba(0,0,0,0.4)",
            };
    }

    function showSuccess(text) {
        var cfg = getSwalConfig();
        Swal.fire({
            ...cfg,
            icon: "success",
            title: "Готово",
            text: text,
            iconColor: cfg.confirmButtonColor,
        });
    }

    function showError(text) {
        Swal.fire({
            ...getSwalConfig(),
            icon: "error",
            title: "Ошибка",
            text: text,
            iconColor: "#e74c3c",
        });
    }

    function showWarning(text) {
        Swal.fire({
            ...getSwalConfig(),
            icon: "warning",
            title: "Внимание",
            text: text,
            iconColor: "#f39c12",
        });
    }

    function showInfo(text) {
        Swal.fire({
            ...getSwalConfig(),
            icon: "info",
            title: "Информация",
            text: text,
            iconColor: "#3498db",
        });
    }

    window.swalLk = {
        success: showSuccess,
        error: showError,
        warning: showWarning,
        info: showInfo,
        confirm: function(text, title) {
            var cfg = getSwalConfig();
            return Swal.fire({
                ...cfg,
                icon: "question",
                title: title || "Подтверждение",
                text: text,
                showCancelButton: true,
                confirmButtonText: "Да",
                cancelButtonText: "Отмена",
                timer: undefined,
                timerProgressBar: false,
            }).then(function(r) { return r.isConfirmed; });
        },
    };

    if (hasMessage) {
        if (flash.success) {
            showSuccess(flash.success);
        } else if (flash.error) {
            showError(flash.error);
        } else if (flash.warning) {
            showWarning(flash.warning);
        } else if (flash.info) {
            showInfo(flash.info);
        }
    }
