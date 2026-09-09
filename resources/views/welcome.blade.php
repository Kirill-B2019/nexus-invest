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

    </div>
</section>
{{-- 3 шага + НЕКСУС ИИ + iGND — непрерывная тёмная полоса --}}
<section class="section-box wow fadeIn box-our-track-2 box-our-track-2--dark-stack">
    {{-- Всего 3 простых шага к началу работы в системе --}}
    <div class="steps-promo" id="how-it-works">
        <div class="steps-promo__frame">
            <div class="steps-promo__grid">
                <div class="steps-promo__intro">
                    <h2 class="steps-promo__title">{{ __('Всего 3 простых шага к началу работы в системе') }}</h2>
                    <p class="steps-promo__lead">{{ __('Простой старт и достижение ваших целей.') }}</p>
                </div>

                <article class="steps-promo__step">
                    <div class="steps-promo__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-prepare.png') }}" alt="" loading="lazy" decoding="async" width="240" height="240">
                    </div>
                    <span class="steps-promo__badge" aria-hidden="true">1</span>
                    <h3 class="steps-promo__step-title">{{ __('Регистрация в системе') }}</h3>
                    <p class="steps-promo__step-text">{{ __('Быстрая и простая регистрация даёт доступ сразу в индивидуальное рабочее пространство по выбранной цели на платформе (кабинет инициатора, инвестора, эксперта, аудитора, аналитика и т.д.).') }}</p>
                </article>

                <div class="steps-promo__arrow" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>

                <article class="steps-promo__step">
                    <div class="steps-promo__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-prepare2.png') }}" alt="" loading="lazy" decoding="async" width="240" height="240">
                    </div>
                    <span class="steps-promo__badge" aria-hidden="true">2</span>
                    <h3 class="steps-promo__step-title">{{ __('Исследования и выбор') }}</h3>
                    <p class="steps-promo__step-text">{{ __('Начало работы с проектом или формирование инвестиционного портфеля. Совместно с экспертами и нашим ИИ подберем наилучшую стратегию привлечения или предложим наиболее интересные и доходные инструменты.') }}</p>
                </article>

                <div class="steps-promo__arrow" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>

                <article class="steps-promo__step">
                    <div class="steps-promo__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-prepare3.png') }}" alt="" loading="lazy" decoding="async" width="240" height="240">
                    </div>
                    <span class="steps-promo__badge" aria-hidden="true">3</span>
                    <h3 class="steps-promo__step-title">{{ __('Запуск и доход') }}</h3>
                    <p class="steps-promo__step-text">{{ __('Запуск проекта или активация выбранных инвестиционных инструментов. Экосистема автоматизирует ключевые процессы, обеспечивая прозрачность, контроль и стабильный поток привлечения или дохода в реальном времени.') }}</p>
                </article>
            </div>
        </div>
    </div>

    {{-- Управление инвестиционной стратегией и прогресс привлечения с НЕКСУС ИИ --}}
    <div class="ai-strategy-promo" id="nexus-ai-strategy">
        <div class="ai-strategy-promo__frame">
            <div class="ai-strategy-promo__grid">
                <div class="ai-strategy-promo__brand">
                    <img
                        class="ai-strategy-promo__logo"
                        src="{{ asset('assets/imgs/template/16.svg') }}"
                        alt="{{ __('НЕКСУС ИИ') }}"
                        width="300"
                        height="88"
                        loading="lazy"
                        decoding="async"
                    >
                    <p class="ai-strategy-promo__lead">{{ __('Аналитика, операторы и управление проектами на основе искусственного интеллекта.') }}</p>
                    <p class="ai-strategy-promo__sub">{{ __('Управление инвестиционной стратегией и прогресс привлечения') }}</p>
                </div>

                <div class="ai-strategy-promo__console">
                    <div class="ai-strategy-promo__console-head">
                        <span class="ai-strategy-promo__console-icon" aria-hidden="true">
                            <svg width="40" height="40" viewBox="0 0 48 48" fill="none">
                                <rect x="14" y="14" width="20" height="20" rx="3" stroke="currentColor" stroke-width="1.6"/>
                                <circle cx="24" cy="24" r="4" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M24 8v4M24 36v4M8 24h4M36 24h4M12 12l3 3M33 33l3 3M12 36l3-3M33 15l3-3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                <path d="M10 22c-4-6-2-12 2-14M38 26c4 6 2 12-2 14M18 40c-7 2-12-2-13-7M30 8c7-2 12 2 13 7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <p class="ai-strategy-promo__console-label">{{ __('Оператор консоль') }}</p>
                    </div>
                    <h2 class="ai-strategy-promo__console-title">
                        <a href="{{ route('nexus-ai') }}">{{ __('Глубокая интеграция ИИ расширяет базовые возможности') }}</a>
                    </h2>
                    <ul class="ai-strategy-promo__list">
                        <li>{{ __('Автоматизация проектного скоринга с вынесением индекса инвестиционной привлекательности и решения об алгоритме токенизации, прогнозы по капитализации после завершения проекта.') }}</li>
                        <li>{{ __('ИИ анализирует потоки заявок, конверсии и выплаты, подсвечивая сильные и слабые сегменты портфеля.') }}</li>
                        <li>{{ __('Стратегические дашборды показывают план/факт по привлечению, срокам и доходности для разных групп инвесторов и проектов.') }}</li>
                        <li>{{ __('Встроенный риск‑анализ и комплаенс‑фильтры помогают снижать долю проблемных кейсов и спекулятивных историй.') }}</li>
                        <li>{{ __('Гибкие сценарии стратегии позволяют моделировать доходность и ликвидность портфеля на горизонте 3–5 лет.') }}</li>
                    </ul>
                </div>

                <div class="ai-strategy-promo__visual">
                    <div class="ai-strategy-promo__media">
                        <img
                            src="{{ asset('assets/imgs/page/homepage1/ai-strategy.png') }}"
                            alt="{{ __('НЕКСУС ИИ — интеллектуальный контур платформы') }}"
                            loading="lazy"
                            decoding="async"
                            width="440"
                            height="440"
                        >
                    </div>
                    <a class="btn btn-brand-4 ai-strategy-promo__cta" href="{{ route('nexus-ai') }}">
                        {{ __('Подробнее') }}
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Система iGND — full-bleed тёмный фон на всю ширину --}}
    <div class="ignd-promo">
        <div class="ignd-promo__frame">
            <div class="ignd-promo__grid">
                <div class="ignd-promo__content">
                    <p class="ignd-promo__eyebrow">{{ __('Система iGND') }}</p>
                    <h2 class="ignd-promo__title">{{ __('В случае реализации инвестиционных рисков') }}</h2>
                    <p class="ignd-promo__lead">{{ __('Система смягчения инвестиционных и проектных рисков') }}</p>
                    <p class="ignd-promo__text">
                        {{ __('Автоматизированная система смягчения рисков (смарт-контракт платформы, нативный внутренний токен iGND) для инвесторов и инициаторов проектов') }}
                    </p>
                    <ul class="ignd-promo__list">
                        <li>{{ __('Участникам системы смягчения рисков, в случае реализации инвестиционных рисков по отдельным проектам, начисляются дополнительные специализированные внутренние токены системы.') }}</li>
                        <li>{{ __('Начисление и обращение токенов iGND реализуется через смарт‑контракты блокчейна экосистемы') }}</li>
                        <li>{{ __('Пулы смягчения рисков на базе iGND аккумулируют ресурсы и позволяют при наступлении риск‑событий частично компенсировать их последствия по выбранным планам участия.') }}</li>
                        <li>{{ __('Полученные токены предоставляют право на участие в отобранных инвестиционных возможностях на специальных условиях в пределах, установленных документацией платформы.') }}</li>
                        <li>{{ __('Функционал системы направлен на частичное сглаживание последствий неблагоприятного исхода отдельных проектов') }}</li>
                    </ul>
                    <a class="btn btn-brand-4 ignd-promo__cta" href="{{ route('ignd') }}">
                        {{ __('Подробнее') }}
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <p class="ignd-promo__note">
                        {{ __('не является гарантией сохранения капитала или доходности.') }}
                        {{ __('не исключает риск потери инвестированных средств.') }}
                    </p>
                    <span class="ignd-promo__pill">{{ __('смарт-контракт') }} · {{ __('токен iGND') }}</span>
                </div>

                <div class="ignd-promo__visual">
                    <div class="ignd-promo__orbit ignd-promo__orbit--tl">
                        <span class="ignd-promo__orbit-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.9 4.9l2.1 2.1M17 17l2.1 2.1M4.9 19.1 7 17M17 7l2.1-2.1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        </span>
                        <span class="ignd-promo__orbit-label">{{ __('Доверие') }}</span>
                    </div>
                    <div class="ignd-promo__orbit ignd-promo__orbit--tr">
                        <span class="ignd-promo__orbit-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 3 5 6v5c0 5 3.2 8.4 7 9.8 3.8-1.4 7-4.8 7-9.8V6l-7-3Z" stroke="currentColor" stroke-width="1.6"/><path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <span class="ignd-promo__orbit-label">{{ __('Защита') }}</span>
                    </div>
                    <div class="ignd-promo__orbit ignd-promo__orbit--bl">
                        <span class="ignd-promo__orbit-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/></svg>
                        </span>
                        <span class="ignd-promo__orbit-label">{{ __('Прозрачность') }}</span>
                    </div>
                    <div class="ignd-promo__orbit ignd-promo__orbit--br">
                        <span class="ignd-promo__orbit-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M4 19V5M4 19h16M8 16V9M12 16v-5M16 16V7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        </span>
                        <span class="ignd-promo__orbit-label">{{ __('Стабильность') }}</span>
                    </div>

                    <div class="ignd-promo__shield">
                        <img src="{{ asset('assets/imgs/page/homepage1/sheld-ignd.png') }}" alt="{{ __('Система смягчения инвестиционных рисков iGND') }}" loading="lazy" decoding="async" width="420" height="420">
                    </div>
                    <p class="ignd-promo__tagline">{{ __('Система смягчения инвестиционных и проектных рисков') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Дорожная карта платформы --}}
