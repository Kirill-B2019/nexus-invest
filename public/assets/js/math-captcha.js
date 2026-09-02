/**
 * Загрузка математической капчи в контейнер .math-captcha
 */
(function () {
    "use strict";

    function getCsrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute("content") || "" : "";
    }

    function loadCaptcha(container) {
        if (!container) {
            return Promise.resolve();
        }

        var questionEl = container.querySelector("[data-question-placeholder]");
        var tokenInput = container.querySelector("[data-captcha-token]");
        var answerInput = container.querySelector("[data-captcha-answer]");
        if (!questionEl || !tokenInput || !answerInput) {
            return Promise.resolve();
        }

        var endpoint = container.getAttribute("data-captcha-endpoint") || "/api/captcha/new";
        questionEl.textContent = container.getAttribute("data-loading-text") || "Загрузка...";
        tokenInput.value = "";
        answerInput.value = "";

        return fetch(endpoint, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": getCsrfToken(),
            },
            credentials: "same-origin",
            body: JSON.stringify({}),
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error("captcha http " + response.status);
                }
                return response.json();
            })
            .then(function (data) {
                questionEl.textContent = data.question || container.getAttribute("data-error-text") || "Ошибка загрузки капчи";
                tokenInput.value = data.token || "";
            })
            .catch(function () {
                questionEl.textContent = container.getAttribute("data-error-text") || "Ошибка загрузки капчи";
            });
    }

    window.NexusMathCaptcha = {
        load: loadCaptcha,
        loadAll: function (root) {
            var scope = root || document;
            var containers = scope.querySelectorAll("[data-math-captcha]");
            containers.forEach(function (container) {
                loadCaptcha(container);
            });
        },
    };

    document.addEventListener("DOMContentLoaded", function () {
        window.NexusMathCaptcha.loadAll();
    });
})();
