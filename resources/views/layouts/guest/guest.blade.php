<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <meta name="author" content="KB @CerberRus00 - Nexus Invest Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="zen-verification" content="K0H1Zjtz1fcqho7Y4wnB9NRcmHMocHkVIoMVPeC9m3QozrwKF7vzm4xrqgVJHPwy" />
    @include('partials.seo-head')
    @php
    $faviconPath = file_exists(public_path('favicon.ico'))
        ? 'favicon.ico'
        : 'assets/imgs/template/favicon.svg';
    $faviconVer = file_exists(public_path($faviconPath)) ? (filemtime(public_path($faviconPath)) ?: '1') : '1';
    $styleVer = config('app.asset_version');
    if ($styleVer === null || $styleVer === '') {
        $styleVer = '1.0.' . (config('app.env') === 'production' ? '0' : time());
    }
    @endphp
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($faviconPath) }}?v={{ $faviconVer }}">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preload" href="{{ asset('assets/imgs/template/logo-head.svg') }}" as="image">
    <link rel="preload" href="{{ asset('assets/fonts/uicons/uicons-regular-rounded.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=manrope:400,500,600,700&display=swap" media="all">
    <link rel="preload" href="{{ asset('assets/css/style.css') }}?v={{ $styleVer }}" as="style">
    <link href="{{ asset('assets/css/style.css') }}?v={{ $styleVer }}" rel="stylesheet" media="all">
    <link rel="preload" href="{{ asset('assets/css/main.css') }}?v={{ $styleVer }}" as="style">
    <link href="{{ asset('assets/css/main.css') }}?v={{ $styleVer }}" rel="stylesheet" media="all">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet"></noscript>
    <style>
        /* Резерв места под скроллбар — при открытии модалки контент не смещается */
        html { scrollbar-gutter: stable; }
        body.modal-open { padding-right: 0 !important; }
        body { overflow-x: clip; max-width: 100vw; }
        .main { max-width: 100%; overflow-x: clip; }
        /* Manrope — шрифт кита NEXUS DS (кириллица) */
        body,
        .main-menu,
        .font-heading {
            font-family: "Manrope", system-ui, sans-serif !important;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="preloader-active">
        <div class="preloader preloader--nexus" role="status" aria-label="{{ __('Загрузка') }}">
            <span class="preloader__spinner" aria-hidden="true"></span>
        </div>
    </div>

    @include('layouts.guest.header')
    @include('layouts.guest.mobile-menu')

    <main class="main">
        @yield('content')
    </main>

    @include('layouts.guest.footer')

    <x-guest.contact-form-modal />
    <x-guest.project-metrics-modal />

    @if ($errors->hasAny(['name', 'email', 'message', 'captcha_answer']) && old('_form') === 'contact')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('contactFormModal');
            if (modal && typeof bootstrap !== 'undefined') {
                new bootstrap.Modal(modal).show();
            }
        });
    </script>
    @endif

    <x-guest.cookie-banner />

    <script>
        window.NEXUS_YANDEX_METRIKA_ID = {{ config('services.metrika.id', 106896230) }};
        (function () {
            var hide = function () {
                var el = document.getElementById('preloader-active');
                if (!el || el.getAttribute('data-done') === '1') {
                    return;
                }
                el.setAttribute('data-done', '1');
                el.classList.add('is-hidden');
                window.setTimeout(function () {
                    if (el.parentNode) {
                        el.parentNode.removeChild(el);
                    }
                }, 350);
            };
            if (window.requestAnimationFrame) {
                window.requestAnimationFrame(function () {
                    window.requestAnimationFrame(hide);
                });
            } else {
                window.setTimeout(hide, 50);
            }
        })();
    </script>
    <script src="{{ asset('assets/js/vendor/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts-vendor')
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugins/scrollup.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugins/wow.js') }}" defer></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ $styleVer }}" defer></script>
    <script src="{{ asset('assets/js/math-captcha.js') }}?v={{ $styleVer }}" defer></script>
    <script src="{{ asset('assets/js/contact-form.js') }}?v={{ $styleVer }}" defer></script>
    <script src="{{ asset('assets/js/cookie-banner.js') }}?v={{ $styleVer }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js" defer></script>
    @php
        $laravelFlash = [
            'success' => session('newsletter_success') ?? session('alert_success'),
            'error' => session('alert_error'),
            'warning' => session('alert_warning'),
            'info' => session('info'),
            'errors' => $errors->any() ? $errors->getMessageBag()->getMessages() : [],
        ];
    @endphp
    <script>
        window.laravelFlash = @json($laravelFlash);
    </script>
    <script src="{{ asset('assets/js/sweetalert-flash.js') }}?v={{ $styleVer }}" defer></script>
    <script src="{{ asset('assets/js/ganimed-status.js') }}?v={{ $styleVer }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var metricsBtn = document.getElementById('projectMetricsContactBtn');
            if (!metricsBtn || typeof bootstrap === 'undefined') {
                return;
            }

            function getModal(el) {
                return bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
            }

            metricsBtn.addEventListener('click', function () {
                var metricsEl = document.getElementById('projectMetricsModal');
                var contactEl = document.getElementById('contactFormModal');
                var subjectInput = document.getElementById('contact-subject');
                var subject = metricsBtn.getAttribute('data-contact-subject') || '';

                if (!metricsEl || !contactEl) {
                    return;
                }

                var openContact = function () {
                    if (subjectInput) {
                        subjectInput.value = subject;
                    }
                    getModal(contactEl).show();
                };

                if (metricsEl.classList.contains('show')) {
                    metricsEl.addEventListener('hidden.bs.modal', function () {
                        openContact();
                    }, { once: true });
                    getModal(metricsEl).hide();
                } else {
                    openContact();
                }
            });
        });
    </script>
    @stack('scripts')
    @stack('seo-jsonld')
</body>
</html>
