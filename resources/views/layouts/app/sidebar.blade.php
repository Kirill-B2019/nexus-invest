{{-- Боковое меню ЛК. --}}
<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('lk') ? 'active' : '' }}">
                    <a href="#lk">
                        <i class="iconsminds-shop-4"></i>
                        <span>{{ __('Панели') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}">
                        <i class="simple-icon-user"></i>
                        <span>{{ __('Профиль') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('app.blank') ? 'active' : '' }}">
                    <a href="{{ route('app.blank') }}">
                        <i class="iconsminds-bucket"></i>
                        <span>{{ __('Пустая страница') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('welcome') }}">
                        <i class="simple-icon-home"></i>
                        <span>{{ __('Главная') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="lk">
                <li class="{{ request()->routeIs('lk') ? 'active' : '' }}">
                    <a href="{{ route('lk') }}">
                        <i class="simple-icon-rocket"></i> <span class="d-inline-block">{{ __('По умолчанию') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('lk.messenger') ? 'active' : '' }}">
                    <a href="{{ route('lk.messenger') }}">
                        <i class="simple-icon-bubble"></i> <span class="d-inline-block">{{ __('Мессенджер') }}</span>
                    </a>
                </li>
                @role('messenger-admin')
                <li class="{{ request()->routeIs('lk.admin.messenger') ? 'active' : '' }}">
                    <a href="{{ route('lk.admin.messenger') }}">
                        <i class="simple-icon-settings"></i> <span class="d-inline-block">{{ __('Управление мессенджером') }}</span>
                    </a>
                </li>
                @endrole
                <li class="{{ request()->routeIs('app.blank') ? 'active' : '' }}">
                    <a href="{{ route('app.blank') }}">
                        <i class="iconsminds-bucket"></i> <span class="d-inline-block">{{ __('Пустая страница') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
