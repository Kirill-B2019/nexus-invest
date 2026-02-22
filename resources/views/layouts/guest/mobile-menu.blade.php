<div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
        <div class="burger-icon burger-icon-white">
            <span class="burger-icon-top"></span>
            <span class="burger-icon-mid"></span>
            <span class="burger-icon-bottom"></span>
        </div>
        <div class="mobile-header-top">
            @auth
                <div class="user-account">
                    <img src="{{ asset('assets/imgs/page/homepage6/author.png') }}" alt="{{ config('app.name') }}">
                    <div class="content">
                        <h6 class="user-name">{{ auth()->user()->name }}</h6>
                        <p class="font-xs text-muted">{{ __('Ваш кабинет') }}</p>
                    </div>
                </div>
            @else
                <div class="user-account">
                    <img src="{{ asset('assets/imgs/page/homepage6/author.png') }}" alt="{{ config('app.name') }}">
                    <div class="content">
                        <h6 class="user-name">{{ __('Гость') }}</h6>
                        <p class="font-xs text-muted">{{ __('Войдите или зарегистрируйтесь') }}</p>
                    </div>
                </div>
            @endauth
        </div>
        <div class="mobile-header-content-area">
            <div class="perfect-scroll">
                <div class="mobile-menu-wrap mobile-header-border">
                    <nav>
                        <ul class="mobile-menu font-heading">
                            @if (!request()->routeIs('welcome'))
                            <li>
                                <a href="{{ route('welcome') }}">{{ __('Главная') }}</a>
                            </li>
                            @endif
                            <li class="has-children">
                                <a href="#" class="{{ request()->routeIs('welcome') ? 'active' : '' }}">{{ __('Нексус') }}</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('features') }}" class="{{ request()->routeIs('features') ? 'active' : '' }}">{{ __('Особенности') }}</a></li>
                                    <li><a href="{{ route('compliance') }}" class="{{ request()->routeIs('compliance') ? 'active' : '' }}">{{ __('Комплаенс') }}</a></li>
                                    <li><a href="#">{{ __('Маркетплейс') }}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('ganimed') }}" class="{{ request()->routeIs('ganimed') ? 'active' : '' }}">{{ __('Ганимед') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/services') }}">{{ __('База знаний') }}</a>
                            </li>
                            <li class="has-children">
                                <a href="#">{{ __('Документы') }}</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('/about') }}">{{ __('Документы платформы') }}</a></li>
                                    <li><a href="{{ url('/services') }}">{{ __('Регулирование') }}</a></li>
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#contactFormModal">{{ __('Связаться с нами') }}</a></li>
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="#">{{ __('Аккаунт') }}</a>
                                <ul class="sub-menu">
                                    @auth
                                        <li><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
                                        <li><a href="{{ route('profile.edit') }}">{{ __('Профиль') }}</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                                @csrf
                                                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Выйти') }}</a>
                                            </form>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}">{{ __('Регистрация') }}</a></li>
                                        <li><a href="{{ route('login') }}">{{ __('Войти') }}</a></li>
                                        <li><a href="{{ route('password.request') }}">{{ __('Забыли пароль?') }}</a></li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                @auth
                    <div class="mobile-account">
                        <h6 class="mb-10">{{ __('Ваш аккаунт') }}</h6>
                        <ul class="mobile-menu font-heading">
                            <li><a href="{{ route('profile.edit') }}">{{ __('Профиль') }}</a></li>
                            <li><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Выйти') }}</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-25">{{ __('Мы в соцсетях') }}</h6>
                    <a class="icon-socials icon-facebook" href="#"><img alt="{{ config('app.name') }}" src="{{ asset('assets/imgs/template/icons/fb.svg') }}"></a>
                    <a class="icon-socials icon-instagram" href="#"><img alt="{{ config('app.name') }}" src="{{ asset('assets/imgs/template/icons/in.svg') }}"></a>
                    <a class="icon-socials icon-twitter" href="#"><img alt="{{ config('app.name') }}" src="{{ asset('assets/imgs/template/icons/tw.svg') }}"></a>
                    <a class="icon-socials icon-be" href="#"><img alt="{{ config('app.name') }}" src="{{ asset('assets/imgs/template/icons/be.svg') }}"></a>
                </div>
                <div class="site-copyright">
                    {{ __('©') }} {{ date('Y') }} {{ config('app.name') }}. | KB @CerbeRus - Nexus Invest Team
                </div>
            </div>
        </div>
    </div>
</div>
