@extends('layouts.guest.guest')

@push('styles')
    @php
        $styleVerRoadmap = config('app.asset_version');
        if ($styleVerRoadmap === null || $styleVerRoadmap === '') {
            $styleVerRoadmap = '1.0.' . (config('app.env') === 'production' ? '0' : time());
        }
    @endphp
    <link rel="preload" href="{{ asset('assets/css/roadmap.css') }}?v={{ $styleVerRoadmap }}" as="style">
    <link href="{{ asset('assets/css/roadmap.css') }}?v={{ $styleVerRoadmap }}" rel="stylesheet" media="all">
    <link rel="preload" href="{{ asset('assets/css/industry-indicators.css') }}?v={{ $styleVerRoadmap }}" as="style">
    <link href="{{ asset('assets/css/industry-indicators.css') }}?v={{ $styleVerRoadmap }}" rel="stylesheet" media="all">
@endpush

@push('scripts-vendor')
    @php
        $v = config('app.asset_version');
        if ($v === null || $v === '') {
            $v = '1.0.' . (config('app.env') === 'production' ? '0' : time());
        }
    @endphp
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}?v={{ $v }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.carouselTicker.js') }}?v={{ $v }}"></script>
    <script src="{{ asset('assets/js/plugins/waypoints.js') }}?v={{ $v }}"></script>
    <script src="{{ asset('assets/js/plugins/counterup.js') }}?v={{ $v }}"></script>
@endpush

@section('metaDescription')
{{ __('НЕКСУС — платформа проектного финансирования и токенизации активов через ЦФА и RWA на блокчейне ГАНИМЕД. Маркетплейс результатов. Соответствие 259-ФЗ, 289-ФЗ.') }}
@endsection

@section('metaKeywords')
{{ __('проектное финансирование, токенизация, ЦФА, RWA, блокчейн ГАНИМЕД, НЕКСУС, инвестиции, цифровые активы, 259-ФЗ, маркетплейс') }}
@endsection

@section('content')
{{-- HERO-блок --}}
<section class="section-box">
   <div class="banner-hero hero-5">
        <div class="banner-inner-top">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-12 col-lg-4 order-1 order-lg-1">
                        <div class="box-banner-left">
                                <a class="btn btn-brand-5-new" href="{{ url('https://main-node.gnd-net.com') }}" target="_blank" rel="noopener noreferrer"><span>{{ __('Работает на:') }}</span> {{ __('блокчейне ГАНИМЕД') }}</a>
                                <p class="neutral-300 small pt-3 uppercase">{{ __('Новационная Единая ') }} <br><span class="display-6 uppercase"> {{ __('Комплексная Система Управления ') }} </span><br>{{ __('Сделками') }}</p>
                                {{--<h6 class="display-5 neutral-200 text-semibold pt-3">{{ __('ПРОЕКТНОЕ ФИНАНСИРОВАНИЕ') }}</h6>--}}
                            <p class="text-lg neutral-200  mt-10 mb-10 display-4 uppercase">
                            {{ __('Платформа полного цикла для токенизации инвестиционных проектов, распределения капитала и финансирования инициатив через цифровые активы.') }}
                            </p>
                            <h1 class="display-1 neutral-0 text-semibold mt-20 mb-20 ">{{ __('НЕКСУС') }}</h1>
                            <p class="text-lg neutral-200  mt-10 mb-30 display-4 uppercase">
                                {{ __('От запуска проекта и привлечения инвестиций до верификации результатов, постпроектного сопровождения и их реализации на цифровом маркетплейсе.') }}
                            </p>
                                {{--<h6 class="display-5 neutral-200 text-semibold pt-3 ">{{ __('ЦИФРОВЫЕ ИНВЕСТИЦИИ') }}</h6>--}}
                                <a class="btn btn-brand-4-medium hover-up mb-4 hero-cta-primary" href="{{asset('doc/NexusWhitePaper.pdf') }}" target="_blank" rel="noopener noreferrer">
                                    {{ __('WHITE PAPER НЕКСУС') }}
                                    <svg width="22" height="8" viewBox="0 0 22 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 4.00032L18.4791 0.479492V3.3074H0V4.69333H18.4791V7.52129L22 4.00032Z" fill=""></path>
                                    </svg>
                                </a>

                                <div class="hero-legal mt-3 mb-2">
                                    <p class="hero-legal__title">{{ __('Правовая и регуляторная основа') }}</p>
                                    <ul class="hero-legal__list" role="list">
                                        <li>
                                            <span class="hero-legal-chip" title="{{ __('259-ФЗ о ЦФА') }}">
                                                <span class="hero-legal-chip__code">259-ФЗ</span>
                                                <span class="hero-legal-chip__hint">{{ __('о ЦФА') }}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="hero-legal-chip" title="{{ __('289-ФЗ о платформенной экономике') }}">
                                                <span class="hero-legal-chip__code">289-ФЗ</span>
                                                <span class="hero-legal-chip__hint">{{ __('о платформенной экономике') }}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="hero-legal-chip" title="{{ __('39-ФЗ об инвестиционной деятельности') }}">
                                                <span class="hero-legal-chip__code">39-ФЗ</span>
                                                <span class="hero-legal-chip__hint">{{ __('об инвестиционной деятельности') }}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="hero-legal-chip" title="{{ __('187-ФЗ о безопасности') }}">
                                                <span class="hero-legal-chip__code">187-ФЗ</span>
                                                <span class="hero-legal-chip__hint">{{ __('о безопасности') }}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="hero-legal-chip" title="{{ __('115-ФЗ о ПОД/ФТ') }}">
                                                <span class="hero-legal-chip__code">115-ФЗ</span>
                                                <span class="hero-legal-chip__hint">{{ __('о ПОД/ФТ') }}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="hero-legal-chip" title="{{ __('152-ФЗ о персональных данных') }}">
                                                <span class="hero-legal-chip__code">152-ФЗ</span>
                                                <span class="hero-legal-chip__hint">{{ __('о персональных данных') }}</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="hero-legal-chip" title="{{ __('ГОСТы 34.10, 34.11, 34.12') }}">
                                                <span class="hero-legal-chip__code">{{ __('ГОСТ') }}</span>
                                                <span class="hero-legal-chip__hint">34.10 · 34.11 · 34.12</span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>


                        </div>
                    </div>

                    <div class="col-12 col-lg-8 order-2 order-lg-2 hero-5-col-cards">
                        <div class="box-banner-right">
                            <div class="blur-bg blur-move hero-5-cards-blur" aria-hidden="true"></div>
                            <div class="hero-eco-grid">
                                <article class="hero-eco-card">
                                    <h6 class="hero-eco-card__title">{{ __('НЕКСУС') }}</h6>
                                    <div class="hero-eco-card__media">
                                        <img src="{{ asset('assets/imgs/page/homepage1/hero-nexus.png') }}" alt="{{ __('НЕКСУС') }}" loading="eager" decoding="async" width="220" height="140">
                                    </div>
                                    <p class="hero-eco-card__desc">{{ __('Платформа токенизации проектов и управления') }}</p>
                                    <p class="hero-eco-card__stage">{{ __('Запуск: СТАДИЯ I') }}</p>
                                </article>
                                <article class="hero-eco-card">
                                    <h6 class="hero-eco-card__title">{{ __('ГАНИМЕД') }}</h6>
                                    <div class="hero-eco-card__media">
                                        <img src="{{ asset('assets/imgs/page/homepage1/hero-ganimed.png') }}" alt="{{ __('ГАНИМЕД') }}" loading="lazy" decoding="async" width="220" height="140">
                                    </div>
                                    <p class="hero-eco-card__desc">{{ __('Блокчейн ГАНИМЕД — основа экосистемы') }}</p>
                                    <p class="hero-eco-card__stage">{{ __('Запуск: СТАДИЯ II') }}</p>
                                </article>
                                <article class="hero-eco-card">
                                    <h6 class="hero-eco-card__title">{{ __('ЦИФРОВОЙ ДЕПОЗИТАРИЙ') }}</h6>
                                    <div class="hero-eco-card__media">
                                        <img src="{{ asset('assets/imgs/page/homepage1/hero-repo.png') }}" alt="{{ __('ЦИФРОВОЙ ДЕПОЗИТАРИЙ') }}" loading="lazy" decoding="async" width="220" height="140">
                                    </div>
                                    <p class="hero-eco-card__desc">{{ __('Хранение и учёт цифровых активов и прав') }}</p>
                                    <p class="hero-eco-card__stage">{{ __('Запуск: СТАДИЯ III') }}</p>
                                </article>
                                <article class="hero-eco-card">
                                    <h6 class="hero-eco-card__title">{{ __('НЕКСУС ЦИФРОВОЙ БАНК') }}</h6>
                                    <div class="hero-eco-card__media">
                                        <img src="{{ asset('assets/imgs/page/homepage1/hero-bank.png') }}" alt="{{ __('НЕКСУС ЦИФРОВОЙ БАНК') }}" loading="lazy" decoding="async" width="220" height="140">
                                    </div>
                                    <p class="hero-eco-card__desc">{{ __('Финансовые сервисы для токенизированных активов') }}</p>
                                    <p class="hero-eco-card__stage">{{ __('Запуск: СТАДИЯ III') }}</p>
                                </article>
                                <article class="hero-eco-card">
                                    <h6 class="hero-eco-card__title">{{ __('СФОРДЭКС') }}</h6>
                                    <div class="hero-eco-card__media">
                                        <img src="{{ asset('assets/imgs/page/homepage1/hero-sfodex.png') }}" alt="{{ __('СФОРДЭКС') }}" loading="lazy" decoding="async" width="220" height="140">
                                    </div>
                                    <p class="hero-eco-card__desc">{{ __('Система фондирования и распределения средств') }}</p>
                                    <p class="hero-eco-card__stage">{{ __('Запуск: СТАДИЯ II') }}</p>
                                </article>
                                <article class="hero-eco-card">
                                    <h6 class="hero-eco-card__title">{{ __('МАРКЕТПЛЕЙС') }}</h6>
                                    <div class="hero-eco-card__media">
                                        <img src="{{ asset('assets/imgs/page/homepage1/hero-market.png') }}" alt="{{ __('МАРКЕТПЛЕЙС') }}" loading="lazy" decoding="async" width="220" height="140">
                                    </div>
                                    <p class="hero-eco-card__desc">{{ __('Витрина рынков цифровых активов и продуктов') }}</p>
                                    <p class="hero-eco-card__stage">{{ __('Запуск: СТАДИЯ IV') }}</p>
                                </article>
                            </div>
                        </div>
                        <div class="d-flex mb-60 align-items-start gap-3 flex-wrap">

                            <div class="w-100 mt-40">
                                <div
                                    class="public-launch-countdown w-100"
                                    data-public-launch-countdown
                                    data-deadline="2027-03-01T00:00:00+03:00"
                                    role="timer"
                                    aria-live="polite"
                                    aria-atomic="true"
                                    aria-label="{{ __('До полной готовности Стадии I') }}: 01.03.2027"
                                >
                                    <div class="public-launch-countdown__info">
                                        <p class="public-launch-countdown__label">{{ __('До полной готовности Стадии I') }}</p>
                                        <p class="public-launch-countdown__date">01.03.2027</p>
                                    </div>
                                    <div class="public-launch-countdown__divider" aria-hidden="true"></div>
                                    <div class="public-launch-countdown__segments">
                                        <div class="public-launch-countdown__segment public-launch-countdown__segment--days">
                                                <span class="public-launch-countdown__value" data-unit="days" aria-label="--">
                                                    <span class="public-launch-countdown__digit">-</span><span class="public-launch-countdown__digit">-</span><span class="public-launch-countdown__digit">-</span>
                                                </span>
                                            <span class="public-launch-countdown__unit">{{ __('countdown unit days') }}</span>
                                        </div>
                                        <span class="public-launch-countdown__sep" aria-hidden="true">:</span>
                                        <div class="public-launch-countdown__segment">
                                                <span class="public-launch-countdown__value" data-unit="hours" aria-label="--">
                                                    <span class="public-launch-countdown__digit">-</span><span class="public-launch-countdown__digit">-</span>
                                                </span>
                                            <span class="public-launch-countdown__unit">{{ __('countdown unit hours') }}</span>
                                        </div>
                                        <span class="public-launch-countdown__sep" aria-hidden="true">:</span>
                                        <div class="public-launch-countdown__segment">
                                                <span class="public-launch-countdown__value" data-unit="minutes" aria-label="--">
                                                    <span class="public-launch-countdown__digit">-</span><span class="public-launch-countdown__digit">-</span>
                                                </span>
                                            <span class="public-launch-countdown__unit">{{ __('countdown unit minutes') }}</span>
                                        </div>
                                        <span class="public-launch-countdown__sep" aria-hidden="true">:</span>
                                        <div class="public-launch-countdown__segment">
                                                <span class="public-launch-countdown__value" data-unit="seconds" aria-label="--">
                                                    <span class="public-launch-countdown__digit">-</span><span class="public-launch-countdown__digit">-</span>
                                                </span>
                                            <span class="public-launch-countdown__unit">{{ __('countdown unit seconds') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <noscript>
                                    <p class="public-launch-countdown__noscript small neutral-300 mt-2 mb-0">{{ __('До полной готовности платформы') }}: 01.03.2027</p>
                                </noscript>
                            </div>
                        </div>
                        <aside class="hero-glossary mt-40" aria-label="{{ __('Ключевые понятия') }}">
                            <span class="hero-glossary__quote" aria-hidden="true">”</span>
                            <div class="hero-glossary__list">
                                <article class="hero-glossary__item">
                                    <h3 class="hero-glossary__term">{{ __('ТОКЕН') }}</h3>
                                    <p class="hero-glossary__text">{{ __('единица учёта, не являющаяся криптовалютой, предназначенная для представления цифрового баланса в некотором активе, иными словами, выполняющая функцию «заменителя ценных бумаг» в цифровом мире. Токены представляют собой запись в регистре, распределённую в блокчейн-цепочке.') }}</p>
                                </article>
                                <article class="hero-glossary__item">
                                    <h3 class="hero-glossary__term">{{ __('RWA (Real World Assets)') }}</h3>
                                    <p class="hero-glossary__text">{{ __('любые материальные активы, которые переносят в цифровой формат на блокчейне: например, золото, недвижимость, ценные бумаги, произведения искусства.') }}</p>
                                </article>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- КАРУСЕЛЬ ЛОГОТИПОВ --}}
@php
    $logoPath = public_path('assets/imgs/page/homepage1/out-logo');
    $logos = glob($logoPath . '/*.png');
    usort($logos, function ($a, $b) {
        return strnatcasecmp(basename($a), basename($b));
    });
@endphp
<section class="section-box wow fadeIn box-logos-2">
    <div class="container">
        <div class="carouselTickerLogos2 carouselTicker_vertical" id="slide-logos">
            <ul class="carouselTicker__list list-logos">
                @foreach ($logos as $logo)
                <li class="carouselTicker__item">
                    <div class="item-logo"><img src="{{ asset('assets/imgs/page/homepage1/out-logo/' . basename($logo)) }}" alt="{{ config('app.name') }}" loading="lazy" decoding="async"></div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

{{-- ЦЕЛЬ ЭКОСИСТЕМЫ --}}
<section class="section-box wow fadeIn box-our-track">
    <div class="container">
        <div class="row align-items-lg-start align-items-center">

            <div class="col-12 col-lg-4 text-center order-2 order-lg-1">
                <div class="box-banner-feature-2">

                    <img src="{{ asset('assets/imgs/page/homepage1/hero-goal.png')}}" alt="{{__('СФОРДЭКС')}}" loading="lazy" decoding="async">
                        <h4 class="neutral-0 mb-15">{{__('Целевые масштабы экосистемы к ')}} <span class="display-3">{{__('2031')}}</span>  {{__(' году')}}</h4>
                        <p class="text-md neutral-500 text-start">{{__('Экосистема призвана стать стандартом в сфере проектного финансирования и служить базовой платформой для структурирования и обращения проектных активов, объединяя инвесторов и инициаторов в едином цифровом пространстве.')}}</p>
                        <div class="list-our-works">
                            <div class="item-work">
                                <h4 class="brand-4"><span class="count">350</span><span>{{__(' тыс.+')}}</span></h4>
                                <p class="text-lg neutral-0 text-start">{{__('Проектов')}}<br /><span class="text-sm neutral-200">{{__('Завершенных и активных')}}</span></p>

                            </div>
                            <div class="item-work">
                                <h4 class="brand-4"><span class="count">7</span><span>{{__(' млн.+')}}</span></h4>
                                <p class="text-lg neutral-0 text-start">{{__('Клиентов')}}<br /><span class="text-sm neutral-200">{{__('Зарегистрировано в экосистеме')}}</span></p>
                            </div>
                            <div class="item-work">
                                <h4 class="brand-4"><span class="count">700</span><span>{{__(' тыс.+')}}</span></h4>
                                <p class="text-lg neutral-0 text-start">{{__('Сделок в год')}}</p>
                            </div>
                            <div class="item-work">
                                <h4 class="brand-4"><span class="count">7</span><span>{{__(' млрд.₽+')}}</span></h4>
                                <p class="text-lg neutral-0 text-start">{{__('Оборот в год')}} <br /><span class="text-sm neutral-200">{{ __('по всем видам сделок и продуктов.') }}</span></p>
                            </div>

                        </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 mb-40 order-1 order-lg-2">
                <div class="box-padding-left-50">
                    <div class="strate-icon"><span></span>
                        {{ __('НЕКСУС') }}&nbsp;
                        <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 2.5L17 0V1.75H0V3.25H17V5L20 2.5Z" fill="currentColor"/>
                            <path d="M0 9.5L3 12V10.25H20V8.75H3V7L0 9.5Z" fill="currentColor"/>
                        </svg>
                        &nbsp;{{ __(' ГАНИМЕД ') }}&nbsp;
                        <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 2.5L17 0V1.75H0V3.25H17V5L20 2.5Z" fill="currentColor"/>
                            <path d="M0 9.5L3 12V10.25H20V8.75H3V7L0 9.5Z" fill="currentColor"/>
                        </svg>
                        &nbsp;{{ __(' СФОРДЕКС') }}</div>
                    <h2 class="heading-2 mb-20">{{ __('ЦЕЛЬ ЭКОСИСТЕМЫ') }}</h2>

                    <p class="text-lg neutral-700 mb-10">    {{__('Создать единую цифровую инфраструктуру для привлечения капитала в реальные проекты: бизнес, девелопмент, инфраструктуру и государственно-частное партнёрство, а также обеспечить формирование законного, технологичного и ликвидного рынка цифровых активов, доступного для частных и институциональных инвесторов.') }}</p>
                    <p class="text-lg neutral-700 mb-10">    {{__('Предоставить портфельным инвесторам инструменты цифрового структурирования инвестиций, формирования инвестиционных портфелей и распределения капитала между проектами в соответствии с заданной стратегией, параметрами риска, сроками реализации и целевыми финансовыми показателями.') }}</p>
                    <p class="text-lg neutral-700 mb-10">    {{__('Обеспечить полный цикл сопровождения проектов от привлечения финансирования и реализации инвестиционной стратегии до постпроектного мониторинга, продвижения и реализации продукции и услуг, созданных в рамках экосистемы, через специализированный цифровой маркетплейс.') }}</p>
                    <p class="text-lg neutral-700 mb-10">    {{__('Создать систему дополнительного специализированного токенизированного финансирования и независимой верификации экологических, гуманитарных и социальных инициатив с подтверждением целевого использования средств, оказанной помощи и достигнутых результатов.') }}</p>
                    <h3 class="heading-2 mb-20">{{ __('Для кого:') }}</h3>
                    <div class="row" id="forWho">
                        <div class="col-12 col-lg-6">
                            <div class="card-pricing card-pricing-style-2 card-pricing-style-3 card-for-who">
                                <div class="card-title mb-3"><h6>{{ __('Инициаторов проектов  (кто привлекает капитал)') }}</h6></div>
                                <div class="card-lists">
                                    <ul class="lists-our-features">
                                        <li class="pb-2"><x-icons.svg-check-circle />
                                            {{ __('Микро, малый и средний бизнес (МСБ) в РФ, которым нужны инвестиции от 1–500 млн ₽ на развитие или запуск') }}</li>
                                        <li class="pb-2"><x-icons.svg-check-circle />
                                            {{ __('Бизнесы с понятным денежным потоком: торговля, услуги, производство, девелопмент, франчайзинг и т.п. (по секторам при регистрации)') }}</li>
                                        <li class="pb-2"><x-icons.svg-check-circle />
                                            {{ __('Финансовые и околофинансовые сервисы, которым нужен white‑label модуль выпуска и размещения обязательств (банки, факторинг, МФО, финтех‑стартапы)') }}</li>
                                        <li class="pb-2"><x-icons.svg-check-circle />
                                            {{ __('Компании и команды, которые планируют разместить продукты своей проектной деятельности на платформе и сохранить постпроектное сопровождение после запуска' )}}</li>


                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card-pricing card-pricing-style-2 card-pricing-style-3 card-for-who text-sm">
                                <div class="card-title mb-3"><h6>{{ __('Проектных инвесторов') }}</h6></div>
                                <div class="card-lists">
                                    <ul class="lists-our-features">
                                        <li class="pb-2"><x-icons.svg-check-circle />
                                            {{ __('Частные инвесторы с чеком от 5–100 тыс. ₽, ищущие доходность 14–25% годовых и выше по структурированным долговым инструментам *') }}</li>
                                        <li class="pb-2"><x-icons.svg-check-circle />
                                            {{ __('Квалифицированные и профессиональные инвесторы, фамильные офисы, небольшие фонды, заинтересованные в пулах МСБ‑займов с ИИ‑скорингом)') }}</li>
                                        <li class="pb-2"><x-icons.svg-check-circle />
                                            {{ __('Профучастники рынка ценных бумаг, банки и брокеры, интегрирующиеся по API') }}</li>
                                        <li class="pb-2"><x-icons.svg-check-circle />
                                            {{ __('B2B‑клиенты SaaS‑части: платформы, которым нужен модуль токенизации/обращения инструментов') }}</li>
                                    </ul>
                                    <p class="text-sm smaller neutral-500">{{ __('* Указанный диапазон — целевые показатели по историческим моделям. Фактическая доходность зависит от реализации проектов. Инвестирование сопряжено с риском потери вложенных средств.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-pricing card-pricing-style-2 card-pricing-style-3 card-for-who card-for-who-with-image text-sm">
                                <div class="card-for-who-content">
                                    <h5 class="mb-3">{{__('Портфельных инвесторов')}}</h5>
                                    <div class="card-lists">
                                        <ul class="lists-our-features">
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Частные и институциональные инвесторы, заинтересованные в распределении капитала между несколькими проектами и цифровыми инвестиционными инструментами.') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Семейные офисы, инвестиционные клубы, фонды и профессиональные участники рынка.') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Участники, которым нужны цифровые инструменты распределения капитала, управления рисками и мониторинга портфеля.') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Инвесторы, выбирающие проекты по заданным параметрам: отрасль, доходность, риск, срок, ликвидность и объём вложений.') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Клиенты, заинтересованные в автоматизированном подборе проектов и стратегий с использованием аналитики, скоринга и ИИ‑инструментов платформы.') }}</li>
                                        </ul>
                                        <p class="text-sm smaller neutral-500">{{ __('Итоговый состав портфеля и доступные инструменты зависят от статуса инвестора, результатов идентификации и комплаенс‑процедур.') }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-pricing card-pricing-style-2 card-pricing-style-3 card-for-who card-for-who-with-image text-sm">
                                <div class="card-for-who-content">
                                    <h5 class="mb-3">{{__('Специализированных инвесторов')}}</h5>
                                    <div class="card-lists">
                                        <ul class="lists-our-features">
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('ESG‑инвесторы, impact‑фонды, благотворительные организации и корпоративные доноры.') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Частные и институциональные участники, заинтересованные в финансировании экологических, гуманитарных и социальных инициатив.') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Организации, которым необходимы специализированные токенизированные инструменты для прозрачного учёта и целевого контроля финансирования.') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Участники, заинтересованные в независимой верификации оказанной помощи, её получателей, объёма и достигнутого эффекта.') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Инвесторы и организации, использующие экологические токены для подтверждения природоохранных мероприятий, восстановления природных объектов и иных измеримых экологических результатов.') }}</li>
                                        </ul>
                                        <p class="text-sm smaller neutral-500">{{ __('Порядок выпуска, обращения и погашения специализированных токенов определяется отдельной документацией платформы.') }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-pricing card-pricing-style-2 card-pricing-style-3 card-for-who card-for-who-with-image text-sm">
                                <div class="card-for-who-content">
                                    <h5 class="mb-3">{{__('А так же...')}}</h5>
                                    <div class="card-lists">
                                        <ul class="lists-our-features">
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Экспертов') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Аудиторов') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Финансовых аналитиков') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Инвестконсультантов') }}</li>
                                            <li class="pb-2"><x-icons.svg-check-circle />
                                                {{ __('Due diligence специалистов') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-for-who-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/forwho.png') }}" alt="{{ __('Для кого предназначена платформа НЕКСУС') }}" loading="lazy" decoding="async"></div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="row align-items-lg-start align-items-center">
            {{-- Как это работает --}}

            <h2 class="mt-15 mb-20">{{ __('Всего 3 простых шага к началу работы в системе') }}</h2>
            <p class="text-lg neutral-500 mb-55">{{ __('Простой старт и достижение ваших целей.') }}</p>
            <div class="row block-steps-badges">
                <div class="col-12 col-lg-4">
                    <div class="box-border-rounded">
                        <div class="card-casestudy">
                            <div class="card-title"><h6><span class="step-badge">1</span>{{ __('Регистрация в системе') }}</h6></div>
                            <div class="card-desc"><p>{{ __('Быстрая и простая регистрация даёт доступ сразу в индивидуальное рабочее пространство по выбранной цели на платформе (кабинет инициатора, инвестора, эксперта, аудитора, аналитика и т.д.).') }}</p></div>
                            <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare.png') }}" alt="{{ config('app.name') }}" loading="lazy" decoding="async"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="box-border-rounded">
                        <div class="card-casestudy">
                            <div class="card-title"><h6><span class="step-badge">2</span>{{ __('Исследования и выбор') }}</h6></div>
                            <div class="card-desc">
                                <p>{{ __('Начало работы с проектом или формирование инвестиционного портфеля.') }}</p>
                                <p>{{ __('Совместно с экспертами и нашим ИИ подберем наилучшую стратегию привлечения или предложим наиболее интересные и доходные инструменты.') }}</p>
                            </div>
                            <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare2.png') }}" alt="{{ config('app.name') }}" loading="lazy" decoding="async"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="box-border-rounded">
                        <div class="card-casestudy">
                            <div class="card-title"><h6><span class="step-badge">3</span>{{ __('Запуск и доход') }}</h6></div>
                            <div class="card-desc"><p>{{ __('Запуск проекта или активация выбранных инвестиционных инструментов. Экосистема автоматизирует ключевые процессы, обеспечивая прозрачность, контроль и стабильный поток привлечения или дохода в реальном времени.') }}</p></div>
                            <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare3.png') }}" alt="{{ config('app.name') }}" loading="lazy" decoding="async"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-start">

                    <a class="btn btn-learmore-2" href="{{ url('/about') }}"><span>
                            <x-icons.svg-arrow />
                        </span>{{ __('Подробнее') }}</a>
                    <p class="text-sm neutral-500">{{ __('Функциональность, операционная модель и т.д.') }}</p>

                </div>
            </div>
        </div>

    </div>
</section>
{{-- Стратегии, которые работают' --}}
<section class="section-box wow fadeIn box-our-track-2">
    <div class="container">
        {{-- Управление инвестиционной стратегией и прогресс привлечения с НЕКСУС ИИ --}}
        <div class="row align-items-center">
            <div class="col-12 col-lg-8 mb-40">
                <div class="strate-icon"><span></span> {{ __('Стратегии, которые работают и управление инвестиционными рисками') }}</div>
                <h2 class="heading-2 mb-20">{{ __('Управление инвестиционной стратегией и прогресс привлечения с НЕКСУС ИИ') }}</h2>
                <p class="text-lg neutral-700">{{__('ИИ платформы помогает выстраивать стратегию, контролировать динамику привлечения капитала и качество портфеля в режиме реального времени') }}</p>
                <div class="row mt-50">
                    <div class="col-12">
                        <div class="card-feature-2">
                            <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/ai-brain.svg') }}" alt="{{ __('Интеграция ИИ') }}" loading="lazy" decoding="async"></div>
                            <div class="card-info"><a href="{{ route('nexus-ai') }}"><h3 class="text-22-bold">{{ __('Глубокая интеграция ИИ расширяет базовые возможности') }}</h3></a>
                                <p class="text-md neutral-800">{{ __('- Автоматизация проектного скоринга с вынесением индекса инвестиционной привлекательности и решения об алгоритме токенизации, прогнозы по капитализации после завершения проекта.') }}</p>
                                <p class="text-md neutral-800">{{ __('- ИИ анализирует потоки заявок, конверсии и выплаты, подсвечивая сильные и слабые сегменты портфеля.') }}</p>
                                <p class="text-md neutral-800">{{ __('- Стратегические дашборды показывают план/факт по привлечению, срокам и доходности для разных групп инвесторов и проектов.') }}</p>
                                <p class="text-md neutral-800">{{ __('- Встроенный риск‑анализ и комплаенс‑фильтры помогают снижать долю проблемных кейсов и спекулятивных историй.') }}</p>
                                <p class="text-md neutral-800">{{ __('- Гибкие сценарии стратегии позволяют моделировать доходность и ликвидность портфеля на горизонте 3–5 лет.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-40">
                <div class="box-border-image">
                    <div class="box-image-line-1">
                        <div class="wow fadeInDown" data-wow-delay="0"><img src="{{ asset('assets/imgs/page/homepage1/ai-strategy.png') }}" alt="{{ __('НЕКСУС ИИ — интеллектуальный контур платформы') }}" loading="lazy" decoding="async"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Система смягчения инвестиционных и проектных рисков --}}
        <div class="row align-items-center">
            <div class="col-12 col-lg-4 text-center mb-40 order-2 order-lg-1">
                <div class="box-border-image">
                    <div class="box-image-line-1">
                        <div class="wow fadeInDown" data-wow-delay="0"><img src="{{ asset('assets/imgs/page/homepage1/sheld-ignd.png') }}" alt="{{ __('Система смягчения инвестиционных рисков iGND') }}" loading="lazy" decoding="async"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 mb-40 order-1 order-lg-2">
                <h2 class="heading-2 mb-20">{{ __('В случае реализации инвестиционных рисков') }}</h2>
                <p class="text-lg neutral-700">{{__('Система смягчения инвестиционных и проектных рисков') }}</p>
                <div class="row mt-50">
                     <div class="col-lg-12">
                        <div class="card-feature-2 card-feature-2-mobile-text-first">
                            <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/sheld-risk.svg') }}" alt="{{ __('Система смягчения рисков') }}" loading="lazy" decoding="async"></div>
                            <div class="card-info"><a href="#"><h3 class="text-22-bold">{{ __('Автоматизированная система смягчения рисков (смарт-контракт платформы, нативный внутренний токен iGND) для инвесторов и инициаторов проектов') }}</h3></a>
                                <p class="text-md neutral-700">{{ __('Участникам системы смягчения рисков, в случае реализации инвестиционных рисков по отдельным проектам, начисляются дополнительные специализированные внутренние токены системы.') }}</p>
                                <p class="text-md neutral-700">{{ __('- Начисление и обращение токенов iGND реализуется через смарт‑контракты блокчейна экосистемы и ') }} <span class="neutral-1000">{{ __('не является гарантией сохранения капитала или доходности.') }}</span></p>
                                <p class="text-md neutral-700">{{__('- Полученные токены предоставляют право на участие в отобранных инвестиционных возможностях на специальных условиях в пределах, установленных документацией платформы.')}}</p>
                                <p class="text-md neutral-700 mt-3">{{__('Функционал системы направлен на частичное сглаживание последствий неблагоприятного исхода отдельных проектов за счёт участия в последующих раундах и иных проектах, но ')}}<span class="neutral-1000">{{ __('не исключает риск потери инвестированных средств.') }}</span></p>
                            </div>
                        </div>
                         <div class="box-buttons-feature-4">
                             <a class="btn btn-learmore-2" href="{{ route('ignd') }}"><span>
                            <x-icons.svg-arrow />
                        </span>{{ __('Подробнее') }}</a>
                         </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
{{-- Дорожная карта платформы --}}
<section class="section-box wow fadeIn box-imazing-features animated" id="Road">
    <div class="container">
        <div class="roadmap-head">
            <h2 class="roadmap-head__title">{{ __('Дорожная карта платформы') }}</h2>
            <div class="roadmap-head__progress" aria-label="{{ __('Прогресс реализации MVP НЕКСУС') }}">
                <span class="roadmap-head__progress-label">{{ __('Прогресс реализации MVP НЕКСУС') }}</span>
                <div class="roadmap-head__progress-track">
                    <div class="roadmap-head__progress-fill" style="width: 37%"></div>
                </div>
                <span class="roadmap-head__progress-value">37%</span>
            </div>
        </div>

        <div class="roadmap-board">
            <article class="roadmap-card">
                <div class="roadmap-card__meta">
                    <span class="roadmap-card__badge">{{ __('Стадия I') }}</span>
                    <span class="roadmap-card__version">V1.0.0 · Q4 2026</span>
                    <span class="roadmap-card__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2.5 20.5 7v10L12 21.5 3.5 17V7L12 2.5Z" stroke="currentColor" stroke-width="1.5"/><path d="M12 12v9.5M12 12 3.5 7M12 12l8.5-5" stroke="currentColor" stroke-width="1.5"/></svg>
                    </span>
                </div>
                <h3 class="roadmap-card__title">{{ __('MVP запуск платформы НЕКСУС и блокчейна ГАНИМЕД') }}</h3>
                <ul class="roadmap-card__list">
                    <li>{{ __('Архитектура блокчейна ГАНИМЕД — готова (MVP)') }}</li>
                    <li>{{ __('Мастер-нода запущена') }}</li>
                    <li>{{ __('Платформа НЕКСУС — в разработке (70%)') }}</li>
                    <li>{{ __('Регистрация ОИС НЕКСУС в ЦБ РФ — документы готовятся') }}</li>
                    <li>{{ __('Обучение НЕКСУС ИИ') }}</li>
                </ul>
                <div class="roadmap-card__status">
                    <div class="roadmap-card__status-row">
                        <span>{{ __('70% готово') }}</span>
                    </div>
                    <div class="roadmap-card__bar"><span style="width: 70%"></span></div>
                </div>
            </article>

            <article class="roadmap-card">
                <div class="roadmap-card__meta">
                    <span class="roadmap-card__badge">{{ __('Стадия II') }}</span>
                    <span class="roadmap-card__version">V2.0.0 · Q2 2027</span>
                    <span class="roadmap-card__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M4 20h16M6 20V10l6-5 6 5v10M10 20v-5h4v5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 12h.01M15 12h.01M12 9h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </span>
                </div>
                <h3 class="roadmap-card__title">{{ __('MVP запуск площадки СФОРДЕКС и регистрация ОИС') }}</h3>
                <ul class="roadmap-card__list">
                    <li>{{ __('Статус ОИС получен') }}</li>
                    <li>{{ __('Площадка СФОРДЕКС интегрирована с ГАНИМЕД и НЕКСУС') }}</li>
                    <li>{{ __('Торги активны 24/7') }}</li>
                    <li>{{ __('Расширенный функционал НЕКСУС реализован') }}</li>
                    <li>{{ __('ГАНИМЕД прошел лицензирование и аудит') }}</li>
                </ul>
                <div class="roadmap-card__status">
                    <div class="roadmap-card__status-row">
                        <span>{{ __('В разработке') }}</span>
                    </div>
                    <div class="roadmap-card__bar"><span style="width: 28%"></span></div>
                </div>
            </article>

            <article class="roadmap-card">
                <div class="roadmap-card__meta">
                    <span class="roadmap-card__badge">{{ __('Стадия III') }}</span>
                    <span class="roadmap-card__version">V3.0.0 · Q1 2028</span>
                    <span class="roadmap-card__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="2.2" stroke="currentColor" stroke-width="1.5"/><circle cx="5" cy="7" r="1.8" stroke="currentColor" stroke-width="1.5"/><circle cx="19" cy="7" r="1.8" stroke="currentColor" stroke-width="1.5"/><circle cx="5" cy="17" r="1.8" stroke="currentColor" stroke-width="1.5"/><circle cx="19" cy="17" r="1.8" stroke="currentColor" stroke-width="1.5"/><path d="M6.6 8.2 10.2 10.8M13.8 10.8l3.6-2.6M6.6 15.8l3.6-2.6M13.8 13.2l3.6 2.6" stroke="currentColor" stroke-width="1.5"/></svg>
                    </span>
                </div>
                <h3 class="roadmap-card__title">{{ __('MVP запуск ЦИФРОВОГО ДЕПОЗИТАРИЯ И РЕГИСТРАЦИЯ ДЕПОЗИТАРНОЙ ЛИЦЕНЗИИ') }}</h3>
                <ul class="roadmap-card__list">
                    <li>{{ __('Юридическое лицо депозитария создано и включено в периметр экосистемы НЕКСУС') }}</li>
                    <li>{{ __('Требования ЦБ РФ по 39‑ФЗ и 259‑ФЗ выполнены') }}</li>
                    <li>{{ __('MVP‑функционал: открытие счетов депо, учет прав, корпоративные действия, отчётность и API запущены') }}</li>
                    <li>{{ __('Расчётно‑клиринговая инфраструктура') }}</li>
                    <li>{{ __('ИБ‑аудит и стресс‑тесты, подтвержден уровень отказоустойчивости и соответствие требованиям по защите информации проведены') }}</li>
                </ul>
                <div class="roadmap-card__status">
                    <div class="roadmap-card__status-row">
                        <span>{{ __('Запланировано') }}</span>
                    </div>
                    <div class="roadmap-card__bar"><span style="width: 8%"></span></div>
                </div>
            </article>

            <article class="roadmap-card">
                <div class="roadmap-card__meta">
                    <span class="roadmap-card__badge">{{ __('Стадия IV') }}</span>
                    <span class="roadmap-card__version">V4.0.0 · 2028+</span>
                    <span class="roadmap-card__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M3 5h2l2.2 9.2a2 2 0 0 0 2 1.5h7.6a2 2 0 0 0 2-1.6L20 8H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="10" cy="19" r="1.5" stroke="currentColor" stroke-width="1.5"/><circle cx="17" cy="19" r="1.5" stroke="currentColor" stroke-width="1.5"/></svg>
                    </span>
                </div>
                <h3 class="roadmap-card__title">{{ __('Маркетплейс, ЦИФРОВОЙ БАНКОВСКИЙ КОНТУР + IPO') }}</h3>
                <ul class="roadmap-card__list">
                    <li>{{ __('Маркетплейс интегрирован с экосистемой: данные по проектам, статусам и лимитам подтягиваются автоматически') }}</li>
                    <li>{{ __('Реализована связка покупок на маркетплейсе с инвестиционными метриками проектов (выручка, LTV, выполнение KPI)') }}</li>
                    <li>{{ __('Платформа интегрирована с банком-оператором') }}</li>
                    <li>{{ __('Запуск маркетплейса') }}</li>
                    <li>{{ __('Запуск цифрового банковского контура') }}</li>
                    <li>{{ __('Подготовка к IPO НЕКСУС') }}</li>

                </ul>
                <div class="roadmap-card__status">
                    <div class="roadmap-card__status-row">
                        <span>{{ __('Запланировано') }}</span>
                    </div>
                    <div class="roadmap-card__bar"><span style="width: 8%"></span></div>
                </div>
            </article>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="section-box box-faqs-3 faq-section-light" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="box-faq-left box-faq-left--intro">
                    <a class="btn btn-brand-4-sm" href="#faq">{{ __('Часто задаваемые вопросы') }}</a>
                    <h2 class="heading-2 mb-20 mt-20">{{ __('Остались вопросы?') }}</h2>
                    <p class="text-lg neutral-700">{{ __('Ниже — ответы на частые вопросы. Дополнительные материалы — в разделе ') }} <a class="text-18-bold brand-1-1" href="{{ route('documentation') }}">{{ __('«Документация»') }}</a>.</p>
                </div>
            </div>
            <div class="col-lg-7">
                <x-guest.faq-accordion :items="[
                    [
                        'question' => 'Что такое НЕКСУС?',
                        'answer' => 'НЕКСУС — экосистема проектного финансирования и токенизации активов в соответствии с российским законодательством (в том числе 259‑ФЗ о ЦФА): запуск проектов, выпуск и обращение цифровых активов, в том числе RWA (токенизация прав на реальные активы), утилитарные цифровые права (УЦП), токенизация иных активов, сопровождение сделок и развитие вторичного рынка в рамках модели платформы.',
                        'open' => true,
                    ],
                    [
                        'question' => 'Чем цифровые активы и ЦФА отличаются от «криптовалюты»?',
                        'answer' => 'ЦФА и иные цифровые активы в контуре платформы выпускаются и обращаются по правилам 259‑ФЗ и договорной модели оператора: есть эмитент, раскрытие информации, учёт прав и требования к инвесторам. Это не свободно обращающаяся «криптовалюта» и не анонимные расчёты вне правового поля РФ.',
                    ],
                    [
                        'question' => 'На какой технологии построен блокчейн ГАНИМЕД?',
                        'answer' => 'ГАНИМЕД реализован как высокопроизводительная распределённая платформа (в т.ч. на Go), с гибридным консенсусом PoSA, EVM‑совместимостью для смарт‑контрактов и развитием экосистемы под задачи токенизации и учёта цифровых активов в соответствии с применимыми требованиями.',
                    ],
                    [
                        'question' => 'Кто может стать участником платформы?',
                        'answer' => 'Доступ к функциям личного кабинета и сделкам предоставляется после регистрации и прохождения процедур идентификации и комплаенса (KYC/AML) в объёме, предусмотренном правилами платформы и законодательством. Набор ролей (инициатор проекта, инвестор, эксперт и др.) определяется моделью доступа и назначенными правами.',
                    ],
                    [
                        'question' => 'Что такое iGND и «смягчение рисков» в экосистеме?',
                        'answer' => [
                            'iGND — внутренний токен экосистемы в логике программ смягчения последствий формально описанных риск‑событий по проектам для инвесторов, выбравших соответствующие планы участия.',
                            'Условия начислений, ограничения и правовая природа закреплены в документах платформы и смарт‑контрактах на блокчейне ГАНИМЕД; начисления не гарантируются и зависят от наступления событий и параметров пулов.',
                        ],
                    ],
                    [
                        'question' => 'Где ознакомиться с официальными документами и White Paper?',
                        'answer' => 'Актуальные PDF (публичная оферта, пользовательское соглашение, политика конфиденциальности, KYC/AML, White Paper и др.) доступны по ссылкам в подвале сайта; расширенные технические и методические материалы — в разделе «Документация».',
                    ],
                    [
                        'question' => 'Как обрабатываются персональные данные?',
                        'answer' => 'Обработка ведётся в соответствии с 152‑ФЗ и политикой конфиденциальности: указаны цели, категории данных, сроки и права субъектов; применяются организационные и технические меры защиты, согласованные с заявленными в документе целями.',
                    ],
                    [
                        'question' => 'На каком этапе развития находится платформа?',
                        'answer' => [
                            'Функционал выводится поэтапно согласно дорожной карте: отдельные модули и интеграции могут находиться в стадии MVP или пилота.',
                            'Блоки «прогресс реализации» и дорожная карта на сайте отражают ориентировочное состояние и планы; конкретные сроки не являются публичной офертой до их отдельного официального объявления.',
                        ],
                    ],
                ]" />
            </div>
        </div>
    </div>
</section>
{{-- Инвестиционные потребности регионов РФ — интерактивная карта --}}
@include('partials.investment-map-section', ['regionsForMap' => $regionsForMap ?? [], 'mapSvg' => $mapSvg ?? '', 'mapFilterDictionaries' => $mapFilterDictionaries ?? []])
{{-- Новости с канала Дзен (https://dzen.ru/digital_fintech), обновляются в админке по кнопке --}}
@if(isset($newsFeedItems) && $newsFeedItems->isNotEmpty())
    @php
        $newsPlaceholder = asset('assets/imgs/page/homepage1/img-news.png');
    @endphp
    <section class="section-box box-latest-news box-latest-news-2" id="news-feed-section">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8 mb-30">
                    <div class="strate-icon"><span></span> {{ __('Актуальные материалы и обновления платформы из нашего канала ДЗЕН.') }}</div>
                    <h2 class="heading-2 mb-10">{{ __('Новости и истории') }}</h2>
                </div>
                <div class="col-lg-4 mb-30">
                    <div class="d-flex flex-wrap align-items-center justify-content-lg-end gap-3">
                        <a class="btn btn-brand-4-sm" href="{{ route('news.index') }}">{{ __('Все новости') }}</a>
                        <div class="box-button-slider box-button-slider-team">
                            <button type="button" class="swiper-button-prev swiper-button-prev-testimonials swiper-button-prev-3" id="news-carousel-prev" aria-label="{{ __('Назад') }}"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.66667 3.33398L2 8.00065M2 8.00065L6.66667 12.6673M2 8.00065H14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>
                            <button type="button" class="swiper-button-next swiper-button-next-testimonials swiper-button-next-3" id="news-carousel-next" aria-label="{{ __('Вперёд') }}"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M9.33333 3.33398L14 8.00065M14 8.00065L9.33333 12.6673M14 8.00065H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-swiper mt-30">
                <div class="swiper-container swiper-group-3" id="news-feed-carousel">
                    <div class="swiper-wrapper">
                        @foreach($newsFeedItems as $item)
                            @php
                                $cover = $item->cover_url ?: $newsPlaceholder;
                                $itemDate = $item->published_at ?? $item->created_at;
                                $href = $item->permalink ?: ($item->url ?: '#');
                            @endphp
                            <div class="swiper-slide">
                                <article class="news-home-card">
                                    <a class="news-home-card__media" href="{{ $href }}" @if($item->is_external) target="_blank" rel="noopener noreferrer" @endif>
                                        <img
                                            class="news-home-card__img"
                                            src="{{ $cover }}"
                                            alt="{{ e($item->title) }}"
                                            width="600"
                                            height="400"
                                            loading="eager"
                                            decoding="async"
                                            onerror="this.onerror=null;this.src='{{ $newsPlaceholder }}';"
                                        >
                                    </a>
                                    <div class="news-home-card__body">
                                        @if($itemDate)
                                            <time class="news-home-card__date" datetime="{{ $itemDate->toDateString() }}">{{ $itemDate->translatedFormat('d F Y') }}</time>
                                        @endif
                                        <a class="news-home-card__title" href="{{ $href }}" @if($item->is_external) target="_blank" rel="noopener noreferrer" @endif>{{ e($item->title) }}</a>
                                        @if($item->description)
                                            <p class="news-home-card__excerpt">{{ e(str()->limit($item->description, 160)) }}</p>
                                        @endif
                                    </div>
                                    <a class="news-home-card__cta" href="{{ $href }}" @if($item->is_external) target="_blank" rel="noopener noreferrer" @endif>
                                        <span class="news-home-card__cta-icon" aria-hidden="true">
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.6557 3.81393L1.71996 12.7497L0.251953 11.2817L9.18664 2.34592H1.31195V0.269531H12.7321V11.6897H10.6557V3.81393Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        {{ __('Подробнее') }}
                                    </a>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            (function() {
                var el = document.getElementById('news-feed-carousel');
                if (!el || typeof Swiper === 'undefined') return;
                var swiper = new Swiper('#news-feed-carousel', {
                    spaceBetween: 30,
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    initialSlide: 0,
                    loop: false,
                    watchOverflow: true,
                    observer: false,
                    observeParents: false,
                    cssMode: false,
                    autoplay: { delay: 5000, disableOnInteraction: false },
                    navigation: {
                        nextEl: '#news-carousel-next',
                        prevEl: '#news-carousel-prev'
                    },
                    breakpoints: {
                        400: { slidesPerView: 1 },
                        800: { slidesPerView: 2 },
                        1200: { slidesPerView: 3 }
                    },
                    on: {
                        reachEnd: function () {
                            var self = this;
                            setTimeout(function () { self.slideTo(0); }, 5000);
                        }
                    }
                });
                void swiper;
            })();
        </script>
    @endpush
@endif

{{-- ОТРАСЛЕВЫЕ ИНДИКАТОРЫ — после блока «Руководители команды» --}}
@include('partials.industry-indicators-board', ['indicatorsBoardId' => 'home-indicators-board'])
{{-- КОМАНДА --}}
<section class="section-box wow box-why-trusted-black">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-30 order-2 order-lg-1">
                <div class="testimonial-img-animated text-center">
                    <img src="{{ asset('assets/imgs/page/homepage1/img-testimonial.png') }}" alt="{{ config('app.name') }}" loading="lazy" decoding="async" class="w-75">
                </div>
                <ul class="list-checked list-checked--team">
                    <li>
                        <span class="d-block fw-semibold neutral-0 mb-5">{{ __('Инженерный контур') }}</span>
                        <span class="text-sm neutral-500">{{ __('Backend, frontend, mobile, DevOps и QA — собирают клиентский слой цифрового банка, личные кабинеты, API‑шлюз к ОИС НЕКСУС и технологический слой ГАНИМЕД в единую управляемую среду.') }}</span>
                    </li>
                    <li>
                        <span class="d-block fw-semibold neutral-0 mb-5">{{ __('Методологи проектного цикла') }}</span>
                        <span class="text-sm neutral-500">{{ __('Описывают, как проект проходит путь от заявки инициатора до выпуска ЦФА, размещения, контроля траншей и выплат: структуры финансирования, KPI, ковенанты и регламенты, которые затем становятся правилами ОИС и сценариями в экосистеме.') }}</span>
                    </li>
                    <li>
                        <span class="d-block fw-semibold neutral-0 mb-5">{{ __('Аналитики и риск‑менеджеры') }}</span>
                        <span class="text-sm neutral-500">{{ __('Следят за концентрацией портфелей, отклонениями plan/fact, просрочками и событиями по выпускам; формируют сигналы для инвесторов в кабинете и для операционного контура ОИС — до того, как риск превращается в регуляторный или репутационный инцидент.') }}</span>
                    </li>
                    <li>
                        <span class="d-block fw-semibold neutral-0 mb-5">{{ __('Специалисты комплаенс и правового блока') }}</span>
                        <span class="text-sm neutral-500">{{ __('Выстраивают допуск участников и проектов под 259‑ФЗ, 115‑ФЗ и требования Банка России к ОИС: KYC/KYB, раскрытие, договорная модель выпуска, взаимодействие с депозитарным и расчётным контуром — отдельно от маркетингового бренда цифрового банка.') }}</span>
                    </li>
                    <li>
                        <span class="d-block fw-semibold neutral-0 mb-5"><a href="{{ route('nexus-ai') }}" class="neutral-0">{{ __('Операторы скоринга, ML и оптимизации (НЕКСУС ИИ)') }}</a></span>
                        <span class="text-sm neutral-500">{{ __('Обучают и разрабатывают модели предварительного скоринга проектов, подбора инструментов для инвестора и раннего выявления аномалий, контроль параметров допуска и мониторинг обязательств без подмены юридического решения алгоритмом.') }}</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 mb-30 order-1 order-lg-2">
                <div class="mb-50"><a class="btn btn-brand-4-sm" href="#">{{ __('Руководители команды и проекта') }}</a>
                    <h3 class="mt-20 neutral-0">{{ __('Команда, которая строит новый стандарт проектного запуска') }}</h3>
                </div>
                <div class="testimonials-stack mt-30" id="onwer">
                    <div class="card-testimonial-3 mb-30 ">
                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/img-review.png') }}" alt="{{ config('app.name') }}" loading="lazy" decoding="async"></div>
                        <div class="card-info">
                            <p class="text-md neutral-500"><i class="fi-rr-quote-right"></i>&nbsp;{{ __('Мы создаём не просто бизнес‑платформу для инвестиций, а новую инфраструктуру рынка, где цифровые инструменты становятся понятным, прозрачным и эффективно работающим каналом капитала в реальную экономику.') }}"</p>
                            <div class="card-author-review">
                                <div class="card-author-info"><span class="author-name">{{__('ЮРИЙ ХЕ')}}</span><span class="author-tag">{{__('Генеральный директор - соучредитель')}}</span></div>
                            </div>
                            <div class="card-rate"><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""></div>
                        </div>
                    </div>
                    <div class="card-testimonial-3 mb-30">
                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/img-review-finance.png') }}" alt="{{ config('app.name') }}" loading="lazy" decoding="async"></div>
                        <div class="card-info">
                            <p class="text-md neutral-500"><i class="fi-rr-quote-right"></i>&nbsp;{{ __('Финансовая архитектура платформы выстроена так, чтобы обеспечивать прозрачную структуру капитала, контролируемую доходность инструментов и устойчивость модели роста на каждом этапе проектного цикла.') }}"</p>
                            <div class="card-author-review">
                                <div class="card-author-info"><span class="author-name">{{__('АДЫЛ НУРМАНБЕТОВ')}}</span><span class="author-tag">{{__('Финансовый директор - соучредитель')}}</span></div>
                            </div>
                            <div class="card-rate"><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""></div>
                        </div>
                    </div>
                    <div class="card-testimonial-3">
                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/img-review-k.png') }}" alt="{{ config('app.name') }}" loading="lazy" decoding="async"></div>
                        <div class="card-info">
                            <p class="text-md neutral-500"><i class="fi-rr-quote-right"></i>&nbsp;{{ __('Я проектирую платформу как целостный механизм, в котором архитектура, код и каждый технический узел связаны в одну логику — превратить сложную финансовую “машину” в управляемую, безопасную и предсказуемую среду роста для проектов и инвесторов.') }}"</p>
                            <div class="card-author-review">
                                <div class="card-author-info"><span class="author-name">{{__('КИРИЛЛ БОЯРИНОВ')}}</span><span class="author-tag">{{__('Автор, системный архитектор - соучредитель')}}</span></div>
                            </div>
                            <div class="card-rate"><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@push('scripts')
    @php
        $vCount = config('app.asset_version');
        if ($vCount === null || $vCount === '') {
            $vCount = '1.0.' . (config('app.env') === 'production' ? '0' : time());
        }
    @endphp
    <script src="{{ asset('assets/js/public-launch-countdown.js') }}?v={{ $vCount }}"></script>
    <script src="{{ asset('assets/js/industry-indicators.js') }}?v={{ $vCount }}" defer></script>
@endpush
