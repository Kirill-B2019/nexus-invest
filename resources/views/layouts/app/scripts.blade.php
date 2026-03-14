{{-- Подключение JS ЛК через @include. --}}
<script src="{{ asset('app/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/chartjs-plugin-datalabels.js') }}"></script>
<script src="{{ asset('app/js/vendor/moment.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/fullcalendar.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/progressbar.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/jquery.barrating.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/select2.full.js') }}"></script>
<script src="{{ asset('app/js/vendor/nouislider.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('app/js/vendor/Sortable.js') }}"></script>
<script src="{{ asset('app/js/vendor/mousetrap.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/glide.min.js') }}"></script>
<script src="{{ asset('app/js/dore.script.js') }}"></script>
<script>window.DORE_BASE = "{{ asset('app') }}";</script>
<script>
(function() {
    var container = document.getElementById('app-container');
    var backdrop = document.getElementById('menu-backdrop');
    if (container && backdrop) {
        backdrop.addEventListener('click', function() { container.classList.remove('main-show-temporary'); });
    }
})();
</script>
<script src="{{ asset('app/js/scripts.js') }}"></script>
<script>
    document.body.classList.remove('show-spinner');
    (function() {
        function getCookie(name) {
            var m = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1') + '=([^;]*)'));
            return m ? decodeURIComponent(m[1]) : null;
        }
        var theme = getCookie('app_theme') || (typeof localStorage !== 'undefined' && localStorage.getItem('dore-theme-color')) || 'dore.dark.greenlime.min.css';
        var isDark = theme && theme.indexOf('dark') > -1;
        var container = document.getElementById('app-container');
        if (isDark) {
            container.classList.add('body-theme-dark');
            document.documentElement.classList.remove('theme-light');
        } else {
            container.classList.remove('body-theme-dark');
            document.documentElement.classList.add('theme-light');
        }
    })();
</script>
<script>
(function() {
    var wrap = document.getElementById('notificationBellWrap');
    if (!wrap) return;
    var url = wrap.dataset.dropdownUrl;
    var baseUrl = wrap.dataset.notificationsPageUrl;
    var scrollEl = document.getElementById('notificationDropdownScroll');
    var placeholder = document.getElementById('notificationDropdownPlaceholder');
    var countEl = document.getElementById('notificationCount');
    var csrfToken = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').content;

    function renderList(data) {
        var count = typeof data.count === 'number' ? data.count : parseInt(data.count, 10) || 0;
        countEl.textContent = count > 99 ? '99+' : String(count);
        countEl.classList.toggle('d-none', count === 0);
        while (scrollEl.firstChild) scrollEl.removeChild(scrollEl.firstChild);
        if (count === 0) {
            var p = document.createElement('div');
            p.className = 'text-center text-muted py-3';
            p.textContent = '{{ __("Нет уведомлений") }}';
            scrollEl.appendChild(p);
            return;
        }
        var html = '';
        data.items.forEach(function(item) {
            var importanceClass = item.importance === 'urgent' ? 'text-danger' : (item.importance === 'high' ? 'text-warning' : '');
            html += '<div class="d-flex flex-row mb-3 pb-3 border-bottom notification-dropdown-item" data-id="' + item.id + '" data-link="' + escapeHtml(item.link || '') + '">';
            html += '<div class="pl-3 pr-2 flex-grow-1"><p class="font-weight-medium mb-1 ' + importanceClass + '">' + escapeHtml(item.title) + '</p>';
            html += '<p class="text-muted mb-0 text-small">' + escapeHtml(item.body) + '</p>';
            html += '<p class="text-muted mb-0 text-small">' + item.created_at + '</p></div></div>';
        });
        scrollEl.insertAdjacentHTML('beforeend', html);
        scrollEl.querySelectorAll('.notification-dropdown-item').forEach(function(el) {
            el.style.cursor = 'pointer';
            el.addEventListener('click', function() {
                var id = this.dataset.id;
                var link = this.dataset.link;
                if (!csrfToken) { if (link) window.location.href = link; else window.location.href = baseUrl; return; }
                fetch(baseUrl + '/' + id + '/read', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'Content-Type': 'application/json' }, body: JSON.stringify({}) })
                    .then(function(r) { return r.json(); })
                    .then(function(res) { if (res.link) window.location.href = res.link; else window.location.href = baseUrl; })
                    .catch(function() { if (link) window.location.href = link; else window.location.href = baseUrl; });
            });
        });
    }
    function escapeHtml(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

    fetch(url, { credentials: 'same-origin' })
        .then(function(r) { return r.json(); })
        .then(renderList)
        .catch(function() {
            if (placeholder) { placeholder.textContent = '{{ __("Нет уведомлений") }}'; placeholder.classList.remove('d-none'); }
            if (countEl) { countEl.textContent = '0'; countEl.classList.add('d-none'); }
        });
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
@php
    $laravelFlashLk = [
        'success' => session('alert_success'),
        'error' => session('alert_error'),
        'warning' => session('alert_warning'),
        'info' => session('info'),
        'errors' => [],
    ];
@endphp
<script>
    window.laravelFlashLk = @json($laravelFlashLk);
</script>
<script src="{{ asset('app/js/sweetalert-flash-lk.js') }}?v=1.0.0"></script>
<script src="{{ asset('app/js/swal-confirm-forms.js') }}"></script>
@stack('scripts')
