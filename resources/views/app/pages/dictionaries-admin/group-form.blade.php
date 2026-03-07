@extends('layouts.app.app')

@section('title', $group ? __('Редактирование группы') : __('Новая группа'))

@section('header')
    <h1>{{ $group ? __('Редактирование группы') : __('Новая группа') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.settings.dictionaries.index') }}">{{ __('Справочники') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $group ? $group->name : __('Новая группа') }}</li>
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
            <form method="post" action="{{ $group ? route('lk.admin.settings.dictionaries.group.update', $group) : route('lk.admin.settings.dictionaries.group.store') }}">
                @csrf
                @if($group) @method('PATCH') @endif
                <div class="form-group">
                    <label for="code" class="form-label">{{ __('Код (латиница, цифры, дефис)') }}</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $group?->code) }}" required maxlength="50" pattern="[a-z0-9_-]+" placeholder="economic">
                </div>
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Название') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $group?->name) }}" required maxlength="255" placeholder="{{ __('Экономические') }}">
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">{{ __('Описание') }}</label>
                    <textarea class="form-control" id="description" name="description" rows="3" maxlength="2000">{{ old('description', $group?->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="sort_order" class="form-label">{{ __('Порядок сортировки') }}</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $group?->sort_order ?? 0) }}" min="0">
                </div>
                <div class="lk-form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a href="{{ route('lk.admin.settings.dictionaries.index') }}" class="btn btn-outline-secondary">{{ __('Отмена') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
