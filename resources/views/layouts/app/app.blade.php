{{--
  Layout закрытой части (ЛК). Ресурсы: public/app/ (asset('app/...')).
  Подключения через @include директивы.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title') @yield('title') - {{ config('app.name') }} @else {{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }} @endif</title>

    <link rel="stylesheet" href="{{ asset('app/font/iconsmind-s/css/iconsminds.css') }}">
    <link rel="stylesheet" href="{{ asset('app/font/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/bootstrap.rtl.only.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/glide.core.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/bootstrap-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/vendor/component-custom-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/dore.dark.greenlime.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/main.css') }}">
    <style>
        /* Верхнее меню ЛК всегда закреплено (на prod без зависимости от загрузки main.css) */
        #app-container .navbar.fixed-top {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1030 !important;
        }
        #app-container .theme-colors,
        #app-container .theme-button { display: none !important; }
        #app-container .navbar-logo .logo,
        #app-container .navbar-logo .logo-mobile { background: none !important; background-image: none !important; }
        #app-container .navbar-logo .logo-dark,
        #app-container .navbar-logo .logo-mobile.logo-dark { visibility: hidden; position: absolute; }
        #app-container .navbar-logo .logo-light,
        #app-container .navbar-logo .logo-mobile.logo-light { visibility: visible; }
        #app-container.body-theme-dark .navbar-logo .logo-light,
        #app-container.body-theme-dark .navbar-logo .logo-mobile.logo-light { visibility: hidden; position: absolute; }
        #app-container.body-theme-dark .navbar-logo .logo-dark,
        #app-container.body-theme-dark .navbar-logo .logo-mobile.logo-dark { visibility: visible; position: static; }
        #app-container .navbar-logo .navbar-logo-img { height: 28px; width: auto; max-width: 140px; object-fit: contain; vertical-align: middle; }
        #app-container .navbar-logo .logo-mobile .navbar-logo-img { max-width: 120px; }
    </style>
    @stack('styles')
</head>
<body id="app-container" class="menu-default show-spinner">
    @include('layouts.app.topbar')
    @include('layouts.app.sidebar')
    <div class="menu-backdrop d-md-none" id="menu-backdrop" aria-hidden="true" title="{{ __('Закрыть меню') }}"></div>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @yield('header')
                    @include('layouts.app.header')
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    @include('layouts.app.footer')

    @include('layouts.app.scripts')
</body>
</html>
