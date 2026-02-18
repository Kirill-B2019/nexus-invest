<x-app-layout>
    <x-slot name="header">
        <h1>{{ $title ?? __('Страница') }}</h1>
    </x-slot>

    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title ?? __('Страница') }}</li>
        </ol>
    </nav>
    <div class="separator mb-5"></div>

    <div class="card">
        <div class="card-body">
            @if(isset($content))
                {!! $content !!}
            @else
                <p class="mb-0">{{ __('Контент страницы.') }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
