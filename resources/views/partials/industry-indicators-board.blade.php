{{-- Единая тёмная секция: ряд 1 — 3 индикатора, ряд 2 — 2 индикатора --}}
@php
    $indicatorsBoardId = $indicatorsBoardId ?? 'industry-indicators-board';
@endphp
<section class="section-box wow box-testimonials-3" id="industry-indicators-board-section">
    <div class="container">
        <a class="btn btn-brand-4-sm" href="#industry-indicators-board-section">{{ __('Отраслевые индикаторы') }}</a>
        <h2 class="mt-15 mb-20 neutral-0">{{ __('Аналитика рынка ЦФА и RWA') }}</h2>
        <p class="text-lg neutral-500 mb-40">
            {{ __('Публичные ориентиры: температура и ликвидность ЦФА, сдвиг капитала RWA/DeFi, риск‑ландшафт и глобальный масштаб токенизации.') }}
        </p>

        <div class="ind-board" id="{{ $indicatorsBoardId }}" data-api-base="{{ url('/api/indicators') }}">
            {{-- Ряд 1: 3 индикатора --}}
            <div class="ind-board__row ind-board__row--3">
                <article class="ind-board__item" id="{{ $indicatorsBoardId }}-cfa-temperature" data-endpoint="cfa-temperature" data-compact="1" aria-labelledby="{{ $indicatorsBoardId }}-temp-title">
                    <div class="ind-panel__head ind-board__head">
                        <div>
                            <p class="ind-panel__eyebrow color-green mb-8">{{ __('Индикатор рынка') }}</p>
                            <h3 id="{{ $indicatorsBoardId }}-temp-title" class="ind-panel__title neutral-0">{{ __('Температура рынка ЦФА в России') }}</h3>
                        </div>
                        <span class="ind-panel__updated text-sm neutral-500" data-role="updated" aria-live="polite"></span>
                    </div>
                    <div class="ind-panel__body" data-role="body">
                        <div class="ind-widget__loading text-sm neutral-500" data-role="loading">{{ __('Загрузка…') }}</div>
                    </div>
                    <p class="ind-panel__explain text-sm neutral-500" data-role="explain"></p>
                    <p class="ind-panel__sources text-sm neutral-600" data-role="sources"></p>
                </article>

                <article class="ind-board__item" id="{{ $indicatorsBoardId }}-liquidity-light" data-endpoint="liquidity-light" data-compact="1" aria-labelledby="{{ $indicatorsBoardId }}-liq-title">
                    <div class="ind-panel__head ind-board__head">
                        <div>
                            <p class="ind-panel__eyebrow color-green mb-8">{{ __('Вторичный рынок') }}</p>
                            <h3 id="{{ $indicatorsBoardId }}-liq-title" class="ind-panel__title neutral-0">{{ __('Ликвидность вторички ЦФА в РФ') }}</h3>
                        </div>
                        <span class="ind-panel__updated text-sm neutral-500" data-role="updated" aria-live="polite"></span>
                    </div>
                    <div class="ind-panel__body" data-role="body">
                        <div class="ind-widget__loading text-sm neutral-500" data-role="loading">{{ __('Загрузка…') }}</div>
                    </div>
                    <p class="ind-panel__explain text-sm neutral-500" data-role="explain"></p>
                    <p class="ind-panel__sources text-sm neutral-600" data-role="sources"></p>
                </article>

                <article class="ind-board__item" id="{{ $indicatorsBoardId }}-rwa-vs-defi" data-endpoint="rwa-vs-defi" data-compact="1" aria-labelledby="{{ $indicatorsBoardId }}-rwa-defi-title">
                    <div class="ind-panel__head ind-board__head">
                        <div>
                            <p class="ind-panel__eyebrow color-green mb-8">{{ __('Глобальный капитал') }}</p>
                            <h3 id="{{ $indicatorsBoardId }}-rwa-defi-title" class="ind-panel__title neutral-0">{{ __('RWA vs DeFi: сдвиг капитала') }}</h3>
                        </div>
                        <span class="ind-panel__updated text-sm neutral-500" data-role="updated" aria-live="polite"></span>
                    </div>
                    <div class="ind-panel__body" data-role="body">
                        <div class="ind-widget__loading text-sm neutral-500" data-role="loading">{{ __('Загрузка…') }}</div>
                    </div>
                    <p class="ind-panel__explain text-sm neutral-500" data-role="explain"></p>
                    <p class="ind-panel__sources text-sm neutral-600" data-role="sources"></p>
                </article>
            </div>

            {{-- Ряд 2: 2 индикатора --}}
            <div class="ind-board__row ind-board__row--2">
                <article class="ind-board__item" id="{{ $indicatorsBoardId }}-risk-map" data-endpoint="risk-map" data-compact="1" aria-labelledby="{{ $indicatorsBoardId }}-risk-title">
                    <div class="ind-panel__head ind-board__head">
                        <div>
                            <p class="ind-panel__eyebrow color-green mb-8">{{ __('Карта рисков') }}</p>
                            <h3 id="{{ $indicatorsBoardId }}-risk-title" class="ind-panel__title neutral-0">{{ __('Риск‑ландшафт ЦФА') }}</h3>
                        </div>
                        <span class="ind-panel__updated text-sm neutral-500" data-role="updated" aria-live="polite"></span>
                    </div>
                    <div class="ind-panel__body" data-role="body">
                        <div class="ind-widget__loading text-sm neutral-500" data-role="loading">{{ __('Загрузка…') }}</div>
                    </div>
                    <p class="ind-panel__explain text-sm neutral-500" data-role="explain"></p>
                    <p class="ind-panel__sources text-sm neutral-600" data-role="sources"></p>
                </article>

                <article class="ind-board__item" id="{{ $indicatorsBoardId }}-rwa-global" data-endpoint="rwa-global" data-compact="1" aria-labelledby="{{ $indicatorsBoardId }}-rwa-global-title">
                    <div class="ind-panel__head ind-board__head">
                        <div>
                            <p class="ind-panel__eyebrow color-green mb-8">{{ __('Глобальная токенизация') }}</p>
                            <h3 id="{{ $indicatorsBoardId }}-rwa-global-title" class="ind-panel__title neutral-0">{{ __('Глобальный RWA‑трекер') }}</h3>
                        </div>
                        <span class="ind-panel__updated text-sm neutral-500" data-role="updated" aria-live="polite"></span>
                    </div>
                    <div class="ind-panel__body" data-role="body">
                        <div class="ind-widget__loading text-sm neutral-500" data-role="loading">{{ __('Загрузка…') }}</div>
                    </div>
                    <p class="ind-panel__explain text-sm neutral-500" data-role="explain"></p>
                    <p class="ind-panel__sources text-sm neutral-600" data-role="sources"></p>
                </article>
            </div>
        </div>
    </div>
</section>
