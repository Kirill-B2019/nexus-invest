@extends('layouts.guest.guest')

@section('metaDescription')
{{ config('app.name') }} — {{ __('Концепция двухтокеновой модели GND + GANI для блокчейна ГАНИМЕД: утилитарный токен и governance.') }}
@endsection

@section('metaKeywords')
{{ __('GND, GANI, токены ГАНИМЕД, двухтокеновая модель, governance, vote-escrow, GNDst-1') }}
@endsection

@section('content')
@php
    $breadcrumbParents = [['label' => __('ГАНИМЕД'), 'url' => route('ganimed')]];
@endphp
<x-guest.public-page-banner
    :pageTitle="$title"
    :bannerDescription="$description ?? ''"
    :breadcrumbParents="$breadcrumbParents"
/>

{{-- 1. Обзор модели --}}
<section class="section-box wow animate__animated animate__fadeIn box-how-it-work animated box-pricing-2" style="visibility: visible;">
    <div class="container">
        <a class="btn btn-brand-4-sm" href="{{ route('ganimed') }}">{{ __('ГАНИМЕД') }}</a>
        <h2 class="mt-15 mb-20">{{ __('Обзор модели') }}</h2>
        <p class="text-lg neutral-500 mb-30">{{ __('Блокчейн ГАНИМЕД использует двухтокеновую архитектуру для разделения утилитарных и управленческих функций.') }}</p>

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">1</span>GND — {{ __('утилитарный токен') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Нативный токен для работы сети: оплата комиссий (газ), стейкинг валидаторов, DeFi, мосты, деривативы на СФОРДЕКС.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">2</span>GANI — {{ __('governance-токен') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Токен децентрализованного управления протоколом: голосование по параметрам, казначейству, партнёрствам; механика vote-escrow (veGANI).') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-lg neutral-700 mt-30 mb-0">{{ __('Это позволяет стабилизировать утилитарный токен (GND не подвержен спекуляциям governance), концентрировать власть у долгосрочных держателей (GANI с vote-escrow) и снизить волатильность газа.') }}</p>
    </div>
</section>

{{-- 2. Токен GND --}}
<section class="section-box wow animate__animated animate__fadeIn box-how-it-work animated box-pricing-2" style="visibility: visible;">
    <div class="container">
        <a class="btn btn-brand-4-sm" href="#">{{ __('Токен GND') }}</a>
        <h2 class="mt-15 mb-20">{{ __('GND (утилитарный)') }}</h2>
        <p class="text-lg neutral-500 mb-30">{{ __('Основные параметры и функции нативного токена сети.') }}</p>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="box-border-rounded mb-30">
                    <div class="card-casestudy">
                        <div class="card-title"><h6>{{ __('Параметры GND') }}</h6></div>
                        <div class="card-desc">
                            <div class="table-responsive">
                                <table class="table table-dark table-bordered table-sm mb-0">
                                    <tbody>
                                        <tr><td>{{ __('Название') }}</td><td>Ganymede Coin (GND)</td></tr>
                                        <tr><td>{{ __('Максимальная эмиссия') }}</td><td>1 000 000 000 GND (1 млрд)</td></tr>
                                        <tr><td>{{ __('Начальная циркуляция') }}</td><td>100 000 000 GND (10%)</td></tr>
                                        <tr><td>Decimals / {{ __('Стандарт') }}</td><td>18 / GNDst-1 (расширенный ERC-20)</td></tr>
                                        <tr><td>{{ __('Инфляция') }} / {{ __('Дефляция') }}</td><td>+2–5% годовых; 50% комиссий сжигается</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6>{{ __('Токеномика (100 млн)') }}</h6></div>
                        <div class="card-desc">
                            <p class="mb-1">{{ __('Валидаторы: 40%') }}</p>
                            <p class="mb-1">{{ __('Экосистема: 25%') }}</p>
                            <p class="mb-1">{{ __('Команда/инвесторы: 20%') }}</p>
                            <p class="mb-1">{{ __('Публичная продажа: 10%') }}</p>
                            <p class="mb-0">{{ __('DAO-казначейство: 5%') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-12 col-md-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">1</span>{{ __('Оплата комиссий (Gas)') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Динамическая комиссия по загрузке сети (аналог EIP-1559), минимум 0.001 GND. 50% сжигается, 50% — валидаторам.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">2</span>{{ __('Стейкинг валидаторов') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Минимум 100 000 GND. Unbonding 7 дней. Slash за простой −5%, за double-sign −50%. Вознаграждения из инфляции 2–5% годовых.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">3</span>{{ __('DeFi и мосты') }}</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Коллатерал для стейблкоинов, ликвидность DEX, farming. Операторы мостов и оракулов блокируют GND как залог (от 50k GND).') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. Токен GANI --}}
<section class="section-box wow animate__animated animate__fadeIn box-how-it-work animated box-pricing-2" style="visibility: visible;">
    <div class="container">
        <a class="btn btn-brand-4-sm" href="#">{{ __('Токен GANI') }}</a>
        <h2 class="mt-15 mb-20">{{ __('GANI (Governance)') }}</h2>
        <p class="text-lg neutral-500 mb-30">{{ __('Фиксированная эмиссия 100 млн GANI, механика vote-escrow и управление протоколом через DAO.') }}</p>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6>{{ __('Параметры GANI') }}</h6></div>
                        <div class="card-desc">
                            <div class="table-responsive">
                                <table class="table table-dark table-bordered table-sm mb-0">
                                    <tbody>
                                        <tr><td>{{ __('Название') }}</td><td>Ganymede Governance (GANI)</td></tr>
                                        <tr><td>{{ __('Эмиссия') }}</td><td>100 000 000 GANI (фиксированная)</td></tr>
                                        <tr><td>{{ __('Начальная циркуляция') }}</td><td>20 000 000 (20%)</td></tr>
                                        <tr><td>{{ __('Стандарт') }}</td><td>GNDst-1 с vote-escrow</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6>{{ __('Распределение GANI') }}</h6></div>
                        <div class="card-desc">
                            <p class="mb-1">{{ __('DAO-казначейство: 40%') }}</p>
                            <p class="mb-1">{{ __('Команда/инвесторы: 30%') }}</p>
                            <p class="mb-1">{{ __('Экосистемные гранты: 15%') }}</p>
                            <p class="mb-1">{{ __('Публичная продажа: 10%') }}</p>
                            <p class="mb-0">{{ __('Ликвидность DEX: 5%') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-12 col-lg-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">1</span>veGANI (vote-escrow)</h6></div>
                        <div class="card-desc">
                            <p>{{ __('Блокировка GANI от 1 недели до 4 лет даёт нетрансферабельные veGANI с множителем силы голоса до 2×. Баланс линейно уменьшается до разблокировки.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title"><h6><span class="number">2</span>{{ __('Кворум и пороги') }}</h6></div>
                        <div class="card-desc">
                            <div class="table-responsive">
                                <table class="table table-dark table-bordered table-sm mb-0">
                                    <thead><tr><th>{{ __('Тип') }}</th><th>{{ __('Кворум') }}</th><th>{{ __('Порог') }}</th></tr></thead>
                                    <tbody>
                                        <tr><td>{{ __('Обычное') }}</td><td>≥10% veGANI</td><td>&gt;51%</td></tr>
                                        <tr><td>{{ __('Критическое') }}</td><td>≥10% veGANI</td><td>≥66%</td></tr>
                                        <tr><td>{{ __('Экстренное') }}</td><td>≥20% veGANI</td><td>≥75%</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Схема стандартов GND / GANI --}}
<section class="section-box box-pricing-2">
    <div class="container">
        <a class="btn btn-brand-4-sm" href="#">{{ __('Стандарты') }}</a>
        <h2 class="mt-15 mb-20">{{ __('Схема стандартов и токенов GND / GANI') }}</h2>
        <p class="text-lg neutral-800 mb-30">{{ __('Блокчейн ГАНИМЕД использует двухтокеновую архитектуру для разделения утилитарных и управленческих функций.') }}</p>
        <p class="text-sm neutral-700 mb-30">{{ __('Двухтокеновая модель GND + GANI разводит функции исполнения и управления: GND используется как базовый утилитарный актив сети (расчётная единица, комиссии, стейкинг валидаторов, DeFi и обеспечение мостов), тогда как GANI закрепляет права управления протоколом и казной через vote‑escrow‑механику и on‑chain голосование. Такая конструкция позволяет, с одной стороны, удерживать предсказуемую экономику комиссий и стабильность работы сети, а с другой — передать стратегические решения о параметрах протокола, поддержке проектов и развитии инфраструктуры децентрализованному сообществу держателей GANI.') }}</p>
        <p class="text-lg neutral-700 mb-30">{{ __('Уровни стандартов, конфиги ноды и порядок шагов от старта до работы с токенами.') }}</p>
        <div class="gnd-gani-diagram">
            <div class="diagram">
                <div class="gnd-diagram-row">
                    <div class="gnd-diagram-column">
                        <div class="gnd-diagram-column-title">{{ __('Уровень 1 — общий стандарт GNDst-1') }}</div>
                        <div class="gnd-diagram-tag">tokens/standards/gndst1/</div>
                        <div class="gnd-diagram-block gnd-diagram-block-emphasis">
                            <div class="gnd-diagram-block-title">IGNDst1.sol</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Интерфейс расширенного GND-st1') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">{{ __('балансы') }}</span>
                                <span class="gnd-diagram-chip">{{ __('переводы') }}</span>
                                <span class="gnd-diagram-chip">KYC</span>
                                <span class="gnd-diagram-chip">snapshot</span>
                                <span class="gnd-diagram-chip">dividends</span>
                                <span class="gnd-diagram-chip">modules</span>
                                <span class="gnd-diagram-chip">cross‑chain</span>
                            </div>
                        </div>
                        <div class="gnd-diagram-block">
                            <div class="gnd-diagram-block-title">gndst1Base.sol</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Эталонный Solidity‑контракт GNDst‑1') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">controller‑only</span>
                                <span class="gnd-diagram-chip">mint disabled</span>
                                <span class="gnd-diagram-chip">{{ __('полный набор функций') }}</span>
                            </div>
                        </div>
                        <div class="gnd-diagram-block">
                            <div class="gnd-diagram-block-title">gndst1.go</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Go‑реализация стандарта для ноды') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">{{ __('балансы в БД') }}</span>
                                <span class="gnd-diagram-chip">{{ __('снапшоты') }}</span>
                                <span class="gnd-diagram-chip">dividends</span>
                                <span class="gnd-diagram-chip">modules</span>
                            </div>
                        </div>
                    </div>
                    <div class="gnd-diagram-column">
                        <div class="gnd-diagram-column-title">{{ __('Уровень 2 — нативные монеты GND / GANI') }}</div>
                        <div class="gnd-diagram-tag">tokens/standards/native/</div>
                        <div class="gnd-diagram-block">
                            <div class="gnd-diagram-block-title">INativeCoin.sol</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Базовый интерфейс "как у монеты"') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">totalSupply</span>
                                <span class="gnd-diagram-chip">balanceOf</span>
                                <span class="gnd-diagram-chip">transfer</span>
                                <span class="gnd-diagram-chip">approve</span>
                                <span class="gnd-diagram-chip">allowance</span>
                                <span class="gnd-diagram-chip">transferFrom</span>
                            </div>
                        </div>
                        <div class="gnd-diagram-block">
                            <div class="gnd-diagram-block-title">IGND.sol / IGANI.sol</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Интерфейсы монет GND и GANI') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">name</span>
                                <span class="gnd-diagram-chip">symbol</span>
                                <span class="gnd-diagram-chip">decimals</span>
                            </div>
                        </div>
                        <div class="gnd-diagram-block gnd-diagram-block-emphasis">
                            <div class="gnd-diagram-block-title">GNDToken.sol</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Реальный контракт GND в сети') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">supply ≤ 1e27</span>
                                <span class="gnd-diagram-chip">18 decimals</span>
                                <span class="gnd-diagram-chip">mint disabled</span>
                                <span class="gnd-diagram-chip">controller</span>
                            </div>
                        </div>
                        <div class="gnd-diagram-block gnd-diagram-block-emphasis">
                            <div class="gnd-diagram-block-title">GANIToken.sol</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Реальный контракт GANI в сети') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">supply 1e14</span>
                                <span class="gnd-diagram-chip">6 decimals</span>
                                <span class="gnd-diagram-chip">mint disabled</span>
                                <span class="gnd-diagram-chip">controller</span>
                            </div>
                        </div>
                        <div class="gnd-diagram-block">
                            <div class="gnd-diagram-block-title">GNDCoinBase.sol / GANICoinBase.sol</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Заглушки под режим native через precompile') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">revert "use precompile"</span>
                                <span class="gnd-diagram-chip">{{ __('сейчас не используются') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gnd-diagram-arrow gnd-diagram-arrow-vertical"></div>
                <div class="gnd-diagram-section">
                    <div class="gnd-diagram-section-label">{{ __('Токеномика сети ГАНИМЕД') }}</div>
                    <div class="gnd-diagram-configs-row">
                        <div class="gnd-diagram-block">
                            <div class="gnd-diagram-block-title">config/coins.json</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Описание монет') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">symbol</span>
                                <span class="gnd-diagram-chip">decimals</span>
                                <span class="gnd-diagram-chip">supply</span>
                                <span class="gnd-diagram-chip">contract_address</span>
                            </div>
                        </div>
                        <div class="gnd-diagram-block">
                            <div class="gnd-diagram-block-title">config/native_contracts.json</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Адреса задеплоенных контрактов') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">gnd_contract_address</span>
                                <span class="gnd-diagram-chip">gani_contract_address</span>
                            </div>
                        </div>
                        <div class="gnd-diagram-block">
                            <div class="gnd-diagram-block-title">core/state.go</div>
                            <div class="gnd-diagram-block-subtitle">{{ __('Источник балансов GND / GANI') }}</div>
                            <div class="gnd-diagram-chips">
                                <span class="gnd-diagram-chip">{{ __('если адреса заданы → token_balances') }}</span>
                                <span class="gnd-diagram-chip">{{ __('иначе → native_balances') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gnd-diagram-arrow gnd-diagram-arrow-vertical"></div>
                <div class="gnd-diagram-section">
                    <div class="gnd-diagram-section-label">{{ __('Порядок шагов от старта до токенов') }}</div>
                    <div class="gnd-diagram-steps">
                        <div class="gnd-diagram-step">
                            <div class="gnd-diagram-step-number">1</div>
                            <div>
                                <div class="gnd-diagram-step-body-title">{{ __('Старт ноды') }}</div>
                                <div class="gnd-diagram-step-body-text">
                                    {{ __('Загружаются') }} <code>config.json</code>, <code>coins.json</code>, <code>native_contracts.json</code>, {{ __('БД; если генезиса нет, будет первый запуск.') }}
                                </div>
                            </div>
                        </div>
                        <div class="gnd-diagram-step">
                            <div class="gnd-diagram-step-number">2</div>
                            <div>
                                <div class="gnd-diagram-step-body-title">{{ __('Первый запуск (FirstLaunch)') }}</div>
                                <div class="gnd-diagram-step-body-text">
                                    {{ __('Создаётся генезис‑блок и нулевая системная транзакция, инициализируется state; авто‑деплоя') }} <code>GND</code>/<code>GANI</code> {{ __('нет.') }}
                                </div>
                            </div>
                        </div>
                        <div class="gnd-diagram-step">
                            <div class="gnd-diagram-step-number">3</div>
                            <div>
                                <div class="gnd-diagram-step-body-title">{{ __('Деплой контрактов GND и GANI') }}</div>
                                <div class="gnd-diagram-step-body-text">
                                    {{ __('Через REST') }} <code>POST /api/v1/contract</code> {{ __('или') }} <code>/api/v1/token/deploy</code> {{ __('деплоятся') }} <code>GNDToken</code> {{ __('и') }} <code>GANIToken</code> {{ __('с параметрами конструктора.') }}
                                </div>
                            </div>
                        </div>
                        <div class="gnd-diagram-step">
                            <div class="gnd-diagram-step-number">4</div>
                            <div>
                                <div class="gnd-diagram-step-body-title">{{ __('Прописка адресов в конфиге') }}</div>
                                <div class="gnd-diagram-step-body-text">
                                    {{ __('Адреса контрактов попадают в') }} <code>native_contracts.json</code> {{ __('и при необходимости в') }} <code>coins.json</code> {{ __('для соответствующих символов.') }}
                                </div>
                            </div>
                        </div>
                        <div class="gnd-diagram-step">
                            <div class="gnd-diagram-step-number">5</div>
                            <div>
                                <div class="gnd-diagram-step-body-title">{{ __('Работа ноды с GND / GANI') }}</div>
                                <div class="gnd-diagram-step-body-text">
                                    {{ __('При следующих запусках state использует') }} <code>token_balances</code> {{ __('по контрактам') }} <code>GNDToken</code>/<code>GANIToken</code>, {{ __('а не старые') }} <code>native_balances</code>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. Взаимодействие и безопасность --}}
<section class="section-box wow animate__animated animate__fadeIn box-how-it-work animated box-pricing-2" style="visibility: visible;">
    <div class="container">
        <a class="btn btn-brand-4-sm" href="#">{{ __('Синергия') }}</a>
        <h2 class="mt-15 mb-20">{{ __('Взаимодействие GND и GANI') }}</h2>
        <p class="text-lg neutral-500 mb-20">{{ __('GANI-держатели через DAO могут изменять параметры инфляции GND (2–5%), процент сжигания (50–70%), минимальные стейки и распределять GND из казначейства. Рост экосистемы увеличивает ценность обоих токенов.') }}</p>
        <p class="text-lg neutral-700 mb-0">{{ __('Безопасность: голосование по snapshot (защита от flash-loan), time-lock для критических решений (2 дня), multisig 3/5 для экстренной паузы без права менять параметры без DAO.') }}</p>
    </div>
</section>

{{-- 5. Дорожная карта (компоненты в стиле Features) --}}
<section class="section-box wow animate__animated animate__fadeIn box-preparing-3 animated box-testimonials-3" style="visibility: visible;">
    <div class="container">
        <div class="text-center">
            <h2 class="neutral-0 mb-20 uppercase">{{ __('Дорожная карта токеномики') }}</h2>
            <p class="text-lg neutral-700 mb-55">{{ __('Этапы развития двухтокеновой модели и экосистемы ГАНИМЕД.') }}</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{ __('Фаза 1: Genesis') }}</h5>
                        <p class="text-sm neutral-600 mb-0">{{ __('Q1 2026. Деплой GND и GANI, стейкинг валидаторов, активация vote-escrow (veGANI).') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{ __('Фаза 2: DeFi') }}</h5>
                        <p class="text-sm neutral-600 mb-0">{{ __('Q2–Q3 2026. Листинг CEX/DEX, lending, синтетические активы на СФОРДЕКС.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{ __('Фаза 3: Cross-chain') }}</h5>
                        <p class="text-sm neutral-600 mb-0">{{ __('Q4 2026. Мосты Ethereum, BSC, Tron; wGND/wGANI; оракулы.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{ __('Фаза 4: Децентрализация') }}</h5>
                        <p class="text-sm neutral-600 mb-0">{{ __('2027. Передача контроля multisig в DAO, полная on-chain governance.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 6. Сравнение с аналогами --}}
<section class="section-box wow animate__animated animate__fadeIn box-how-it-work animated box-pricing-2" style="visibility: visible;">
    <div class="container">
        <a class="btn btn-brand-4-sm" href="#">{{ __('Сравнение') }}</a>
        <h2 class="mt-15 mb-20">{{ __('Сравнение с аналогами') }}</h2>
        <p class="text-lg neutral-500 mb-30">{{ __('Позиционирование модели ГАНИМЕД относительно других блокчейн-проектов.') }}</p>
        <div class="box-border-rounded">
            <div class="card-casestudy">
                <div class="card-desc">
                    <div class="table-responsive">
                        <table class="table table-dark table-bordered table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>{{ __('Параметр') }}</th>
                                    <th>{{ __('ГАНИМЕД') }}</th>
                                    <th>Ethereum</th>
                                    <th>Cosmos</th>
                                    <th>Curve</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>{{ __('Утилитарный токен') }}</td><td>GND</td><td>ETH</td><td>ATOM</td><td>CRV</td></tr>
                                <tr><td>{{ __('Governance токен') }}</td><td>GANI (veGANI)</td><td>ETH</td><td>ATOM</td><td>veCRV</td></tr>
                                <tr><td>{{ __('Разделение функций') }}</td><td>✓</td><td>—</td><td>—</td><td>✓</td></tr>
                                <tr><td>{{ __('Burn комиссий') }}</td><td>50%</td><td>100%</td><td>—</td><td>—</td></tr>
                                <tr><td>Vote-escrow</td><td>4 года, 2×</td><td>—</td><td>—</td><td>4 года, 2.5×</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
