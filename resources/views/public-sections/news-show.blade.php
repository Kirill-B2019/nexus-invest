@extends('layouts.guest.guest')

@section('metaDescription')
{{ e(str()->limit($item->description ?: $item->title, 160)) }}
@endsection

@section('metaKeywords')
{{ __('новости НЕКСУС, ') . e($item->title) }}
@endsection

@if($item->cover_url)
@section('ogImage')
{{ $item->cover_url }}
@endsection
@endif

@section('content')
@php
    $itemDate = $item->published_at ?? $item->created_at;
@endphp
<section class="section-box news-article-hero">
    <div class="banner-hero hero-4">
        <div class="banner-inner">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb news-article-breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('Главная') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news.index') }}">{{ __('Новости') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ e(str()->limit($item->title, 60)) }}</li>
                    </ol>
                </nav>
                <p class="neutral-300 small mb-10 news-article-meta">
                    @if($itemDate){{ $itemDate->translatedFormat('d F Y') }} · @endif
                    {{ $item->source_label }}
                </p>
                <h1 class="heading-banner neutral-0">{{ e($item->title) }}</h1>
                @if($item->description)
                    <p class="banner-description text-lg neutral-200">{{ e($item->description) }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="section-box news-article pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                @if($item->cover_url)
                    <div class="news-article__cover mb-40 text-center">
                        <img class="w-100" src="{{ $item->cover_url }}" alt="{{ e($item->title) }}" loading="eager" decoding="async">
                    </div>
                @endif
                @if($item->body)
                    <div class="news-article__body text-lg neutral-700">
                        {!! $item->body !!}
                    </div>
                @endif
                <div class="mt-50">
                    <a class="btn btn-brand-4-medium" href="{{ route('news.index') }}">{{ __('Все новости') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('seo-jsonld')
@php
    $articleSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'NewsArticle',
        'headline' => $item->title,
        'datePublished' => optional($item->published_at)->toAtomString(),
        'dateModified' => optional($item->updated_at)->toAtomString(),
        'description' => $item->description,
        'image' => $item->cover_url ? [$item->cover_url] : [],
        'author' => [
            '@type' => 'Organization',
            'name' => config('app.name'),
        ],
        'mainEntityOfPage' => url()->current(),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
@endsection
