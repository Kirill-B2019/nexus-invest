{{-- Боковое меню ЛК. Управление и настройки — только через страницу «Настройки» (/lk/admin/settings). --}}
@php
    $hasManagementAccess = auth()->user()->can('manage-dictionaries') || auth()->user()->hasRole('roles-admin') || auth()->user()->can('update-news-feed') || auth()->user()->can('manage-notifications') || auth()->user()->hasRole('messenger-admin');
    $isLkSubMenuActive = request()->routeIs('lk') || request()->routeIs('lk.messenger') || request()->routeIs('lk.notifications.*') || request()->routeIs('app.blank');
@endphp
<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ $isLkSubMenuActive ? 'active' : '' }}">
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
                @if($hasManagementAccess)
                <li class="{{ request()->routeIs('lk.admin.*') ? 'active' : '' }}">
                    <a href="{{ route('lk.admin.settings.index') }}">
                        <i class="simple-icon-settings"></i>
                        <span>{{ __('Настройки') }}</span>
                    </a>
                </li>
                @endif
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
                <li class="{{ request()->routeIs('lk.notifications.*') ? 'active' : '' }}">
                    <a href="{{ route('lk.notifications.index') }}">
                        <i class="simple-icon-bell"></i> <span class="d-inline-block">{{ __('Уведомления') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('app.blank') ? 'active' : '' }}">
                    <a href="{{ route('app.blank') }}">
                        <i class="iconsminds-bucket"></i> <span class="d-inline-block">{{ __('Пустая страница') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
