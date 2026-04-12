@extends('layouts.app.app')

@section('title', __('Мой портфель'))

@section('header')
    <h1>{{ __('Мой портфель') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Мой портфель')],
    ]" separator-margin="mb-5" />

    <x-lk-placeholder-card
        :title="__('Мой портфель')"
        :description="__('Здесь появятся ваши инвестиции, активы и аналитика. Сейчас откройте список проектов или уведомления.')"
    >
        <div class="d-flex flex-wrap lk-form-actions">
            <a href="{{ route('lk.projects.all') }}" class="btn btn-primary btn-sm">{{ __('Все проекты') }}</a>
            <a href="{{ route('lk.notifications.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Уведомления') }}</a>
        </div>
    </x-lk-placeholder-card>
@endsection
