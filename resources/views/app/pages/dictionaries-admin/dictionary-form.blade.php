@extends('layouts.app.app')

@section('title', $dictionary ? __('Редактирование справочника') : __('Новый справочник'))

@section('header')
    <h1>{{ $dictionary ? __('Редактирование справочника') : __('Новый справочник') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.settings.dictionaries.index') }}">{{ __('Справочники') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $dictionary ? $dictionary->name : __('Новый справочник') }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ $dictionary ? route('lk.admin.settings.dictionaries.dictionary.update', $dictionary) : route('lk.admin.settings.dictionaries.dictionary.store') }}">
                @csrf
                @if($dictionary) @method('PATCH') @endif
                <div class="form-group">
                    <label for="ref_dictionary_group_id" class="form-label">{{ __('Группа') }}</label>
                    <select class="form-control" id="ref_dictionary_group_id" name="ref_dictionary_group_id" required>
                        @foreach($groups as $g)
                            <option value="{{ $g->id }}" {{ old('ref_dictionary_group_id', $selectedGroup?->id) == $g->id ? 'selected' : '' }}>{{ $g->name }} ({{ $g->code }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="code" class="form-label">{{ __('Код (латиница, цифры, дефис)') }}</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $dictionary?->code) }}" required maxlength="50" pattern="[a-z0-9_-]+" placeholder="countries">
                </div>
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Название') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dictionary?->name) }}" required maxlength="255" placeholder="{{ __('Страны') }}">
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">{{ __('Описание') }}</label>
                    <textarea class="form-control" id="description" name="description" rows="3" maxlength="2000">{{ old('description', $dictionary?->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="sort_order" class="form-label">{{ __('Порядок сортировки') }}</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $dictionary?->sort_order ?? 0) }}" min="0">
                </div>
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a href="{{ route('lk.admin.settings.dictionaries.index') }}" class="btn btn-outline-secondary">{{ __('Отмена') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
