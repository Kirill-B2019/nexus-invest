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
            <p class="text-muted mb-3">{{ __('Пользователь: :name (:email). Отметьте роли, которые должны быть назначены.', ['name' => $user->name, 'email' => $user->email]) }}</p>
            <form method="post" action="{{ route('lk.admin.roles.user.update', $user) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    @foreach($roles as $role)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a href="{{ route('lk.admin.roles.users') }}" class="btn btn-outline-secondary">{{ __('Отмена') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
