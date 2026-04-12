@extends('layouts.app.app')

@section('title', __('Дашборд инициатора'))

@section('header')
    <h1>{{ __('Дашборд инициатора') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Инициатор')],
    ]" separator-margin="mb-5" />

    <x-lk-placeholder-card
        :title="__('Панель инициатора')"
        :description="__('Здесь появятся сводка по проектам, статусы модерации и коммуникации с инвесторами. Сейчас перейдите в разделы ниже.')"
    >
        <div class="d-flex flex-wrap lk-form-actions">
            <a href="{{ route('lk.projects.my') }}" class="btn btn-primary btn-sm">{{ __('Мои проекты') }}</a>
            <a href="{{ route('lk.projects.create') }}" class="btn btn-outline-primary btn-sm">{{ __('Новый проект') }}</a>
            <a href="{{ route('lk.notifications.index') }}" class="btn btn-outline-primary btn-sm">{{ __('Уведомления') }}</a>
        </div>
    </x-lk-placeholder-card>
@endsection
