@extends('layouts.app.app')

@section('title', $permission ? __('Редактирование разрешения') : __('Создание разрешения'))

@section('header')
    <h1>{{ $permission ? __('Редактирование разрешения') : __('Создание разрешения') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Управление ролями'), 'url' => route('lk.admin.roles.users')],
        ['label' => __('Разрешения'), 'url' => route('lk.admin.roles.permissions')],
        ['label' => $permission ? $permission->name : __('Новое')],
    ]" separator-margin="mb-4" />

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ $permission ? route('lk.admin.roles.permission.update', $permission) : route('lk.admin.roles.permission.store') }}">
                @csrf
                @if($permission) @method('PATCH') @endif
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Название разрешения') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $permission?->name) }}" required maxlength="255" placeholder="например: use-messenger">
                </div>
                <div class="form-group">
                    <label for="slug" class="form-label">{{ __('Описание (slug)') }}</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $permission?->slug) }}" maxlength="500" placeholder="{{ __('Краткое описание разрешения') }}">
                </div>
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a href="{{ route('lk.admin.roles.permissions') }}" class="btn btn-outline-secondary">{{ __('Отмена') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
