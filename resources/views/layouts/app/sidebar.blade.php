{{-- Боковое меню ЛК. Управление и настройки — только через страницу «Настройки» (/lk/admin/settings). --}}
@php
    $user = auth()->user();
    $roleSwitch = app(\App\Services\LkRoleSwitchService::class);
    $effectiveRole = $roleSwitch->getEffectiveRole($user);
    $hasInvestor = $roleSwitch->hasEffectiveRole($user, 'investor');
    $hasInitiator = $roleSwitch->hasEffectiveRole($user, 'initiator');
    $hasExpert = $roleSwitch->hasEffectiveRole($user, 'expert');
    $hasManagementAccess = $roleSwitch->hasEffectiveManagementAccess($user);
    $isLkSubMenuActive = request()->routeIs('lk') || request()->routeIs('lk.dashboard.*') || request()->routeIs('lk.messenger') || request()->routeIs('lk.notifications.*');
    $hasProjectsAccess = $hasInvestor || $hasInitiator;
    $isProjectsSubMenuActive = request()->routeIs('lk.projects.*');
    $hasPlatformRole = $hasInvestor || $hasInitiator || $hasExpert;
    $hasMessengerAccess = $roleSwitch->hasEffectiveMessengerAccess($user);
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
                @if($hasInvestor)
                <li class="{{ request()->routeIs('lk.portfolio') ? 'active' : '' }}">
                    <a href="{{ route('lk.portfolio') }}">
                        <i class="simple-icon-briefcase"></i>
                        <span>{{ __('Мой портфель') }}</span>
                    </a>
                </li>
                @endif
                @if($hasProjectsAccess)
                <li class="{{ $isProjectsSubMenuActive ? 'active' : '' }}">
                    <a href="#projects">
                        <i class="simple-icon-doc"></i>
                        <span>{{ __('Проекты') }}</span>
                    </a>
                </li>
                @endif
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
                @if($hasPlatformRole)
                    @if($hasInvestor)
                <li class="{{ request()->routeIs('lk.dashboard.investor') ? 'active' : '' }}">
                    <a href="{{ route('lk.dashboard.investor') }}">
                        <i class="simple-icon-wallet"></i> <span class="d-inline-block">{{ __('Инвестор') }}</span>
                    </a>
                </li>
                    @endif
                    @if($hasInitiator)
                <li class="{{ request()->routeIs('lk.dashboard.initiator') ? 'active' : '' }}">
                    <a href="{{ route('lk.dashboard.initiator') }}">
                        <i class="simple-icon-rocket"></i> <span class="d-inline-block">{{ __('Инициатор') }}</span>
                    </a>
                </li>
                    @endif
                    @if($hasExpert)
                <li class="{{ request()->routeIs('lk.dashboard.expert') ? 'active' : '' }}">
                    <a href="{{ route('lk.dashboard.expert') }}">
                        <i class="simple-icon-magnifier"></i> <span class="d-inline-block">{{ __('Эксперт') }}</span>
                    </a>
                </li>
                    @endif
                @else
                <li class="{{ request()->routeIs('lk') ? 'active' : '' }}">
                    <a href="{{ route('lk') }}">
                        <i class="simple-icon-rocket"></i> <span class="d-inline-block">{{ __('По умолчанию') }}</span>
                    </a>
                </li>
                @endif
                @if($hasMessengerAccess)
                <li class="{{ request()->routeIs('lk.messenger') ? 'active' : '' }}">
                    <a href="{{ route('lk.messenger') }}">
                        <i class="simple-icon-bubble"></i> <span class="d-inline-block">{{ __('Мессенджер') }}</span>
                    </a>
                </li>
                @endif
                <li class="{{ request()->routeIs('lk.notifications.*') ? 'active' : '' }}">
                    <a href="{{ route('lk.notifications.index') }}">
                        <i class="simple-icon-bell"></i> <span class="d-inline-block">{{ __('Уведомления') }}</span>
                    </a>
                </li>
            </ul>
            @if($hasProjectsAccess)
            <ul class="list-unstyled" data-link="projects">
                @if($hasInvestor)
                <li class="{{ request()->routeIs('lk.projects.all') ? 'active' : '' }}">
                    <a href="{{ route('lk.projects.all') }}">
                        <i class="simple-icon-list"></i> <span class="d-inline-block">{{ __('Все проекты') }}</span>
                    </a>
                </li>
                @endif
                @if($hasInitiator)
                <li class="{{ request()->routeIs('lk.projects.my') ? 'active' : '' }}">
                    <a href="{{ route('lk.projects.my') }}">
                        <i class="simple-icon-folder"></i> <span class="d-inline-block">{{ __('Мои проекты') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('lk.projects.create') ? 'active' : '' }}">
                    <a href="{{ route('lk.projects.create') }}">
                        <i class="simple-icon-plus"></i> <span class="d-inline-block">{{ __('Новый проект') }}</span>
                    </a>
                </li>
                @endif
            </ul>
            @endif
        </div>
    </div>
</div>
