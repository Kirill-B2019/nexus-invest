/**
 * Статус блокчейна ГАНИМЕД по block/latest (футер публичной части).
 * Запрос к /api/ganimed/block, отображение активен/ошибка и данных последнего блока.
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
    var blockDetailsEl = document.getElementById("ganimed-block-details");
    var blockHeightEl = document.getElementById("ganimed-block-height");
    var blockHashEl = document.getElementById("ganimed-block-hash");
    var blockMerkleEl = document.getElementById("ganimed-block-merkle");
    var blockMinerEl = document.getElementById("ganimed-block-miner");
    var blockUpdatedEl = document.getElementById("ganimed-block-updated");
    var blockFinalizedEl = document.getElementById("ganimed-block-finalized");

    function renderStatus(ok) {
        loadingEl.classList.add("d-none");
        resultEl.classList.remove("d-none");
        checkboxEl.className = "ganimed-status-checkbox " + (ok ? "ganimed-status-ok" : "ganimed-status-fail");
        textEl.textContent = ok ? "Активен" : "Ошибка";
    }

    function renderBlockDetails(block) {
        if (!blockDetailsEl || !block) {
            if (blockDetailsEl) blockDetailsEl.classList.add("d-none");
            return;
        }
        blockDetailsEl.classList.remove("d-none");
        if (blockHeightEl) blockHeightEl.textContent = block.height;
        if (blockHashEl) blockHashEl.textContent = block.hash || "—";
        if (blockMerkleEl) blockMerkleEl.textContent = block.merkleRoot || "—";
        if (blockMinerEl) blockMinerEl.textContent = block.miner || "—";
        if (blockUpdatedEl) blockUpdatedEl.textContent = block.updatedAt || "—";
        if (blockFinalizedEl) {
            blockFinalizedEl.className = "ganimed-status-checkbox " + (block.isFinalized ? "ganimed-status-ok" : "ganimed-status-fail");
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
})();
