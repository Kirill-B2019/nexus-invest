@extends('layouts.app.app')

@section('title', __('Пользователи'))

@section('header')
    <h1>{{ __('Пользователи') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Управление ролями'), 'url' => route('lk.admin.roles.users')],
        ['label' => __('Пользователи')],
    ]" separator-margin="mb-4" />

    @include('layouts.app.flash')

    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-3">{{ __('Назначьте роли пользователям. Нажмите «Изменить роли» у нужного пользователя.') }}</p>
            <div class="table-responsive">
                <table class="table table-hover table-mobile-stack">
                    <thead>
                        <tr>
                            <th>{{ __('Имя') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Роли') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td data-label="{{ __('Имя') }}">{{ $user->name }}</td>
                                <td data-label="{{ __('Email') }}">{{ $user->email }}</td>
                                <td data-label="{{ __('Роли') }}">
                                    @forelse($user->roles as $r)
                                        <span class="badge badge-secondary mr-1">{{ $r->name }}</span>
                                    @empty
                                        <span class="text-muted">—</span>
                                    @endforelse
                                </td>
                                <td class="actions-cell">
                                    <div class="table-actions-desktop d-none d-md-block">
                                        <a href="{{ route('lk.admin.roles.user.edit', $user) }}" class="btn btn-outline-primary btn-sm">{{ __('Изменить роли') }}</a>
                                    </div>
                                    <div class="table-actions-mobile d-md-none dropdown">
                                        <button type="button" class="btn btn-outline-secondary btn-sm lk-actions-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">⋯</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('lk.admin.roles.user.edit', $user) }}">{{ __('Изменить роли') }}</a>
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
