@extends('layouts.guest.app')

@section('content')
@php
    $pageTitle = __('Особенности');
@endphp
{{-- Page header --}}
<section class="section-box">
    <div class="banner-hero hero-4">
        <div class="banner-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('Главная') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                            </ol>
                        </nav>
                        <h1 class="heading-banner neutral-0">{{ $pageTitle }}</h1>
                        <p class="banner-description text-lg neutral-200">{{ __('Операционная модель и ключевые особенности экосистемы НЕКСУС.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ОПЕРАЦИОННАЯ МОДЕЛЬ И ОСОБЕННОСТИ --}}
<section class="section-box wow fadeIn box-preparing-2">
    <div class="container">
        <div class="text-center">
            <h2 class="mb-15">{{ __('ОПЕРАЦИОННАЯ МОДЕЛЬ И ОСОБЕННОСТИ') }}</h2>
            <p class="text-lg neutral-700">{{ __('НЕКСУС')}} {{ __('— привлекает проектные инвестиции, структурирует и запускает сделки, блокчейн гарантирует техническую и юридически значимую фиксацию прав, площадка обмена активов превращает эти права в ликвидный торгуемый инструмент.')}}
            <p class="text-lg neutral-700">{{__('В результате ')}}
                <span class="text-22-bold">{{ __('инициатор проекта')}}</span>
                {{ __('получает прозрачный и регулируемый канал привлечения капитала, а')}}
                <span class="text-22-bold">{{ __('инвестор ')}}</span>
                {{ __('— доступный, управляемый и ликвидный инструмент участия в реальных проектах.') }}</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="box-border-rounded">
                            <div class="card-casestudy">
                                <div class="card-title"><h6><span class="number"><i class="fi-rr-apps-add small"></i></span>{{__('Воронка проекта (инициатор)')}}</h6></div>
                                <div class="card-desc">
                                    <ul class="list-checked text-sm neutral-600">
                                        <li>{{__('Регистрация через Госуслуги, загрузка материалов проекта и параметров привлечения.')}}</li>
                                        <li>{{__('Быстрый AI‑скоринг проекта (50+ параметров, рейтинг, решение за 24–48 часов).')}}</li>
                                        <li>{{__('Экспертный due diligence с итоговым заключением и отчётом.')}}</li>
                                        <li>{{__('Токенизация проекта (оцифровка проектных активов).')}}</li>
                                        <li>{{__('Подготовка документов и регистрация выпуска цифровых активов.')}}</li>
                                        <li>{{__('Разработка и деплой смарт‑контрактов на ГАНИМЕД, интеграция с API ЦБ.')}}</li>
                                        <li>{{__('Публикация проекта в каталоге НЕКСУС и запуск инвестирования.')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="box-border-rounded">
                            <div class="card-casestudy">
                                <div class="card-title"><h6><span class="number"><i class="fi-rr-stats small"></i></span>{{__('Поток инвестора')}}</h6></div>
                                <div class="card-desc">
                                    <ul class="list-checked text-sm neutral-600">
                                        <li>{{__('Регистрация через Госуслуги, верификация и KYC.')}}</li>
                                        <li>{{__('Изучение каталога проектов, рейтингов и отчётов AI‑скоринга.')}}</li>
                                        <li>{{__('Выбор проектов по параметрам: доходность, срок, сектор, риск.')}}</li>
                                        <li>{{__('Ознакомление с due diligence и документацией выпуска ЦФА.')}}</li>
                                        <li>{{__('Инвестирование через смарт‑контракты, получение токенов.')}}</li>
                                        <li>{{__('Автоматические выплаты (купон, дивиденды) по условиям выпуска.')}}</li>
                                        <li>{{__('Вторичный рынок СФОРДЕКС для продажи или покупки токенов.')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="box-border-rounded">
                            <div class="card-casestudy">
                                <div class="card-title"><h6><span class="number"><i class="fi-rr-shuffle small"></i></span>{{__('Денежные потоки и выплаты')}}</h6></div>
                                <div class="card-desc"><p>{{ __('Эскроу‑счета и смарт‑контракты для автоматических выплат купона и погашения. Прозрачный учёт поступлений от проектов, распределение средств инвесторам в режиме реального времени.') }}</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="box-border-rounded">
                            <div class="card-casestudy">
                                <div class="card-title"><h6><span class="number"><i class="fi-rr-shield small"></i></span>{{__('Контур соответствия (комплаенс) и безопасности')}}</h6></div>
                                <div class="card-desc"><p>{{ __('KYC через Госуслуги, мониторинг ПОД/ФТ, соответствие 259-ФЗ, 289-ФЗ, 115-ФЗ, 152-ФЗ. ИБ‑аудит, защита данных по ГОСТ, интеграция с реестрами ЦБ.') }}</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="box-border-rounded">
                            <div class="card-casestudy">
                                <div class="card-title"><h6><span class="number"><i class="fi-rr-diamond small"></i></span>{{__('Роль AI')}}</h6></div>
                                <div class="card-desc"><p>{{ __('AI‑скоринг проектов (50+ параметров, решение за 24–48 ч), аналитика портфеля, риск‑оценка, автоматические отчёты, стратегические дашборды и прогнозы доходности.') }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-apps-add small"></i></span>{{ __('Ключевые преимущества') }}</h6></div>
                        <div class="card-desc">
                            <ul class="list-checked text-sm neutral-600">
                                <li>{{ __('Полное соответствие законодательству РФ: 259-ФЗ, 289-ФЗ, 39-ФЗ, 187-ФЗ, 115-ФЗ, 152-ФЗ.') }}</li>
                                <li>{{ __('Интеграция с Госуслугами и API ЦБ.') }}</li>
                                <li>{{ __('Блокчейн ГАНИМЕД для обеспечения неизменяемости реестра.') }}</li>
                                <li>{{ __('Вторичный рынок СФОРДЕКС для ликвидности активов.') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-90">
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing">
                    <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare.png') }}" alt="{{ config('app.name') }}"></div>
                    <div class="card-info">
                        <h5>{{ __('Каталог проектов') }}</h5>
                        <p class="text-lg neutral-700 w-85 mx-auto">{{ __('Публикация и поиск проектов с AI‑рейтингами, параметрами привлечения и due diligence. Фильтры по сектору, доходности и сроку.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing">
                    <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare2.png') }}" alt="{{ config('app.name') }}"></div>
                    <div class="card-info">
                        <h5>{{ __('Токенизация и ЦФА') }}</h5>
                        <p class="text-lg neutral-700 w-85 mx-auto">{{ __('Оцифровка проектных активов по 259-ФЗ, выпуск и размещение цифровых финансовых активов, смарт‑контракты на ГАНИМЕД.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing">
                    <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare3.png') }}" alt="{{ config('app.name') }}"></div>
                    <div class="card-info">
                        <h5>{{ __('Вторичный рынок') }}</h5>
                        <p class="text-lg neutral-700 w-85 mx-auto">{{ __('СФОРДЕКС — круглосуточная торговля токенами, маркет‑мейкинг, ликвидность проектных инвестиций.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Preparing 3 --}}
<section class="section-box wow fadeIn box-preparing-3">
    <div class="container">
        <div class="text-center">
            <h2 class="neutral-0 mb-20">{{ __('Компоненты экосистемы НЕКСУС') }}</h2>
            <p class="text-lg neutral-700">{{ __('Цифровая инфраструктура для проектного финансирования: платформа, блокчейн, вторичный рынок, депозитарий и маркетплейс.') }}</p>
        </div>
        <div class="row mt-90">
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="{{ route('login') }}"><img src="{{ asset('assets/imgs/page/homepage3/marketing.svg') }}" width="33" height="32" alt="{{ __('Платформа НЕКСУС') }}"></a>
                    <div class="card-info"><a href="{{ route('login') }}"><h5 class="text-22-bold">{{ __('Платформа НЕКСУС') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Запуск проектов через выпуск ЦФА, каталог, KYC, комплаенс и управление сделками.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="{{ route('login') }}"><img src="{{ asset('assets/imgs/page/homepage3/digital.svg') }}" width="33" height="32" alt="{{ __('Блокчейн ГАНИМЕД') }}"></a>
                    <div class="card-info"><a href="{{ route('login') }}"><h5 class="text-22-bold">{{ __('Блокчейн ГАНИМЕД') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Высокопроизводительный блокчейн для ЦФА, смарт‑контракты, до 1 000 TPS, интеграция с API ЦБ.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="{{ route('login') }}"><img src="{{ asset('assets/imgs/page/homepage3/product.svg') }}" width="33" height="32" alt="{{ __('СФОРДЕКС') }}"></a>
                    <div class="card-info"><a href="{{ route('login') }}"><h5 class="text-22-bold">{{ __('СФОРДЕКС') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Площадка вторичного рынка активов с круглосуточной торговлей и маркет‑мейкингом.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="{{ route('login') }}"><img src="{{ asset('assets/imgs/page/homepage3/social.svg') }}" width="33" height="32" alt="{{ __('Цифровой депозитарий') }}"></a>
                    <div class="card-info"><a href="{{ route('login') }}"><h5 class="text-22-bold">{{ __('Цифровой депозитарий') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Учёт и хранение цифровых прав на активы, реестр владельцев ЦФА по законодательству РФ.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="{{ route('login') }}"><img src="{{ asset('assets/imgs/page/homepage3/discover.svg') }}" width="33" height="32" alt="{{ __('Маркетплейс') }}"></a>
                    <div class="card-info"><a href="{{ route('login') }}"><h5 class="text-22-bold">{{ __('Маркетплейс') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Реализация товаров и услуг проектов, запущенных на платформе. Постпроектное сопровождение.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="{{ route('compliance') }}"><img src="{{ asset('assets/imgs/page/homepage3/keep.svg') }}" width="33" height="32" alt="{{ __('Соответствие') }}"></a>
                    <div class="card-info"><a href="{{ route('compliance') }}"><h5 class="text-22-bold">{{ __('Соответствие') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('259-ФЗ, 289-ФЗ, 39-ФЗ, 187-ФЗ, 115-ФЗ, 152-ФЗ, ГОСТы 34.10, 34.11, 34.12.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
