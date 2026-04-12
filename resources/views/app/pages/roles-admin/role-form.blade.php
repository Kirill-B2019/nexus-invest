@extends('layouts.app.app')

@section('title', $role ? __('Редактирование роли') : __('Создание роли'))

@section('header')
    <h1>{{ $role ? __('Редактирование роли') : __('Создание роли') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Управление ролями'), 'url' => route('lk.admin.roles.users')],
        ['label' => __('Роли'), 'url' => route('lk.admin.roles.roles')],
        ['label' => $role ? $role->name : __('Новая')],
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
            <form method="post" action="{{ $role ? route('lk.admin.roles.role.update', $role) : route('lk.admin.roles.role.store') }}">
                @csrf
                @if($role) @method('PATCH') @endif
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Название роли') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role?->name) }}" required maxlength="255">
                </div>
                <div class="form-group">
                    <label for="slug" class="form-label">{{ __('Описание (slug)') }}</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $role?->slug) }}" maxlength="500" placeholder="{{ __('Краткое описание роли') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">{{ __('Разрешения') }}</label>
                    <div class="row">
                        @foreach($permissions as $perm)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    @php
                                        $checked = $role && $role->hasPermissionTo($perm->name);
                                    @endphp
                                    <input type="checkbox" class="custom-control-input" id="perm-{{ $perm->id }}" name="permissions[]" value="{{ $perm->id }}" {{ old('permissions') !== null ? (in_array($perm->id, old('permissions', [])) ? 'checked' : '') : ($checked ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="perm-{{ $perm->id }}">{{ $perm->name }}@if($perm->slug)<span class="text-muted small"> — {{ $perm->slug }}</span>@endif</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($permissions->isEmpty())
                        <p class="text-muted small">{{ __('Нет разрешений в системе. Они создаются сидерами или при первом использовании (например, use-messenger).') }}</p>
                    @endif
                </div>
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a href="{{ route('lk.admin.roles.roles') }}" class="btn btn-outline-secondary">{{ __('Отмена') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
