@extends('layouts.app.app')

@section('title', __('Роли пользователя'))

@section('header')
    <h1>{{ __('Роли пользователя') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.roles.users') }}">{{ __('Управление ролями') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.roles.users') }}">{{ __('Пользователи') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-4">{{ __('Пользователь: :name (:email). Отметьте роли и разрешения, которые должны быть назначены.', ['name' => $user->name, 'email' => $user->email]) }}</p>
            <form method="post" action="{{ route('lk.admin.roles.user.update', $user) }}">
                @csrf
                @method('PATCH')
                <div class="form-group mb-4">
                    <label class="form-label font-weight-medium">{{ __('Роли') }}</label>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}@if($role->slug)<span class="text-muted small"> — {{ $role->slug }}</span>@endif
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="form-label font-weight-medium">{{ __('Разрешения (прямое назначение)') }}</label>
                    <div class="row">
                        @foreach($permissions as $perm)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="perm-{{ $perm->id }}" name="permissions[]" value="{{ $perm->id }}" {{ $user->hasPermissionTo($perm->name) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="perm-{{ $perm->id }}">
                                        {{ $perm->name }}@if($perm->slug)<span class="text-muted small"> — {{ $perm->slug }}</span>@endif
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($permissions->isEmpty())
                        <p class="text-muted small">{{ __('Нет разрешений в системе.') }}</p>
                    @endif
                </div>
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a href="{{ route('lk.admin.roles.users') }}" class="btn btn-outline-secondary">{{ __('Отмена') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
