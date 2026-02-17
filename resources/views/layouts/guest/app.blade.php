<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <meta name="description" content="{{ $metaDescription ?? config('app.name') . ' - ' . __('Публичная страница') }}">
    <meta name="keywords" content="{{ $metaKeywords ?? __('главная, страница') }}">
    <meta name="author" content="KB @CerbeRus">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
    $faviconPath = file_exists(public_path('favicon.ico'))
        ? 'favicon.ico'
        : 'assets/imgs/template/favicon.svg';
    $faviconVer = file_exists(public_path($faviconPath)) ? (filemtime(public_path($faviconPath)) ?: '1') : '1';
@endphp
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($faviconPath) }}?v={{ $faviconVer }}">
    {{-- Manrope: геометрический sans-serif, похож на Urbanist, с поддержкой кириллицы --}}
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=manrope:400,500,600,700&display=swap">
    <link href="{{ asset('assets/css/style.css') }}?v=1.0.0" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}?v=1.0.0" rel="stylesheet">
    <link href="{{ asset('assets/css/roadmap.css') }}?v=1.0.0" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        html[lang="ru"] body,
        html[lang="ru"] .main-menu,
        html[lang="ru"] .font-heading,
        html[lang="ru"] h1, html[lang="ru"] h2, html[lang="ru"] h3, html[lang="ru"] h4, html[lang="ru"] h5, html[lang="ru"] h6,
        html[lang="ru"] p, html[lang="ru"] span, html[lang="ru"] a, html[lang="ru"] li, html[lang="ru"] label, html[lang="ru"] input, html[lang="ru"] button {
            font-family: "Manrope", "Urbanist", sans-serif !important;
        }
    </style>
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>
    @stack('styles')
</head>
<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center"><img src="{{ asset('assets/imgs/template/loading.gif') }}" alt="{{ config('app.name') }}"></div>
            </div>
        </div>
    </div>

    @include('layouts.guest.header')
    @include('layouts.guest.mobile-menu')

    <main class="main">

        @yield('content')
    </main>

    @include('layouts.guest.footer')

    <x-contact-form-modal />

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

    <x-cookie-banner />

    <script src="{{ asset('assets/js/vendor/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.carouselTicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/masonry.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v=1.0.0"></script>
    <script src="{{ asset('assets/js/cookie-banner.js') }}?v=1.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    @php
        $laravelFlash = [
            'success' => session('newsletter_success') ?? session('alert_success'),
            'error' => session('alert_error'),
            'warning' => session('alert_warning'),
            'errors' => $errors->any() ? $errors->getMessageBag()->getMessages() : [],
        ];
    @endphp
    <script>
        window.laravelFlash = @json($laravelFlash);
    </script>
    <script src="{{ asset('assets/js/sweetalert-flash.js') }}?v=1.0.0"></script>
    @stack('scripts')
</body>
</html>
