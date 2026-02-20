@extends('layouts.app.app')

@section('title', __('Управление мессенджером'))

@section('header')
    <h1>{{ __('Управление мессенджером') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Управление мессенджером') }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!$trueconf_configured)
        <div class="alert alert-warning">
            {{ __('TrueConf не настроен. Укажите TRUECONF_CLIENT_ID и TRUECONF_CLIENT_SECRET в .env. Назначение доступа создаст учётные записи после настройки.') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-3">{{ __('Отметьте пользователей, которым разрешён доступ к мессенджеру (чат и звонки). При первом включении для них создаётся учётная запись в TrueConf.') }}</p>
            @if($trueconf_configured)
                <form method="post" action="{{ route('lk.admin.messenger.sync') }}" class="mb-3 d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">{{ __('Синхронизировать пользователей с сервером TrueConf') }}</button>
                </form>
            @endif
            <form method="post" action="{{ route('lk.admin.messenger.update') }}">
                @csrf
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Имя') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Доступ к мессенджеру') }}</th>
                                <th>{{ __('Логин TrueConf') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="custom-switch custom-switch-primary-inverse custom-switch-small">
                                            <input class="custom-switch-input" id="messenger-user-{{ $user->id }}" type="checkbox" name="users[]" value="{{ $user->id }}" {{ $user->messenger_access ? 'checked' : '' }}>
                                            <label class="custom-switch-btn" for="messenger-user-{{ $user->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="text-muted small">{{ $user->trueconf_login ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
            </form>
        </div>
    </div>
@endsection
