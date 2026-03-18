{{--
  Layout закрытой части (ЛК). Ресурсы: public/app/ (asset('app/...')).
  Подключения через @include директивы.
--}}
@php
    $themeFile = request()->cookie('app_theme', 'dore.dark.greenlime.css');
    $validThemes = ['dore.light.greenlime.css', 'dore.dark.greenlime.css'];
    $themeFile = in_array($themeFile, $validThemes) ? $themeFile : 'dore.dark.greenlime.css';
    $isDarkTheme = str_contains($themeFile, 'dark');
@endphp
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
    <link rel="stylesheet" href="{{ asset('app/css/' . $themeFile) }}">
    <link rel="stylesheet" href="{{ asset('app/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/app.css') }}">
    @stack('styles')
</head>
<body id="app-container" class="menu-default show-spinner{{ $isDarkTheme ? ' theme-dark' : ' theme-light' }}">
    @include('layouts.app.topbar')
    @include('layouts.app.sidebar')
    <div class="menu-backdrop d-md-none" id="menu-backdrop" aria-hidden="true" title="{{ __('Закрыть меню') }}"></div>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @hasSection('header')
                    <div class="app-page-header">
                        @yield('header')
                    </div>
                    @endif
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
