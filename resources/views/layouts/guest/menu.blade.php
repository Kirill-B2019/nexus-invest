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
                    <div class="mega-menu-nexus__grid">
                        <div class="mega-menu-nexus__col">
                            <div class="mega-menu-nexus__heading">
                                <span class="mega-menu-nexus__heading-text">{{ __('Продукт') }}</span>
                            </div>
                            <ul class="mega-menu-nexus__list">
                                <li>
                                    <a href="{{ route('features') }}" class="mega-menu-nexus__link {{ request()->routeIs('features') ? 'active' : '' }}">
                                        <span class="mega-menu-nexus__item-icon" aria-hidden="true">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 3.5L14.2 9.1L20.2 9.6L15.6 13.5L17.2 19.4L12 16.2L6.8 19.4L8.4 13.5L3.8 9.6L9.8 9.1L12 3.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        <span class="mega-menu-nexus__item-body">
                                            <span class="mega-menu-nexus__item-title">{{ __('Особенности') }}</span>
                                            <span class="mega-menu-nexus__item-desc">{{ __('Ключевые возможности платформы НЕКСУС для цифровых финансовых активов') }}</span>
                                        </span>
                                        <span class="mega-menu-nexus__item-arrow" aria-hidden="true">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.5 7H11.5M11.5 7L7.5 3M11.5 7L7.5 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('ignd') }}" class="mega-menu-nexus__link {{ request()->routeIs('ignd') ? 'active' : '' }}">
                                        <span class="mega-menu-nexus__item-icon" aria-hidden="true">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 16.5L12 20.5L20 16.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4 12L12 16L20 12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4 7.5L12 11.5L20 7.5L12 3.5L4 7.5Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        <span class="mega-menu-nexus__item-body">
                                            <span class="mega-menu-nexus__item-title">{{ __('Система iGND') }}</span>
                                            <span class="mega-menu-nexus__item-desc">{{ __('Инновационная система гарантированного обеспечения цифровых активов') }}</span>
                                        </span>
                                        <span class="mega-menu-nexus__item-arrow" aria-hidden="true">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.5 7H11.5M11.5 7L7.5 3M11.5 7L7.5 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mega-menu-nexus__col">
                            <div class="mega-menu-nexus__heading">
                                <span class="mega-menu-nexus__heading-text">{{ __('Регуляторика') }}</span>
                            </div>
                            <ul class="mega-menu-nexus__list">
                                <li>
                                    <a href="{{ route('compliance') }}" class="mega-menu-nexus__link {{ request()->routeIs('compliance') ? 'active' : '' }}">
                                        <span class="mega-menu-nexus__item-icon" aria-hidden="true">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 3L19 6.5V12.2C19 16.2 16.1 19.7 12 21C7.9 19.7 5 16.2 5 12.2V6.5L12 3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                                <path d="M9 12.2L11 14.2L15.2 10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        <span class="mega-menu-nexus__item-body">
                                            <span class="mega-menu-nexus__item-title">{{ __('Комплаенс') }}</span>
                                            <span class="mega-menu-nexus__item-desc">{{ __('Соответствие требованиям регуляторов и международным стандартам') }}</span>
                                        </span>
                                        <span class="mega-menu-nexus__item-arrow" aria-hidden="true">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.5 7H11.5M11.5 7L7.5 3M11.5 7L7.5 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('documentation') }}" class="mega-menu-nexus__link {{ request()->routeIs('documentation') ? 'active' : '' }}">
                                        <span class="mega-menu-nexus__item-icon" aria-hidden="true">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 3.5H14L18 7.5V20.5H7V3.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                                <path d="M14 3.5V7.5H18" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                                <path d="M10 11.5H15M10 15H15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                            </svg>
                                        </span>
                                        <span class="mega-menu-nexus__item-body">
                                            <span class="mega-menu-nexus__item-title">{{ __('Документация') }}</span>
                                            <span class="mega-menu-nexus__item-desc">{{ __('Правовые документы, политики и технические регламенты') }}</span>
                                        </span>
                                        <span class="mega-menu-nexus__item-arrow" aria-hidden="true">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.5 7H11.5M11.5 7L7.5 3M11.5 7L7.5 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </a>
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
