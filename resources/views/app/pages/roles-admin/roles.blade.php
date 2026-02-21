@extends('layouts.app.app')

@section('title', __('Роли'))

@section('header')
    <h1>{{ __('Роли') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.roles.users') }}">{{ __('Управление ролями') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Роли') }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 lk-card-header-actions">
                <p class="text-muted mb-0">{{ __('Создавайте роли и назначайте им разрешения.') }}</p>
                <a href="{{ route('lk.admin.roles.role.create') }}" class="btn btn-primary btn-sm">{{ __('Создать роль') }}</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-mobile-stack">
                    <thead>
                        <tr>
                            <th>{{ __('Название') }}</th>
                            <th>{{ __('Описание (slug)') }}</th>
                            <th>{{ __('Разрешений') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td data-label="{{ __('Название') }}">{{ $role->name }}</td>
                                <td class="text-muted small" data-label="{{ __('Описание (slug)') }}">{{ $role->slug ?? '—' }}</td>
                                <td data-label="{{ __('Разрешений') }}">{{ $role->permissions_count }}</td>
                                <td class="actions-cell">
                                    <div class="table-actions-desktop d-none d-md-block">
                                        <a href="{{ route('lk.admin.roles.role.edit', $role) }}" class="btn btn-outline-primary btn-sm mr-1">{{ __('Изменить') }}</a>
                                        @if(!in_array($role->name, ['roles-admin'], true))
                                            <form method="post" action="{{ route('lk.admin.roles.role.destroy', $role) }}" class="d-inline" onsubmit="return confirm('{{ __('Удалить роль?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Удалить') }}</button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="table-actions-mobile d-md-none dropdown">
                                        <button type="button" class="btn btn-outline-secondary btn-sm lk-actions-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">⋯</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('lk.admin.roles.role.edit', $role) }}">{{ __('Изменить') }}</a>
                                            @if(!in_array($role->name, ['roles-admin'], true))
                                                <form method="post" action="{{ route('lk.admin.roles.role.destroy', $role) }}" class="dropdown-item p-0" onsubmit="return confirm('{{ __('Удалить роль?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">{{ __('Удалить') }}</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
