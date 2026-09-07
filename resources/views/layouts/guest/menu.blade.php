<nav class="nav-main-menu d-none d-xl-block">
    <ul class="main-menu">
        @if (!request()->routeIs('welcome'))
        <li>
            <a href="{{ route('welcome') }}">{{ __('Главная') }}</a>
        </li>
        @endif
        <li class="mega-li has-children">
            <a class="{{ request()->routeIs('features', 'compliance', 'ignd', 'documentation') ? 'active' : '' }}" href="#">{{ __('Нексус') }}</a>
            <div class="mega-menu mega-menu-nexus">
                <div class="mega-menu-inner">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <h6 class="mega-menu-title">{{ __('Продукт') }}</h6>
                            <ul>
                                <li>
                                    <a href="{{ route('features') }}" class="{{ request()->routeIs('features') ? 'active' : '' }}">{{ __('Особенности') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('ignd') }}" class="{{ request()->routeIs('ignd') ? 'active' : '' }}">{{ __('Система iGND') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="mega-menu-title">{{ __('Регуляторика') }}</h6>
                            <ul>
                                <li>
                                    <a href="{{ route('compliance') }}" class="{{ request()->routeIs('compliance') ? 'active' : '' }}">{{ __('Комплаенс') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('documentation') }}" class="{{ request()->routeIs('documentation') ? 'active' : '' }}">{{ __('Документация') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <a href="{{ route('ganimed') }}" class="{{ request()->routeIs('ganimed') ? 'active' : '' }}">{{ __('Ганимед') }}</a>
        </li>
        <li>
            <a href="{{ route('nexus-ai') }}" class="{{ request()->routeIs('nexus-ai') ? 'active' : '' }}">{{ __('ИИ') }}</a>
        </li>
        <li>
            <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'active' : '' }}">{{ __('Новости') }}</a>
        </li>
    </ul>
</nav>
