/**
 * Статус кросс-узла нод блокчейна ГАНИМЕД (футер публичной части).
 * Запрос к /api/ganimed/health, отображение ОК/False и кнопка «Проверить».
 */
(function () {
    "use strict";

    var statusUrl = document.getElementById("ganimed-node-status")?.getAttribute("data-status-url");
    if (!statusUrl) return;

    var loadingEl = document.getElementById("ganimed-status-loading");
    var resultEl = document.getElementById("ganimed-status-result");
    var checkboxEl = document.getElementById("ganimed-status-checkbox");
    var textEl = document.getElementById("ganimed-status-text");
    var refreshBtn = document.getElementById("ganimed-status-refresh");

    function render(ok) {
        loadingEl.classList.add("d-none");
        resultEl.classList.remove("d-none");
        checkboxEl.className = "ganimed-status-checkbox " + (ok ? "ganimed-status-ok" : "ganimed-status-fail");
        textEl.textContent = ok ? "Активен" : "Ошибка";
    }

    function setLoading() {
        loadingEl.classList.remove("d-none");
        resultEl.classList.add("d-none");
        if (refreshBtn) refreshBtn.disabled = true;
    }

    function setLoaded() {
        if (refreshBtn) refreshBtn.disabled = false;
    }

    function fetchStatus(refresh) {
        var url = refresh ? statusUrl + "?refresh=1" : statusUrl;
        setLoading();
        fetch(url, {
            headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
        })
            .then(function (r) {
                return r.json();
            })
            .then(function (data) {
                render(data.ok === true);
                setLoaded();
            })
            .catch(function () {
                render(false);
                setLoaded();
            });
    }

    fetchStatus(false);
    if (refreshBtn) refreshBtn.addEventListener("click", function () { fetchStatus(true); });
})();
