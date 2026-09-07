@extends('layouts.app.app')

@section('title', __('Управление лентой новостей'))

@section('header')
    <h1>{{ __('Управление лентой новостей') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Настройки'), 'url' => route('lk.admin.settings.index')],
        ['label' => __('Управление лентой новостей')],
    ]" separator-margin="mb-4" />

    @include('layouts.app.flash')

    <div class="card mb-4">
        <div class="card-body">
            <p class="text-muted mb-3">
                {{ __('Единая лента: публикации Дзен, редакционные статьи сайта и (позже) информагентство. Публичные материалы — на странице «Новости».') }}
                <a href="{{ route('news.index') }}" target="_blank" rel="noopener noreferrer">{{ route('news.index') }}</a>
            </p>

            <div class="d-flex flex-wrap gap-2 mb-3 lk-form-actions">
                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('update-news-feed'))
                    <form method="post" action="{{ route('lk.admin.news-feed.update') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Обновить Дзен') }}</button>
                    </form>
                    @if($agencyEnabled)
                        <form method="post" action="{{ route('lk.admin.news-feed.agency-sync') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">{{ __('Обновить агентство') }}</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-outline-secondary" disabled title="{{ __('Включите news.sources.agency.enabled') }}">{{ __('Обновить агентство') }}</button>
                    @endif
                @endif
                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('manage-news'))
                    <a href="{{ route('lk.admin.news-feed.create') }}" class="btn btn-success">{{ __('Добавить статью') }}</a>
                @endif
            </div>
            <p class="text-muted small mb-0">
                {{ __('Канал Дзен:') }}
                <a href="{{ $channelUrl }}" target="_blank" rel="noopener noreferrer">{{ $channelUrl }}</a>
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="get" class="row g-2 align-items-end mb-3">
                <div class="col-12 col-md-4">
                    <label class="form-label" for="filter-source">{{ __('Источник') }}</label>
                    <select name="source" id="filter-source" class="form-select">
                        <option value="">{{ __('Все') }}</option>
                        <option value="dzen" @selected(($filters['source'] ?? '') === 'dzen')>{{ __('Дзен') }}</option>
                        <option value="editorial" @selected(($filters['source'] ?? '') === 'editorial')>{{ __('Редакция') }}</option>
                        <option value="agency" @selected(($filters['source'] ?? '') === 'agency')>{{ __('Агентство') }}</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="filter-status">{{ __('Статус') }}</label>
                    <select name="status" id="filter-status" class="form-select">
                        <option value="">{{ __('Все') }}</option>
                        <option value="published" @selected(($filters['status'] ?? '') === 'published')>{{ __('Опубликовано') }}</option>
                        <option value="draft" @selected(($filters['status'] ?? '') === 'draft')>{{ __('Черновик') }}</option>
                        <option value="hidden" @selected(($filters['status'] ?? '') === 'hidden')>{{ __('Скрыто') }}</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <button type="submit" class="btn btn-outline-primary">{{ __('Фильтр') }}</button>
                    <a href="{{ route('lk.admin.news-feed.index') }}" class="btn btn-link">{{ __('Сбросить') }}</a>
                </div>
            </form>

            <div class="table-responsive mt-2">
                <table class="table table-hover table-sm table-mobile-stack">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Дата') }}</th>
                            <th>{{ __('Источник') }}</th>
                            <th>{{ __('Статус') }}</th>
                            <th>{{ __('Заголовок') }}</th>
                            <th class="text-end">{{ __('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($items ?? []) as $newsItem)
                            <tr>
                                <td class="text-nowrap text-muted small" data-label="{{ __('ID') }}">{{ $newsItem->getKey() }}</td>
                                <td class="text-nowrap text-muted small" data-label="{{ __('Дата') }}">{{ ($newsItem->published_at ?? $newsItem->created_at)?->format('d.m.Y H:i') ?? '—' }}</td>
                                <td data-label="{{ __('Источник') }}">{{ $newsItem->source_label }}</td>
                                <td data-label="{{ __('Статус') }}">
                                    @if($newsItem->status === 'published')
                                        <span class="badge bg-success">{{ __('Опубликовано') }}</span>
                                    @elseif($newsItem->status === 'draft')
                                        <span class="badge bg-secondary">{{ __('Черновик') }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ __('Скрыто') }}</span>
                                    @endif
                                </td>
                                <td data-label="{{ __('Заголовок') }}">
                                    {{ str()->limit($newsItem->title, 60) }}
                                    @if($newsItem->source === 'editorial' && $newsItem->status === 'published' && $newsItem->slug)
                                        <br><a class="small" href="{{ route('news.show', $newsItem->slug) }}" target="_blank" rel="noopener noreferrer">{{ __('Открыть на сайте') }}</a>
                                    @elseif($newsItem->url)
                                        <br><a class="small" href="{{ $newsItem->getRawOriginal('url') ?: $newsItem->url }}" target="_blank" rel="noopener noreferrer">{{ __('Внешняя ссылка') }}</a>
                                    @endif
                                </td>
                                <td class="text-end actions-cell">
                                    @php
                                        $canManageEditorial = auth()->user()->hasRole('super-admin') || auth()->user()->can('manage-news');
                                        $canManageExternal = auth()->user()->hasRole('super-admin') || auth()->user()->can('update-news-feed');
                                        $canAct = $newsItem->source === 'editorial' ? $canManageEditorial : $canManageExternal;
                                    @endphp
                                    <div class="table-actions-desktop d-none d-md-flex flex-wrap gap-1 justify-content-end">
                                        @if($newsItem->source === 'editorial' && $canManageEditorial)
                                            <a href="{{ route('lk.admin.news-feed.edit', $newsItem) }}" class="btn btn-outline-primary btn-sm">{{ __('Изменить') }}</a>
                                        @endif
                                        @if($canAct && $newsItem->status !== 'hidden')
                                            <form method="post" action="{{ route('lk.admin.news-feed.hide', $newsItem) }}" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-warning btn-sm">{{ __('Скрыть') }}</button>
                                            </form>
                                        @endif
                                        @if($canAct)
                                        <form method="post" action="{{ route('lk.admin.news-feed.destroy', $newsItem) }}" class="d-inline" data-swal-confirm="{{ __('Удалить запись?') }}" data-swal-title="{{ __('Подтверждение') }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Удалить') }}</button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="table-actions-mobile d-md-none dropdown">
                                        <button type="button" class="btn btn-outline-secondary btn-sm lk-actions-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}">⋯</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if($newsItem->source === 'editorial' && $canManageEditorial)
                                                <a class="dropdown-item" href="{{ route('lk.admin.news-feed.edit', $newsItem) }}">{{ __('Изменить') }}</a>
                                            @endif
                                            @if($canAct && $newsItem->status !== 'hidden')
                                                <form method="post" action="{{ route('lk.admin.news-feed.hide', $newsItem) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">{{ __('Скрыть') }}</button>
                                                </form>
                                            @endif
                                            @if($canAct)
                                            <form method="post" action="{{ route('lk.admin.news-feed.destroy', $newsItem) }}" data-swal-confirm="{{ __('Удалить запись?') }}" data-swal-title="{{ __('Подтверждение') }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">{{ __('Удалить') }}</button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">{{ __('Нет записей.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($items, 'links'))
                <div class="mt-3">{{ $items->links() }}</div>
            @endif
        </div>
    </div>
@endsection
