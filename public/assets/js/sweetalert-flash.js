/**
 * SweetAlert2 — показ flash-сообщений и ошибок в стиле публичной части
 * Тема: тёмный фон (#191919), акцент #C5FF41
 */
(function () {
    "use strict";

    var flash = window.laravelFlash || {};
    var hasMessage = flash.success || flash.error || flash.warning || flash.info || (flash.errors && Object.keys(flash.errors).length > 0);

    if (!hasMessage || typeof Swal === "undefined") return;

    var swalConfig = {
        customClass: {
            popup: "swal-public-theme",
            confirmButton: "swal-btn-confirm",
        },
        background: "#191919",
        color: "#ECEEF2",
        confirmButtonColor: "#C5FF41",
        confirmButtonText: "OK",
        timer: 5000,
        timerProgressBar: true,
        backdrop: "rgba(0,0,0,0.75)",
    };

    function showSuccess(text) {
        Swal.fire({
            ...swalConfig,
            icon: "success",
            title: "Готово",
            text: text,
            iconColor: "#C5FF41",
        });
    }

    function showError(text) {
        Swal.fire({
            ...swalConfig,
            icon: "error",
            title: "Ошибка",
            text: text,
            iconColor: "#e74c3c",
        });
    }

    function showWarning(text) {
        Swal.fire({
            ...swalConfig,
            icon: "warning",
            title: "Внимание",
            text: text,
            iconColor: "#f39c12",
        });
    }

    function showInfo(text) {
        Swal.fire({
            ...swalConfig,
            icon: "info",
            title: "Информация",
            text: text,
            iconColor: "#3498db",
        });
    }

    function showValidationErrors(errors) {
        var messages = [];
        for (var field in errors) {
            if (errors.hasOwnProperty(field) && Array.isArray(errors[field])) {
                messages = messages.concat(errors[field]);
            }
        }
        var text = messages.length > 0 ? messages.join("\n") : "Проверьте введённые данные.";
        showError(text);
    }

    if (flash.success) {
        showSuccess(flash.success);
    } else if (flash.error) {
        showError(flash.error);
    } else if (flash.warning) {
        showWarning(flash.warning);
    } else if (flash.info) {
        showInfo(flash.info);
    } else if (flash.errors && Object.keys(flash.errors).length > 0) {
        showValidationErrors(flash.errors);
    }

    window.swalPublic = {
        success: showSuccess,
        error: showError,
        warning: showWarning,
        info: showInfo,
    };
})();
