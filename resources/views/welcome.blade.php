@extends('layouts.guest.app')

@section('content')
{{-- HERO-блок --}}
<section class="section-box">
   <div class="banner-hero hero-5">
        <div class="banner-inner-top">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-12 col-lg-6 order-1 order-lg-1">
                        <div class="box-banner-left">
                                <p class="btn btn-brand-5-new" href="#"><span>{{ __('Работает на:') }}</span> {{__('блокчейне ГАНИМЕД') }}</p>
                                <p class="neutral-700 small pt-3">{{ __('НАЦИОНАЛЬНАЯ ЭКОСИСТЕМА КОЛЛЕКТИВНОГО СОФИНАНСИРОВАНИЯ УЧАСТНИКОВ СТАРТАП-СЕКТОРА') }}</p>
                                <h6 class="display-6 neutral-0 text-semibold pt-3">{{ __('ПРОЕКТНОЕ ФИНАСИРОВАНИЕ') }}</h6>
                                <h1 class="display-1 neutral-0 text-semibold pt-3">{{ __('НЕКСУС') }}</h1>
                                <p class="text-lg neutral-500 mb-55 display-4 pt-3 uppercase">
                                    {{ __('Полнофункциональная платформа быстрого запуска и финансирования проектов через цифровые активы и токенизацию') }}<br />
                                    {{ __('Постпроектное сопровождение, реализация результатов (маркетплейс)') }}</p>
                                <a class="btn btn-brand-4-medium hover-up mb-4" href="{{ route('login') }}">
                                    {{ __('WHITE PAPER НЕКСУС') }}
                                    <svg width="22" height="8" viewBox="0 0 22 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 4.00032L18.4791 0.479492V3.3074H0V4.69333H18.4791V7.52129L22 4.00032Z" fill=""></path>
                                    </svg>
                                </a>
                                <p class="neutral-700 small pt-3">{{ __('полное соответствие законодательству РФ: 259-ФЗ о ЦФА, 289-ФЗ о платформенной экономике, 39-ФЗ об инвестиционной деятельности, 187‑ФЗ о безопасности, 115-ФЗ о ПОД/ФТ, 152-ФЗ о персональных данных, ГОСТы 34.10, 34.11, 34.12') }}</p>                     <div class="d-flex mb-60">
                                    <div class="neutral-700 mt-40 sidebar-border-left border-secondary d-none d-md-block">

                                        <p class="smaller"><i class="fi-rr-quote-right"></i>
                                            <span class="text-semibold">{{ __(' ТОКЕН') }}</span>{{ __(' - единица учёта, не являющаяся криптовалютой, предназначенная для представления цифрового баланса в некотором активе, иными словами, выполняющая функцию «заменителя ценных бумаг» в цифровом мире. Токены представляют собой запись в регистре, распределённую вблокчейн-цепочке.') }}
                                        </p>
                                        <p class="smaller">
                                            <span class="text-semibold">{{ __('RWA (Real World Assets)') }}</span> {{ __(' — это любые материальные активы, которые переносят в цифровой формат на блокчейне: например,золото, недвижимость, ценные бумаги, произведения искусства') }}
                                        </p>

                                    </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-6 order-2 order-lg-2 hero-5-col-cards">

                        <div class="box-banner-right">
                            <div class="row ">
                                <div class="col-12">
                                    <div class="blur-bg blur-move hero-5-cards-blur" aria-hidden="true"></div>
                                    <div class="card-features-5 card-features-5-first">
                                        <span class="card-badge">{{__('Запуск: СТАДИЯ I')}}</span>
                                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/hero-nexus.png') }}" alt="{{__('НЕКСУС')}}"></div>
                                        <div class="card-info">
                                            <h6>{{__('НЕКСУС')}}</h6>
                                            <p class="text-sm neutral-500">{{__('Цифровая платформа проектного финансирования. Запуск инвестпроектов через выпуск токенизированных цифровых активов по 259-ФЗ, с обеспечением их первичного размещения и вторичного обращения. Полный цикл: KYC, комплаенс и управление сделками.')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="card-features-5">
                                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/hero-ganimed.png')}}" alt="{{__('ГАНИМЕД')}}"></div>
                                        <span class="card-badge">{{__('Запуск: СТАДИЯ I')}}</span>
                                        <div class="card-info">
                                            <h6>{{__('ГАНИМЕД')}}</h6>
                                            <p class="text-sm neutral-500">{{__('Высокопроизводительный блокчейн инфраструктурного уровня, оптимизированный под требования законодательства РФ и работу с цифровыми финансовыми активами')}}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-sm-6">
                                    <div class="card-features-5">
                                        <span class="card-badge card-badge-2">{{__('Запуск: СТАДИЯ II')}}</span>
                                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/hero-sfodex.png')}}" alt="{{__('СФОРДЭКС')}}"></div>
                                        <div class="card-info">
                                            <h6>{{__('СФОРДЭКС')}}</h6>
                                            <p class="text-sm neutral-500">{{__('Площадка вторичного рынка активов экосистемы с круглосуточной торговлей токенами и автоматическим маркет‑мейкингом для обеспечения ликвидности проектных инвестиций')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="card-features-5">
                                        <span class="card-badge card-badge-2">{{__('Запуск: СТАДИЯ III')}}</span>
                                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/hero-repo.png')}}" alt="{{__('НЕКСУС')}}"></div>
                                        <div class="card-info">
                                            <h6>{{__('ЦИФРОВОЙ ДЕПОЗИТАРИЙ')}}</h6>
                                            <p class="text-sm neutral-500">{{__('Учет и хранение цифровых прав на активы. Ведение реестра владельцев цифровых активов в соответствии с требованиями законодательства РФ')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 ">
                                    <div class="blur-bg blur-move hero-5-cards-blur" aria-hidden="true"></div>
                                    <div class="card-features-5">
                                        <span class="card-badge card-badge-2">{{__('Запуск: СТАДИЯ IV')}}</span>
                                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/hero-market.png') }}" alt="{{__('НЕКСУС маркетплейс')}}"></div>
                                        <div class="card-info">
                                            <h6>{{__('МАРКЕТПЛЕЙС')}}</h6>
                                            <p class="text-sm neutral-500">{{__('Маркетплейс реализации товаров и услуг проектов, запущенных на цифровой платформе.')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="up-info-block p-0 m-0 uppercase">
                <span>{{__('Обратите внимание!')}}</span>{{__('ЭКОСИСТЕМА НЕКСУС находится в стадии запуска прототипа (сборка MVP версии).')}}<br />{{__('Вся информация - ПРЕЗЕНТАЦИЯ ЭКОСИСТЕМЫ.')}}
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
                    <div class="item-logo"><img src="{{ asset('assets/imgs/page/homepage1/out-logo/' . basename($logo)) }}" alt="{{ config('app.name') }}"></div>
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

                    <img src="{{ asset('assets/imgs/page/homepage1/hero-goal.png')}}" alt="{{__('СФОРДЭКС')}}">
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
                    <p class="text-lg neutral-700">
                        {{__('Создать единую цифровую инфраструктуру для привлечения капитала в реальные проекты (бизнес,девелопмент, инфраструктура, ГЧП).') }}
                        <br>{{__('Обеспечить законный, технологичный и ликвидный рынок цифровых активов, доступный как для частных, так и для институциональных инвесторов.') }}
                        <br>{{__('Предоставить возможность реализации продукции и услуг, запущенных через экосистему, проектов, возможность постпроектного сопровождения.') }}
                    </p>
                    <h3 class="heading-2 mb-20">{{ __('Для кого:') }}</h3>
                    <div class="row" id="forWho">
                        <div class="col-12 col-lg-6">
                            <div class="card-pricing card-pricing-style-2 card-pricing-style-3 card-for-who">
                                <div class="card-title mb-3"><h6>{{ __('Инициаторов проектов  (кто привлекает капитал)') }}</h6></div>
                                <div class="card-lists">
                                    <ul class="lists-our-features">
                                        <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                            {{ __('Микро, малый и средний бизнес (МСБ) в РФ, которым нужны инвестиции от 1–500 млн ₽ на развитие или запуск') }}</li>
                                        <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                            {{ __('Бизнесы с понятным денежным потоком: торговля, услуги, производство, девелопмент, франчайзинг и т.п. (по секторам при регистрации)') }}</li>
                                        <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                            {{ __('Финансовые и околофинансовые сервисы, которым нужен white‑label модуль выпуска и размещения обязательств (банки, факторинг, МФО, финтех‑стартапы)') }}</li>
                                        <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                            {{ __('Компании и команды, которые планируют разместить продукты своей проектной деятельности на платформе и сохранить постпроектное сопровождение после запуска' )}}</li>


                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card-pricing card-pricing-style-2 card-pricing-style-3 card-for-who text-sm">
                                <div class="card-title mb-3"><h6>{{ __('Инвесторов') }}</h6></div>
                                <div class="card-lists">
                                    <ul class="lists-our-features">
                                        <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                            {{ __('Частные инвесторы с чеком от 5–100 тыс. ₽, ищущие доходность 14–25% годовых и выше по структурированным долговым инструментам') }}</li>
                                        <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                            {{ __('Квалифицированные и профессиональные инвесторы, фамильные офисы, небольшие фонды, заинтересованные в пулах МСБ‑займов с ИИ‑скорингом)') }}</li>
                                        <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                            {{ __('Профучастники рынка ценных бумаг, банки и брокеры, интегрирующиеся по API') }}</li>
                                        <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                            {{ __('B2B‑клиенты SaaS‑части: платформы, которым нужен модуль токенизации/обращения инструментов') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-pricing card-pricing-style-2 card-pricing-style-3 card-for-who card-for-who-with-image text-sm">
                                <div class="card-for-who-content">
                                    <h5 class="mb-3">{{__('А так же...')}}</h5>
                                    <div class="card-lists">
                                        <ul class="lists-our-features">
                                            <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                                {{ __('Экспертов') }}</li>
                                            <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                                {{ __('Аудиторов') }}</li>
                                            <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                                {{ __('Финансовых аналитиков') }}</li>
                                            <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                                {{ __('Инвестконсультантов') }}</li>
                                            <li class="pb-2"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_51_57)"><path d="M13 26C20.1799 26 26 20.1799 26 13C26 5.8201 20.1799 0 13 0C5.8201 0 0 5.8201 0 13C0 20.1799 5.8201 26 13 26Z" fill="#C5FF55"></path><path d="M7.11719 13.8396L10.479 17.2014L18.8835 8.79688" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_51_57"><rect width="26" height="26" fill="white"></rect></clipPath></defs></svg>
                                                {{ __('Due diligence специалистов') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-for-who-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/forwho.png') }}" alt="{{ config('app.name') }}"></div>
                            </div>
                        </div>
                    </div>
                    {{-- Как это работает --}}
                    <a class="btn btn-brand-4-sm" href="#">{{ __('Как это работает') }}</a>
                    <h2 class="mt-15 mb-20">{{ __('Всего 3 простых шага к началу работы в системе') }}</h2>
                    <p class="text-lg neutral-500 mb-55">{{ __('Простой старт и достижение ваших целей.') }}</p>
                    <div class="row block-steps-badges">
                        <div class="col-12 col-lg-4">
                            <div class="box-border-rounded">
                                <div class="card-casestudy">
                                    <div class="card-title"><h6><span class="step-badge">1</span>{{ __('Регистрация в системе') }}</h6></div>
                                    <div class="card-desc"><p>{{ __('Быстрая и простая регистрация даёт доступ сразу в индивидуальное рабочее пространство по выбранной цели на платформе (кабинет инициатора, инвестора, эксперта, аудитора, аналитика и т.д.).') }}</p></div>
                                    <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare.png') }}" alt="{{ config('app.name') }}"></div>
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
                                    <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare2.png') }}" alt="{{ config('app.name') }}"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="box-border-rounded">
                                <div class="card-casestudy">
                                    <div class="card-title"><h6><span class="step-badge">3</span>{{ __('Запуск и доход') }}</h6></div>
                                    <div class="card-desc"><p>{{ __('Запуск проекта или активация выбранных инвестиционных инструментов. Экосистема автоматизирует ключевые процессы, обеспечивая прозрачность, контроль и стабильный поток привлечения или дохода в реальном времени.') }}</p></div>
                                    <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare3.png') }}" alt="{{ config('app.name') }}"></div>
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
                            <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/ai-brain.svg') }}"></div>
                            <div class="card-info"><a href="#"><h3 class="text-22-bold">{{ __('Глубокая интеграция ИИ расширяет базовые возможности') }}</h3></a>
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
                        <div class="wow fadeInDown" data-wow-delay="0"><img src="{{ asset('assets/imgs/page/homepage1/ai-strategy.png') }}" alt="{{ config('app.name') }}"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Система смягчения инвестиционных и проектных рисков --}}
        <div class="row align-items-center">
            <div class="col-12 col-lg-4 text-center mb-40">
                <div class="box-border-image">
                    <div class="box-image-line-1">
                        <div class="wow fadeInDown" data-wow-delay="0"><img src="{{ asset('assets/imgs/page/homepage1/sheld-ignd.png') }}" alt="{{ config('app.name') }}"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 mb-40">
                <h2 class="heading-2 mb-20">{{ __('В случае реализации инвестиционных рисков') }}</h2>
                <p class="text-lg neutral-700">{{__('Система смягчения инвестиционных и проектных рисков') }}</p>
                <div class="row mt-50">
                     <div class="col-lg-12">
                        <div class="card-feature-2">
                            <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/sheld-risk.svg') }}"></div>
                            <div class="card-info"><a href="#"><h3 class="text-22-bold">{{ __('Автоматизированная система смягчения рисков (смарт-контракт платформы, нативный внутренний токен iGND) для инвесторов и инициаторов проектов') }}</h3></a>
                                <p class="text-md neutral-700">{{ __('Участникам системы смягчения рисков, в случае реализации инвестиционных рисков по отдельным проектам, начисляются дополнительные специализированные внутренние токены системы.')}}
                                <p class="text-md neutral-700">{{ __('- Начисление и обращение токенов iGND реализуется через смарт‑контракты блокчейна экосистемы и ')}} <span class="neutral-1000">{{ __('не является гарантией сохранения капитала или доходности.') }}</span></p>
                                <p class="text-md neutral-700">{{__('- Полученные токены предоставляют право на участие в отобранных инвестиционных возможностях на специальных условиях в пределах, установленных документацией платформы.')}}</p>
                                <p class="text-md neutral-700 mt-3">{{__('Функционал системы направлен на частичное сглаживание последствий неблагоприятного исхода отдельных проектов за счёт участия в последующих раундах и иных проектах, но ')}}<span class="neutral-1000">{{ __('не исключает риск потери инвестированных средств.') }}</span></p>
                            </div>
                        </div>
                         <div class="box-buttons-feature-4">
                             <a class="btn btn-learmore-2" href="{{ url('/about') }}"><span>
                            <x-icons.svg-arrow />
                        </span>{{ __('Подробнее') }}</a>
                         </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
{{-- Road — горизонтальная дорожная карта --}}
<section class="section-box wow fadeIn box-imazing-features animated" id="Road">
    <div class="container">
        <div class="text-center mb-60">
            <h2 class="neutral-0 mb-20">{{ __('Дорожная карта') }}</h2>
            <p class="text-lg neutral-500">{{ __('Ключевые этапы развития экосистемы НЕКСУС') }}</p>
        </div>
        <div class="roadmap-horizontal">
            <div class="list-change-log roadmap-list">
                <div class="item-log">
                    <div class="date-log"><span class="btn btn-brand-4-sm">{{__('Стадия I: 4 кв. 2026')}}</span></div>
                    <div class="line-log"></div>
                    <div class="info-log">
                        <h4 class="neutral-400 text-sm">{{ __('V 1.0.0') }}</h4>
                        <p class="text-md neutral-0 uppercase">{{ __('MVP запуск проектной платформы НЕКСУС и блокчейна ГАНИМЕД') }}</p>
                        <ul class="list-check-black text-sm">
                            <li>{{ __('Базовый функционал платформы НЕКСУС запущен') }}</li>
                            <li>{{ __('ГАНИМЕД запущен, ноды активны, шардинг (сегментирование) работает') }}</li>
                            <li>{{ __('Валидаторы PoA регистрируются') }}</li>
                            <li>{{ __('Кошельки платформы активны') }}</li>
                            <li>{{ __('Система смягчения инвестиционных рисков реализована') }}</li>
                            <li>{{ __('ИИ продолжает обучение  модели и участвует в оценке, аналитике и прогнозах') }}</li>
                            <li>{{ __('Платежные шлюзы ввод/вывод средств активны') }}</li>
                            <li>{{ __('Комплаенс работает') }}</li>
                            <li>{{ __('Библиотека смарт-контрактов сформирована и доступна пользователям') }}</li>

                        </ul>
                    </div>
                </div>
                <div class="item-log">
                    <div class="date-log"><span class="btn btn-brand-4-sm">{{__('Стадия II: 2 кв. 2027')}}</span></div>
                    <div class="line-log"></div>
                    <div class="info-log">
                        <h4 class="neutral-400 text-sm">{{ __('V 2.0.0') }}</h4>
                        <p class="text-md neutral-0 uppercase">{{ __('MVP запуск площадки СФОРДЕКС и регистрация ОИС') }}</p>
                        <ul class="list-check-black text-sm">
                            <li>{{ __('Статус ОИС получен') }}</li>
                            <li>{{ __('Площадка СФОРДЕКС интегрирована с ГАНИМЕД и НЕКСУС') }}</li>
                            <li>{{ __('Торги активны 24/7') }}</li>
                            <li>{{ __('Расширенный функционал НЕКСУС реализован')}}</li>
                            <li>{{ __('ГАНИМЕД прошел лицензирование и аудит')}}</li>
                         </ul>
                    </div>
                </div>
                <div class="item-log">
                    <div class="date-log"><span class="btn btn-brand-4-sm">{{__('Стадия III: 1 кв. 2028')}}</span></div>
                    <div class="line-log"></div>
                    <div class="info-log">
                        <h4 class="neutral-400 text-sm">{{ __('V 3.0.0') }}</h4>
                        <p class="text-md neutral-0 uppercase">{{ __('MVP запуск ЦИФРОВОГО ДЕПОЗИТАРИЯ И РЕГИСТРАЦИЯ ДЕПОЗИТАРНОЙ ЛИЦЕНЗИИ') }}</p>
                        <ul class="list-check-black text-sm">
                            <li>{{ __('Юридическое лицо депозитария создано и включено в периметр экосистемы НЕКСУС') }}</li>
                            <li>{{ __('Требования ЦБ РФ по 39‑ФЗ и 259‑ФЗ выполнены') }}</li>
                            <li>{{ __('MVP‑функционал: открытие счетов депо, учет прав, корпоративные действия, отчётность и API запущены') }}</li>
                            <li>{{ __('ИБ‑аудит и стресс‑тесты, подтвержден уровень отказоустойчивости и соответствие требованиям по защите информации проведены') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="item-log">
                    <div class="date-log"><span class="btn btn-brand-4-sm">{{__('Стадия 4: 2028+')}}</span></div>
                    <div class="line-log"></div>
                    <div class="info-log">
                        <h4 class="neutral-400 text-sm">{{ __('V 4.0.0') }}</h4>
                        <p class="text-md neutral-0 uppercase">{{ __('MVP запуск МАРКЕТПЛЕЙСА ПРОДУКЦИИ И УСЛУГ ПРОИНВЕСТИРОВАННЫХ ПРОЕКТОВ ПОДГОТОВКА IPO') }}</p>
                        <ul class="list-check-black text-sm">
                            <li>{{ __('Маркетплейс интегрирован с экосистемой: данные по проектам, статусам и лимитам подтягиваются автоматически') }}</li>
                            <li>{{ __('Запущен витринный каталог товаров и услуг проинвестированных проектов с онлайн-оплатой и базовой логистикой') }}</li>
                            <li>{{ __('Реализована связка покупок на маркетплейсе с инвестиционными метриками проектов (выручка, LTV, выполнение KPI)') }}</li>
                            <li>{{ __('Доступен личный кабинет инвестора с аналитикой продаж портфельных компаний на маркетплейсе') }}</li>
                            <li>{{ __('Внедрены базовые инструменты промо: промокоды для инвесторов, кэшбэк/скидки, витрины специальных предложений от портфельных компаний') }}</li>
                            <li>{{ __('Маркетплейс и витрина портфельных проектов используются как витрина роста перед подготовкой к IPO платформы в 2030–2031 гг.') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="section-box box-faqs-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="box-faq-left">
                    <a class="btn btn-brand-4-sm" href="#">{{ __('Часто задаваемые вопросы') }}</a>
                    <h2 class="heading-2 mb-20 mt-20">{{ __('Остались вопросы?') }}</h2>
                    <p class="text-lg neutral-700">{{ __('Ниже — ответы на частые вопросы. Если не нашли нужное — просто') }} <a class="text-18-bold brand-1-1" href="#" data-bs-toggle="modal" data-bs-target="#contactFormModal">{{ __('Связаться с нами') }}</a></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="accordion accordion-flush accordion-style-2" id="accordionFAQS">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">{{ __('Какие аудитории можно выбирать при создании кампаний?') }}</button>
                        </h2>
                        <div class="accordion-collapse collapse show" id="flush-collapseOne" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body"><p>{{ __('Узнайте, чем наша платформа выделяется на рынке и почему клиенты выбирают нас.') }}</p></div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">{{ __('Можете ли вы дать ориентиры по расходам на рекламу?') }}</button>
                        </h2>
                        <div class="accordion-collapse collapse" id="flush-collapseTwo" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body">{{ __('Узнайте, чем наша платформа выделяется на рынке и почему клиенты выбирают нас.') }}</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">{{ __('Где будут показываться мои объявления?') }}</button>
                        </h2>
                        <div class="accordion-collapse collapse" id="flush-collapseThree" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body">{{ __('Узнайте, чем наша платформа выделяется на рынке и почему клиенты выбирают нас.') }}</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">{{ __('Какие ключевые слова лучше использовать в кампаниях?') }}</button>
                        </h2>
                        <div class="accordion-collapse collapse" id="flush-collapseFour" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body">{{ __('Узнайте, чем наша платформа выделяется на рынке и почему клиенты выбирают нас.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- КОМАНДА --}}
<section class="section-box wow fadeIn box-testimonials-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-30">
                <div class="testimonial-img-animated">
                    <img src="{{ asset('assets/imgs/page/homepage1/img-testimonial.png') }}" alt="{{ config('app.name') }}">
                </div>
                <ul class="list-checked">
                    <li>{{__('Команда разработки (backend, frontend, mobile, DevOps, QA) ')}}</li>
                    <li>{{__('Методологи')}}</li>
                    <li>{{__('Группа аналитики и риск‑менеджмента')}}</li>
                    <li>{{__('Группа комплаенса и юридического блока')}}</li>
                    <li>{{__('Группа скоринга, машинного обучения и оптимизации')}}</li>
                </ul>
            </div>
            <div class="col-lg-6 mb-30">
                <div class="mb-50"><a class="btn btn-brand-4-sm" href="#">{{ __('Руководители команды и проекта') }}</a>
                    <h3 class="mt-20 neutral-0">{{ __('Команда, которая строит новый стандарт проектного запуска') }}</h3>
                </div>
                <div class="testimonials-stack mt-30">
                    <div class="card-testimonial-3 mb-30 ">
                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/img-review.png') }}" alt="{{ config('app.name') }}"></div>
                        <div class="card-info">
                            <p class="text-md neutral-500"><i class="fi-rr-quote-right"></i>&nbsp;{{ __('Мы создаём не просто бизнес‑платформу для инвестиций, а новую инфраструктуру рынка, где цифровые инструменты становятся понятным, прозрачным и эффективно работающим каналом капитала в реальную экономику.') }}"</p>
                            <div class="card-author-review">
                                <div class="card-author-info"><span class="author-name">{{__('ЮРИЙ ХЕ')}}</span><span class="author-tag">{{__('Генеральный директор - соучредитель')}}</span></div>
                            </div>
                            <div class="card-rate"><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""></div>
                        </div>
                    </div>
                    <div class="card-testimonial-3">
                        <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage1/img-review-k.png') }}" alt="{{ config('app.name') }}"></div>
                        <div class="card-info">
                            <p class="text-md neutral-500"><i class="fi-rr-quote-right"></i>&nbsp;{{ __('Я проектирую платформу как целостный механизм, в котором архитектура, код и каждый технический узел связаны в одну логику — превратить сложную финансовую “машину” в управляемую, безопасную и предсказуемую среду роста для проектов и инвесторов.') }}"</p>
                            <div class="card-author-review">
                                <div class="card-author-info"><span class="author-name">{{__('КИРИЛЛ БОЯРИНОВ')}}</span><span class="author-tag">{{__('Автор, системный архитектор, тимлид - соучредитель')}}</span></div>
                            </div>
                            <div class="card-rate"><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Latest news --}}
{{--<section class="section-box box-latest-news box-latest-news-2">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-8 mb-30">
                <h2 class="heading-2 mb-10">{{ __('Новости и истории') }}</h2>
                <p class="text-lg neutral-700">{{ __('Актуальные материалы и обновления платформы.') }}</p>
            </div>
            <div class="col-lg-4 mb-30">
                <div class="box-button-slider box-button-slider-team justify-content-end">
                    <div class="swiper-button-prev swiper-button-prev-testimonials swiper-button-prev-3"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.66667 3.33398L2 8.00065M2 8.00065L6.66667 12.6673M2 8.00065H14" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>
                    <div class="swiper-button-next swiper-button-next-testimonials swiper-button-next-3"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.33333 3.33398L14 8.00065M14 8.00065L9.33333 12.6673M14 8.00065H2" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>
                </div>
            </div>
        </div>
        <div class="box-swiper mt-30">
            <div class="swiper-container swiper-group-3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card-news">
                            <div class="card-image"><a href="{{ url('/blog') }}"><img src="{{ asset('assets/imgs/page/homepage1/img-news.png') }}" alt="{{ config('app.name') }}"></a></div>
                            <div class="card-info"><a class="heading-4" href="{{ url('/blog') }}">{{ __('Сейчас важна последовательность и единый подход.') }}</a>
                                <p class="text-md neutral-700 mt-15 mb-35">{{ __('Краткое описание новости или материала для блога.') }}</p>
                                <a class="btn btn-learmore-2" href="{{ url('/blog') }}"><span><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_24_999)"><path d="M10.6557 3.81393L1.71996 12.7497L0.251953 11.2817L9.18664 2.34592H1.31195V0.269531H12.7321V11.6897H10.6557V3.81393Z" fill="#191919"></path></g><defs><clippath id="clip0_24_999"><rect width="13" height="13" fill="white"></rect></clippath></defs></svg></span>{{ __('Подробнее') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-news">
                            <div class="card-image"><a href="{{ url('/blog') }}"><img src="{{ asset('assets/imgs/page/homepage1/img-news2.png') }}" alt="{{ config('app.name') }}"></a></div>
                            <div class="card-info"><a class="heading-4" href="{{ url('/blog') }}">{{ __('Важно согласованное поведение и единый подход.') }}</a>
                                <p class="text-md neutral-700 mt-15 mb-35">{{ __('Краткое описание новости или материала для блога.') }}</p>
                                <a class="btn btn-learmore-2" href="{{ url('/blog') }}"><span><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_24_999)"><path d="M10.6557 3.81393L1.71996 12.7497L0.251953 11.2817L9.18664 2.34592H1.31195V0.269531H12.7321V11.6897H10.6557V3.81393Z" fill="#191919"></path></g><defs><clippath id="clip0_24_999"><rect width="13" height="13" fill="white"></rect></clippath></defs></svg></span>{{ __('Подробнее') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-news">
                            <div class="card-image"><a href="{{ url('/blog') }}"><img src="{{ asset('assets/imgs/page/homepage1/img-news3.png') }}" alt="{{ config('app.name') }}"></a></div>
                            <div class="card-info"><a class="heading-4" href="{{ url('/blog') }}">{{ __('Как стартапам повысить шансы на получение финансирования') }}</a>
                                <p class="text-md neutral-700 mt-15 mb-35">{{ __('Краткое описание новости или материала для блога.') }}</p>
                                <a class="btn btn-learmore-2" href="{{ url('/blog') }}"><span><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_24_999)"><path d="M10.6557 3.81393L1.71996 12.7497L0.251953 11.2817L9.18664 2.34592H1.31195V0.269531H12.7321V11.6897H10.6557V3.81393Z" fill="#191919"></path></g><defs><clippath id="clip0_24_999"><rect width="13" height="13" fill="white"></rect></clippath></defs></svg></span>{{ __('Подробнее') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>--}}
@endsection
