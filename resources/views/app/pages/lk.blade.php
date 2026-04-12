@extends('layouts.app.app')

@section('title', __('Личный кабинет'))

@section('header')
    <h1>{{ __('Личный кабинет') }}</h1>
@endsection

@section('content')
    @include('app.partials.lk-home-dashboard')
@endsection
