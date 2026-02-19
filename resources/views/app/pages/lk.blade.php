@extends('layouts.app.app')

@section('title', __('Личный кабинет'))

@section('header')
    <h1>{{ __('Личный кабинет') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Главная') }}</li>
        </ol>
    </nav>
    <div class="separator mb-5"></div>

    <div class="card">
        <div class="card-body">
            <p class="mb-0">{{ __('Вы вошли в систему!') }}</p>
        </div>
    </div>
@endsection
