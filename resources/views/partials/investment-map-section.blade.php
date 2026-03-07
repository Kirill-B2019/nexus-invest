{{-- Секция «Инвестиционные потребности регионов РФ» — интерактивная карта, светлая тема. --}}
<section class="section-box wow fadeIn box-investment-map" id="investment-map-section">
    <div class="container">
        <header class="mb-4">
            <h2 class="heading-2 mb-2">{{ __('Инвестиционные потребности регионов РФ') }}</h2>
            <p class="neutral-600">{{ __('Интерактивная карта с детализацией по регионам. Наведите на регион для подсказки, нажмите для подробностей.') }}</p>
        </header>
        <div class="rf-map-layout">
            <aside class="rf-map-filters-card" aria-label="{{ __('Фильтры') }}">
                <div class="rf-map-filters-card-inner">
                <div class="rf-map-filters-title" aria-hidden="true">
                    <svg class="rf-map-filters-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                </div>

                <div class="rf-map-filter-block rf-map-filter-dropdown" id="rf-map-regions-dropdown-block">
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
                        <div class="rf-map-filter-block rf-map-filter-dropdown">
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
                <div class="rf-map-filter-actions">
                    <button type="button" class="rf-map-btn rf-map-btn-apply" id="rf-map-btn-apply">{{ __('Применить') }}</button>
                    <button type="button" class="rf-map-btn rf-map-btn-reset" id="rf-map-btn-reset">{{ __('Сброс') }}</button>
                </div>
            </aside>
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
<script src="{{ asset('assets/js/investment-map.js') }}?v=1.0.0"></script>
@endpush
