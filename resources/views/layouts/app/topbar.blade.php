{{-- Шапка ЛК (topbar). --}}
<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>
        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>
        <div class="search" data-search-path="{{ url('/') }}/app/search?q=">
            <input placeholder="{{ __('Поиск…') }}">
            <span class="search-icon">
                <i class="simple-icon-magnifier"></i>
            </span>
        </div>
    </div>

    <a class="navbar-logo" href="{{ route('lk') }}">
        <span class="logo logo-light d-none d-xs-block">
            <img src="{{ asset('assets/imgs/template/logo-black.svg') }}" alt="{{ config('app.name') }}" class="navbar-logo-img">
        </span>
        <span class="logo logo-dark d-none d-xs-block">
            <img src="{{ asset('assets/imgs/template/white-full.svg') }}" alt="{{ config('app.name') }}" class="navbar-logo-img">
        </span>
        <span class="logo-mobile logo-light d-block d-xs-none">
            <img src="{{ asset('assets/imgs/template/logo-black.svg') }}" alt="{{ config('app.name') }}" class="navbar-logo-img">
        </span>
        <span class="logo-mobile logo-dark d-block d-xs-none">
            <img src="{{ asset('assets/imgs/template/white-full.svg') }}" alt="{{ config('app.name') }}" class="navbar-logo-img">
        </span>
    </a>

    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            <div class="d-none d-md-inline-block align-text-bottom mr-3">
                <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                     data-toggle="tooltip" data-placement="left" title="{{ __('Тёмная тема') }}">
                    <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                    <label class="custom-switch-btn" for="switchDark"></label>
                </div>
            </div>
            <div class="position-relative d-none d-sm-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                    <a href="{{ route('profile.edit') }}" class="icon-menu-item">
                        <i class="iconsminds-equalizer d-block"></i>
                        <span>{{ __('Настройки') }}</span>
                    </a>
                    <a href="{{ route('lk') }}" class="icon-menu-item">
                        <i class="iconsminds-bar-chart-4 d-block"></i>
                        <span>{{ __('Доходы') }}</span>
                    </a>
                    <a href="{{ route('welcome') }}" class="icon-menu-item">
                        <i class="simple-icon-home d-block"></i>
                        <span>{{ __('Главная') }}</span>
                    </a>
                </div>
            </div>
            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bell"></i>
                    <span class="count">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                    <div class="scroll">
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <div class="pl-3">
                                <p class="font-weight-medium mb-1">{{ __('Нет уведомлений') }}</p>
                                <p class="text-muted mb-0 text-small">{{ date('d.m.Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                <i class="simple-icon-size-fullscreen"></i>
                <i class="simple-icon-size-actual"></i>
            </button>
        </div>

        <div class="user d-inline-block">
            <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="name">{{ Auth::user()->name }}</span>
                <span>
                    <i class="simple-icon-user"></i>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right mt-3">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Аккаунт') }}</a>
                <a class="dropdown-item" href="{{ route('lk') }}">{{ __('Возможности') }}</a>
                <a class="dropdown-item" href="{{ route('welcome') }}">{{ __('Главная') }}</a>
                <a class="dropdown-item" href="#">{{ __('Поддержка') }}</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">{{ __('Выйти') }}</button>
                </form>
            </div>
        </div>
    </div>
</nav>
