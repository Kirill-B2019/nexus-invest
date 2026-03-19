<nav class="nav-main-menu d-none d-xl-block">
    <ul class="main-menu">
        @if (!request()->routeIs('welcome'))
        <li>
            <a href="{{ route('welcome') }}">{{ __('Главная') }}</a>
        </li>
        @endif
        <li class="has-children"><a class="active" href="#">{{ __('Нексус') }}</a>
            <ul class="sub-menu">
                <li><a href="{{ route('features') }}">{{ __('Особенности') }}</a></li>
                <li><a href="{{ route('compliance') }}">{{ __('Комплаенс') }}</a></li>
            </ul>

        </li>
        <li>
            <a href="{{ route('ganimed') }}" class="{{ request()->routeIs('ganimed') ? 'active' : '' }}">{{ __('Ганимед') }}</a>
        </li>
        <li>
            <a href="{{ route('ignd') }}" class="{{ request()->routeIs('ignd') ? 'active' : '' }}">{{ __('Система iGND') }}</a>
        </li>
        <li><a href="{{ route('documentation') }}">{{ __('Документация') }}</a></li>
        {{--<li class="mega-li has-children">
            <a href="#">{{ __('Документы') }}</a>
            <div class="mega-menu">
                <div class="mega-menu-inner">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>{{ __('Документы') }}</h6>
                                    <ul>
                                        <li><a href="{{ route('documentation') }}">{{ __('Документация') }}</a></li>
                                        <li><a href="{{ url('/about') }}">{{ __('Документы платформы') }}</a></li>
                                        <li><a href="{{ url('/services') }}">{{ __('Регулирование') }}</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#contactFormModal">{{ __('Связаться с нами') }}</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ __('Аккаунт') }}</h6>
                                    <ul>
                                        @auth
                                            <li><a href="{{ route('lk') }}">{{ __('Разместить проект') }}</a></li>
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
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box-desc-menu">
                                <h6 class="text-16-semibold">{{ __('Ваш проект в системе') }}</h6>
                                <p class="text-xs mt-10 mb-25">{{ __('Ваш проект уже будет в проектном каталоге MVP запуска.') }}</p>
                                <a class="btn btn-black-md btn-rounded" href="{{ route('login') }}">
                                    {{ __('Разместить проект') }}
                                    <svg width="22" height="8" viewBox="0 0 22 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 4.00032L18.4791 0.479492V3.3074H0V4.69333H18.4791V7.52129L22 4.00032Z" fill=""></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>--}}
    </ul>
</nav>
