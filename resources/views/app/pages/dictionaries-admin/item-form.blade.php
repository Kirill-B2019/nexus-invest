@extends('layouts.app.app')

@section('title', $item ? __('Редактирование элемента') : __('Новый элемент'))

@section('header')
    <h1>{{ $item ? __('Редактирование элемента') : __('Новый элемент') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.settings.dictionaries.index') }}">{{ __('Справочники') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.settings.dictionaries.show', $dictionary) }}">{{ $dictionary->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $item ? $item->name : __('Новый элемент') }}</li>
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
