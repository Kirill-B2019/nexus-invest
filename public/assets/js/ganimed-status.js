/**
 * Статус блокчейна ГАНИМЕД по block/latest (футер публичной части).
 * Запрос к /api/ganimed/block, отображение статуса узла и данных последнего блока.
 */
(function () {
    "use strict";

    var statusUrl = document.getElementById("ganimed-node-status")?.getAttribute("data-status-url");
    if (!statusUrl) return;

    var loadingEl = document.getElementById("ganimed-status-loading");
    var resultEl = document.getElementById("ganimed-status-result");
    var checkboxEl = document.getElementById("ganimed-status-checkbox");
    var textEl = document.getElementById("ganimed-status-text");
    var subtitleEl = document.getElementById("ganimed-status-subtitle");
    var refreshBtn = document.getElementById("ganimed-status-refresh");
    var blockDetailsEl = document.getElementById("ganimed-block-details");
    var blockHeightEl = document.getElementById("ganimed-block-height");
    var blockHashEl = document.getElementById("ganimed-block-hash");
    var blockMerkleEl = document.getElementById("ganimed-block-merkle");
    var blockMinerEl = document.getElementById("ganimed-block-miner");
    var blockUpdatedEl = document.getElementById("ganimed-block-updated");
    var blockFinalizedEl = document.getElementById("ganimed-block-finalized");
    var nexusAiStatusEl = document.getElementById("nexus-ai-node-status");
    var nexusAiStatusUrl = nexusAiStatusEl?.getAttribute("data-status-url");
    var nexusAiLoadingEl = document.getElementById("nexus-ai-status-loading");
    var nexusAiResultEl = document.getElementById("nexus-ai-status-result");
    var nexusAiIndicatorEl = document.getElementById("nexus-ai-status-indicator");
    var nexusAiTextEl = document.getElementById("nexus-ai-status-text");
    var nexusAiCheckedEl = document.getElementById("nexus-ai-status-checked");
    var nexusAiRefreshBtn = document.getElementById("nexus-ai-status-refresh");

    function shortHash(value) {
        if (!value || value === "—") return "—";
        var s = String(value);
        if (s.length <= 18) return s;
        return s.slice(0, 6) + "..." + s.slice(-8);
    }

    function formatHeight(value) {
        var n = Number(value);
        if (!Number.isFinite(n)) return value || "—";
        return n.toLocaleString("ru-RU");
    }

    function relativeTime(unixTs, fallback) {
        if (!unixTs) return fallback || "—";
        var diffSec = Math.max(0, Math.round(Date.now() / 1000 - Number(unixTs)));
        if (diffSec < 60) return diffSec + " сек. назад";
        if (diffSec < 3600) return Math.floor(diffSec / 60) + " мин. назад";
        if (diffSec < 86400) return Math.floor(diffSec / 3600) + " ч. назад";
        return fallback || Math.floor(diffSec / 86400) + " дн. назад";
    }

    function renderStatus(ok) {
        loadingEl.classList.add("d-none");
        resultEl.classList.remove("d-none");
        checkboxEl.className = "ganimed-status-checkbox " + (ok ? "ganimed-status-ok" : "ganimed-status-fail");
        textEl.textContent = ok ? "Узел доступен" : "Узел недоступен";
        textEl.classList.toggle("is-fail", !ok);
        if (subtitleEl) {
            subtitleEl.textContent = ok
                ? "Сеть работает в штатном режиме"
                : "Нет ответа от мастер-ноды";
        }
    }

    function renderBlockDetails(block) {
        if (!blockDetailsEl || !block) {
            if (blockDetailsEl) blockDetailsEl.classList.add("d-none");
            return;
        }
        blockDetailsEl.classList.remove("d-none");
        if (blockHeightEl) blockHeightEl.textContent = formatHeight(block.height);
        if (blockHashEl) blockHashEl.textContent = shortHash(block.hash);
        if (blockMerkleEl) blockMerkleEl.textContent = shortHash(block.merkleRoot);
        if (blockMinerEl) blockMinerEl.textContent = block.miner || "—";
        if (blockUpdatedEl) blockUpdatedEl.textContent = block.updatedAt || "—";
        if (blockFinalizedEl) {
            if (block.isFinalized) {
                blockFinalizedEl.textContent = relativeTime(block.updatedAtUnix, block.updatedAt || "да");
            } else {
                blockFinalizedEl.textContent = "нет";
            }
        }
    }

    function setLoading() {
        loadingEl.classList.remove("d-none");
        resultEl.classList.add("d-none");
        if (blockDetailsEl) blockDetailsEl.classList.add("d-none");
        if (refreshBtn) refreshBtn.disabled = true;
    }

    function setLoaded() {
        if (refreshBtn) refreshBtn.disabled = false;
    }

    function fetchNexusAiStatus(refresh) {
        if (!nexusAiStatusUrl) return;
        var url = refresh ? nexusAiStatusUrl + "?refresh=1" : nexusAiStatusUrl;
        if (nexusAiLoadingEl) nexusAiLoadingEl.classList.remove("d-none");
        if (nexusAiResultEl) nexusAiResultEl.classList.add("d-none");
        if (nexusAiRefreshBtn) nexusAiRefreshBtn.disabled = true;

        fetch(url, {
            headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                var ok = data.ok === true;
                if (nexusAiLoadingEl) nexusAiLoadingEl.classList.add("d-none");
                if (nexusAiResultEl) nexusAiResultEl.classList.remove("d-none");
                if (nexusAiIndicatorEl) {
                    nexusAiIndicatorEl.className = "ganimed-status-checkbox " + (ok ? "ganimed-status-ok" : "ganimed-status-fail");
                }
                if (nexusAiTextEl) {
                    nexusAiTextEl.textContent = ok ? "Активен" : "Недоступен";
                    nexusAiTextEl.classList.toggle("is-fail", !ok);
                }
                if (nexusAiCheckedEl) {
                    nexusAiCheckedEl.textContent = data.checked_at ? "Проверено: " + data.checked_at : "";
                }
                if (nexusAiRefreshBtn) nexusAiRefreshBtn.disabled = false;
            })
            .catch(function () {
                if (nexusAiLoadingEl) nexusAiLoadingEl.classList.add("d-none");
                if (nexusAiResultEl) nexusAiResultEl.classList.remove("d-none");
                if (nexusAiIndicatorEl) nexusAiIndicatorEl.className = "ganimed-status-checkbox ganimed-status-fail";
                if (nexusAiTextEl) {
                    nexusAiTextEl.textContent = "Недоступен";
                    nexusAiTextEl.classList.add("is-fail");
                }
                if (nexusAiCheckedEl) nexusAiCheckedEl.textContent = "";
                if (nexusAiRefreshBtn) nexusAiRefreshBtn.disabled = false;
            });
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
                var ok = data.ok === true;
                renderStatus(ok);
                renderBlockDetails(data.block || null);
                setLoaded();
            })
            .catch(function () {
                renderStatus(false);
                renderBlockDetails(null);
                setLoaded();
            });
    }

    fetchStatus(false);
    if (refreshBtn) refreshBtn.addEventListener("click", function () { fetchStatus(true); });
    fetchNexusAiStatus(false);
    if (nexusAiRefreshBtn) nexusAiRefreshBtn.addEventListener("click", function () { fetchNexusAiStatus(true); });
})();
