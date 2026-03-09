@extends('layouts.app.app')

@section('title', __('Настройки'))

@section('header')
    <h1>{{ __('Настройки') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Настройки') }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    <p class="text-muted mb-4">{{ __('Управление и настройки системы. Выберите раздел из списка ниже.') }}</p>

    {{-- Общие --}}
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="h5 mb-3 text-uppercase text-muted">{{ __('Общие') }}</h2>
            <ul class="list-unstyled mb-0">
                @can('manage-dictionaries')
                <li class="mb-2">
                    <a href="{{ route('lk.admin.settings.dictionaries.index') }}">
                        <i class="simple-icon-book-open mr-2"></i>{{ __('Справочники') }}
                    </a>
                </li>
                @endcan
                @if(!auth()->user()->can('manage-dictionaries'))
                <li class="text-muted small">{{ __('Нет доступных разделов.') }}</li>
                @endif
            </ul>
        </div>
    </div>

    {{-- Системные --}}
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="h5 mb-3 text-uppercase text-muted">{{ __('Системные') }}</h2>
            <ul class="list-unstyled mb-0">
                @role('messenger-admin')
                <li class="mb-2">
                    <a href="{{ route('lk.admin.messenger') }}">
                        <i class="simple-icon-bubble mr-2"></i>{{ __('Мессенджер') }}
                    </a>
                </li>
                @endrole
                @can('update-news-feed')
                <li class="mb-2">
                    <a href="{{ route('lk.admin.news-feed.index') }}">
                        <i class="simple-icon-doc mr-2"></i>{{ __('Новости') }}
                    </a>
                </li>
                @endcan
                @role('roles-admin')
                <li class="mb-2">
                    <a href="{{ route('lk.admin.roles.users') }}">
                        <i class="simple-icon-people mr-2"></i>{{ __('Пользователи') }}
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('lk.admin.roles.roles') }}">
                        <i class="simple-icon-user-following mr-2"></i>{{ __('Роли') }}
                    </a>
                </li>
                <li class="mb-2 pl-3">
                    <a href="{{ route('lk.admin.roles.permissions') }}" class="text-muted">
                        <i class="simple-icon-lock mr-2"></i>{{ __('Разрешения') }}
                    </a>
                </li>
                @endrole
                @can('manage-notifications')
                <li class="mb-2">
                    <a href="{{ route('lk.admin.notifications.index') }}">
                        <i class="simple-icon-bell mr-2"></i>{{ __('Уведомления') }}
                    </a>
                </li>
                @endcan
                @if(!auth()->user()->hasRole('messenger-admin') && !auth()->user()->can('update-news-feed') && !auth()->user()->hasRole('roles-admin') && !auth()->user()->can('manage-notifications'))
                <li class="text-muted small">{{ __('Нет доступных разделов.') }}</li>
                @endif
            </ul>
        </div>
    </div>

    {{-- Модульные --}}
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="h5 mb-3 text-uppercase text-muted">{{ __('Модульные') }}</h2>
            <p class="text-muted small mb-0">{{ __('Разделы модулей будут добавлены здесь.') }}</p>
        </div>
    </div>
@endsection
