@props([
    'item',
    'placeholder' => null,
])
@php
    $placeholder = $placeholder ?: asset('assets/imgs/page/homepage1/img-news.png');
    $cover = $item->cover_url ?: $placeholder;
    $itemDate = $item->published_at ?? $item->created_at;
    $isExternal = $item->is_external;
    $href = $item->permalink;
    $cta = $isExternal
        ? ($item->source === \App\Models\NewsFeedItem::SOURCE_DZEN ? __('Читать на Дзен') : __('Источник'))
        : __('Читать');
@endphp
<article class="news-card">
    <div class="news-card__media">
        <a class="news-card__media-link" href="{{ $href }}" @if($isExternal) target="_blank" rel="noopener noreferrer" @endif>
            <img src="{{ $cover }}" alt="{{ e($item->title) }}" loading="eager" decoding="async" onerror="this.onerror=null; this.src='{{ $placeholder }}';">
        </a>
    </div>
    <div class="news-card__content">
        <div class="news-card__meta">
            @if($itemDate)
                <time class="news-card__date" datetime="{{ $itemDate->toDateString() }}">{{ $itemDate->translatedFormat('d F Y') }}</time>
            @endif
            <span class="news-card__badge">{{ $item->source_label }}</span>
        </div>
        <a class="news-card__title" href="{{ $href }}" @if($isExternal) target="_blank" rel="noopener noreferrer" @endif>{{ e($item->title) }}</a>
        <p class="news-card__excerpt">{{ $item->description ? e(str()->limit($item->description, 140)) : "\u{00A0}" }}</p>
    </div>
    <div class="news-card__footer">
        <a class="news-card__cta btn btn-learmore-2" href="{{ $href }}" @if($isExternal) target="_blank" rel="noopener noreferrer" @endif>
            <span>
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M10.6557 3.81393L1.71996 12.7497L0.251953 11.2817L9.18664 2.34592H1.31195V0.269531H12.7321V11.6897H10.6557V3.81393Z" fill="currentColor"></path>
                </svg>
            </span>
            {{ $cta }}
        </a>
    </div>
</article>
