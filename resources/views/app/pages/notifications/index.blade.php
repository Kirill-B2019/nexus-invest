@extends('layouts.app.app')

@section('title', __('Уведомления'))

@section('header')
    <h1>{{ __('Уведомления') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Уведомления') }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-3 lk-card-header-actions">
                <span class="text-muted mr-2">{{ __('Показать:') }}</span>
                <a href="{{ route('lk.notifications.index', ['filter' => 'active']) }}" class="btn btn-sm {{ ($filter ?? 'active') === 'active' ? 'btn-primary' : 'btn-outline-secondary' }}">{{ __('Активные') }}</a>
                <a href="{{ route('lk.notifications.index', ['filter' => 'unread']) }}" class="btn btn-sm {{ ($filter ?? '') === 'unread' ? 'btn-primary' : 'btn-outline-secondary' }}">{{ __('Непрочитанные') }}</a>
                <a href="{{ route('lk.notifications.index', ['filter' => 'expired']) }}" class="btn btn-sm {{ ($filter ?? '') === 'expired' ? 'btn-primary' : 'btn-outline-secondary' }}">{{ __('Истёкшие') }}</a>
                @if(($filter ?? 'active') !== 'expired')
                    <form method="post" action="{{ route('lk.notifications.mark-all-read') }}" class="d-inline ml-auto">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary btn-sm">{{ __('Отметить все прочитанными') }}</button>
                    </form>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-sm table-mobile-stack">
                    <thead>
                        <tr>
                            <th>{{ __('Тип') }}</th>
                            <th>{{ __('Важность') }}</th>
                            <th>{{ __('Заголовок') }}</th>
                            <th>{{ __('Дата') }}</th>
                            <th class="text-end">{{ __('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $n)
                            @php
                                $data = $n->data ?? [];
                                $importance = $data['importance'] ?? 'normal';
                                $importanceLabels = ['low' => __('Низкая'), 'normal' => __('Обычная'), 'high' => __('Высокая'), 'urgent' => __('Срочная')];
                                $typeLabel = ($data['type'] ?? '') === 'system' ? __('Системное') : __('Ручное');
                            @endphp
                            <tr class="{{ $n->read_at ? '' : 'table-active' }}">
                                <td data-label="{{ __('Тип') }}" class="text-muted small">{{ $typeLabel }}</td>
                                <td data-label="{{ __('Важность') }}">
                                    <span class="badge badge-{{ $importance === 'urgent' ? 'danger' : ($importance === 'high' ? 'warning' : 'secondary') }}">{{ $importanceLabels[$importance] ?? $importance }}</span>
                                </td>
                                <td data-label="{{ __('Заголовок') }}">
                                    <strong>{{ $data['title'] ?? '—' }}</strong>
                                    @if(!empty($data['body']))
                                        <div class="text-muted small mt-1">{{ Str::limit($data['body'], 100) }}</div>
                                    @endif
                                    @if(!empty($data['link']))
                                        <a href="{{ $data['link'] }}" target="_blank" rel="noopener noreferrer" class="small">{{ __('Открыть ссылку') }}</a>
                                    @endif
                                </td>
                                <td data-label="{{ __('Дата') }}" class="text-nowrap text-muted small">{{ $n->created_at->format('d.m.Y H:i') }}</td>
                                <td class="actions-cell text-end">
                                    @if(!$n->read_at)
                                        <div class="table-actions-desktop d-none d-md-block">
                                            <form method="post" action="{{ route('lk.notifications.mark-read', $n->id) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary btn-sm">{{ __('Прочитано') }}</button>
                                            </form>
                                        </div>
                                        <div class="table-actions-mobile d-md-none dropdown">
                                            <button type="button" class="btn btn-outline-secondary btn-sm lk-actions-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">⋯</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <form method="post" action="{{ route('lk.notifications.mark-read', $n->id) }}" class="dropdown-item p-0">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">{{ __('Прочитано') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted small">{{ __('Прочитано') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">{{ __('Нет уведомлений.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($notifications->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
