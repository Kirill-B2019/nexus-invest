@extends('layouts.app.app')

@section('title', $item ? __('Редактирование элемента') : __('Новый элемент'))

@section('header')
    <h1>{{ $item ? __('Редактирование элемента') : __('Новый элемент') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Справочники'), 'url' => route('lk.admin.settings.dictionaries.index')],
        ['label' => $dictionary->name, 'url' => route('lk.admin.settings.dictionaries.show', $dictionary)],
        ['label' => $item ? $item->name : __('Новый элемент')],
    ]" separator-margin="mb-4" />

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ $item ? route('lk.admin.settings.dictionaries.item.update', [$dictionary, $item]) : route('lk.admin.settings.dictionaries.item.store', $dictionary) }}">
                @csrf
                @if($item) @method('PATCH') @endif
                <div class="form-group">
                    <label for="code" class="form-label">{{ __('Код') }}</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $item?->code) }}" required maxlength="100" placeholder="ru">
                </div>
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Название') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item?->name) }}" required maxlength="255">
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">{{ __('Описание') }}</label>
                    <textarea class="form-control" id="description" name="description" rows="3" maxlength="2000">{{ old('description', $item?->description) }}</textarea>
                </div>
                @if($dictionary->code === 'regions')
                <div class="form-group">
                    <label for="item_type" class="form-label">{{ __('Тип') }}</label>
                    <select class="form-control" id="item_type" name="item_type">
                        <option value="">{{ __('— не указан —') }}</option>
                        <option value="country" {{ old('item_type', $item?->item_type) === 'country' ? 'selected' : '' }}>{{ __('Страна') }}</option>
                        <option value="region" {{ old('item_type', $item?->item_type) === 'region' ? 'selected' : '' }}>{{ __('Регион') }}</option>
                        <option value="city" {{ old('item_type', $item?->item_type) === 'city' ? 'selected' : '' }}>{{ __('Город') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="country_code" class="form-label">{{ __('Страна (код ISO)') }}</label>
                    <input type="text" class="form-control" id="country_code" name="country_code" value="{{ old('country_code', $item?->country_code) }}" maxlength="10" placeholder="RU">
                </div>
                <div class="form-group">
                    <label for="map_code" class="form-label">{{ __('Код на карте') }}</label>
                    <input type="text" class="form-control" id="map_code" name="map_code" value="{{ old('map_code', $item?->map_code) }}" maxlength="20" placeholder="RU-MOW">
                    <small class="form-text text-muted">{{ __('Для синхронизации с картой регионов (напр. RU-MOW, RU-SPE).') }}</small>
                </div>
                @endif
                @if($dictionary->code === 'regulatory_documents')
                <div class="form-group">
                    <label for="document_url" class="form-label">{{ __('Ссылка на документ') }}</label>
                    <input type="url" class="form-control" id="document_url" name="document_url" value="{{ old('document_url', $item?->document_url) }}" maxlength="500" placeholder="https://">
                    <small class="form-text text-muted">{{ __('URL страницы или файла с текстом документа.') }}</small>
                    @error('document_url')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_ru" name="is_ru" value="1" {{ old('is_ru', $item?->is_ru ?? false) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_ru">{{ __('RU') }}</label>
                    </div>
                    <small class="form-text text-muted">{{ __('Российский документ') }}</small>
                </div>
                @endif
                <div class="form-group">
                    <label for="sort_order" class="form-label">{{ __('Порядок сортировки') }}</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" min="0">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $item?->is_active ?? true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">{{ __('Активен') }}</label>
                    </div>
                </div>
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a href="{{ route('lk.admin.settings.dictionaries.show', $dictionary) }}" class="btn btn-outline-secondary">{{ __('Отмена') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
