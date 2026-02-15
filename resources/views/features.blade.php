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
                                    <ul class="list-check text-md neutral-600">
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
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="box-border-rounded">
                            <div class="card-casestudy">
                                <div class="card-title"><h6><span class="number"><i class="fi-rr-shuffle small"></i></span>{{__('Денежные потоки и выплаты')}}</h6></div>
                                <div class="card-desc"><p>{{ __('Быстрая и простая регистрация даёт доступ к индивидуальным решениям и спецпредложениям.') }}</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="box-border-rounded">
                            <div class="card-casestudy">
                                <div class="card-title"><h6><span class="number"><i class="fi-rr-shield small"></i></span>{{__('Контур соответствии (комплаенс) и безопасности')}}</h6></div>
                                <div class="card-desc"><p>{{ __('Быстрая и простая регистрация даёт доступ к индивидуальным решениям и спецпредложениям.') }}</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="box-border-rounded">
                            <div class="card-casestudy">
                                <div class="card-title"><h6><span class="number"><i class="fi-rr-diamond small"></i></span>{{__('Роль AI')}}</h6></div>
                                <div class="card-desc"><p>{{ __('Быстрая и простая регистрация даёт доступ к индивидуальным решениям и спецпредложениям.') }}</p></div>
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
                        <h5>{{ __('Простая панель управления') }}</h5>
                        <p class="text-lg neutral-700 w-85 mx-auto">{{ __('Управляйте своими процессами легко и эффективно.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing">
                    <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare2.png') }}" alt="{{ config('app.name') }}"></div>
                    <div class="card-info">
                        <h5>{{ __('Детальная отчётность') }}</h5>
                        <p class="text-lg neutral-700 w-85 mx-auto">{{ __('Достигайте лучших результатов с детальной отчётностью и обоснованными решениями.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing">
                    <div class="card-image"><img class="wow fadeInUp" src="{{ asset('assets/imgs/page/homepage1/img-prepare3.png') }}" alt="{{ config('app.name') }}"></div>
                    <div class="card-info">
                        <h5>{{ __('Сравнение продаж') }}</h5>
                        <p class="text-lg neutral-700 w-85 mx-auto">{{ __('Максимальное использование данных и детальная отчётность для стратегических решений.') }}</p>
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
            <h2 class="neutral-0 mb-20">{{ __('Готовим ваш успех: мы предлагаем действительно сильные IT-решения') }}</h2>
            <p class="text-lg neutral-700">{{ config('app.name') }} {{ __('— независимая платформа с солидной историей. Мы собрали лучшие инструменты для вашего бизнеса.') }}</p>
        </div>
        <div class="row mt-90">
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="#"><img src="{{ asset('assets/imgs/page/homepage3/marketing.svg') }}" width="33" height="32" alt=""></a>
                    <div class="card-info"><a href="#"><h5 class="text-22-bold">{{ __('Контент-маркетинг') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Создание и распространение полезного контента для привлечения и удержания целевой аудитории.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="#"><img src="{{ asset('assets/imgs/page/homepage3/digital.svg') }}" width="33" height="32" alt=""></a>
                    <div class="card-info"><a href="#"><h5 class="text-22-bold">{{ __('Реформирование бизнеса') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Пересмотр и улучшение процессов, структуры и стратегий компании.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="#"><img src="{{ asset('assets/imgs/page/homepage3/product.svg') }}" width="33" height="32" alt=""></a>
                    <div class="card-info"><a href="#"><h5 class="text-22-bold">{{ __('Управление IT') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Управление технологическими ресурсами для эффективной и безопасной работы IT-систем.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="#"><img src="{{ asset('assets/imgs/page/homepage3/social.svg') }}" width="33" height="32" alt=""></a>
                    <div class="card-info"><a href="#"><h5 class="text-22-bold">{{ __('План инфраструктуры') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Стратегия проектирования, построения и поддержки физической и цифровой инфраструктуры.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="#"><img src="{{ asset('assets/imgs/page/homepage3/discover.svg') }}" width="33" height="32" alt=""></a>
                    <div class="card-info"><a href="#"><h5 class="text-22-bold">{{ __('Расширенный файрвол') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Усиление защиты сетей и систем от несанкционированного доступа и киберугроз.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-preparing-2">
                    <a class="card-image" href="#"><img src="{{ asset('assets/imgs/page/homepage3/keep.svg') }}" width="33" height="32" alt=""></a>
                    <div class="card-info"><a href="#"><h5 class="text-22-bold">{{ __('Защита данных') }}</h5></a>
                        <p class="text-md neutral-700">{{ __('Защита конфиденциальной информации с помощью надёжных протоколов и шифрования.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
