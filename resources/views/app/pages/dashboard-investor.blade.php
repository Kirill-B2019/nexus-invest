@extends('layouts.app.app')

@section('title', __('Дашборд инвестора'))

@section('header')
    <h1>{{ __('Дашборд инвестора') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Инвестор')],
    ]" separator-margin="mb-5" />

    <x-lk-placeholder-card
        :title="__('Панель инвестора')"
        :description="__('Здесь появятся проекты для инвестирования, аналитика портфеля и рекомендации. Пока используйте разделы ниже.')"
    >
        <div class="d-flex flex-wrap lk-form-actions">
            <a href="{{ route('lk.portfolio') }}" class="btn btn-primary btn-sm">{{ __('Мой портфель') }}</a>
            <a href="{{ route('lk.projects.all') }}" class="btn btn-outline-primary btn-sm">{{ __('Все проекты') }}</a>
            <a href="{{ route('lk.notifications.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Уведомления') }}</a>
        </div>
    </x-lk-placeholder-card>
@endsection
