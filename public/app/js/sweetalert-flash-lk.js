/**
 * SweetAlert2 — flash-сообщения в теме закрытой части (ЛК).
 * Тема: классы theme-dark / theme-light на #app-container (см. layouts/app/app.blade.php).
 * Палитра согласована с public/app/css/app.css (--app-color-primary и т.д.).
 */
(function () {
    "use strict";

    var flash = window.laravelFlashLk || {};
    var hasMessage = flash.success || flash.error || flash.warning || flash.info || (flash.errors && Object.keys(flash.errors).length > 0);

    /**
     * Тёмная тема: data-lk-theme с сервера (layouts/app/app.blade.php) — приоритет;
     * затем классы theme-light / theme-dark на #app-container; затем имя файла темы в cookie app_theme.
     */
    function isLkDarkTheme() {
        var container = document.getElementById("app-container");
        if (container) {
            var dataTheme = container.getAttribute("data-lk-theme");
            if (dataTheme === "light") {
                return false;
            }
            if (dataTheme === "dark") {
                return true;
            }
            if (container.classList.contains("theme-light")) {
                return false;
            }
            if (container.classList.contains("theme-dark")) {
                return true;
            }
        }
        var m = document.cookie.match(/(?:^|; )app_theme=([^;]*)/);
        var raw = m ? decodeURIComponent(m[1]) : "";
        if (raw.indexOf(".light.") !== -1 || /(^|\/)dore\.light\./i.test(raw)) {
            return false;
        }
        if (raw.indexOf(".dark.") !== -1 || /(^|\/)dore\.dark\./i.test(raw)) {
            return true;
        }
        return raw.indexOf("dark") !== -1 && raw.indexOf("light") === -1;
    }

    window.isLkDarkTheme = isLkDarkTheme;

    /** После открытия: классы и inline-цвета (CDN Swal может перезаписать стили после didOpen — см. scheduleSync). */
    function syncLkSwalPopupTheme() {
        if (typeof Swal === "undefined" || typeof Swal.getPopup !== "function") {
            return;
        }
        var popup = Swal.getPopup();
        if (!popup) {
            return;
        }
        var dark = isLkDarkTheme();
        popup.classList.add("swal-lk-theme");
        var titleEl = popup.querySelector(".swal2-title");
        var htmlEl = popup.querySelector(".swal2-html-container");
        var htmlById = document.getElementById("swal2-html-container");
        if (dark) {
            popup.classList.remove("swal-lk-theme-light");
            popup.style.setProperty("background-color", "#191919", "important");
            popup.style.setProperty("color", "#eceef2", "important");
            if (titleEl) {
                titleEl.style.setProperty("color", "#eceef2", "important");
            }
            if (htmlEl) {
                htmlEl.style.setProperty("color", "#eceef2", "important");
            }
            if (htmlById && htmlById !== htmlEl) {
                htmlById.style.setProperty("color", "#eceef2", "important");
            }
        } else {
            popup.classList.add("swal-lk-theme-light");
            popup.style.setProperty("background-color", "#ffffff", "important");
            popup.style.setProperty("color", "#1f2937", "important");
            if (titleEl) {
                titleEl.style.setProperty("color", "#1f2937", "important");
            }
            if (htmlEl) {
                htmlEl.style.setProperty("color", "#1f2937", "important");
            }
            if (htmlById && htmlById !== htmlEl) {
                htmlById.style.setProperty("color", "#1f2937", "important");
            }
        }
    }

    /** Swal применяет свои стили после didOpen — повторяем синхронизацию. */
    function scheduleSyncLkSwalPopupTheme() {
        syncLkSwalPopupTheme();
        if (typeof requestAnimationFrame === "function") {
            requestAnimationFrame(function () {
                syncLkSwalPopupTheme();
            });
        }
        setTimeout(syncLkSwalPopupTheme, 0);
        setTimeout(syncLkSwalPopupTheme, 50);
        setTimeout(syncLkSwalPopupTheme, 150);
    }

    window.syncLkSwalPopupTheme = syncLkSwalPopupTheme;
    window.scheduleSyncLkSwalPopupTheme = scheduleSyncLkSwalPopupTheme;

    /**
     * Цвета иконок и акцента в одной палитре с темой ЛК (не дефолтные цвета SweetAlert2).
     * Доступна до загрузки Swal — для swal-confirm-forms и др.
     */
    function getLkSwalThemePalette() {
        var dark = isLkDarkTheme();
        return dark
            ? {
                accent: "#C5FF41",
                error: "#F87171",
                warning: "#FBBF24",
                info: "#7DD3FC",
                question: "#C5FF41",
            }
            : {
                accent: "#4B7B5B",
                error: "#B91C1C",
                warning: "#B45309",
                info: "#1D4ED8",
                question: "#4B7B5B",
            };
    }

    window.getLkSwalThemePalette = getLkSwalThemePalette;

    if (typeof Swal === "undefined") return;

    function getSwalConfig() {
        var palette = getLkSwalThemePalette();
        var isDark = isLkDarkTheme();
        var base = isDark
            ? {
                customClass: { popup: "swal-lk-theme", confirmButton: "swal-lk-btn-confirm" },
                background: "#191919",
                color: "#ECEEF2",
                confirmButtonColor: palette.accent,
                confirmButtonText: "OK",
                timer: 5000,
                timerProgressBar: true,
                backdrop: "rgba(0,0,0,0.75)",
            }
            : {
                customClass: { popup: "swal-lk-theme swal-lk-theme-light", confirmButton: "swal-lk-btn-confirm" },
                background: "#FFFFFF",
                color: "#1F2937",
                confirmButtonColor: palette.accent,
                confirmButtonText: "OK",
                timer: 5000,
                timerProgressBar: true,
                backdrop: "rgba(0,0,0,0.4)",
            };
        base.heightAuto = false;
        base.scrollbarPadding = false;
        base.didOpen = function () {
            scheduleSyncLkSwalPopupTheme();
        };
        return base;
    }

    window.getLkSwalBaseConfig = getSwalConfig;

    function showSuccess(text) {
        var palette = getLkSwalThemePalette();
        var cfg = getSwalConfig();
        Swal.fire({
            ...cfg,
            icon: "success",
            title: "Готово",
            text: text,
            iconColor: palette.accent,
        });
    }

    function showError(text) {
        var palette = getLkSwalThemePalette();
        Swal.fire({
            ...getSwalConfig(),
            icon: "error",
            title: "Ошибка",
            text: text,
            iconColor: palette.error,
        });
    }

    function showWarning(text) {
        var palette = getLkSwalThemePalette();
        Swal.fire({
            ...getSwalConfig(),
            icon: "warning",
            title: "Внимание",
            text: text,
            iconColor: palette.warning,
        });
    }

    function showInfo(text) {
        var palette = getLkSwalThemePalette();
        Swal.fire({
            ...getSwalConfig(),
            icon: "info",
            title: "Информация",
            text: text,
            iconColor: palette.info,
        });
    }

    window.swalLk = {
        success: showSuccess,
        error: showError,
        warning: showWarning,
        info: showInfo,
        confirm: function(text, title) {
            var palette = getLkSwalThemePalette();
            var cfg = getSwalConfig();
            return Swal.fire({
                ...cfg,
                icon: "question",
                iconColor: palette.question,
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
