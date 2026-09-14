{{-- Пульт рынка: пульс (3) → сцена деталей → глубина (риск + global) --}}
@php
    $indicatorsBoardId = $indicatorsBoardId ?? 'industry-indicators-board';
@endphp
<section class="section-box wow box-testimonials-3 box-indicators-promo" id="industry-indicators-board-section">
    <div class="indicators-promo">
        <div class="indicators-promo__frame">
            <header class="indicators-promo__head">
                <div class="indicators-promo__head-text">
                    <h2 class="indicators-promo__title">{{ __('Аналитика рынка') }}</h2>
                    <p class="indicators-promo__lead">{{ __('Публичные ориентиры по ЦФА и RWA: температура, ликвидность, сдвиг капитала, риски и глобальный масштаб токенизации.') }}</p>
                </div>
                <div class="indicators-promo__live">
                    <span class="indicators-promo__badge">
                        <span class="indicators-promo__badge-dot" aria-hidden="true"></span>
                        {{ __('Live') }}
                    </span>
                    <span class="indicators-promo__updated text-sm" data-role="board-updated" aria-live="polite"></span>
                </div>
            </header>

            <div
                class="indicators-promo__board ind-board"
                id="{{ $indicatorsBoardId }}"
                data-api-base="{{ url('/api/indicators') }}"
                data-indicators-promo="1"
            >
                {{-- Полоса пульса --}}
                <div class="ind-pulse" role="tablist" aria-label="{{ __('Пульс рынка') }}">
                    <button
                        type="button"
                        class="ind-pulse__chip is-active"
                        role="tab"
                        id="{{ $indicatorsBoardId }}-tab-temp"
                        aria-selected="true"
                        aria-controls="{{ $indicatorsBoardId }}-panel-cfa-temperature"
                        data-pulse-endpoint="cfa-temperature"
                    >
                        <span class="ind-pulse__label">{{ __('Температура ЦФА') }}</span>
                        <span class="ind-pulse__value" data-role="pulse-value">—</span>
                        <span class="ind-pulse__meta" data-role="pulse-meta">{{ __('Загрузка…') }}</span>
                    </button>
                    <button
                        type="button"
                        class="ind-pulse__chip"
                        role="tab"
                        id="{{ $indicatorsBoardId }}-tab-liq"
                        aria-selected="false"
                        aria-controls="{{ $indicatorsBoardId }}-panel-liquidity-light"
                        data-pulse-endpoint="liquidity-light"
                        tabindex="-1"
                    >
                        <span class="ind-pulse__label">{{ __('Ликвидность вторички') }}</span>
                        <span class="ind-pulse__value" data-role="pulse-value">—</span>
                        <span class="ind-pulse__meta" data-role="pulse-meta">{{ __('Загрузка…') }}</span>
                    </button>
                    <button
                        type="button"
                        class="ind-pulse__chip"
                        role="tab"
                        id="{{ $indicatorsBoardId }}-tab-rwa"
                        aria-selected="false"
                        aria-controls="{{ $indicatorsBoardId }}-panel-rwa-vs-defi"
                        data-pulse-endpoint="rwa-vs-defi"
                        tabindex="-1"
                    >
                        <span class="ind-pulse__label">{{ __('RWA vs DeFi') }}</span>
                        <span class="ind-pulse__value" data-role="pulse-value">—</span>
                        <span class="ind-pulse__meta" data-role="pulse-meta">{{ __('Загрузка…') }}</span>
                    </button>
                </div>

                {{-- Сцена деталей (один активный виджет из пульса) --}}
                <div class="ind-stage">
                    <article
                        class="ind-board__item ind-stage__panel is-active"
                        id="{{ $indicatorsBoardId }}-panel-cfa-temperature"
                        role="tabpanel"
                        aria-labelledby="{{ $indicatorsBoardId }}-tab-temp"
                        data-endpoint="cfa-temperature"
                        data-compact="1"
                    >
                        <div class="ind-panel__head ind-stage__head">
                            <h3 class="ind-panel__title">{{ __('Температура рынка ЦФА в России') }}</h3>
                        </div>
                        <div class="ind-panel__body" data-role="body">
                            <div class="ind-widget__loading text-sm" data-role="loading">{{ __('Загрузка…') }}</div>
                        </div>
                        <p class="ind-panel__explain" data-role="explain"></p>
                    </article>

                    <article
                        class="ind-board__item ind-stage__panel"
                        id="{{ $indicatorsBoardId }}-panel-liquidity-light"
                        role="tabpanel"
                        aria-labelledby="{{ $indicatorsBoardId }}-tab-liq"
                        data-endpoint="liquidity-light"
                        data-compact="1"
                        hidden
                    >
                        <div class="ind-panel__head ind-stage__head">
                            <h3 class="ind-panel__title">{{ __('Ликвидность вторички ЦФА в РФ') }}</h3>
                        </div>
                        <div class="ind-panel__body" data-role="body">
                            <div class="ind-widget__loading text-sm" data-role="loading">{{ __('Загрузка…') }}</div>
                        </div>
                        <p class="ind-panel__explain" data-role="explain"></p>
                    </article>

                    <article
                        class="ind-board__item ind-stage__panel"
                        id="{{ $indicatorsBoardId }}-panel-rwa-vs-defi"
                        role="tabpanel"
                        aria-labelledby="{{ $indicatorsBoardId }}-tab-rwa"
                        data-endpoint="rwa-vs-defi"
                        data-compact="1"
                        hidden
                    >
                        <div class="ind-panel__head ind-stage__head">
                            <h3 class="ind-panel__title">{{ __('RWA vs DeFi: сдвиг капитала') }}</h3>
                        </div>
                        <div class="ind-panel__body" data-role="body">
                            <div class="ind-widget__loading text-sm" data-role="loading">{{ __('Загрузка…') }}</div>
                        </div>
                        <p class="ind-panel__explain" data-role="explain"></p>
                    </article>
                </div>

                {{-- Глубина: риск + global --}}
                <div class="ind-depth">
                    <article
                        class="ind-board__item ind-depth__item"
                        id="{{ $indicatorsBoardId }}-risk-map"
                        data-endpoint="risk-map"
                        data-compact="1"
                        aria-labelledby="{{ $indicatorsBoardId }}-risk-title"
                    >
                        <div class="ind-panel__head ind-depth__head">
                            <p class="ind-panel__eyebrow">{{ __('Карта рисков') }}</p>
                            <h3 id="{{ $indicatorsBoardId }}-risk-title" class="ind-panel__title">{{ __('Риск‑ландшафт ЦФА') }}</h3>
                        </div>
                        <div class="ind-panel__body" data-role="body">
                            <div class="ind-widget__loading text-sm" data-role="loading">{{ __('Загрузка…') }}</div>
                        </div>
                        <p class="ind-panel__explain" data-role="explain"></p>
                    </article>

                    <article
                        class="ind-board__item ind-depth__item"
                        id="{{ $indicatorsBoardId }}-rwa-global"
                        data-endpoint="rwa-global"
                        data-compact="1"
                        aria-labelledby="{{ $indicatorsBoardId }}-rwa-global-title"
                    >
                        <div class="ind-panel__head ind-depth__head">
                            <p class="ind-panel__eyebrow">{{ __('Глобальная токенизация') }}</p>
                            <h3 id="{{ $indicatorsBoardId }}-rwa-global-title" class="ind-panel__title">{{ __('Глобальный RWA‑трекер') }}</h3>
                        </div>
                        <div class="ind-panel__body" data-role="body">
                            <div class="ind-widget__loading text-sm" data-role="loading">{{ __('Загрузка…') }}</div>
                        </div>
                        <p class="ind-panel__explain" data-role="explain"></p>
                    </article>
                </div>

                <footer class="indicators-promo__foot">
                    <p class="indicators-promo__disclaimer">{{ __('Публичные ориентиры, не инвестиционная рекомендация.') }}</p>
                    <p class="indicators-promo__sources" data-role="board-sources"></p>
                </footer>
            </div>
        </div>
    </div>
</section>
