@extends('layouts.app.app')

@section('title', __('Дашборд инициатора'))

@section('header')
    <h1>{{ __('Дашборд инициатора') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Инициатор') }}</li>
        </ol>
    </nav>
    <div class="separator mb-5"></div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __('Панель инициатора') }}</h5>
            <p class="mb-0">{{ __('Здесь отображаются ваши проекты, заявки на размещение, статусы модерации и коммуникация с инвесторами.') }}</p>
        </div>
    </div>
@endsection
