@extends('layouts.app.app')

@section('title', __('Управление мессенджером'))

@section('header')
    <h1>{{ __('Управление мессенджером') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Управление мессенджером')],
    ]" separator-margin="mb-4" />

    @include('layouts.app.flash')

    @if(!($trueconf_configured ?? false))
        <div class="alert alert-warning">
            {{ __('TrueConf не настроен. Укажите TRUECONF_CLIENT_ID и TRUECONF_CLIENT_SECRET в .env. Назначение доступа создаст учётные записи после настройки.') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-3">{{ __('Отметьте пользователей, которым разрешён доступ к мессенджеру (чат и звонки). При первом включении для них создаётся учётная запись в TrueConf.') }}</p>
            @if($trueconf_configured ?? false)
                <div class="lk-form-actions mb-3">
                    <form method="post" action="{{ route('lk.admin.messenger.sync') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">{{ __('Синхронизировать пользователей с сервером TrueConf') }}</button>
                    </form>
                </div>
            @endif
            <form method="post" action="{{ route('lk.admin.messenger.update') }}">
                @csrf
                <div class="table-responsive">
                    <table class="table table-hover table-mobile-stack">
                        <thead>
                            <tr>
                                <th>{{ __('Имя') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Доступ к мессенджеру') }}</th>
                                <th>{{ __('Логин TrueConf') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users ?? [] as $user)
                                <tr>
                                    <td data-label="{{ __('Имя') }}">{{ $user->name }}</td>
                                    <td data-label="{{ __('Email') }}">{{ $user->email }}</td>
                                    <td data-label="{{ __('Доступ к мессенджеру') }}">
                                        <div class="custom-switch custom-switch-primary-inverse custom-switch-small">
                                            <input class="custom-switch-input" id="messenger-user-{{ $user->id }}" type="checkbox" name="users[]" value="{{ $user->id }}" {{ $user->messenger_access ? 'checked' : '' }}>
                                            <label class="custom-switch-btn" for="messenger-user-{{ $user->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="text-muted small" data-label="{{ __('Логин TrueConf') }}">{{ $user->trueconf_login ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
