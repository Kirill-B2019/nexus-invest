@extends('layouts.app.app')

@section('title', __('Управление уведомлениями'))

@section('header')
    <h1>{{ __('Управление уведомлениями') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Уведомления')],
    ]" separator-margin="mb-4" />

    @include('layouts.app.flash')

    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-3">{{ __('Создание и рассылка уведомлений пользователям ЛК. Уведомления отображаются в колокольчике и на странице «Уведомления».') }}</p>
            <a href="{{ route('lk.admin.notifications.create') }}" class="btn btn-primary">{{ __('Создать уведомление') }}</a>
        </div>
    </div>
@endsection
