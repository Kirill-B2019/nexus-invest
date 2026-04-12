@extends('layouts.app.app')

@section('title', __('Справочники'))

@section('header')
    <h1>{{ __('Справочники') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Управление'), 'url' => route('lk.admin.settings.dictionaries.index')],
        ['label' => __('Общие настройки'), 'url' => route('lk.admin.settings.dictionaries.index')],
        ['label' => __('Справочники')],
    ]" separator-margin="mb-4" />
    @include('layouts.app.flash')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between lk-card-header-actions mb-3">
                <p class="text-muted mb-0">{{ __('Группы и справочники для системной классификации. Выберите справочник для редактирования элементов.') }}</p>
                <span class="badge badge-light">{{ __('Вариант UI: карточки + быстрые действия') }}</span>
            </div>
            <form method="get" action="{{ route('lk.admin.settings.dictionaries.index') }}" class="mb-3" id="dictionaries-index-search-form">
                <input type="hidden" name="sort" value="{{ $sortBy ?? 'sort_order' }}">
                <input type="hidden" name="dir" value="{{ $sortDir ?? 'asc' }}">
                <div class="position-relative" id="dictionaries-index-search-wrap">
                    <div class="input-group">
                        <input type="search" class="form-control" name="q" id="dictionaries-index-search-input" value="{{ $searchQuery ?? '' }}" placeholder="{{ __('Поиск по группе и справочникам…') }}" maxlength="200" aria-label="{{ __('Поиск') }}" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-primary">{{ __('Искать') }}</button>
                            @if(!empty($searchQuery))
                                <a href="{{ route('lk.admin.settings.dictionaries.index') }}" class="btn btn-outline-secondary">{{ __('Сбросить') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="list-group lk-dictionaries-search-dropdown position-absolute shadow-sm border" id="dictionaries-index-search-dropdown" style="display: none; z-index: 1050; max-height: 280px; overflow-y: auto; left: 0; right: 0; top: 100%; margin-top: 2px; min-width: 200px;"></div>
                </div>
            </form>
            @if(!empty($searchQuery))
                <p class="text-muted small mb-2">{{ __('Найдено групп: :count', ['count' => $groups->count()]) }}</p>
            @endif
            @php
                $indexSortBy = $sortBy ?? 'sort_order';
                $indexSortDir = $sortDir ?? 'asc';
                $indexParams = array_filter(['q' => $searchQuery ?? '']);
                $indexSortLink = function ($col) use ($indexParams, $indexSortBy, $indexSortDir) {
                    $dir = ($indexSortBy === $col && $indexSortDir === 'asc') ? 'desc' : 'asc';
                    return route('lk.admin.settings.dictionaries.index', array_merge($indexParams, ['sort' => $col, 'dir' => $dir]));
                };
            @endphp
            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start lk-card-header-actions">
                <span class="align-self-center small text-muted mr-2">{{ __('Сортировка групп:') }}</span>
                <a href="{{ $indexSortLink('sort_order') }}" class="btn btn-outline-secondary btn-sm">{{ __('По порядку') }}{{ $indexSortBy === 'sort_order' ? ($indexSortDir === 'asc' ? ' ↑' : ' ↓') : '' }}</a>
                <a href="{{ $indexSortLink('name') }}" class="btn btn-outline-secondary btn-sm">{{ __('По названию') }}{{ $indexSortBy === 'name' ? ($indexSortDir === 'asc' ? ' ↑' : ' ↓') : '' }}</a>
                <a href="{{ route('lk.admin.settings.dictionaries.group.create') }}" class="btn btn-outline-primary btn-sm ml-2">{{ __('Добавить группу') }}</a>
                <a href="{{ route('lk.admin.settings.dictionaries.dictionary.create') }}" class="btn btn-primary btn-sm">{{ __('Добавить справочник') }}</a>
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3 pt-3 border-top lk-dictionaries-density" id="dictionaries-index-density-wrap">
                <span class="small text-muted mb-0">{{ __('Плотность таблиц в группах:') }}</span>
                <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('Плотность таблиц') }}">
                    <button type="button" class="btn btn-outline-secondary lk-density-btn" data-density="normal" aria-pressed="true">{{ __('Обычная') }}</button>
                    <button type="button" class="btn btn-outline-secondary lk-density-btn" data-density="compact" aria-pressed="false">{{ __('Компактная') }}</button>
                </div>
            </div>
        </div>
    </div>

    @forelse($groups as $group)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                    <div class="min-w-0">
                        <h5 class="card-title mb-1">{{ $group->name }}</h5>
                        @if($group->description)
                            <p class="text-muted small mb-1">{{ $group->description }}</p>
                        @endif
                        <span class="badge badge-secondary">{{ $group->code }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="table-actions-desktop d-none d-md-block">
                            <a href="{{ route('lk.admin.settings.dictionaries.group.edit', $group) }}" class="btn btn-outline-secondary btn-sm mr-1">{{ __('Изменить') }}</a>
                            <form method="post" action="{{ route('lk.admin.settings.dictionaries.group.destroy', $group) }}" class="d-inline" data-swal-confirm="{{ __('Удалить группу и все её справочники?') }}" data-swal-title="{{ __('Подтверждение') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Удалить') }}</button>
                            </form>
                        </div>
                        <div class="table-actions-mobile d-md-none dropdown">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">{{ __('Действия') }}</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('lk.admin.settings.dictionaries.group.edit', $group) }}">{{ __('Изменить') }}</a>
                                <form method="post" action="{{ route('lk.admin.settings.dictionaries.group.destroy', $group) }}" class="dropdown-item p-0" data-swal-confirm="{{ __('Удалить группу и все её справочники?') }}" data-swal-title="{{ __('Подтверждение') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">{{ __('Удалить') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-mobile-stack dictionaries-admin-table mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('Справочник') }}</th>
                                <th>{{ __('Код') }}</th>
                                <th class="actions-cell">{{ __('Действия') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($group->dictionaries as $dict)
                                <tr>
                                    <td data-label="{{ __('Справочник') }}">
                                        <a href="{{ route('lk.admin.settings.dictionaries.show', $dict) }}">{{ $dict->name }}</a>
                                    </td>
                                    <td data-label="{{ __('Код') }}" class="text-muted small">{{ $dict->code }}</td>
                                    <td class="actions-cell">
                                        <div class="table-actions-desktop d-none d-md-block">
                                            <a href="{{ route('lk.admin.settings.dictionaries.dictionary.edit', $dict) }}" class="btn btn-outline-secondary btn-sm mr-1">{{ __('Изм.') }}</a>
                                            <form method="post" action="{{ route('lk.admin.settings.dictionaries.dictionary.destroy', $dict) }}" class="d-inline" data-swal-confirm="{{ __('Удалить справочник?') }}" data-swal-title="{{ __('Подтверждение') }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Удалить') }}</button>
                                            </form>
                                        </div>
                                        <div class="table-actions-mobile d-md-none dropdown">
                                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="{{ __('Действия') }}" title="{{ __('Действия') }}">{{ __('Действия') }}</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('lk.admin.settings.dictionaries.show', $dict) }}">{{ __('Открыть') }}</a>
                                                <a class="dropdown-item" href="{{ route('lk.admin.settings.dictionaries.dictionary.edit', $dict) }}">{{ __('Изменить') }}</a>
                                                <form method="post" action="{{ route('lk.admin.settings.dictionaries.dictionary.destroy', $dict) }}" class="dropdown-item p-0" data-swal-confirm="{{ __('Удалить справочник?') }}" data-swal-title="{{ __('Подтверждение') }}">
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
                                    <td colspan="3" class="text-muted">{{ __('Нет справочников в группе.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-0">{{ __('Нет групп. Добавьте группу или выполните сидер RefDictionaryGroupsSeeder.') }}</p>
            </div>
        </div>
    @endforelse

    @push('scripts')
    <script>
    (function() {
        var wrap = document.getElementById('dictionaries-index-search-wrap');
        var input = document.getElementById('dictionaries-index-search-input');
        var dropdown = document.getElementById('dictionaries-index-search-dropdown');
        var searchUrl = '{{ route('lk.admin.settings.dictionaries.search.index') }}';
        var debounceTimer = null;
        var minChars = 2;

        function hideDropdown() {
            if (dropdown) { dropdown.style.display = 'none'; dropdown.innerHTML = ''; }
        }

        function showDropdown(html) {
            if (!dropdown) return;
            dropdown.innerHTML = html || '';
            dropdown.style.display = (html ? 'block' : 'none');
        }

        function escapeHtml(s) {
            if (!s) return '';
            var div = document.createElement('div');
            div.textContent = s;
            return div.innerHTML;
        }

        function doSearch() {
            var q = (input && input.value ? input.value : '').trim();
            if (q.length < minChars) { hideDropdown(); return; }
            fetch(searchUrl + '?q=' + encodeURIComponent(q), { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var items = data.items || [];
                    if (items.length === 0) {
                        showDropdown('<div class="list-group-item text-muted small">' + '{{ __('Совпадений не найдено') }}' + '</div>');
                        return;
                    }
                    var html = items.map(function(it) {
                        return '<a href="' + (it.url || '#') + '" class="list-group-item list-group-item-action">' +
                            '<span class="font-weight-medium">' + escapeHtml(it.name) + '</span>' +
                            (it.code ? ' <span class="text-muted small">' + escapeHtml(it.code) + '</span>' : '') +
                            (it.group_name ? ' <span class="d-block small text-muted">' + escapeHtml(it.group_name) + '</span>' : '') +
                            '</a>';
                    }).join('');
                    showDropdown(html);
                })
                .catch(function() { hideDropdown(); });
        }

        if (input) {
            input.addEventListener('input', function() { clearTimeout(debounceTimer); debounceTimer = setTimeout(doSearch, 300); });
            input.addEventListener('focus', function() { if ((input.value || '').trim().length >= minChars) doSearch(); });
            input.addEventListener('keydown', function(e) { if (e.key === 'Escape') { hideDropdown(); input.blur(); } });
        }
        document.addEventListener('click', function(e) { if (wrap && !wrap.contains(e.target)) hideDropdown(); });
    })();
    (function() {
        var KEY = 'lk_dictionaries_index_compact';
        var tables = document.querySelectorAll('table.dictionaries-admin-table');
        var wrap = document.getElementById('dictionaries-index-density-wrap');
        if (!tables.length || !wrap) return;
        var btns = wrap.querySelectorAll('.lk-density-btn');
        function setCompact(on) {
            tables.forEach(function(t) {
                t.classList.toggle('table-dictionaries-compact', on);
                t.classList.toggle('table-sm', on);
            });
            btns.forEach(function(b) {
                var isC = b.getAttribute('data-density') === 'compact';
                var sel = on === isC;
                b.classList.toggle('btn-primary', sel);
                b.classList.toggle('btn-outline-secondary', !sel);
                b.setAttribute('aria-pressed', sel ? 'true' : 'false');
            });
            try { localStorage.setItem(KEY, on ? '1' : '0'); } catch (e) {}
        }
        var stored = null;
        try { stored = localStorage.getItem(KEY); } catch (e) {}
        setCompact(stored === '1');
        btns.forEach(function(b) {
            b.addEventListener('click', function() {
                setCompact(b.getAttribute('data-density') === 'compact');
            });
        });
    })();
    </script>
    @endpush
@endsection
