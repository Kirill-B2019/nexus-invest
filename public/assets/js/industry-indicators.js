/**
 * Публичные виджеты отраслевых индикаторов ЦФА/RWA.
 * Загрузка JSON с /api/indicators/*, отрисовка без сторонних chart-библиотек.
 */
(function () {
    "use strict";

    var widgets = document.querySelectorAll(
        "[data-endpoint].ind-widget, [data-endpoint].ind-panel, [data-endpoint].ind-trio__item, [data-endpoint].ind-duo__item, [data-endpoint].ind-board__item"
    );
    if (!widgets.length) return;

    var apiHost =
        document.querySelector("[data-api-base]") ||
        document.getElementById("industry-indicators-board") ||
        document.getElementById("industry-indicators-grid") ||
        document.getElementById("industry-indicators-grid-rest") ||
        document.getElementById("home-indicators-board");

    var apiBase =
        (apiHost && apiHost.getAttribute("data-api-base")) || "/api/indicators";

    function esc(str) {
        return String(str == null ? "" : str)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;");
    }

    function formatDate(iso) {
        if (!iso) return "";
        var d = new Date(iso);
        if (isNaN(d.getTime())) return "";
        var dd = String(d.getDate()).padStart(2, "0");
        var mm = String(d.getMonth() + 1).padStart(2, "0");
        var yyyy = d.getFullYear();
        return dd + "." + mm + "." + yyyy;
    }

    function pct(value, digits) {
        if (value == null || isNaN(value)) return "—";
        return (Number(value) * 100).toFixed(digits == null ? 1 : digits) + "%";
    }

    function num(value, digits) {
        if (value == null || isNaN(value)) return "—";
        return Number(value).toFixed(digits == null ? 1 : digits);
    }

    function trendHtml(trend) {
        if (trend === "up") return '<span class="ind-trend-up" aria-label="рост">↑</span>';
        if (trend === "down") return '<span class="ind-trend-down" aria-label="снижение">↓</span>';
        return '<span class="ind-trend-stable" aria-label="стабильно">→</span>';
    }

    function setMeta(widget, data) {
        var updated = widget.querySelector('[data-role="updated"]');
        var explain = widget.querySelector('[data-role="explain"]');
        var sources = widget.querySelector('[data-role="sources"]');

        if (updated) {
            updated.textContent = data.last_updated_at
                ? "Обновлено: " + formatDate(data.last_updated_at)
                : "";
        }
        if (explain) {
            explain.textContent = data.explanation || "";
        }
        if (sources) {
            var names = (data.sources || [])
                .map(function (s) {
                    return s.name;
                })
                .filter(Boolean);
            sources.textContent = names.length ? "Источники: " + names.join(", ") + "." : "";
        }
    }

    function showError(widget, message) {
        var body = widget.querySelector('[data-role="body"]');
        if (!body) return;
        body.innerHTML =
            '<div class="ind-widget__error" role="status">' +
            esc(message || "Данные временно недоступны") +
            "</div>";
        setMeta(widget, { explanation: "", sources: [], last_updated_at: null });
    }

    function renderTemperature(widget, data) {
        var idx = data.cfa_temp_index;
        var interp = data.interpretation || "neutral";
        var fillW = Math.max(4, Math.min(100, Number(idx) || 0));
        var comps = data.components || {};
        var labels = {
            placement: "Размещения",
            secondary: "Вторичка",
            quality: "Качество",
            users: "Пользователи",
        };

        var mini = Object.keys(labels)
            .map(function (key) {
                var c = comps[key] || {};
                var valLabel =
                    key === "placement" || key === "users"
                        ? c.value == null
                            ? "—"
                            : (c.value * 100).toFixed(1) + "%"
                        : pct(c.value, 1);
                return (
                    '<div class="ind-mini-card">' +
                    '<div class="ind-mini-card__name">' +
                    esc(labels[key]) +
                    "</div>" +
                    '<div class="ind-mini-card__val">' +
                    esc(num(c.norm, 0)) +
                    " " +
                    trendHtml(c.trend) +
                    "</div>" +
                    '<div class="ind-mini-card__meta">' +
                    esc(valLabel) +
                    "</div>" +
                    "</div>"
                );
            })
            .join("");

        widget.querySelector('[data-role="body"]').innerHTML =
            '<div class="ind-temp" role="img" aria-label="Температура рынка ЦФА: ' +
            esc(String(idx)) +
            ", " +
            esc(data.interpretation_label || "") +
            '">' +
            '<div class="ind-temp__value">' +
            '<div class="ind-temp__value-num">' +
            esc(num(idx, 0)) +
            "</div>" +
            '<span class="ind-temp__value-label is-' +
            esc(interp) +
            '">' +
            esc(data.interpretation_label || "") +
            "</span>" +
            "</div>" +
            '<div class="ind-temp__scale-wrap">' +
            '<div class="ind-temp__scale-labels">' +
            "<span>Охлаждение</span><span>Нейтрально</span><span>Перегрев</span>" +
            "</div>" +
            '<div class="ind-temp__scale">' +
            '<div class="ind-temp__scale-fill" style="width:' +
            fillW +
            '%"></div>' +
            '<div class="ind-temp__scale-marker is-' +
            esc(interp) +
            '" style="left:' +
            fillW +
            '%"></div>' +
            "</div>" +
            '<div class="ind-temp__scale-ticks"><span>0</span><span>35</span><span>65</span><span>100</span></div>' +
            "</div>" +
            "</div>" +
            '<div class="ind-mini-grid">' +
            mini +
            "</div>";

        setMeta(widget, data);
    }

    function renderRwaVsDefi(widget, data) {
        var quarters = data.quarters || [];
        var maxVal = 1;
        quarters.forEach(function (q) {
            maxVal = Math.max(maxVal, q.rwa_deposits_b || 0, q.defi_deposits_b || 0);
        });

        var bars = quarters
            .map(function (q) {
                var hRwa = Math.round(((q.rwa_deposits_b || 0) / maxVal) * 100);
                var hDefi = Math.round(((q.defi_deposits_b || 0) / maxVal) * 100);
                return (
                    '<div class="ind-bars__group">' +
                    '<div class="ind-bars__cols">' +
                    '<div class="ind-bars__col ind-bars__col--rwa" style="height:' +
                    hRwa +
                    '%" title="RWA: $' +
                    esc(num(q.rwa_deposits_b, 1)) +
                    ' млрд"></div>' +
                    '<div class="ind-bars__col ind-bars__col--defi" style="height:' +
                    hDefi +
                    '%" title="DeFi: $' +
                    esc(num(q.defi_deposits_b, 1)) +
                    ' млрд"></div>' +
                    "</div>" +
                    '<div class="ind-bars__label">' +
                    esc(q.quarter) +
                    "<br>доля RWA " +
                    esc(pct(q.rwa_deposit_share, 1)) +
                    "</div>" +
                    "</div>"
                );
            })
            .join("");

        var rwaYoy = data.rwa_spot_volume_yoy_pct;
        var dexYoy = data.dex_total_volume_yoy_pct;

        widget.querySelector('[data-role="body"]').innerHTML =
            '<div class="ind-legend">' +
            '<span class="ind-legend__rwa">Депозиты RWA</span>' +
            '<span class="ind-legend__defi">Депозиты DeFi</span>' +
            "</div>" +
            '<div class="ind-bars" role="img" aria-label="Сравнение депозитов RWA и DeFi по кварталам">' +
            bars +
            "</div>" +
            '<div class="ind-stat-row mt-3">' +
            '<div class="ind-stat-card">' +
            '<div class="ind-stat-card__label">RWA спот объём г/г</div>' +
            '<div class="ind-stat-card__value ' +
            (rwaYoy >= 0 ? "ind-trend-up" : "ind-trend-down") +
            '">' +
            (rwaYoy == null ? "—" : (rwaYoy >= 0 ? "+" : "") + num(rwaYoy, 1) + "%") +
            "</div></div>" +
            '<div class="ind-stat-card">' +
            '<div class="ind-stat-card__label">Общий DEX объём г/г</div>' +
            '<div class="ind-stat-card__value ' +
            (dexYoy >= 0 ? "ind-trend-up" : "ind-trend-down") +
            '">' +
            (dexYoy == null ? "—" : (dexYoy >= 0 ? "+" : "") + num(dexYoy, 1) + "%") +
            "</div></div>" +
            "</div>";

        setMeta(widget, data);
    }

    function renderLiquidity(widget, data) {
        var interp = data.interpretation || "medium";
        var history = data.history || [];
        var maxShare = 0.1;
        history.forEach(function (h) {
            maxShare = Math.max(maxShare, h.secondary_share || 0);
        });

        var w = 320;
        var h = 72;
        var pad = 8;
        var points = history.map(function (item, i) {
            var x =
                history.length === 1
                    ? w / 2
                    : pad + (i / (history.length - 1)) * (w - pad * 2);
            var y = h - pad - ((item.secondary_share || 0) / maxShare) * (h - pad * 2);
            return x.toFixed(1) + "," + y.toFixed(1);
        });

        var spark =
            history.length > 0
                ? '<div class="ind-spark" aria-hidden="true"><svg viewBox="0 0 ' +
                  w +
                  " " +
                  h +
                  '" preserveAspectRatio="none">' +
                  '<polyline fill="none" stroke="#C5FF41" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" points="' +
                  points.join(" ") +
                  '"/></svg></div>'
                : "";

        widget.querySelector('[data-role="body"]').innerHTML =
            '<div class="ind-light">' +
            '<div class="ind-light__circle is-' +
            esc(interp) +
            '" role="img" aria-label="Ликвидность: ' +
            esc(data.interpretation_label || "") +
            '">' +
            esc(data.interpretation_label || "") +
            "</div>" +
            '<div class="ind-light__meta">' +
            spark +
            '<div class="ind-stat-card">' +
            '<div class="ind-stat-card__label">Доля вторички · индекс</div>' +
            '<div class="ind-stat-card__value">' +
            esc(pct(data.secondary_share, 1)) +
            " · " +
            esc(num(data.liquidity_index, 0)) +
            "</div></div>" +
            "</div>" +
            "</div>";

        setMeta(widget, data);
    }

    function renderRwaGlobal(widget, data) {
        var deltas = data.deltas_30d || {};
        var cards = [
            {
                label: "Распределённая стоимость RWA",
                value: "$" + num(data.rwa_distributed_value_b, 1) + " млрд",
                delta: deltas.rwa_distributed_value_pct,
            },
            {
                label: "Держатели RWA",
                value: num(data.rwa_holders_m, 1) + " млн",
                delta: deltas.rwa_holders_pct,
            },
            {
                label: "Дневной объём трансферов",
                value: "$" + num(data.daily_transfer_volume_b, 1) + " млрд",
                delta: deltas.daily_transfer_volume_pct,
            },
            {
                label: "Токенизированные казначейские",
                value: "$" + num(data.tokenized_treasuries_b, 2) + " млрд",
                delta: null,
            },
            {
                label: "Токенизированный частный кредит",
                value: "$" + num(data.tokenized_private_credit_b, 2) + " млрд",
                delta: null,
            },
            {
                label: "Спот‑объём RWA",
                value: "$" + num(data.rwa_spot_volume_b, 1) + " млрд",
                delta: null,
            },
        ];

        var metrics = cards
            .map(function (c) {
                var deltaHtml = "";
                if (c.delta != null) {
                    var cls = c.delta >= 0 ? "ind-trend-up" : "ind-trend-down";
                    var arrow = c.delta >= 0 ? "↑" : "↓";
                    deltaHtml =
                        '<div class="ind-metric__delta ' +
                        cls +
                        '">' +
                        arrow +
                        " " +
                        Math.abs(c.delta).toFixed(2) +
                        "% за 30д</div>";
                }
                return (
                    '<div class="ind-metric">' +
                    '<div class="ind-metric__label">' +
                    esc(c.label) +
                    "</div>" +
                    '<div class="ind-metric__value">' +
                    esc(c.value) +
                    "</div>" +
                    deltaHtml +
                    "</div>"
                );
            })
            .join("");

        var s = data.structure || {};
        var f = Number(s.funds_pct || 0);
        var c = Number(s.commodities_pct || 0);
        var st = Number(s.stocks_pct || 0);
        var pie =
            "conic-gradient(#C5FF41 0 " +
            f +
            "%, #52B8AA " +
            f +
            "% " +
            (f + c) +
            "%, #9B9C9F " +
            (f + c) +
            "% 100%)";

        widget.querySelector('[data-role="body"]').innerHTML =
            '<div class="ind-metric-grid">' +
            metrics +
            "</div>" +
            '<div class="ind-pie">' +
            '<div class="ind-pie__chart" style="background:' +
            pie +
            '" role="img" aria-label="Структура RWA"></div>' +
            '<ul class="ind-pie__legend">' +
            '<li><span><span class="ind-pie__dot" style="background:#C5FF41"></span>Фонды</span><strong>' +
            esc(num(f, 1)) +
            "%</strong></li>" +
            '<li><span><span class="ind-pie__dot" style="background:#52B8AA"></span>Товары</span><strong>' +
            esc(num(c, 1)) +
            "%</strong></li>" +
            '<li><span><span class="ind-pie__dot" style="background:#9B9C9F"></span>Акции</span><strong>' +
            esc(num(st, 1)) +
            "%</strong></li>" +
            "</ul></div>";

        setMeta(widget, data);
    }

    function renderSmeCost(widget, data) {
        var loan = Number(data.sme_loan_rate_pct || 0);
        var cfa = Number(data.cfa_yield_nexus_pct || 0);
        var max = Math.max(loan, cfa, 1);
        var hLoan = Math.round((loan / max) * 140);
        var hCfa = Math.round((cfa / max) * 140);
        var spread = data.spread_sme_pct;
        var save =
            spread != null && spread > 0
                ? '<div class="ind-sme-save">Экономия для бизнеса: ' +
                  esc(num(spread, 1)) +
                  " п.п.</div>"
                : '<div class="ind-stat-card text-center">Спрэд: ' +
                  esc(num(spread, 1)) +
                  " п.п.</div>";

        widget.querySelector('[data-role="body"]').innerHTML =
            '<div class="ind-sme-bars" role="img" aria-label="Сравнение ставок SME и ЦФА НЕКСУС">' +
            '<div class="ind-sme-bar">' +
            '<div class="ind-sme-bar__pct">' +
            esc(num(loan, 1)) +
            "%</div>" +
            '<div class="ind-sme-bar__fill ind-sme-bar__fill--loan" style="height:' +
            hLoan +
            'px"></div>' +
            '<div class="ind-sme-bar__name">Средняя ставка<br>по кредитам SME</div>' +
            "</div>" +
            '<div class="ind-sme-bar">' +
            '<div class="ind-sme-bar__pct">' +
            esc(num(cfa, 1)) +
            "%</div>" +
            '<div class="ind-sme-bar__fill ind-sme-bar__fill--cfa" style="height:' +
            hCfa +
            'px"></div>' +
            '<div class="ind-sme-bar__name">Доходность ЦФА<br>НЕКСУС</div>' +
            "</div>" +
            "</div>" +
            save;

        setMeta(widget, data);
    }

    function riskLevelRadius(level) {
        if (level === "high") return 1;
        if (level === "medium") return 0.62;
        return 0.28;
    }

    function riskShortLabel(name) {
        var map = {
            credit: "Кредит",
            liquidity: "Ликвидн.",
            no_asv: "АСВ",
            structural: "Структура",
            collateral: "Обеспеч.",
            tech: "Технолог.",
            legal_transition: "Правовой",
            tax: "Налог",
            concentration: "Концентр.",
            fraud: "Мошенн.",
        };
        if (name && map[name]) return map[name];
        var raw = String(name || "");
        return raw.length > 12 ? raw.slice(0, 11) + "…" : raw;
    }

    function renderRiskMap(widget, data) {
        var risks = data.risks || [];
        if (!risks.length) {
            showError(widget, "Данные временно недоступны");
            return;
        }

        var size = 420;
        var cx = size / 2;
        var cy = size / 2;
        var maxR = 132;
        var n = risks.length;
        var rings = [0.28, 0.62, 1];

        function pointAt(i, radiusFactor) {
            var angle = -Math.PI / 2 + (2 * Math.PI * i) / n;
            return {
                x: cx + maxR * radiusFactor * Math.cos(angle),
                y: cy + maxR * radiusFactor * Math.sin(angle),
                angle: angle,
            };
        }

        var ringPolys = rings
            .map(function (rf) {
                var pts = [];
                for (var i = 0; i < n; i++) {
                    var p = pointAt(i, rf);
                    pts.push(p.x.toFixed(1) + "," + p.y.toFixed(1));
                }
                return (
                    '<polygon class="ind-radar__ring" points="' +
                    pts.join(" ") +
                    '" />'
                );
            })
            .join("");

        var axes = "";
        var labels = "";
        var dataPts = [];
        for (var i = 0; i < n; i++) {
            var edge = pointAt(i, 1);
            var tip = pointAt(i, 1.22);
            var r = risks[i];
            var rf = riskLevelRadius(r.level);
            var dp = pointAt(i, rf);
            dataPts.push(dp.x.toFixed(1) + "," + dp.y.toFixed(1));

            axes +=
                '<line class="ind-radar__axis" x1="' +
                cx +
                '" y1="' +
                cy +
                '" x2="' +
                edge.x.toFixed(1) +
                '" y2="' +
                edge.y.toFixed(1) +
                '" />';

            var anchor =
                Math.abs(Math.cos(tip.angle)) < 0.25
                    ? "middle"
                    : tip.x >= cx
                      ? "start"
                      : "end";

            labels +=
                '<text class="ind-radar__label" data-risk-idx="' +
                i +
                '" x="' +
                tip.x.toFixed(1) +
                '" y="' +
                tip.y.toFixed(1) +
                '" text-anchor="' +
                anchor +
                '" dominant-baseline="middle">' +
                esc(riskShortLabel(r.id || r.name)) +
                "</text>";
        }

        var dots = risks
            .map(function (r, idx) {
                var p = pointAt(idx, riskLevelRadius(r.level));
                return (
                    '<circle class="ind-radar__dot is-' +
                    esc(r.level) +
                    '" data-risk-idx="' +
                    idx +
                    '" cx="' +
                    p.x.toFixed(1) +
                    '" cy="' +
                    p.y.toFixed(1) +
                    '" r="6" tabindex="0" role="button" aria-label="' +
                    esc(r.name) +
                    ": " +
                    esc(r.level_label || r.level) +
                    '" />'
                );
            })
            .join("");

        var legend = risks
            .map(function (r, idx) {
                return (
                    '<button type="button" class="ind-radar__legend-item is-' +
                    esc(r.level) +
                    '" data-risk-idx="' +
                    idx +
                    '">' +
                    '<span class="ind-radar__legend-dot is-' +
                    esc(r.level) +
                    '"></span>' +
                    '<span class="ind-radar__legend-name">' +
                    esc(r.name) +
                    "</span>" +
                    '<span class="ind-risk-level is-' +
                    esc(r.level) +
                    '">' +
                    esc(r.level_label || r.level) +
                    "</span>" +
                    "</button>"
                );
            })
            .join("");

        widget.querySelector('[data-role="body"]').innerHTML =
            '<div class="ind-radar">' +
            '<div class="ind-radar__chart-wrap">' +
            '<svg class="ind-radar__svg" viewBox="0 0 ' +
            size +
            " " +
            size +
            '" role="img" aria-label="Радарная диаграмма рисков ЦФА">' +
            '<g class="ind-radar__grid">' +
            ringPolys +
            axes +
            "</g>" +
            '<polygon class="ind-radar__area" points="' +
            dataPts.join(" ") +
            '" />' +
            '<polyline class="ind-radar__outline" fill="none" points="' +
            dataPts.join(" ") +
            " " +
            dataPts[0] +
            '" />' +
            labels +
            dots +
            "</svg>" +
            '<div class="ind-radar__tooltip" hidden data-role="radar-tooltip"></div>' +
            "</div>" +
            '<div class="ind-radar__legend" aria-label="Список рисков">' +
            legend +
            "</div>" +
            '<div class="ind-radar__scale text-sm">' +
            '<span><i class="ind-radar__scale-swatch is-low"></i>Низкий</span>' +
            '<span><i class="ind-radar__scale-swatch is-medium"></i>Средний</span>' +
            '<span><i class="ind-radar__scale-swatch is-high"></i>Высокий</span>' +
            "</div>" +
            "</div>";

        setMeta(widget, data);
        bindRiskRadar(widget, risks);
    }

    function bindRiskRadar(widget, risks) {
        var root = widget.querySelector(".ind-radar");
        var tip = widget.querySelector('[data-role="radar-tooltip"]');
        var wrap = widget.querySelector(".ind-radar__chart-wrap");
        if (!root || !tip || !wrap) return;

        function showTip(idx, clientX, clientY) {
            var r = risks[idx];
            if (!r) return;
            tip.hidden = false;
            tip.innerHTML =
                "<strong>" +
                esc(r.name) +
                '</strong><span class="ind-risk-level is-' +
                esc(r.level) +
                '">' +
                esc(r.level_label || r.level) +
                "</span>" +
                '<p class="ind-radar__tooltip-m">' +
                esc(r.manifestation || "") +
                "</p>" +
                '<p class="ind-radar__tooltip-c">' +
                esc(r.control || "") +
                "</p>";

            var rect = wrap.getBoundingClientRect();
            var x = clientX - rect.left + 12;
            var y = clientY - rect.top + 12;
            var maxX = rect.width - tip.offsetWidth - 8;
            var maxY = rect.height - tip.offsetHeight - 8;
            tip.style.left = Math.max(8, Math.min(x, maxX)) + "px";
            tip.style.top = Math.max(8, Math.min(y, maxY)) + "px";

            root.querySelectorAll(".ind-radar__dot, .ind-radar__legend-item, .ind-radar__label").forEach(function (el) {
                el.classList.toggle("is-active", String(el.getAttribute("data-risk-idx")) === String(idx));
            });
        }

        function hideTip() {
            tip.hidden = true;
            root.querySelectorAll(".is-active").forEach(function (el) {
                el.classList.remove("is-active");
            });
        }

        root.querySelectorAll("[data-risk-idx]").forEach(function (el) {
            el.addEventListener("mouseenter", function (e) {
                showTip(Number(el.getAttribute("data-risk-idx")), e.clientX, e.clientY);
            });
            el.addEventListener("mousemove", function (e) {
                showTip(Number(el.getAttribute("data-risk-idx")), e.clientX, e.clientY);
            });
            el.addEventListener("mouseleave", hideTip);
            el.addEventListener("focus", function () {
                var box = el.getBoundingClientRect();
                showTip(Number(el.getAttribute("data-risk-idx")), box.left + box.width / 2, box.top);
            });
            el.addEventListener("blur", hideTip);
            if (el.tagName === "BUTTON") {
                el.addEventListener("click", function (e) {
                    var box = el.getBoundingClientRect();
                    showTip(Number(el.getAttribute("data-risk-idx")), box.left + box.width / 2, box.top);
                    e.preventDefault();
                });
            }
        });
    }

    var renderers = {
        "cfa-temperature": renderTemperature,
        "rwa-vs-defi": renderRwaVsDefi,
        "liquidity-light": renderLiquidity,
        "rwa-global": renderRwaGlobal,
        "sme-cost": renderSmeCost,
        "risk-map": renderRiskMap,
    };

    function loadWidget(widget) {
        var endpoint = widget.getAttribute("data-endpoint");
        if (!endpoint || !renderers[endpoint] || widget.getAttribute("data-loaded") === "1") return;
        widget.setAttribute("data-loaded", "1");

        fetch(apiBase + "/" + endpoint, {
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            credentials: "same-origin",
        })
            .then(function (res) {
                if (!res.ok) throw new Error("HTTP " + res.status);
                return res.json();
            })
            .then(function (data) {
                if (!data || data.ok === false) {
                    showError(widget, (data && data.message) || "Данные временно недоступны");
                    return;
                }
                renderers[endpoint](widget, data);
            })
            .catch(function () {
                showError(widget, "Данные временно недоступны");
            });
    }

    function startLoading() {
        // Один пакетный запрос вместо 5 отдельных
        var boardRoot = document.querySelector(".ind-board");
        if (boardRoot) {
            fetch(apiBase + "/board", {
                headers: {
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                credentials: "same-origin",
            })
                .then(function (res) {
                    if (!res.ok) throw new Error("HTTP " + res.status);
                    return res.json();
                })
                .then(function (bundle) {
                    if (!bundle || bundle.ok === false) {
                        widgets.forEach(function (w) {
                            showError(w, "Данные временно недоступны");
                        });
                        return;
                    }
                    widgets.forEach(function (widget) {
                        var endpoint = widget.getAttribute("data-endpoint");
                        if (!endpoint || !renderers[endpoint]) return;
                        widget.setAttribute("data-loaded", "1");
                        var data = bundle[endpoint];
                        if (!data || data.ok === false) {
                            showError(widget, (data && data.message) || "Данные временно недоступны");
                            return;
                        }
                        renderers[endpoint](widget, data);
                    });
                })
                .catch(function () {
                    // Fallback: по одному эндпоинту
                    widgets.forEach(loadWidget);
                });
            return;
        }

        widgets.forEach(loadWidget);
    }

    // Ленивый старт: грузим только когда секция близко к viewport
    var section =
        document.getElementById("industry-indicators-board-section") ||
        document.getElementById("industry-indicators-home");

    if (section && "IntersectionObserver" in window) {
        var io = new IntersectionObserver(
            function (entries) {
                for (var i = 0; i < entries.length; i++) {
                    if (entries[i].isIntersecting) {
                        io.disconnect();
                        startLoading();
                        break;
                    }
                }
            },
            { rootMargin: "240px 0px", threshold: 0.01 }
        );
        io.observe(section);
    } else {
        startLoading();
    }
})();
