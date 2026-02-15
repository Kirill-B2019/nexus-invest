<header class="header sticky-bar">
    <div class="container">
        <div class="main-header">
            <div class="header-left">
                <div class="header-logo">
                    <a class="d-flex" href="{{ route('welcome') }}">
                        <img class="logo-head" alt="{{ config('app.name') }}" src="{{ asset('assets/imgs/template/logo-head.svg') }}">
                    </a>
                </div>
                <div class="header-nav">
                    @include('layouts.guest.menu')
                </div>
            </div>
            <div class="header-right">
                @auth
                    <a class="btn btn-brand-4-medium btn-cabinet hover-up" href="{{ url('/dashboard') }}" aria-label="{{ __('Личный кабинет') }}">
                        <span class="btn-cabinet-text">{{ __('Личный кабинет') }}</span>
                        <svg class="btn-cabinet-icon btn-cabinet-icon-desk" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M22 11.0003L18.4791 7.47949V10.3074H0V11.6933H18.4791V14.5213L22 11.0003Z" fill=""></path>
                        </svg>
                        <span class="btn-cabinet-icon-mobile"><i class="fi-rr-user" aria-hidden="true"></i></span>
                    </a>
                @else
                    <a class="btn btn-brand-4-medium btn-cabinet hover-up" href="{{ route('login') }}" aria-label="{{ __('Ваш кабинет') }}">
                        <span class="btn-cabinet-text">{{ __('Ваш кабинет') }}</span>
                        <svg class="btn-cabinet-icon btn-cabinet-icon-desk" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M22 11.0003L18.4791 7.47949V10.3074H0V11.6933H18.4791V14.5213L22 11.0003Z" fill=""></path>
                        </svg>
                        <span class="btn-cabinet-icon-mobile"><i class="fi-rr-user" aria-hidden="true"></i></span>
                    </a>
                @endauth
                <div class="burger-icon burger-icon-white">
                    <span class="burger-icon-top"></span>
                    <span class="burger-icon-mid"></span>
                    <span class="burger-icon-bottom"></span>
                </div>
            </div>
        </div>
    </div>
</header>
