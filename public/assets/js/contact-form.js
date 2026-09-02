/**
 * Форма обратной связи: обновление CSRF и капчи при открытии модального окна.
 */
(function () {
    "use strict";

    function getCsrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute("content") || "" : "";
    }

    function setCsrfToken(token) {
        if (!token) {
            return;
        }

        var meta = document.querySelector('meta[name="csrf-token"]');
        if (meta) {
            meta.setAttribute("content", token);
        }

        var form = document.getElementById("contact-form");
        if (!form) {
            return;
        }

        var input = form.querySelector('input[name="_token"]');
        if (input) {
            input.value = token;
        }
    }

    function refreshCsrfToken() {
        return fetch("/api/csrf-token", {
            method: "GET",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            credentials: "same-origin",
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error("csrf http " + response.status);
                }
                return response.json();
            })
            .then(function (data) {
                setCsrfToken(data.token);
            });
    }

    function refreshContactForm() {
        var modal = document.getElementById("contactFormModal");
        if (!modal) {
            return;
        }

        refreshCsrfToken()
            .catch(function () {
                /* остаётся токен со страницы */
            })
            .finally(function () {
                if (window.NexusMathCaptcha && typeof window.NexusMathCaptcha.loadAll === "function") {
                    window.NexusMathCaptcha.loadAll(modal);
                }
            });
    }

    document.addEventListener("DOMContentLoaded", function () {
        var modal = document.getElementById("contactFormModal");
        if (!modal || typeof bootstrap === "undefined") {
            return;
        }

        modal.addEventListener("show.bs.modal", refreshContactForm);
    });
})();
