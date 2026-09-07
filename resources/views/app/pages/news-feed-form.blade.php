@extends('layouts.app.app')

@section('title', $isEdit ? __('Редактирование статьи') : __('Новая статья'))

@section('header')
    <h1>{{ $isEdit ? __('Редактирование статьи') : __('Новая статья') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Настройки'), 'url' => route('lk.admin.settings.index')],
        ['label' => __('Новости'), 'url' => route('lk.admin.news-feed.index')],
        ['label' => $isEdit ? __('Редактирование') : __('Новая статья')],
    ]" separator-margin="mb-4" />

    @include('layouts.app.flash')

    <div class="card">
        <div class="card-body">
            <form method="post"
                  action="{{ $isEdit ? route('lk.admin.news-feed.item.update', $item) : route('lk.admin.news-feed.store') }}"
                  enctype="multipart/form-data"
                  class="lk-form">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label" for="title">{{ __('Заголовок') }}</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $item->title) }}" required maxlength="500">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="slug">{{ __('Slug (URL)') }}</label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug', $item->slug) }}" maxlength="200" placeholder="{{ __('Латиница, авто из заголовка если пусто') }}">
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if($isEdit && $item->slug && $item->status === 'published')
                        <div class="form-text">
                            <a href="{{ route('news.show', $item->slug) }}" target="_blank" rel="noopener noreferrer">{{ route('news.show', $item->slug) }}</a>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">{{ __('Анонс') }}</label>
                    <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                              maxlength="2000">{{ old('description', $item->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="body">{{ __('Текст статьи (HTML)') }}</label>
                    <textarea name="body" id="body" rows="14" class="form-control font-monospace @error('body') is-invalid @enderror">{{ old('body', $item->body) }}</textarea>
                    <div class="form-text">{{ __('Допустимы: p, br, strong, em, ul/ol/li, a, h2, h3, blockquote, img.') }}</div>
                    @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="status">{{ __('Статус') }}</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" @selected(old('status', $item->status) === 'draft')>{{ __('Черновик') }}</option>
                            <option value="published" @selected(old('status', $item->status) === 'published')>{{ __('Опубликовано') }}</option>
                            <option value="hidden" @selected(old('status', $item->status) === 'hidden')>{{ __('Скрыто') }}</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="published_at">{{ __('Дата публикации') }}</label>
                        <input type="datetime-local" name="published_at" id="published_at"
                               class="form-control @error('published_at') is-invalid @enderror"
                               value="{{ old('published_at', optional($item->published_at)->format('Y-m-d\TH:i')) }}">
                        @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="cover">{{ __('Обложка') }}</label>
                    @if($item->cover_url)
                        <div class="mb-2">
                            <img src="{{ $item->cover_url }}" alt="" style="max-width: 240px; border-radius: 8px;">
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="remove_cover" id="remove_cover" value="1" @checked(old('remove_cover'))>
                            <label class="form-check-label" for="remove_cover">{{ __('Удалить обложку') }}</label>
                        </div>
                    @endif
                    <input type="file" name="cover" id="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                    @error('cover')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="lk-form-actions d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a href="{{ route('lk.admin.news-feed.index') }}" class="btn btn-outline-secondary">{{ __('К списку') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
