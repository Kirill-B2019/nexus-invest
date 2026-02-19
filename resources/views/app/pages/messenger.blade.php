@extends('layouts.app.app')

@section('title', __('Мессенджер'))

@section('header')
    <h1>{{ __('Мессенджер') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Мессенджер') }}</li>
        </ol>
    </nav>
    <div class="separator mb-3"></div>
    <div class="nmess-embed-wrapper">
        <iframe
            src="{{ asset('nmess/index.html') }}"
            title="{{ __('Мессенджер НЕКСУС') }}"
            class="nmess-iframe"
        ></iframe>
    </div>
    <style>
        .nmess-embed-wrapper { height: calc(100vh - 200px); min-height: 400px; }
        .nmess-iframe { width: 100%; height: 100%; border: none; border-radius: 8px; }
    </style>
@endsection
