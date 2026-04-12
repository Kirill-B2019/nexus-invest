@extends('layouts.app.app')

@section('title', __('Модерация проектов'))

@section('header')
    <h1>{{ __('Модерация проектов') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Настройки'), 'url' => route('lk.admin.settings.index')],
        ['label' => __('Модерация проектов')],
    ]" separator-margin="mb-5" />
    @include('layouts.app.flash')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ __('Проекты на модерации') }}</h5>
            <p class="text-muted small mb-4">{{ __('Одобряйте или отклоняйте проекты, отправленные инициаторами. Инициатор получит уведомление о результате.') }}</p>

            <div class="table-responsive">
                <table class="table table-hover table-mobile-stack">
                    <thead>
                        <tr>
                            <th>{{ __('Название') }}</th>
                            <th>{{ __('Инициатор') }}</th>
                            <th>{{ __('Статус') }}</th>
                            <th>{{ __('Дата отправки') }}</th>
                            <th class="actions-cell">{{ __('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td data-label="{{ __('Название') }}">{{ $project->name ?: __('Без названия') }}</td>
                            <td data-label="{{ __('Инициатор') }}">{{ $project->user?->name ?? '—' }}</td>
                            <td data-label="{{ __('Статус') }}">
                                @if($project->status === 'moderation')
                                    <span class="badge badge-warning">{{ \App\Models\Project::statusLabel($project->status) }}</span>
                                @elseif($project->status === 'approved')
                                    <span class="badge badge-success">{{ \App\Models\Project::statusLabel($project->status) }}</span>
                                @else
                                    <span class="badge badge-danger">{{ \App\Models\Project::statusLabel($project->status) }}</span>
                                @endif
                            </td>
                            <td data-label="{{ __('Дата отправки') }}">{{ $project->submitted_at?->format('d.m.Y H:i') ?? '—' }}</td>
                            <td class="actions-cell">
                                <div class="table-actions-desktop d-none d-md-block">
                                    <a href="{{ route('lk.admin.projects.moderation.show', $project) }}" class="btn btn-sm btn-outline-primary">{{ __('Просмотр') }}</a>
                                </div>
                                <div class="table-actions-mobile d-md-none dropdown">
                                    <button type="button" class="btn btn-outline-secondary btn-sm lk-actions-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">⋯</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('lk.admin.projects.moderation.show', $project) }}">{{ __('Просмотр') }}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">{{ __('Нет проектов на модерации.') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $projects->links() }}</div>
        </div>
    </div>
@endsection
