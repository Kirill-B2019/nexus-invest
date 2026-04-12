@extends('layouts.app.app')

@section('title', __('Мои проекты'))

@section('header')
    <h1>{{ __('Мои проекты') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Проекты'), 'url' => route('lk.projects.my')],
        ['label' => __('Мои проекты')],
    ]" separator-margin="mb-5" />
    @include('layouts.app.flash')

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 lk-card-header-actions">
                <div>
                    <h5 class="card-title mb-1">{{ __('Мои проекты') }}</h5>
                    <p class="text-muted mb-0 small">{{ __('Здесь отображаются ваши проекты, заявки на размещение и статусы модерации.') }}</p>
                </div>
                <a href="{{ route('lk.projects.create') }}" class="btn btn-primary mt-2 mt-md-0">
                    <i class="simple-icon-plus"></i> {{ __('Новый проект') }}
                </a>
            </div>

            @if($projects->isEmpty())
                <p class="text-muted">{{ __('У вас пока нет проектов.') }} <a href="{{ route('lk.projects.create') }}">{{ __('Создать первый проект') }}</a></p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-mobile-stack">
                        <thead>
                            <tr>
                                <th>{{ __('Название') }}</th>
                                <th>{{ __('Статус') }}</th>
                                <th>{{ __('Обновлён') }}</th>
                                <th class="actions-cell">{{ __('Действия') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td data-label="{{ __('Название') }}">
                                    <a href="{{ $project->canEdit() ? route('lk.projects.edit', $project) : '#' }}">
                                        {{ $project->name ?: __('Без названия') }}
                                    </a>
                                </td>
                                <td data-label="{{ __('Статус') }}">
                                    @if($project->status === 'draft')
                                        <span class="badge badge-secondary">{{ \App\Models\Project::statusLabel($project->status) }}</span>
                                    @elseif($project->status === 'moderation')
                                        <span class="badge badge-warning">{{ \App\Models\Project::statusLabel($project->status) }}</span>
                                    @elseif($project->status === 'approved')
                                        <span class="badge badge-success">{{ \App\Models\Project::statusLabel($project->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ \App\Models\Project::statusLabel($project->status) }}</span>
                                    @endif
                                </td>
                                <td data-label="{{ __('Обновлён') }}">{{ $project->updated_at->format('d.m.Y H:i') }}</td>
                                <td class="actions-cell" data-label="{{ __('Действия') }}">
                                    <div class="table-actions-desktop d-none d-md-block">
                                        @if($project->canEdit())
                                            <a href="{{ route('lk.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary">{{ __('Редактировать') }}</a>
                                        @else
                                            <a href="{{ route('lk.projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary">{{ __('Просмотр') }}</a>
                                        @endif
                                    </div>
                                    <div class="table-actions-mobile d-md-none dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">
                                            {{ __('Действия') }}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if($project->canEdit())
                                                <a class="dropdown-item" href="{{ route('lk.projects.edit', $project) }}">{{ __('Редактировать') }}</a>
                                            @else
                                                <a class="dropdown-item" href="{{ route('lk.projects.edit', $project) }}">{{ __('Просмотр') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $projects->links() }}</div>
            @endif
        </div>
    </div>
@endsection
