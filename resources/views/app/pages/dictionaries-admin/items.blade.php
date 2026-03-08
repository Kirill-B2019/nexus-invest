@extends('layouts.app.app')

@section('title', $dictionary->name)

@section('header')
    <h1>{{ $dictionary->name }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.settings.dictionaries.index') }}">{{ __('Справочники') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $dictionary->name }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-3">{{ $dictionary->description ?: __('Элементы справочника.') }}</p>
            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start lk-card-header-actions mb-3">
                <a href="{{ route('lk.admin.settings.dictionaries.item.create', $dictionary) }}" class="btn btn-primary btn-sm">{{ __('Добавить элемент') }}</a>
                <a href="{{ route('lk.admin.settings.dictionaries.dictionary.edit', $dictionary) }}" class="btn btn-outline-secondary btn-sm">{{ __('Изменить справочник') }}</a>
                <a href="{{ route('lk.admin.settings.dictionaries.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('К списку справочников') }}</a>
            </div>

            <form method="get" action="{{ route('lk.admin.settings.dictionaries.show', $dictionary) }}" class="mb-3" id="dictionaries-search-form">
                <input type="hidden" name="sort" value="{{ $sortBy }}">
                <input type="hidden" name="dir" value="{{ $sortDir }}">
                <div class="position-relative" id="dictionaries-search-wrap">
                    <div class="input-group">
                        <input type="search" class="form-control" name="q" id="dictionaries-search-input" value="{{ $searchQuery }}" placeholder="{{ __('Поиск по коду, названию, описанию…') }}" maxlength="200" aria-label="{{ __('Поиск') }}" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-primary">{{ __('Искать') }}</button>
                            @if($searchQuery !== '')
                                <a href="{{ route('lk.admin.settings.dictionaries.show', $dictionary) }}" class="btn btn-outline-secondary">{{ __('Сбросить') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="list-group position-absolute shadow-sm border bg-white" id="dictionaries-search-dropdown" style="display: none; z-index: 1050; max-height: 280px; overflow-y: auto; left: 0; right: 0; top: 100%; margin-top: 2px; min-width: 200px;"></div>
                </div>
            </form>

            @if($searchQuery !== '')
                <p class="text-muted small mb-2">{{ __('Найдено записей: :count', ['count' => $items->count()]) }}</p>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-mobile-stack">
                    <thead>
                        <tr>
                            @php
                                $baseUrl = route('lk.admin.settings.dictionaries.show', $dictionary);
                                $params = array_filter(['q' => $searchQuery ?: null]);
                                $sortLink = function ($col) use ($baseUrl, $params, $sortBy, $sortDir) {
                                    $dir = ($sortBy === $col && $sortDir === 'asc') ? 'desc' : 'asc';
                                    $url = $baseUrl . '?' . http_build_query(array_merge($params, ['sort' => $col, 'dir' => $dir]));
                                    return $url;
                                };
                            @endphp
                            <th><a href="{{ $sortLink('code') }}" class="text-dark">{{ __('Код') }}@if($sortBy === 'code') {{ $sortDir === 'asc' ? ' ↑' : ' ↓' }}@endif</a></th>
                            <th><a href="{{ $sortLink('name') }}" class="text-dark">{{ __('Название') }}@if($sortBy === 'name') {{ $sortDir === 'asc' ? ' ↑' : ' ↓' }}@endif</a></th>
                            @if($dictionary->code === 'regions')
                                <th><a href="{{ $sortLink('item_type') }}" class="text-dark">{{ __('Тип') }}@if($sortBy === 'item_type') {{ $sortDir === 'asc' ? ' ↑' : ' ↓' }}@endif</a></th>
                                <th><a href="{{ $sortLink('country_code') }}" class="text-dark">{{ __('Страна') }}@if($sortBy === 'country_code') {{ $sortDir === 'asc' ? ' ↑' : ' ↓' }}@endif</a></th>
                                <th><a href="{{ $sortLink('map_code') }}" class="text-dark">{{ __('Код на карте') }}@if($sortBy === 'map_code') {{ $sortDir === 'asc' ? ' ↑' : ' ↓' }}@endif</a></th>
                            @endif
                            <th>{{ __('Описание') }}</th>
                            <th><a href="{{ $sortLink('is_active') }}" class="text-dark">{{ __('Активен') }}@if($sortBy === 'is_active') {{ $sortDir === 'asc' ? ' ↑' : ' ↓' }}@endif</a></th>
                            @if($dictionary->code === 'regulatory_documents')
                            <th>{{ __('Ссылка') }}</th>
                            <th><a href="{{ $sortLink('is_ru') }}" class="text-dark">{{ __('RU') }}@if($sortBy === 'is_ru') {{ $sortDir === 'asc' ? ' ↑' : ' ↓' }}@endif</a></th>
                            @endif
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td data-label="{{ __('Код') }}">{{ $item->code }}</td>
                                <td data-label="{{ __('Название') }}">{{ $item->name }}</td>
                                @if($dictionary->code === 'regions')
                                    <td data-label="{{ __('Тип') }}">
                                        @if($item->item_type === 'country') {{ __('Страна') }}
                                        @elseif($item->item_type === 'region') {{ __('Регион') }}
                                        @elseif($item->item_type === 'city') {{ __('Город') }}
                                        @else — @endif
                                    </td>
                                    <td data-label="{{ __('Страна') }}">{{ $item->country_code ?? '—' }}</td>
                                    <td data-label="{{ __('Код на карте') }}">{{ $item->map_code ?? '—' }}</td>
                                @endif
                                <td class="text-muted small" data-label="{{ __('Описание') }}">{{ $item->description ? \Illuminate\Support\Str::limit($item->description, 60) : '—' }}</td>
                                <td data-label="{{ __('Активен') }}">{{ $item->is_active ? __('Да') : __('Нет') }}</td>
                                @if($dictionary->code === 'regulatory_documents')
                                <td data-label="{{ __('Ссылка') }}">
                                    @if(!empty($item->document_url))
                                    <a href="{{ $item->document_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary btn-sm">{{ __('Открыть') }}</a>
                                    @else
                                    <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td data-label="{{ __('RU') }}">{{ ($item->is_ru ?? false) ? __('Да') : __('Нет') }}</td>
                                @endif
                                @php
                                    $itemId = (int) ($item->id ?? 0);
                                    $hasValidId = $itemId > 0;
                                    $itemEditUrl = $hasValidId ? url('/lk/admin/settings/dictionaries/' . (int) $dictionary->id . '/items/' . $itemId . '/edit') : '#';
                                    $itemDestroyUrl = $hasValidId ? url('/lk/admin/settings/dictionaries/' . (int) $dictionary->id . '/items/' . $itemId) : '#';
                                @endphp
                                <td class="actions-cell">
                                    @if($hasValidId)
                                    <div class="table-actions-desktop d-none d-md-block">
                                        <a href="{{ $itemEditUrl }}" class="btn btn-outline-primary btn-sm mr-1">{{ __('Изменить') }}</a>
                                        <form method="post" action="{{ $itemDestroyUrl }}" class="d-inline" onsubmit="return confirm('{{ __('Удалить элемент?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Удалить') }}</button>
                                        </form>
                                    </div>
                                    <div class="table-actions-mobile d-md-none dropdown">
                                        <button type="button" class="btn btn-outline-secondary btn-sm lk-actions-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">⋯</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ $itemEditUrl }}">{{ __('Изменить') }}</a>
                                            <form method="post" action="{{ $itemDestroyUrl }}" class="dropdown-item p-0" onsubmit="return confirm('{{ __('Удалить элемент?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">{{ __('Удалить') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                    <span class="text-muted small" title="{{ __('Нет идентификатора записи') }}">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $dictionary->code === 'regions' ? 8 : ($dictionary->code === 'regulatory_documents' ? 7 : 5) }}" class="text-muted">{{ __('Нет элементов. Добавьте первый элемент.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    (function() {
        var wrap = document.getElementById('dictionaries-search-wrap');
        var input = document.getElementById('dictionaries-search-input');
        var dropdown = document.getElementById('dictionaries-search-dropdown');
        var searchUrl = '{{ route('lk.admin.settings.dictionaries.search', $dictionary) }}';
        var debounceTimer = null;
        var minChars = 2;

        function hideDropdown() {
            dropdown.style.display = 'none';
            dropdown.innerHTML = '';
        }

        function showDropdown(html) {
            dropdown.innerHTML = html;
            dropdown.style.display = (html ? 'block' : 'none');
        }

        function doSearch() {
            var q = (input.value || '').trim();
            if (q.length < minChars) {
                hideDropdown();
                return;
            }
            var url = searchUrl + '?q=' + encodeURIComponent(q);
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var items = data.items || [];
                    if (items.length === 0) {
                        showDropdown('<div class="list-group-item text-muted small">' + '{{ __('Совпадений не найдено') }}' + '</div>');
                        return;
                    }
                    var html = items.map(function(it) {
                        return '<a href="' + (it.edit_url || '#') + '" class="list-group-item list-group-item-action">' +
                            '<span class="font-weight-medium">' + escapeHtml(it.name) + '</span>' +
                            (it.code ? ' <span class="text-muted small">' + escapeHtml(it.code) + '</span>' : '') +
                            '</a>';
                    }).join('');
                    showDropdown(html);
                })
                .catch(function() { hideDropdown(); });
        }

        function escapeHtml(s) {
            var div = document.createElement('div');
            div.textContent = s;
            return div.innerHTML;
        }

        input.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(doSearch, 300);
        });
        input.addEventListener('focus', function() {
            if ((input.value || '').trim().length >= minChars) { doSearch(); }
        });
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') { hideDropdown(); input.blur(); }
        });
        document.addEventListener('click', function(e) {
            if (wrap && !wrap.contains(e.target)) { hideDropdown(); }
        });
    })();
    </script>
    @endpush
@endsection
