@extends('layouts.app.app')

@section('title', __('Настройки'))

@section('header')
    <h1>{{ __('Настройки') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Настройки')],
    ]" separator-margin="mb-4" />
    @include('layouts.app.flash')

    <p class="text-muted mb-4">{{ __('Управление и настройки системы. Выберите раздел из списка ниже.') }}</p>

    <div class="row">
        {{-- Общие --}}
        <div class="col-12 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h6 mb-2 text-uppercase text-muted">{{ __('Общие') }}</h2>
                    <p class="text-muted small mb-3">{{ __('Системные справочники, коды и классификаторы платформы.') }}</p>
                    @can('manage-dictionaries')
                        <a href="{{ route('lk.admin.settings.dictionaries.index') }}" class="btn btn-primary btn-sm">{{ __('Справочники') }}</a>
                    @else
                        <p class="text-muted small mb-0">{{ __('Нет доступных разделов.') }}</p>
                    @endcan
                </div>
            </div>
        </div>

        {{-- Системные --}}
        <div class="col-12 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h6 mb-2 text-uppercase text-muted">{{ __('Системные') }}</h2>
                    <p class="text-muted small mb-3">{{ __('Управление ролями, уведомлениями и инфраструктурными модулями.') }}</p>
                    <div class="lk-admin-settings-actions" role="navigation" aria-label="{{ __('Системные разделы') }}">
                        @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('messenger-admin'))
                            <a href="{{ route('lk.admin.messenger') }}" class="btn btn-outline-primary btn-sm">{{ __('Мессенджер') }}</a>
                        @endif
                        @can('update-news-feed')
                            <a href="{{ route('lk.admin.news-feed.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Новости') }}</a>
                        @endcan
                        @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('roles-admin'))
                            <a href="{{ route('lk.admin.roles.users') }}" class="btn btn-outline-primary btn-sm">{{ __('Пользователи') }}</a>
                            <a href="{{ route('lk.admin.roles.roles') }}" class="btn btn-outline-primary btn-sm">{{ __('Роли') }}</a>
                            <a href="{{ route('lk.admin.roles.permissions') }}" class="btn btn-outline-primary btn-sm">{{ __('Разрешения') }}</a>
                        @endif
                        @can('manage-notifications')
                            <a href="{{ route('lk.admin.notifications.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Уведомления') }}</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        {{-- Модульные --}}
        <div class="col-12 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h6 mb-2 text-uppercase text-muted">{{ __('Модульные') }}</h2>
                    <p class="text-muted small mb-3">{{ __('Доменные процессы: модерация проектов и связанный workflow.') }}</p>
                    @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('moderate-projects'))
                        <a href="{{ route('lk.admin.projects.moderation.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Модерация проектов') }}</a>
                    @else
                        <p class="text-muted small mb-0">{{ __('Нет доступных разделов.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
