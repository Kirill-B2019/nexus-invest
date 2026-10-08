/*!
 * jquery.counterup.js 1.0
 *
 * Copyright 2013, Benjamin Intal http://gambit.ph @bfintal
 * Released under the GPL v2 License
 *
 * Date: Nov 26, 2024
 */
(function (e) {
    "use strict";
    e.fn.counterUp = function (t) {
        var n = e.extend(
            {
                time: 400,
                delay: 10
            },
            t
        );
        return this.each(function () {
            var t = e(this),
                r = n;
            if (t.data("counterup-active")) return;
            t.data("counterup-active", true);
            var i = function () {
                var e = [],
                    n = r.time / r.delay,
                    i = t.text(),
                    s = /[0-9]+,[0-9]+/.test(i);
                i = i.replace(/,/g, "");
                var o = /^[0-9]+$/.test(i),
                    u = /^[0-9]+\.[0-9]+$/.test(i),
                    a = u ? (i.split(".")[1] || []).length : 0;
                if (!o && !u) {
                    t.data("counterup-active", false);
                    return;
                }
                for (var f = n; f >= 1; f--) {
                    var l = parseInt((i / n) * f);
                    u && (l = parseFloat((i / n) * f).toFixed(a));
                    if (s) while (/(\d+)(\d{3})/.test(l.toString())) l = l.toString().replace(/(\d+)(\d{3})/, "$1,$2");
                    e.unshift(l);
                }
                t.data("counterup-nums", e);
                t.text("0");
                var c = function () {
                    var nums = t.data("counterup-nums");
                    if (!nums || !nums.length) {
                        delete t.data("counterup-nums");
                        t.data("counterup-nums", null);
                        t.data("counterup-func", null);
                        t.data("counterup-active", false);
                        return;
                    }
                    t.text(nums.shift());
                    if (nums.length) setTimeout(t.data("counterup-func"), r.delay);
                    else {
                        delete t.data("counterup-nums");
                        t.data("counterup-nums", null);
                        t.data("counterup-func", null);
                        t.data("counterup-active", false);
                    }
                };
                t.data("counterup-func", c);
                setTimeout(t.data("counterup-func"), r.delay);
            };
            t.waypoint(i, {
                offset: "100%",
                triggerOnce: !0
            });
        });
    };
})(jQuery);
