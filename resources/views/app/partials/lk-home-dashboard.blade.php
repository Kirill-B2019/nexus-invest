@php
    $user = auth()->user();
    $roleSwitch = app(\App\Services\LkRoleSwitchService::class);
    $hasInvestor = $roleSwitch->hasEffectiveRole($user, 'investor');
    $hasInitiator = $roleSwitch->hasEffectiveRole($user, 'initiator');
    $hasExpert = $roleSwitch->hasEffectiveRole($user, 'expert');
    $hasMessengerAccess = $roleSwitch->hasEffectiveMessengerAccess($user);
    $hasManagementAccess = $roleSwitch->hasEffectiveManagementAccess($user);
@endphp
<x-lk-breadcrumb :items="[
    ['label' => __('Личный кабинет'), 'url' => route('lk')],
    ['label' => __('Главная')],
]" separator-margin="mb-5" />
@include('layouts.app.flash')

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title mb-2">{{ __('Добро пожаловать, :name!', ['name' => $user->name]) }}</h5>
        <p class="text-muted mb-0">{{ __('Выберите действие, чтобы быстро перейти к рабочему сценарию.') }}</p>
    </div>
</div>

<div class="row">
    @if($hasInitiator)
        <div class="col-12 col-md-6 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="mb-2">{{ __('Для инициатора') }}</h6>
                    <p class="text-muted small mb-3">{{ __('Создайте проект или продолжите работу с черновиками.') }}</p>
                    <div class="d-flex flex-wrap lk-form-actions">
                        <a href="{{ route('lk.projects.create') }}" class="btn btn-primary btn-sm">{{ __('Новый проект') }}</a>
                        <a href="{{ route('lk.projects.my') }}" class="btn btn-outline-primary btn-sm">{{ __('Мои проекты') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($hasInvestor)
        <div class="col-12 col-md-6 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="mb-2">{{ __('Для инвестора') }}</h6>
                    <p class="text-muted small mb-3">{{ __('Перейдите к портфелю и списку доступных проектов.') }}</p>
                    <div class="d-flex flex-wrap lk-form-actions">
                        <a href="{{ route('lk.portfolio') }}" class="btn btn-primary btn-sm">{{ __('Мой портфель') }}</a>
                        <a href="{{ route('lk.projects.all') }}" class="btn btn-outline-primary btn-sm">{{ __('Все проекты') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($hasExpert)
        <div class="col-12 col-md-6 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="mb-2">{{ __('Для эксперта') }}</h6>
                    <p class="text-muted small mb-3">{{ __('Откройте профильный дашборд и рабочие задачи.') }}</p>
                    <a href="{{ route('lk.dashboard.expert') }}" class="btn btn-primary btn-sm">{{ __('Дашборд эксперта') }}</a>
                </div>
            </div>
        </div>
    @endif

    <div class="col-12 col-md-6 col-xl-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="mb-2">{{ __('Коммуникации') }}</h6>
                <p class="text-muted small mb-3">{{ __('Проверяйте уведомления и сообщения по проектам.') }}</p>
                <div class="d-flex flex-wrap lk-form-actions">
                    <a href="{{ route('lk.notifications.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Уведомления') }}</a>
                    @if($hasMessengerAccess)
                        <a href="{{ route('lk.messenger') }}" class="btn btn-outline-primary btn-sm">{{ __('Мессенджер') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="mb-2">{{ __('Профиль') }}</h6>
                <p class="text-muted small mb-3">{{ __('Обновите личные данные, пароль и параметры аккаунта.') }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">{{ __('Открыть профиль') }}</a>
            </div>
        </div>
    </div>

    @if($hasManagementAccess)
        <div class="col-12 col-md-6 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="mb-2">{{ __('Управление') }}</h6>
                    <p class="text-muted small mb-3">{{ __('Администрирование ролей, словарей, уведомлений и модерации.') }}</p>
                    <a href="{{ route('lk.admin.settings.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Админ-настройки') }}</a>
                </div>
            </div>
        </div>
    @endif
</div>
