@extends('layouts.app.app')

@section('title', __('Дашборд эксперта'))

@section('header')
    <h1>{{ __('Дашборд эксперта') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Эксперт')],
    ]" separator-margin="mb-5" />

    <x-lk-placeholder-card
        :title="__('Панель эксперта')"
        :description="__('Здесь появятся очередь экспертизы, формы оценки и отчёты. Пока используйте уведомления и главную ЛК.')"
    >
        <div class="d-flex flex-wrap lk-form-actions">
            <a href="{{ route('lk.notifications.index') }}" class="btn btn-primary btn-sm">{{ __('Уведомления') }}</a>
            <a href="{{ route('lk') }}" class="btn btn-outline-primary btn-sm">{{ __('Главная ЛК') }}</a>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">{{ __('Профиль') }}</a>
        </div>
    </x-lk-placeholder-card>
@endsection
