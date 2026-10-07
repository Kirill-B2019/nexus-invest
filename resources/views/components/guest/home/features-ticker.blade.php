{{-- Компонент хранит единый список особенностей и их компактное представление в ленте. --}}
@php
    $platformFeatureTags = [
        ['icon' => 'fi-rr-diploma', 'label' => 'ЦФА'],
        ['icon' => 'fi-rr-building', 'label' => 'RWA'],
        ['icon' => 'fi-rr-badge', 'label' => 'УЦП'],
        ['icon' => 'fi-rr-layers', 'label' => 'Токенизация'],
        ['icon' => 'fi-rr-chart-network', 'label' => 'ГАНИМЕД'],
        ['icon' => 'fi-rr-chart-connected', 'label' => 'PoSA'],
        ['icon' => 'fi-rr-interactive', 'label' => 'Смарт-контракты'],
        ['icon' => 'fi-rr-head-side-thinking', 'label' => 'НЕКСУС ИИ'],
        ['icon' => 'fi-rr-chart-histogram', 'label' => 'Скоринг'],
        ['icon' => 'fi-rr-shield-check', 'label' => 'iGND'],
        ['icon' => 'fi-rr-fingerprint', 'label' => 'KYC/AML'],
        ['icon' => 'fi-rr-shield', 'label' => 'Комплаенс'],
        ['icon' => 'fi-rr-map', 'label' => 'Карта РФ'],
        ['icon' => 'fi-rr-shop', 'label' => 'Маркетплейс'],
        ['icon' => 'fi-rr-shuffle', 'label' => 'СФОРДЕКС'],
        ['icon' => 'fi-rr-refresh', 'label' => 'Вторичный рынок'],
        ['icon' => 'fi-rr-database', 'label' => 'Депозитарий'],
        ['icon' => 'fi-rr-bank', 'label' => 'Цифровой банк'],
        ['icon' => 'fi-rr-document-signed', 'label' => '282-ФЗ'],
        ['icon' => 'fi-rr-scale', 'label' => '289-ФЗ'],
        ['icon' => 'fi-rr-lock', 'label' => 'ГОСТ-криптография'],
        ['icon' => 'fi-rr-home', 'label' => 'Данные в РФ'],
        ['icon' => 'fi-rr-link', 'label' => 'API'],
        ['icon' => 'fi-rr-resources', 'label' => 'White-label'],
        ['icon' => 'fi-rr-chart-pie', 'label' => 'Портфельные стратегии'],
        ['icon' => 'fi-rr-apps', 'label' => 'Мультиролевые ЛК'],
        ['icon' => 'fi-rr-key', 'label' => 'RBAC'],
        ['icon' => 'fi-rr-mobile', 'label' => 'Мобильные клиенты'],
        ['icon' => 'fi-rr-recycle', 'label' => 'Полный цикл'],
    ];
@endphp

<section class="section-box box-logos-2 box-logos-2--dark box-features-ticker" aria-label="{{ __('Особенности платформы') }}">
    <div class="features-ticker features-ticker--centered">
        <div class="features-ticker__track">
            <div class="carouselTicker carouselTickerFeatures" id="slide-features">
                <ul class="carouselTicker__list">
                    @foreach ($platformFeatureTags as $tag)
                        <li class="carouselTicker__item">
                            <span class="item-feature-tag">
                                <i class="{{ $tag['icon'] }}" aria-hidden="true"></i>
                                <span class="item-feature-tag__label">{{ __($tag['label']) }}</span>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
