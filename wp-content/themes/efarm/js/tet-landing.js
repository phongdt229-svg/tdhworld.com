/* Landing Quà Tết — đếm ngược, hoa mai rơi, lọc hộp quà */
(function () {
    'use strict';

    // ---------- Đếm ngược tới Giao thừa ----------
    var countdown = document.querySelector('.tet-countdown');
    if (countdown) {
        var target = new Date(countdown.getAttribute('data-target')).getTime();
        var units = {};
        ['days', 'hours', 'minutes', 'seconds'].forEach(function (u) {
            units[u] = countdown.querySelector('[data-unit="' + u + '"]');
        });
        var pad = function (n) { return n < 10 ? '0' + n : String(n); };
        var tick = function () {
            var diff = Math.max(0, target - Date.now());
            var s = Math.floor(diff / 1000);
            units.days.textContent = pad(Math.floor(s / 86400));
            units.hours.textContent = pad(Math.floor((s % 86400) / 3600));
            units.minutes.textContent = pad(Math.floor((s % 3600) / 60));
            units.seconds.textContent = pad(s % 60);
            if (diff === 0) {
                countdown.querySelector('.tet-countdown__label').textContent = 'Chúc Mừng Năm Mới!';
                clearInterval(timer);
            }
        };
        var timer = setInterval(tick, 1000);
        tick();
    }

    // ---------- Hoa mai rơi ----------
    var petals = document.querySelector('.tet-petals');
    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (petals && !reduceMotion) {
        var count = window.innerWidth < 768 ? 12 : 26;
        for (var i = 0; i < count; i++) {
            var p = document.createElement('span');
            var size = 8 + Math.random() * 10;
            p.className = 'tet-petal';
            p.style.left = (Math.random() * 100) + '%';
            p.style.width = size + 'px';
            p.style.height = size + 'px';
            p.style.animationDuration = (8 + Math.random() * 8) + 's';
            p.style.animationDelay = (-Math.random() * 16) + 's';
            p.style.setProperty('--drift', (Math.random() * 160 - 80) + 'px');
            petals.appendChild(p);
        }
    }

    // ---------- Lọc hộp quà theo ngân sách ----------
    var tabs = document.querySelectorAll('.tet-tab');
    var gifts = document.querySelectorAll('.tet-gift');
    Array.prototype.forEach.call(tabs, function (tab) {
        tab.addEventListener('click', function () {
            var filter = tab.getAttribute('data-filter');
            Array.prototype.forEach.call(tabs, function (t) { t.classList.toggle('is-active', t === tab); });
            Array.prototype.forEach.call(gifts, function (g) {
                g.classList.toggle('is-hidden', filter !== 'all' && g.getAttribute('data-tier') !== filter);
            });
        });
    });
})();
