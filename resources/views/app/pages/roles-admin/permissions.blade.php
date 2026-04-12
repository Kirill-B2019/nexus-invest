@extends('layouts.app.app')

@section('title', __('Разрешения'))

@section('header')
    <h1>{{ __('Разрешения') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Управление ролями'), 'url' => route('lk.admin.roles.users')],
        ['label' => __('Разрешения')],
    ]" separator-margin="mb-4" />

    @include('layouts.app.flash')

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 lk-card-header-actions">
                <p class="text-muted mb-0">{{ __('Разрешения назначаются ролям в разделе «Роли».') }}</p>
                <a href="{{ route('lk.admin.roles.permission.create') }}" class="btn btn-primary btn-sm">{{ __('Создать разрешение') }}</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-mobile-stack">
                    <thead>
                        <tr>
                            <th>{{ __('Название') }}</th>
                            <th>{{ __('Описание (slug)') }}</th>
                            <th>{{ __('Guard') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $perm)
                            <tr>
                                <td data-label="{{ __('Название') }}">{{ $perm->name }}</td>
                                <td class="text-muted small" data-label="{{ __('Описание (slug)') }}">{{ $perm->slug ?? '—' }}</td>
                                <td data-label="{{ __('Guard') }}">{{ $perm->guard_name }}</td>
                                <td class="actions-cell">
                                    <div class="table-actions-desktop d-none d-md-block">
                                        <a href="{{ route('lk.admin.roles.permission.edit', $perm) }}" class="btn btn-outline-primary btn-sm mr-1">{{ __('Изменить') }}</a>
                                        <form method="post" action="{{ route('lk.admin.roles.permission.destroy', $perm) }}" class="d-inline" data-swal-confirm="{{ __('Удалить разрешение?') }}" data-swal-title="{{ __('Подтверждение') }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Удалить') }}</button>
                                        </form>
                                    </div>
                                    <div class="table-actions-mobile d-md-none dropdown">
                                        <button type="button" class="btn btn-outline-secondary btn-sm lk-actions-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">⋯</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('lk.admin.roles.permission.edit', $perm) }}">{{ __('Изменить') }}</a>
                                            <form method="post" action="{{ route('lk.admin.roles.permission.destroy', $perm) }}" class="dropdown-item p-0" data-swal-confirm="{{ __('Удалить разрешение?') }}" data-swal-title="{{ __('Подтверждение') }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">{{ __('Удалить') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">{{ __('Нет разрешений.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
