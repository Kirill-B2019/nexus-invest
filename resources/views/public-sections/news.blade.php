@extends('layouts.guest.guest')

@section('metaDescription')
{{ __('Новости экосистемы НЕКСУС: материалы редакции и публикации канала Дзен о проектном финансировании, ЦФА и токенизации.') }}
@endsection

@section('metaKeywords')
{{ __('новости НЕКСУС, Дзен, ЦФА, токенизация, проектное финансирование, экосистема НЕКСУС') }}
@endsection

@section('content')
<x-guest.public-page-banner
    :pageTitle="$title"
    :bannerDescription="$description ?? ''"
/>

<section class="section-box news-page pb-80" id="news-page">
    <div class="container">
        @if($items->isNotEmpty())
            <div
                id="news-feed"
                class="news-page-feed news-page-feed--{{ $viewMode }}"
                data-news-view="{{ $viewMode }}"
            >
                <div class="news-page-toolbar">
                    <p class="news-page-toolbar__hint mb-0">{{ __('Вид ленты') }}</p>
                    <div class="news-view-toggle" role="group" aria-label="{{ __('Вид ленты') }}">
                        <button
                            type="button"
                            class="news-view-toggle__btn{{ $viewMode === 'blocks' ? ' is-active' : '' }}"
                            data-news-view="blocks"
                            aria-pressed="{{ $viewMode === 'blocks' ? 'true' : 'false' }}"
                            title="{{ __('Блоки') }}"
                        >
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <rect x="1.5" y="1.5" width="6" height="6" rx="1.2" stroke="currentColor" stroke-width="1.5"/>
                                <rect x="10.5" y="1.5" width="6" height="6" rx="1.2" stroke="currentColor" stroke-width="1.5"/>
                                <rect x="1.5" y="10.5" width="6" height="6" rx="1.2" stroke="currentColor" stroke-width="1.5"/>
                                <rect x="10.5" y="10.5" width="6" height="6" rx="1.2" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            <span>{{ __('Блоки') }}</span>
                        </button>
                        <button
                            type="button"
                            class="news-view-toggle__btn{{ $viewMode === 'list' ? ' is-active' : '' }}"
                            data-news-view="list"
                            aria-pressed="{{ $viewMode === 'list' ? 'true' : 'false' }}"
                            title="{{ __('Список') }}"
                        >
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <rect x="1.5" y="2.25" width="15" height="2.5" rx="1" fill="currentColor"/>
                                <rect x="1.5" y="7.75" width="15" height="2.5" rx="1" fill="currentColor"/>
                                <rect x="1.5" y="13.25" width="15" height="2.5" rx="1" fill="currentColor"/>
                            </svg>
                            <span>{{ __('Список') }}</span>
                        </button>
                    </div>
                </div>

                <div class="row news-page-grid">
                    @foreach($items as $item)
                        <div class="col-12 col-md-6 col-lg-4 mb-30 news-page-grid__item d-flex">
                            <x-guest.news-card :item="$item" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="news-page-pagination d-flex justify-content-center mt-20">
                {{ $items->onEachSide(1)->links('vendor.pagination.news') }}
            </div>
        @else
            <div class="text-center py-60">
                <h2 class="heading-3 mb-20">{{ __('Пока нет публикаций') }}</h2>
                <p class="text-lg neutral-700 mb-30">{{ __('Следите за обновлениями в официальном канале Дзен.') }}</p>
                <a class="btn btn-brand-4-medium" href="{{ $channelUrl }}" target="_blank" rel="noopener noreferrer">{{ __('Открыть канал Дзен') }}</a>
            </div>
        @endif

        <div class="row mt-60">
            <div class="col-12">
                <div class="box-border-rounded news-page-cta">
                    <div class="card-casestudy">
                        <div class="card-title">
                            <h2 class="heading-5 mb-10">{{ __('Канал Дзен от авторов НЕКСУС') }}</h2>
                        </div>
                        <div class="card-desc">
                            <p class="text-lg neutral-700 mb-20">{{ __('Новости и материалы о цифровых финансах, финтехе и развитии экосистемы.') }}</p>
                            <a class="btn btn-brand-4-medium" href="{{ $channelUrl }}" target="_blank" rel="noopener noreferrer">{{ __('Перейти в канал') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/news-view.js') }}?v={{ config('app.asset_version') }}"></script>
@endpush