<section class="section-box wow fadeIn box-imazing-features animated" id="Road">
    <div class="roadmap-shell">
        <div class="roadmap-shell__frame">
            <div class="roadmap-head">
                <h2 class="roadmap-head__title">{{ __('Дорожная карта платформы') }}</h2>
                <div class="roadmap-head__progress" aria-label="{{ __('Прогресс реализации MVP НЕКСУС') }}">
                    <span class="roadmap-head__progress-label">{{ __('Прогресс реализации MVP НЕКСУС') }}</span>
                    <div class="roadmap-head__progress-track">
                        <div class="roadmap-head__progress-fill" style="width: 47%"></div>
                    </div>
                    <span class="roadmap-head__progress-value">47%</span>
                </div>
            </div>

            <div class="roadmap-board">
                <article class="roadmap-card">
                    <div class="roadmap-card__meta">
                        <span class="roadmap-card__badge">{{ __('Стадия I') }}</span>
                        <span class="roadmap-card__version">V1.0.0 · Q1 2027</span>
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
                        <li>{{ __('Реализована связка покупок на маркетплейсе с инвестиционными метриками проектов (выручка, LTV, другие KPI)') }}</li>
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

            <div class="roadmap-foot">
                <div class="roadmap-foot__metrics">
                    <div class="roadmap-metric">
                        <span class="roadmap-metric__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 20V10l8-6 8 6v10H4Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M10 20v-6h4v6" stroke="currentColor" stroke-width="1.6"/></svg>
                        </span>
                        <div class="roadmap-metric__text">
                            <strong>350 {{ __('тыс.+') }}</strong>
                            <span>{{ __('Проектов') }}</span>
                        </div>
                    </div>
                    <div class="roadmap-metric">
                        <span class="roadmap-metric__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.6"/><circle cx="16" cy="9" r="2.5" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 19c.6-3 2.8-4.5 5.5-4.5S14 16 14.5 19M14 14.6c1.7.2 3.3 1.2 4 3.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        </span>
                        <div class="roadmap-metric__text">
                            <strong>7 {{ __('млн.+') }}</strong>
                            <span>{{ __('Клиентов') }}</span>
                        </div>
                    </div>
                    <div class="roadmap-metric">
                        <span class="roadmap-metric__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M7 7h10M7 12h10M7 17h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><rect x="3.5" y="3.5" width="17" height="17" rx="3" stroke="currentColor" stroke-width="1.6"/></svg>
                        </span>
                        <div class="roadmap-metric__text">
                            <strong>700 {{ __('тыс.+') }}</strong>
                            <span>{{ __('Сделок в год') }}</span>
                        </div>
                    </div>
                    <div class="roadmap-metric">
                        <span class="roadmap-metric__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3v18M16.5 7.5c0-1.7-2-3-4.5-3s-4.5 1.3-4.5 3 2 3 4.5 3 4.5 1.3 4.5 3-2 3-4.5 3-4.5-1.3-4.5-3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        </span>
                        <div class="roadmap-metric__text">
                            <strong>7 {{ __('млрд.₽+') }}</strong>
                            <span>{{ __('Оборот в год') }}</span>
                        </div>
                    </div>
                </div>
                <a class="roadmap-foot__cta" href="#forWho">
                    <span>{{ __('Цель экосистемы к 2031 году') }}</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
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
{{-- КОМАНДА — галерея руководителей + полоса контуров --}}
<section class="section-box wow box-why-trusted-black team-section" id="team">
    <div class="container">
        <div class="team-block">
            <div class="team-block__head">
                <a class="btn btn-brand-4-sm" href="#onwer">{{ __('Руководители команды и проекта') }}</a>
                <h2 class="team-block__title">{{ __('Команда, которая строит новый стандарт проектного запуска и цифровых инвестиций') }}</h2>
            </div>

            <div class="team-leaders" id="onwer">
                <article class="team-leader">
                    <div class="team-leader__photo">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-review.png') }}" alt="{{ __('ЮРИЙ ХЕ') }}" loading="lazy" decoding="async" width="420" height="420">
                    </div>
                    <h3 class="team-leader__name">{{ __('ЮРИЙ ХЕ') }}</h3>
                    <p class="team-leader__role">{{ __('Генеральный директор - соучредитель') }}</p>
                    <p class="team-leader__quote">{{ __('Мы создаём не просто бизнес‑платформу для инвестиций, а новую инфраструктуру рынка, где цифровые инструменты становятся понятным, прозрачным и эффективно работающим каналом капитала в реальную экономику.') }}</p>
                    <div class="team-leader__stars" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt="">
                    </div>
                </article>

                <article class="team-leader">
                    <div class="team-leader__photo">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-review-finance.png') }}" alt="{{ __('АДЫЛ НУРМАНБЕТОВ') }}" loading="lazy" decoding="async" width="420" height="420">
                    </div>
                    <h3 class="team-leader__name">{{ __('АДЫЛ НУРМАНБЕТОВ') }}</h3>
                    <p class="team-leader__role">{{ __('Финансовый директор - соучредитель') }}</p>
                    <p class="team-leader__quote">{{ __('Финансовая архитектура платформы выстроена так, чтобы обеспечивать прозрачную структуру капитала, контролируемую доходность инструментов и устойчивость модели роста на каждом этапе проектного цикла.') }}</p>
                    <div class="team-leader__stars" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt="">
                    </div>
                </article>

                <article class="team-leader">
                    <div class="team-leader__photo">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-review-k.png') }}" alt="{{ __('КИРИЛЛ БОЯРИНОВ') }}" loading="lazy" decoding="async" width="420" height="420">
                    </div>
                    <h3 class="team-leader__name">{{ __('КИРИЛЛ БОЯРИНОВ') }}</h3>
                    <p class="team-leader__role">{{ __('Автор платформы, системный архитектор - соучредитель') }}</p>
                    <p class="team-leader__quote">{{ __('Я проектирую платформу как целостный механизм, в котором архитектура, код и каждый технический узел связаны в одну логику — превратить сложную финансовую “машину” в управляемую, безопасную и предсказуемую среду роста для проектов и инвесторов.') }}</p>
                    <div class="team-leader__stars" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt="">
                    </div>
                </article>
            </div>

            <div class="team-contours" id="team-contours">
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-1.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">{{ __('Инженерный контур') }}</h3>
                    <p class="team-contours__text">{{ __('Backend, frontend, mobile, DevOps и QA — собирают клиентский слой цифрового банка, личные кабинеты, API‑шлюз к ОИС НЕКСУС и технологический слой ГАНИМЕД в единую управляемую среду.') }}</p>
                </article>
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-2.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">{{ __('Методологи проектного цикла') }}</h3>
                    <p class="team-contours__text">{{ __('Описывают, как проект проходит путь от заявки инициатора до выпуска ЦФА, размещения, контроля траншей и выплат: структуры финансирования, KPI, ковенанты и регламенты, которые затем становятся правилами ОИС и сценариями в экосистеме.') }}</p>
                </article>
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-3.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">{{ __('Аналитики и риск‑менеджеры') }}</h3>
                    <p class="team-contours__text">{{ __('Следят за концентрацией портфелей, отклонениями plan/fact, просрочками и событиями по выпускам; формируют сигналы для инвесторов в кабинете и для операционного контура ОИС — до того, как риск превращается в регуляторный или репутационный инцидент.') }}</p>
                </article>
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-4.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">{{ __('Специалисты комплаенс и правового блока') }}</h3>
                    <p class="team-contours__text">{{ __('Выстраивают допуск участников и проектов под 259‑ФЗ, 115‑ФЗ и требования Банка России к ОИС: KYC/KYB, раскрытие, договорная модель выпуска, взаимодействие с депозитарным и расчётным контуром — отдельно от маркетингового бренда цифрового банка.') }}</p>
                </article>
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-5.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">
                        <a href="{{ route('nexus-ai') }}">{{ __('Операторы скоринга, ML и оптимизации (НЕКСУС ИИ)') }}</a>
                    </h3>
                    <p class="team-contours__text">{{ __('Обучают и разрабатывают модели предварительного скоринга проектов, подбора инструментов для инвестора и раннего выявления аномалий, контроль параметров допуска и мониторинг обязательств без подмены юридического решения алгоритмом.') }}</p>
                </article>
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
