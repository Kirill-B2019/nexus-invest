/**
 * Обратный отсчёт до публичного запуска (главная, блок hero).
 * Целевая дата: data-deadline (ISO-8601).
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

    var units = ['days', 'hours', 'minutes', 'seconds'];
    var els = {};
    units.forEach(function (u) {
        var el = root.querySelector('[data-unit="' + u + '"]');
        if (el) {
            els[u] = el;
        }
    });

    function pad2(n) {
        return String(n).padStart(2, '0');
    }

    function padDays(n) {
        // Не меньше 2 символов; до 99 без ведущего нуля в сотнях — ширина держится CSS
        return n < 100 ? String(n).padStart(2, '0') : String(n);
    }

    function tick() {
        var ms = deadline.getTime() - Date.now();
        if (ms <= 0) {
            if (els.days) {
                els.days.textContent = padDays(0);
            }
            if (els.hours) {
                els.hours.textContent = '00';
            }
            if (els.minutes) {
                els.minutes.textContent = '00';
            }
            if (els.seconds) {
                els.seconds.textContent = '00';
            }
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
            els.days.textContent = days > 999 ? String(days) : padDays(days);
        }
        if (els.hours) {
            els.hours.textContent = pad2(hours);
        }
        if (els.minutes) {
            els.minutes.textContent = pad2(minutes);
        }
        if (els.seconds) {
            els.seconds.textContent = pad2(seconds);
        }
    }

    tick();
    setInterval(tick, 1000);
})();
