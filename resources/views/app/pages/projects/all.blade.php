@extends('layouts.app.app')

@section('title', __('Все проекты'))

@section('header')
    <h1>{{ __('Все проекты') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Проекты'), 'url' => route('lk.projects.all')],
        ['label' => __('Все проекты')],
    ]" separator-margin="mb-5" />

    <x-lk-placeholder-card
        :title="__('Все проекты')"
        :description="__('Каталог проектов платформы для инвестирования будет отображаться здесь. Пока перейдите в портфель или к уведомлениям.')"
    >
        <div class="d-flex flex-wrap lk-form-actions">
            <a href="{{ route('lk.portfolio') }}" class="btn btn-primary btn-sm">{{ __('Мой портфель') }}</a>
            <a href="{{ route('lk.notifications.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Уведомления') }}</a>
        </div>
    </x-lk-placeholder-card>
@endsection
