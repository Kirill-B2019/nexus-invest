/**
 * Переключатель вида ленты новостей (блоки / список) с сохранением в cookie.
 */
(function () {
    "use strict";

    var COOKIE_NAME = "news_view";
    var COOKIE_DAYS = 365;
    var MODES = ["blocks", "list"];

    function getCookie(name) {
        var match = document.cookie.match(
            new RegExp("(?:^|; )" + name.replace(/([.$?*|{}()[\]\\/+^])/g, "\\$1") + "=([^;]*)")
        );
        return match ? decodeURIComponent(match[1]) : null;
    }

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var d = new Date();
            d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
            expires = "; expires=" + d.toUTCString();
        }
        document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/; SameSite=Lax";
    }

    function normalizeMode(mode) {
        return MODES.indexOf(mode) !== -1 ? mode : "list";
    }

    function applyMode(feed, mode) {
        mode = normalizeMode(mode);
        feed.classList.remove("news-page-feed--blocks", "news-page-feed--list");
        feed.classList.add("news-page-feed--" + mode);
        feed.setAttribute("data-news-view", mode);

        var buttons = feed.querySelectorAll(".news-view-toggle__btn[data-news-view]");
        buttons.forEach(function (btn) {
            var active = btn.getAttribute("data-news-view") === mode;
            btn.classList.toggle("is-active", active);
            btn.setAttribute("aria-pressed", active ? "true" : "false");
        });
    }

    function init() {
        var feed = document.getElementById("news-feed");
        if (!feed) {
            return;
        }

        var fromCookie = normalizeMode(getCookie(COOKIE_NAME) || feed.getAttribute("data-news-view") || "list");
        applyMode(feed, fromCookie);

        feed.addEventListener("click", function (event) {
            var btn = event.target.closest(".news-view-toggle__btn[data-news-view]");
            if (!btn || !feed.contains(btn)) {
                return;
            }
            var mode = normalizeMode(btn.getAttribute("data-news-view"));
            applyMode(feed, mode);
            setCookie(COOKIE_NAME, mode, COOKIE_DAYS);
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
