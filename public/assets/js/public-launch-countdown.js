/**
 * Обратный отсчёт до публичного запуска (главная, блок hero).
 * Целевая дата: data-deadline (ISO-8601).
 * Цифры рендерятся по слотам фиксированной ширины — без смещения вёрстки.
 */
(function () {
    'use strict';

    var root = document.querySelector('[data-public-launch-countdown]');
    if (!root) {
        return;
    }

    var raw = root.getAttribute('data-deadline');
    if (!raw) {
        return;
    }

    var deadline = new Date(raw);
    if (Number.isNaN(deadline.getTime())) {
        return;
    }

    var places = {
        days: 3,
        hours: 2,
        minutes: 2,
        seconds: 2
    };

    var els = {};
    Object.keys(places).forEach(function (u) {
        var el = root.querySelector('[data-unit="' + u + '"]');
        if (el) {
            els[u] = el;
        }
    });

    function renderUnit(el, value, size, hideLeadingZeros) {
        var n = Math.max(0, value | 0);
        var s = String(n);
        if (s.length < size) {
            s = s.padStart(size, '0');
        }
        if (s.length > size) {
            s = s.slice(s.length - size);
        }

        var digits = el.querySelectorAll('.public-launch-countdown__digit');
        if (digits.length !== size) {
            var html = '';
            for (var i = 0; i < size; i++) {
                html += '<span class="public-launch-countdown__digit">' + s.charAt(i) + '</span>';
            }
            el.innerHTML = html;
            digits = el.querySelectorAll('.public-launch-countdown__digit');
        }

        var seen = !hideLeadingZeros;
        for (var j = 0; j < size; j++) {
            var ch = s.charAt(j);
            var isPad = false;
            if (hideLeadingZeros && !seen) {
                if (ch === '0' && j < size - 1) {
                    isPad = true;
                } else {
                    seen = true;
                }
            }
            digits[j].textContent = ch;
            digits[j].classList.toggle('is-pad', isPad);
        }
        el.setAttribute('aria-label', String(n));
    }

    function tick() {
        var ms = deadline.getTime() - Date.now();
        if (ms <= 0) {
            renderUnit(els.days, 0, places.days, true);
            renderUnit(els.hours, 0, places.hours, false);
            renderUnit(els.minutes, 0, places.minutes, false);
            renderUnit(els.seconds, 0, places.seconds, false);
            return;
        }

        var totalSec = Math.floor(ms / 1000);
        var days = Math.floor(totalSec / 86400);
        var rem = totalSec % 86400;
        var hours = Math.floor(rem / 3600);
        rem %= 3600;
        var minutes = Math.floor(rem / 60);
        var seconds = rem % 60;

        if (els.days) {
            renderUnit(els.days, days, places.days, true);
        }
        if (els.hours) {
            renderUnit(els.hours, hours, places.hours, false);
        }
        if (els.minutes) {
            renderUnit(els.minutes, minutes, places.minutes, false);
        }
        if (els.seconds) {
            renderUnit(els.seconds, seconds, places.seconds, false);
        }
    }

    tick();
    setInterval(tick, 1000);
})();
