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
    <div class="separator mb-4"></div>
    <div class="card">
        <div class="card-body">
            <h5 class="text-warning">{{ __('Нет доступа к мессенджеру') }}</h5>
            <p class="mb-2">{{ __('Доступ к чату и звонкам нужно назначить в разделе «Управление мессенджером».') }}</p>
            @if($is_admin)
                <div class="lk-form-actions">
                    <a href="{{ route('lk.admin.messenger') }}" class="btn btn-primary">{{ __('Перейти к управлению мессенджером') }}</a>
                </div>
            @else
                <p class="text-muted small mb-0">{{ __('Обратитесь к администратору платформы.') }}</p>
            @endif
        </div>
    </div>
@endsection
