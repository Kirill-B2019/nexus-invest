@extends('layouts.guest.guest')

@section('content')
@php
    $pageTitle = __('ГАНИМЕД');
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
                        <p class="banner-description text-lg neutral-200">{{ __('Высокопроизводительная распределённая платформа на Go с гибридным консенсусом PoSA, мульти-VM (EVM, WASM, MoveVM) и двухтокеновой моделью GND + GANI. Токенизация RWA, выпуск ЦФА по 259-ФЗ, интеграция с НЕКСУС и СФОРДЕКС.') }}</p>
                        <nav class="mt-4 d-flex flex-wrap gap-2 justify-content-center" aria-label="{{ __('Навигация по разделам') }}">
                            <a href="#ecosystem" class="btn btn-sm btn-outline-light btn-rounded">{{ __('Экосистема НЕКСУС') }}</a>
                            <a href="#nexus-depo" class="btn btn-sm btn-outline-light btn-rounded">{{ __('НЕКСУС-ДЕПО') }}</a>
                            <a href="#marketplace" class="btn btn-sm btn-outline-light btn-rounded">{{ __('Маркетплейс') }}</a>
                            <a href="#ignd" class="btn btn-sm btn-outline-light btn-rounded">{{ __('iGND') }}</a>
                            <a href="#gnd-v1" class="btn btn-sm btn-outline-light btn-rounded">{{ __('GND_v1') }}</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Описание --}}
