@extends('layouts.app.app')

@section('title', __('Управление лентой новостей'))

@section('header')
    <h1>{{ __('Управление лентой новостей') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Управление лентой новостей') }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-3">
                {{ __('Новости на главной странице берутся из канала Дзен. Нажмите «Обновить ленту», чтобы загрузить последние публикации.') }}
                <a href="{{ $channelUrl }}" target="_blank" rel="noopener noreferrer">{{ $channelUrl }}</a>
            </p>
            <form method="post" action="{{ route('lk.admin.news-feed.update') }}" class="mb-3 lk-form-actions-inline">
                @csrf
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Обновить ленту') }}</button>
                </div>
            </form>
            <p class="text-muted small mb-0">{{ __('При обновлении ленты картинки обложек скачиваются в storage и сохраняются в БД. Новости на главной выводятся по дате публикации (сначала новые).') }}</p>
            <div class="table-responsive mt-3">
                <table class="table table-hover table-sm table-mobile-stack">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Дата') }}</th>
                            <th>{{ __('Заголовок') }}</th>
                            <th>{{ __('Ссылка') }}</th>
                            <th class="text-end">{{ __('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($items ?? []) as $newsItem)
                            <tr>
                                <td class="text-nowrap text-muted small" data-label="{{ __('ID') }}">
                                    <span title="{{ __('Внутренний ID') }}">{{ $newsItem->getKey() ?? $newsItem->id ?? '—' }}</span>
                                    @if($newsItem->external_id)
                                        <br><span class="text-muted" style="font-size:0.85em" title="{{ __('ID в источнике (Дзен)') }}">{{ Str::limit($newsItem->external_id, 12) }}</span>
                                    @endif
                                </td>
                                <td class="text-nowrap text-muted small" data-label="{{ __('Дата') }}">{{ ($newsItem->published_at ?? $newsItem->created_at)?->format('d.m.Y H:i') ?? '—' }}</td>
                                <td data-label="{{ __('Заголовок') }}">{{ str()->limit($newsItem->title, 60) }}</td>
                                <td data-label="{{ __('Ссылка') }}"><a href="{{ $newsItem->url }}" target="_blank" rel="noopener noreferrer" class="small">{{ __('Открыть') }}</a></td>
                                <td class="text-end actions-cell">
                                    @if($newsItem->getKey())
                                    <div class="table-actions-desktop d-none d-md-block">
                                        <form method="post" action="{{ route('lk.admin.news-feed.destroy', ['newsFeedItem' => $newsItem->getKey()]) }}" class="d-inline" data-swal-confirm="{{ __('Удалить статью с сайта? Картинка также будет удалена.') }}" data-swal-title="{{ __('Подтверждение') }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Удалить') }}</button>
                                        </form>
                                    </div>
                                    <div class="table-actions-mobile d-md-none dropdown">
                                        <button type="button" class="btn btn-outline-secondary btn-sm lk-actions-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">⋯</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form method="post" action="{{ route('lk.admin.news-feed.destroy', ['newsFeedItem' => $newsItem->getKey()]) }}" class="dropdown-item p-0" data-swal-confirm="{{ __('Удалить статью с сайта? Картинка также будет удалена.') }}" data-swal-title="{{ __('Подтверждение') }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">{{ __('Удалить') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">{{ __('Нет записей. Нажмите «Обновить ленту».') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
