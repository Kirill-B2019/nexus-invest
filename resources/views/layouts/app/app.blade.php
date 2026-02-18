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
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

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
    <link rel="stylesheet" href="{{ asset('app/css/dore.light.bluenavy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/main.css') }}">
    <style>
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
<body id="app-container" class="menu-default">
    @include('layouts.app.topbar')
    @include('layouts.app.sidebar')

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('layouts.app.header')
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>

    @include('layouts.app.footer')

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
    <script src="{{ asset('app/js/scripts.js') }}"></script>
    <script>
        document.body.classList.remove('show-spinner');
        (function() {
            var theme = typeof localStorage !== 'undefined' && localStorage.getItem('dore-theme-color');
            if (theme && theme.indexOf('dark') > -1) document.getElementById('app-container').classList.add('body-theme-dark');
            else document.getElementById('app-container').classList.remove('body-theme-dark');
        })();
    </script>
    @stack('scripts')
</body>
</html>
