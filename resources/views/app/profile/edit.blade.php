@extends('layouts.app.app')

@section('title', __('Профиль'))

@section('header')
    <h1>{{ __('Профиль') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Профиль')],
    ]" separator-margin="mb-4" />
    @include('layouts.app.flash')

    @php
        $profileAvatarUrl = Auth::user()->profile_photo_url ?? asset('assets/imgs/template/logo-only.svg');
    @endphp

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ __('Данные профиля') }}</h5>
            <div class="mb-4 d-flex align-items-center">
                <img src="{{ $profileAvatarUrl }}" alt="" class="rounded-circle mr-3" width="64" height="64" style="object-fit: cover;">
                <div>
                    <p class="text-muted small mb-0">{{ __('Текущее фото') }}</p>
                    <p class="text-muted small mb-0">{{ __('Загрузите новое или удалите — ниже в форме.') }}</p>
                </div>
            </div>
            @include('app.profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            @include('app.profile.partials.update-password-form')
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @include('app.profile.partials.delete-user-form')
        </div>
    </div>
@endsection
