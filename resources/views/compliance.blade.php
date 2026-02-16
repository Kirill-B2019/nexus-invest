@extends('layouts.guest.app')

@section('content')
@php
    $pageTitle = __('Соответствие');
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
                        <p class="banner-description text-lg neutral-200">{{ __('Юридическое и нормативное соответствие экосистемы НЕКСУС законодательству Российской Федерации.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Нормативная база --}}
<section class="section-box wow fadeIn box-preparing-2">
    <div class="container">
        <div class="text-center mb-60">
            <h2 class="mb-15">{{ __('Полное соответствие законодательству РФ') }}</h2>
            <p class="text-lg neutral-700">{{ __('Экосистема НЕКСУС и блокчейн ГАНИМЕД разрабатываются с учётом требований федерального законодательства в сфере цифровых финансовых активов, платформенной экономики, инвестиционной деятельности, информационной безопасности, ПОД/ФТ и персональных данных.') }}</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-document small"></i></span>259-ФЗ</h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('О цифровых финансовых активах, цифровой валюте и о внесении изменений в отдельные законодательные акты РФ. Регулирование выпуска и обращения ЦФА, смарт-контрактов, операторов обмена.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('Регистрация выпусков ЦФА в реестре ЦБ РФ, использование смарт-контрактов для фиксации прав, интеграция с API ЦБ, ведение реестра владельцев цифровых активов в соответствии с требованиями законодательства.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-document small"></i></span>289-ФЗ</h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('О платформенной экономике. Требования к операторам платформ, к договорам с пользователями, к порядку привлечения инвестиций через платформы.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('Регистрация в реестре операторов платформ, типовые договоры с пользователями в соответствии с требованиями 289-ФЗ, прозрачные условия привлечения инвестиций, размещение обязательной информации на платформе.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-document small"></i></span>39-ФЗ</h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('Об инвестиционной деятельности в РФ, осуществляемой в форме капитальных вложений. Основания для законного привлечения инвестиций в проекты.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('Структурирование проектов как капитальные вложения, due diligence с документальным подтверждением, публикация инвестиционных предложений с соблюдением требований к раскрытию информации.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-shield small"></i></span>187-ФЗ</h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('О безопасности критической информационной инфраструктуры РФ. Требования к защите информации, к обеспечению отказоустойчивости и безопасности ключевых систем.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('ИБ‑аудит и стресс‑тесты, подтверждение уровня отказоустойчивости, меры по защите информации в соответствии с требованиями по КИИ, сегментирование и резервирование.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-user small"></i></span>115-ФЗ</h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('О противодействии легализации (отмыванию) доходов, полученных преступным путём, и финансированию терроризма (ПОД/ФТ). KYC, идентификация пользователей, мониторинг операций.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('Идентификация через Госуслуги, верификация пользователей, мониторинг подозрительных операций, формирование отчётности для Росфинмониторинга, блокировка операций при выявлении рисков.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-lock small"></i></span>152-ФЗ</h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('О персональных данных. Обработка, хранение и защита персональных данных участников платформы в соответствии с требованиями законодательства.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('Согласие на обработку ПДн, шифрование и защита данных, ограничение доступа, уведомление Роскомнадзора при необходимости, политика конфиденциальности.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-50">
            <h2 class="mb-15">{{ __('Криптографические стандарты') }}</h2>
            <p class="text-lg neutral-700 mb-30">{{ __('Использование российских стандартов криптографии и электронной подписи для обеспечения целостности и юридической значимости данных в блокчейне и при взаимодействии с реестрами.') }}</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy card-casestudy-gost">
                        <div class="card-title card-title-gost"><h6><span class="number"><i class="fi-rr-fingerprint small"></i></span><span class="gost-label">ГОСТ 34.10</span></h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('Стандарты электронной подписи. Алгоритмы формирования и проверки электронной подписи.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('Подписание транзакций и смарт-контрактов по ГОСТ Р 34.10-2012, верификация подписей при взаимодействии с реестрами и API ЦБ.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy card-casestudy-gost">
                        <div class="card-title card-title-gost"><h6><span class="number"><i class="fi-rr-fingerprint small"></i></span><span class="gost-label">ГОСТ 34.11</span></h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('Функции хеширования. Обеспечение целостности данных и идентификации в криптографических протоколах.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('Хеширование блоков и данных по ГОСТ Р 34.11-2012 (Стрибог), обеспечение целостности реестра и неизменяемости записей в блокчейне.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-30">
                <div class="box-border-rounded">
                    <div class="card-casestudy card-casestudy-gost">
                        <div class="card-title card-title-gost"><h6><span class="number"><i class="fi-rr-fingerprint small"></i></span><span class="gost-label">ГОСТ 34.12</span></h6></div>
                        <div class="card-desc">
                            <p class="text-sm neutral-600">{{ __('Симметричное шифрование. Алгоритмы шифрования данных для защиты информации при хранении и передаче.') }}</p>
                            <p class="text-sm neutral-700 mt-15"><strong>{{ __('Как достигается:') }}</strong> {{ __('Шифрование чувствительных данных по ГОСТ Р 34.12-2015 (Кузнечик), защита персональных данных и ключей при хранении и передаче.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-50">
            <div class="col-12">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-check small"></i></span>{{ __('Комплаенс и KYC') }}</h6></div>
                        <div class="card-desc">
                            <p class="text-md neutral-600">{{ __('Платформа предусматривает процедуры идентификации и верификации участников (KYC), мониторинг операций в рамках ПОД/ФТ, взаимодействие с уполномоченными органами в объёме, установленном законодательством. Технические и организационные меры направлены на соблюдение требований 259-ФЗ, 289-ФЗ, 115-ФЗ и иных применимых норм.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
