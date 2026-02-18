<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="zen-verification" content="K0H1Zjtz1fcqho7Y4wnB9NRcmHMocHkVIoMVPeC9m3QozrwKF7vzm4xrqgVJHPwy" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Theme styles -->
        <link href="{{ asset('assets/css/style.css') }}?v=1.0.0" rel="stylesheet">
        <link href="{{ asset('assets/css/main.css') }}?v=1.0.0" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .auth-page {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem 1rem;
                background-color: var(--color-dark);
                font-family: "Manrope", sans-serif;
            }
            .auth-page .auth-logo {
                width: 180px;
                height: 180px;
                object-fit: contain;
            }
            .auth-page .auth-card {
                width: 100%;
                max-width: 28rem;
                margin-top: 2rem;
                padding: 2rem;
                background-color: var(--color-surface-dark-2);
                border: 1px solid rgba(197, 255, 65, 0.3);
                border-radius: 16px;
                overflow: hidden;
            }
            .auth-page label { color: var(--color-surface-light) !important; }
            .auth-page input[type="text"],
            .auth-page input[type="email"],
            .auth-page input[type="password"] {
                background-color: var(--color-text-muted-8) !important;
                border: 1px solid var(--color-text-muted-7) !important;
                color: var(--color-white) !important;
                border-radius: 10px !important;
            }
            .auth-page input:focus {
                border-color: var(--color-primary) !important;
                outline: none !important;
                box-shadow: 0 0 0 2px rgba(197, 255, 65, 0.3) !important;
            }
            .auth-page input::placeholder { color: var(--color-text-muted-3); }
            .auth-page .text-gray-600 { color: var(--color-text-muted-4) !important; }
            .auth-page button[type="submit"] {
                background-color: var(--color-primary) !important;
                color: var(--color-dark) !important;
                border: none !important;
                padding: 14px 25px !important;
                border-radius: 32px !important;
                font-weight: 600 !important;
            }
            .auth-page button[type="submit"]:hover {
                background-color: var(--color-surface-light) !important;
            }
            .auth-page a { color: var(--color-primary) !important; }
            .auth-page a:hover { color: var(--color-surface-light) !important; }
            .auth-page input[type="checkbox"]:checked {
                background-color: var(--color-primary) !important;
                border-color: var(--color-primary) !important;
            }
            .auth-page .text-red-600 { color: #f87171 !important; }
            .auth-channels-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
            .auth-channel-btn:hover { opacity: 0.95; background: #d4ff6b !important; color: #0E0E0E !important; }
            @media (max-width: 767px) {
                .auth-channels-grid { grid-template-columns: 1fr; }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="auth-page">
            <div class="text-center">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('assets/imgs/template/logo-head.svg') }}" alt="{{ config('app.name') }}" class="auth-logo">
                </a>

            </div>
            <h4 class="display-6 neutral-300 pt-0">{{ __('ПРОЕКТНОЕ ФИНАСИРОВАНИЕ') }}</h4>
            <div class="auth-card">
                {{ $slot }}
            </div>
            @isset($channels)
            <div class="auth-channels-outer" style="margin-top: 1.5rem; width: 100%; max-width: 28rem;">
                {{ $channels }}
            </div>
            @endisset
        </div>
    </body>
</html>
