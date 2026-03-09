@extends('layouts.app.app')

@section('title', __('Управление уведомлениями'))

@section('header')
    <h1>{{ __('Управление уведомлениями') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Уведомления') }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-3">{{ __('Создание и рассылка уведомлений пользователям ЛК. Уведомления отображаются в колокольчике и на странице «Уведомления».') }}</p>
            <a href="{{ route('lk.admin.notifications.create') }}" class="btn btn-primary">{{ __('Создать уведомление') }}</a>
        </div>
    </div>
@endsection
