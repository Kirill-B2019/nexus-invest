@extends('layouts.app.app')

@section('title', __('Дашборд эксперта'))

@section('header')
    <h1>{{ __('Дашборд эксперта') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Эксперт') }}</li>
        </ol>
    </nav>
    <div class="separator mb-5"></div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __('Панель эксперта') }}</h5>
            <p class="mb-0">{{ __('Здесь отображаются проекты на экспертизу, очередь проверок, формы оценки и отчёты.') }}</p>
        </div>
    </div>
@endsection
