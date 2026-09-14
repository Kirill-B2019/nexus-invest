{{-- Карта инвестиций — тёмная «консоль аналитики» (вариант A) --}}
<section class="section-box wow fadeIn box-our-track-2 box-our-track-2--dark-stack box-investment-map mt-0" id="investment-map-section">
    <div class="map-promo">
        <div class="map-promo__frame">
            <header class="map-promo__head">
                <div class="map-promo__head-text">
                    <h2 class="map-promo__title">{{ __('Карта инвестиций') }}</h2>
                    <p class="map-promo__lead">{{ __('Интерактивная карта регионов РФ. Наведите на регион для подсказки, нажмите для подробностей.') }}</p>
                    <p class="map-promo__demo">{{ __('Карта носит демонстрационный характер') }}</p>
                </div>
                <span class="map-promo__badge">
                    <span class="map-promo__badge-dot" aria-hidden="true"></span>
                    {{ __('Регионы РФ') }}
                </span>
            </header>

            <div class="map-promo__toolbar" aria-label="{{ __('Фильтры') }}">
                <div class="map-promo__filters">
                    <div class="rf-map-filter-block rf-map-filter-dropdown map-promo__filter" id="rf-map-regions-dropdown-block">
                        <p class="rf-map-filters-label">{{ __('Регион') }}</p>
                        @if(!empty($regionsForMap))
                            <div class="rf-map-dropdown" data-filter="regions">
                                <button type="button" class="rf-map-dropdown-trigger" aria-expanded="false" aria-haspopup="listbox" data-placeholder="{{ __('Выбрать...') }}">
                                    <span class="rf-map-dropdown-text">{{ __('Выбрать...') }}</span>
                                    <span class="rf-map-dropdown-arrow" aria-hidden="true">▾</span>
                                </button>
                                <div class="rf-map-dropdown-panel" role="listbox" aria-multiselectable="true" hidden>
                                    <div class="rf-map-filter-options">
                                        @foreach($regionsForMap as $mapCode => $r)
                                            <label class="rf-map-filter-option">
                                                <input type="checkbox" name="rf-filter-regions[]" value="{{ $mapCode }}" data-code="{{ $mapCode }}" data-title="{{ e($r['name'] ?? '') }}" class="ganimed-status-checkbox">
                                                <span>{{ $r['name'] ?? $mapCode }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="rf-map-filters-empty small">{{ __('Нет данных регионов.') }}</p>
                        @endif
                    </div>

                    @foreach($mapFilterDictionaries ?? [] as $filterDict)
                        @if(!empty($filterDict['items']))
                            <div class="rf-map-filter-block rf-map-filter-dropdown map-promo__filter">
                                <p class="rf-map-filters-label">{{ $filterDict['name'] }}</p>
                                <div class="rf-map-dropdown" data-filter="{{ $filterDict['code'] }}">
                                    <button type="button" class="rf-map-dropdown-trigger" aria-expanded="false" aria-haspopup="listbox" data-placeholder="{{ __('Выбрать...') }}">
                                        <span class="rf-map-dropdown-text">{{ __('Выбрать...') }}</span>
                                        <span class="rf-map-dropdown-arrow" aria-hidden="true">▾</span>
                                    </button>
                                    <div class="rf-map-dropdown-panel" role="listbox" aria-multiselectable="true" hidden>
                                        <div class="rf-map-filter-options">
                                            @foreach($filterDict['items'] as $item)
                                                <label class="rf-map-filter-option">
                                                    <input type="checkbox" name="rf-filter-{{ $filterDict['code'] }}[]" value="{{ $item['id'] }}" data-name="{{ e($item['name'] ?? '') }}" class="ganimed-status-checkbox">
                                                    <span>{{ $item['name'] ?? $item['code'] ?? '' }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="map-promo__actions rf-map-filter-actions">
                    <button type="button" class="rf-map-btn rf-map-btn-apply" id="rf-map-btn-apply">{{ __('Применить') }}</button>
                    <button type="button" class="rf-map-btn rf-map-btn-reset" id="rf-map-btn-reset">{{ __('Сброс') }}</button>
                </div>
            </div>

            <div class="map-promo__stage">
                <div class="rf-map-wrapper">
                    <div class="rf-map" id="rf-map-container">
                        <div class="district" id="rf-map-tooltip" aria-hidden="true"><b></b><span></span></div>
                        @if(!empty($regionsForMap))
                            @foreach($regionsForMap as $r)
                                <div id="{{ $r['map_code'] }}" class="district-text" style="display: none;">{{ $r['name'] }}</div>
                            @endforeach
                        @endif
                        @if(!empty($mapSvg))
                            {!! $mapSvg !!}
                        @endif
                        <div class="district-links"></div>
                    </div>
                </div>
            </div>

            <footer class="map-promo__foot">
                <div class="map-promo__legend" aria-label="{{ __('Легенда') }}">
                    <span class="map-promo__legend-item">
                        <span class="map-promo__legend-dot map-promo__legend-dot--active" aria-hidden="true"></span>
                        {{ __('Активные') }}
                    </span>
                    <span class="map-promo__legend-item">
                        <span class="map-promo__legend-dot map-promo__legend-dot--planned" aria-hidden="true"></span>
                        {{ __('Планируемые') }}
                    </span>
                </div>
                <p class="map-promo__selected" id="map-promo-selected-count" aria-live="polite"></p>
            </footer>
        </div>
    </div>

    <dialog class="region-details-modal" id="region-details-modal" aria-labelledby="region-details-title">
        <div class="region-details-inner">
            <header class="region-details-header">
                <h3 id="region-details-title" class="h5 mb-0"></h3>
                <button type="button" class="region-details-close" data-close-modal aria-label="{{ __('Закрыть') }}">&times;</button>
            </header>
            <div class="region-details-body" id="region-details-body"></div>
        </div>
    </dialog>
    <script type="application/json" id="regions-for-map-data">{{ json_encode($regionsForMap ?? []) }}</script>
</section>
@push('scripts')
    @php
        $mapJsVer = config('app.asset_version');
        if ($mapJsVer === null || $mapJsVer === '') {
            $mapJsVer = '1.0.' . (config('app.env') === 'production' ? '0' : time());
        }
    @endphp
    <script src="{{ asset('assets/js/investment-map.js') }}?v={{ $mapJsVer }}"></script>
@endpush
