/**
 * Cookie consent banner
 * Показывает баннер, пока пользователь не сделает выбор.
 * Сохраняет cookie_consent=accepted|rejected на 6 месяцев.
 */
(function () {
    "use strict";

    var COOKIE_NAME = "cookie_consent";
    var COOKIE_DAYS = 180;

    function getCookie(name) {
        var match = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([.$?*|{}()[\]\\/+^])/g, "\\$1") + "=([^;]*)"));
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

    function hideBanner() {
        var banner = document.getElementById("cookie-banner");
        if (banner) {
            banner.classList.remove("is-visible");
            banner.setAttribute("aria-hidden", "true");
        }
    }

    function showBanner() {
        var banner = document.getElementById("cookie-banner");
        if (banner) {
            banner.classList.add("is-visible");
            banner.setAttribute("aria-hidden", "false");
        }
    }

    function handleChoice(value) {
        if (value === "accepted") {
            setCookie(COOKIE_NAME, value, COOKIE_DAYS);
            if (typeof window.onCookieConsentAccepted === "function") {
                window.onCookieConsentAccepted();
            }
        }
        // При отклонении cookie не сохраняем — баннер будет показываться при каждом обновлении
        hideBanner();
    }

    function init() {
        if (getCookie(COOKIE_NAME) === "accepted") {
            return;
        }
        showBanner();

        var banner = document.getElementById("cookie-banner");
        if (!banner) return;

        banner.addEventListener("click", function (e) {
            var btn = e.target.closest("[data-consent]");
            if (btn) {
                e.preventDefault();
                handleChoice(btn.getAttribute("data-consent"));
            }
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