<section class="section-box wow fadeIn box-preparing-2" id="description">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Описание') }}</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <p class="text-lg neutral-700">{{ __('ГАНИМЕД (GANIMED) — высокопроизводительная распределённая вычислительная платформа, разработанная на языке Go, с гибридным консенсусом PoSA (Proof-of-Stake / Proof-of-Authority), EVM-совместимой виртуальной машиной, поддержкой WASM и MoveVM и двухтокеновой экономической моделью (GND + GANI).') }}</p>
                            <p class="text-lg neutral-700">{{ __('Платформа предназначена для: создания и функционирования децентрализованных приложений (dApps); токенизации реальных активов (RWA) — недвижимости, долговых и долевых инструментов; выпуска и обращения цифровых финансовых активов (ЦФА) по 259-ФЗ; обеспечения работы DeFi-протоколов; интеграции с IoT для автоматизированных расчётов; предоставления инфраструктуры для корпоративных и государственных заказчиков.') }}</p>
                            <p class="text-lg neutral-700">{{ __('Миссия: создать комплаенс-ориентированную блокчейн-инфраструктуру для токенизации реальных активов, выпуска и обращения ЦФА с полным соответствием российскому и международному законодательству. Демократизировать инвестиции в реальные проекты через безопасную платформу с минимальным порогом входа.') }}</p>
                            <p class="text-lg neutral-700">{{ __('ГАНИМЕД входит в единую инфраструктуру платформы НЕКСУС вместе с каталогом проектов, вторичным рынком СФОРДЕКС и цифровым депозитарием. Проект функционирует в двойной юрисдикции: РФ (259-ФЗ, ЦБ РФ) и международные площадки.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ГАНИМЕД в экосистеме НЕКСУС: схема связки --}}
<section class="section-box wow fadeIn box-preparing-2" id="ecosystem">
    <div class="container">
        <h2 class="text-center mb-20">{{ __('ГАНИМЕД в экосистеме НЕКСУС') }}</h2>
        <p class="text-center text-lg neutral-700 mb-50">{{ __('Блокчейн ГАНИМЕД — технологическое ядро экосистемы: на нём фиксируются выпуски ЦФА, смарт‑контракты выплат и система смягчения рисков (iGND). Платформа НЕКСУС, вторичный рынок СФОРДЕКС, цифровой депозитарий НЕКСУС-ДЕПО и маркетплейс используют единый реестр и API ГАНИМЕД.') }}</p>
        <div class="row justify-content-center ganimed-ecosystem-scheme">
            <div class="col-6 col-md-4 col-lg-2 text-center mb-30">
                <a href="{{ route('features') }}" class="card-preparing-2 d-block text-decoration-none">
                    <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage3/marketing.svg') }}" width="40" height="40" alt=""></div>
                    <div class="card-info"><h6 class="text-16-semibold neutral-0">{{ __('Платформа НЕКСУС') }}</h6></div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center mb-30">
                <div class="card-preparing-2 border-brand">
                    <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage3/digital.svg') }}" width="40" height="40" alt=""></div>
                    <div class="card-info"><h6 class="text-16-semibold neutral-0">{{ __('ГАНИМЕД') }}</h6><p class="text-xs neutral-500 mb-0">{{ __('блокчейн') }}</p></div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center mb-30">
                <a href="{{ route('features') }}" class="card-preparing-2 d-block text-decoration-none">
                    <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage3/product.svg') }}" width="40" height="40" alt=""></div>
                    <div class="card-info"><h6 class="text-16-semibold neutral-0">{{ __('СФОРДЕКС') }}</h6></div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center mb-30">
                <div class="card-preparing-2">
                    <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage3/social.svg') }}" width="40" height="40" alt=""></div>
                    <div class="card-info"><h6 class="text-16-semibold neutral-0">{{ __('НЕКСУС-ДЕПО') }}</h6></div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 text-center mb-30">
                <a href="{{ route('features') }}" class="card-preparing-2 d-block text-decoration-none">
                    <div class="card-image"><img src="{{ asset('assets/imgs/page/homepage3/discover.svg') }}" width="40" height="40" alt=""></div>
                    <div class="card-info"><h6 class="text-16-semibold neutral-0">{{ __('Маркетплейс') }}</h6></div>
                </a>
            </div>
        </div>
        <div class="row mt-20">
            <div class="col-12 text-center">
                <p class="text-sm neutral-500">{{ __('Связка данных: каталог проектов и выпуски ЦФА (НЕКСУС) → реестр и смарт‑контракты (ГАНИМЕД) → учёт прав (НЕКСУС-ДЕПО), торги (СФОРДЕКС), реализация товаров и услуг (маркетплейс), начисление iGND при рисках.') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Цифровой депозитарий НЕКСУС-ДЕПО --}}
<section class="section-box wow fadeIn box-preparing-2" id="nexus-depo">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Цифровой депозитарий НЕКСУС-ДЕПО') }}</h2>
        <div class="row align-items-center">
            <div class="col-12 col-lg-4 text-center mb-4 mb-lg-0">
                <img src="{{ asset('assets/imgs/page/homepage3/social.svg') }}" width="80" height="80" alt="" class="img-fluid">
            </div>
            <div class="col-12 col-lg-8">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <p class="text-lg neutral-700">{{ __('Цифровой депозитарий НЕКСУС-ДЕПО обеспечивает учёт и хранение цифровых прав на активы, ведение реестра владельцев ЦФА в соответствии с законодательством РФ (39-ФЗ, 259-ФЗ). Юридическое лицо депозитария входит в периметр экосистемы НЕКСУС и интегрировано с блокчейном ГАНИМЕД.') }}</p>
                            <p class="text-lg neutral-700">{{ __('Функционал: открытие счетов депо, учёт прав на ЦФА, корпоративные действия, отчётность и API. ИБ-аудит и стресс-тесты подтверждают отказоустойчивость и соответствие требованиям по защите информации. Данные о владельцах и объёмах ЦФА синхронизируются с реестром ГАНИМЕД.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Маркетплейс --}}
<section class="section-box wow fadeIn box-preparing-2" id="marketplace">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Маркетплейс продукции и услуг проектов') }}</h2>
        <div class="row align-items-center">
            <div class="col-12 col-lg-8 order-2 order-lg-1">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <p class="text-lg neutral-700">{{ __('Маркетплейс экосистемы НЕКСУС предоставляет возможность реализации товаров и услуг проектов, привлёкших инвестиции через платформу. Витринный каталог с онлайн-оплатой и базовой логистикой; данные по проектам, статусам и лимитам подтягиваются из НЕКСУС и ГАНИМЕД автоматически.') }}</p>
                            <p class="text-lg neutral-700">{{ __('Покупки на маркетплейсе связаны с инвестиционными метриками проектов (выручка, LTV, выполнение KPI). Инвестор получает в личном кабинете аналитику продаж портфельных компаний. Таким образом, маркетплейс дополняет блокчейн-инфраструктуру ГАНИМЕД и платформу НЕКСУС, обеспечивая постпроектное сопровождение и витрину роста.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-center order-1 order-lg-2 mb-4 mb-lg-0">
                <img src="{{ asset('assets/imgs/page/homepage3/discover.svg') }}" alt="{{ __('Маркетплейс НЕКСУС') }}" class="img-fluid" width="120" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Система смягчения инвестиционных рисков (iGND) --}}
<section class="section-box wow fadeIn box-preparing-2" id="ignd">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Система смягчения инвестиционных рисков (iGND)') }}</h2>
        <div class="row align-items-center">
            <div class="col-12 col-lg-4 text-center mb-40 order-2 order-lg-1">
                <img src="{{ asset('assets/imgs/page/homepage1/sheld-risk.svg') }}" alt="{{ __('Система смягчения рисков') }}" class="img-fluid" width="200" loading="lazy">
                @if(file_exists(public_path('assets/imgs/page/homepage1/sheld-ignd.png')))
                <img src="{{ asset('assets/imgs/page/homepage1/sheld-ignd.png') }}" alt="iGND" class="img-fluid mt-3" width="160" loading="lazy">
                @endif
            </div>
            <div class="col-12 col-lg-8 mb-40 order-1 order-lg-2">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <p class="text-lg neutral-700">{{ __('Автоматизированная система смягчения инвестиционных и проектных рисков реализована на смарт‑контрактах блокчейна ГАНИМЕД и использует нативный внутренний токен iGND. Участникам системы (инвесторам и инициаторам проектов) при реализации инвестиционных рисков по отдельным проектам начисляются дополнительные специализированные внутренние токены.') }}</p>
                            <p class="text-lg neutral-700">{{ __('Полученные токены iGND предоставляют право на участие в отобранных инвестиционных возможностях на специальных условиях в пределах, установленных документацией платформы. Функционал направлен на частичное сглаживание последствий неблагоприятного исхода отдельных проектов за счёт участия в последующих раундах и иных проектах.') }}</p>
                            <p class="text-md neutral-700 mt-3"><strong>{{ __('Важно:') }}</strong> {{ __('Начисление и обращение токенов iGND реализуется через смарт‑контракты блокчейна экосистемы и не является гарантией сохранения капитала или доходности. Система не исключает риск потери инвестированных средств.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Характеристики --}}
<section class="section-box wow fadeIn box-preparing-2" id="characteristics">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Характеристики') }}</h2>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-time-fast small"></i></span>{{ __('Производительность') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Целевые показатели: 1 000–5 000 TPS, время блока 3 секунды, финализация ≤ 10 секунд. Uptime ≥ 99,9%, до 1 000 000 активных адресов без деградации. API до 10 000 RPS при задержке &lt; 500 ms.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-shield small"></i></span>{{ __('Криптография по ГОСТ') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('ГОСТ 34.10-2018 (подпись ECGOST), 34.11-2018 (хэш Стрибог), 34.12-2018 (Кузнечик/Магма). Интеграция через КриптоПро CSP; сертификация ФСБ (СКЗИ). Соответствие 259-ФЗ, 289-ФЗ, 115-ФЗ, 152-ФЗ, 187-ФЗ.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-file-code small"></i></span>{{ __('Мульти-VM и смарт‑контракты') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('EVM (Solidity), WASM (Rust, C++, AssemblyScript), MoveVM (Move). Совместимость с Ethereum, миграция dApps. Смарт‑контракты для выпуска ЦФА, эскроу, купона и погашения. Песочница исполнения и аудит кода.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-12 col-md-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-shuffle small"></i></span>{{ __('Консенсус PoSA') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Гибридный консенсус Proof-of-Stake / Proof-of-Authority: динамическое переключение PoS ↔ PoA по решению DAO. Epoch 6 часов, ≥ 100 валидаторов в PoS, slashing 1,5% при сбое. Финализация за 3–5 секунд с криптографической необратимостью.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number"><i class="fi-rr-layers small"></i></span>{{ __('Пятислойная архитектура') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Слой 0 — физическая инфраструктура и сеть (libp2p, ГОСТ-шифрование). Слой 1 — данные (блоки, DAG-подграфы, снапшоты). Слой 2 — консенсус (PoSA). Слой 3 — исполнение (EVM, WASM, MoveVM). Слой 4 — приложения (REST, RPC, WebSocket API, блок-обозреватель, кошельки).') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Ключевые особенности --}}
<section class="section-box wow fadeIn box-preparing-2" id="features">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Ключевые особенности') }}</h2>
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <ul class="list-checked text-sm neutral-600">
                                <li>{{ __('Гибридный консенсус PoSA: динамическое переключение PoS ↔ PoA для публичных и корпоративных сегментов.') }}</li>
                                <li>{{ __('Стандарт GNDst-1: расширенный ERC-20 с нативной поддержкой KYC/AML, Travel Rule, кросс-чейн.') }}</li>
                                <li>{{ __('AI-защита (GNN): обнаружение аномалий и мошенничества, предиктивное масштабирование.') }}</li>
                                <li>{{ __('Двухтокеновая модель: GND (утилитарный, 1 млрд) — gas, стейкинг, DeFi; GANI (управление, 100 млн) — голосование в DAO.') }}</li>
                                <li>{{ __('ГОСТ-криптография (34.10/34.11/34.12) через КриптоПро CSP; двойная юрисдикция РФ и международные площадки.') }}</li>
                                <li>{{ __('Вторичный рынок СФОРДЕКС: торговля ЦФА 24/7, AMM, маркет-мейкинг; комиссии &lt; $0,01 за транзакцию.') }}</li>
                                <li>{{ __('REST API, JSON-RPC (Ethereum-совместимый), WebSocket API для событий в реальном времени.') }}</li>
                                <li>{{ __('Неизменяемый реестр, выпуск и учёт ЦФА по 259-ФЗ, интеграция с реестрами ЦБ РФ.') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Процесс реализации --}}
<section class="section-box wow fadeIn box-preparing-2" id="implementation">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Процесс реализации и дорожная карта') }}</h2>
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <p class="text-lg neutral-700 mb-3">{{ __('Внедрение ГАНИМЕД в рамках экосистемы НЕКСУС и соответствие регуляторике:') }}</p>
                            <ul class="list-checked text-sm neutral-600">
                                <li>{{ __('Регистрация как оператор информационной системы в реестре ЦБ РФ (259-ФЗ), минимальный размер собственных средств 50 млн руб., правила ИС, утверждённые ЦБ.') }}</li>
                                <li>{{ __('Сертификация ФСБ (СКЗИ): криптоядро, архитектура, хранение ключей; испытания и выдача сертификата соответствия.') }}</li>
                                <li>{{ __('Соответствие 115-ФЗ (ПОД/ФТ), 152-ФЗ (персональные данные), 187-ФЗ (КИИ), 289-ФЗ (цифровые платформы).') }}</li>
                                <li>{{ __('Критический этап (0–6 мес): завершение Core, Tokens, VM; нагрузочные тесты 1000 TPS; ГОСТ-интеграция; beta launch.') }}</li>
                                <li>{{ __('Средний этап (6–12 мес): zk-EVM, DAG-оптимизация, UI (Explorer, Wallet, DevPanel), полная документация API.') }}</li>
                                <li>{{ __('Долгосрочный этап (12–24 мес): шардинг, мосты (IBC, LayerZero, Wormhole), 5000+ TPS, 100+ валидаторов.') }}</li>
                                <li>{{ __('Стратегический этап (24–36 мес): полная децентрализация DAO, экспансия СНГ/БРИКС.') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Структура монет --}}
<section class="section-box wow fadeIn box-preparing-2" id="coin-structure">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Двухтокеновая модель GND + GANI') }}</h2>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">1</span>{{ __('Токен GND (утилитарный)') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Нативный утилитарный токен сети: общая эмиссия 1 млрд. Функции: оплата комиссий (gas), стейкинг валидаторов, обеспечение DeFi, мосты. Инфляционная модель +2–5% в год для вознаграждения валидаторов. 50% комиссий сжигается (burn), создавая дефляционное давление. Минимальный стейк валидатора определяется через governance.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">2</span>{{ __('Токен GANI (управление)') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Токен управления: фиксированный cap 100 млн. Право голоса в DAO по параметрам протокола, казначейству, стратегическим партнёрствам. Механика vote-escrow: блокировка до 4 лет даёт множитель до 2× к силе голоса. Кворум ≥ 10% GANI в vote-escrow; критические решения принимаются при ≥ 66%.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-12">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <p class="text-lg neutral-700">{{ __('Правовая квалификация: GND и GANI не являются ценными бумагами — не предоставляют прав на дивиденды или управление юридическими лицами. GND даёт утилитарные права (gas, стейкинг), GANI — право голоса в DAO. Окончательная квалификация — за регуляторами (ЦБ РФ и др.).') }}</p>
                            <p class="text-lg neutral-700">{{ __('Выпуск и учёт цифровых финансовых активов (ЦФА) по 259-ФЗ осуществляются поверх платформы: токены представляют права на проектные активы (долг, долевое участие, доходные права) и учитываются в реестре и депозитарии.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Описание стандарта --}}
<section class="section-box wow fadeIn box-preparing-2" id="standard">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Стандарт токенов GNDst-1') }}</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <p class="text-lg neutral-700">{{ __('GNDst-1 (GANIMED Standard Token v1) — расширенный стандарт токенов, совместимый с ERC-20 и дополненный функциями для токенизации RWA и соблюдения регуляторных требований. Модули: KYC/AML (whitelist/blacklist, интеграция Sumsub/Blockpass через оракулы); Travel Rule (данные отправителя/получателя для переводов свыше порога); кросс-чейн (мосты IBC, LayerZero, Wormhole V2); снапшоты состояний для начисления дивидендов/дохода; RBAC (Owner, Compliance Officer, Minter, Pauser).') }}</p>
                            <p class="text-lg neutral-700">{{ __('Типовая схема токенизации недвижимости на ГАНИМЕД: правовое структурирование (SPV); выпуск токенов GNDst-1 с kycRequired и whitelist инвесторов; модуль распределения дохода (арендные платежи через смарт-контракт); снимки для фиксации распределения; регистрация ЦФА в ЦБ РФ или в юрисдикции площадки; обращение на СФОРДЕКС или DEX.') }}</p>
                            <p class="text-lg neutral-700">{{ __('Стандарт обеспечивает совместимость с экосистемой НЕКСУС, вторичным рынком СФОРДЕКС и цифровым депозитарием. Техническая документация (API v1.0) доступна в разделе «Документация».') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Дополнительная информация: репозиторий GND_v1 --}}
<section class="section-box wow fadeIn box-preparing-2" id="gnd-v1">
    <div class="container">
        <h2 class="text-center mb-30">{{ __('Дополнительная информация: репозиторий GND_v1') }}</h2>
        <p class="text-center text-lg neutral-700 mb-4">{{ __('Репозиторий GND_v1 — открытый источник с эталонной реализацией и технической документацией блокчейна ГАНИМЕД. В нём описаны архитектура, API, консенсус, токены и интеграции.') }}</p>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-desc">
                            <ul class="list-checked text-sm neutral-600 mb-0">
                                <li>{{ __('Архитектура: ядро (блоки, транзакции, состояние, мемпул, комиссии GND, кошельки), консенсус PoS/PoA с динамическим переключением, EVM-подобная VM и смарт-контракты (Solidity), универсальный интерфейс токенов (ERC-20, TRC-20, кастомные), интеграция (оракулы, мосты, IPFS), мониторинг и аудит.') }}</li>
                                <li>{{ __('API: REST (блоки, транзакции, балансы, деплой и вызов контрактов), JSON-RPC 2.0 (blockchain_*, state_*, contract_*, token_*), WebSocket для событий в реальном времени; аутентификация X-API-Key, лимитирование по IP.') }}</li>
                                <li>{{ __('Адреса: форматы GND1… (аккаунты) и GNDct1… (контракты); комиссии и gas оплачиваются в GND; GND используется для стейкинга в PoS и оплаты операций в PoA.') }}</li>
                                <li>{{ __('Документация в репозитории: architecture.md, api.md, consensus.md, contracts.md, tokens.md, integration.md, описание структуры и кошельков.') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="https://github.com/Kirill-B2019/GND_v1/tree/main/docs" class="btn btn-outline-dark btn-rounded" target="_blank" rel="noopener noreferrer">{{ __('Документация GND_v1 на GitHub') }}</a>
        </div>
    </div>
</section>

{{-- Ссылки на документацию и концепцию --}}
<section class="section-box wow fadeIn">
    <div class="container">
        <div class="text-center">
            <p class="text-lg neutral-700 mb-20">{{ __('Подробные спецификации API и протоколов — в разделе «Техническая документация» на странице Документации. Полная концепция блокчейн-платформы ГАНИМЕД (техническая, экономическая и регуляторная) доступна в PDF.') }}</p>
            <a href="{{ route('documentation') }}#step-3" class="btn btn-black-md btn-rounded mr-2 mb-2">{{ __('Перейти к документации') }}</a>
            <a href="{{ asset('doc/Kontseptsiya_Blockchain_GANIMED_RF_v3.3.pdf') }}" class="btn btn-outline-dark btn-rounded mb-2" target="_blank" rel="noopener noreferrer">{{ __('Концепция ГАНИМЕД (PDF)') }}</a>
        </div>
    </div>
</section>
@endsection
