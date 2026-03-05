@extends('layouts.guest.guest')

@section('metaDescription')
{{ config('app.name') }} — {{ __('ГАНИМЕД — умный блокчейн с ГОСТ‑криптографией, встроенным комплаенсом и AI‑управлением в экосистеме НЕКСУС для токенизации реальных активов.') }}
@endsection

@section('metaKeywords')
{{ __('ГАНИМЕД, блокчейн, НЕКСУС, ГОСТ, токенизация, ЦФА, комплаенс') }}
@endsection

@section('content')
@php
    $pageTitle = __('ГАНИМЕД');
@endphp
{{-- ГАНИМЕД --}}
<section class="section-box wow animate__animated animate__fadeIn ganimed-hero animated pt-130" style="visibility: visible;" id="ganimed-hero">
    <div class="container">
        <div class="text-center"><a class="btn btn-brand-5" href="{{ url('https://main-node.gnd-net.com') }}" target="_blank" rel="noopener noreferrer">{{__('Гибридный блокчейн')}}</a>
            <h1 class="display-1 neutral-0 text-semibold pt-3">{{__('ГАНИМЕД')}}</h1>
            <h2 class="mb-25 mt-15 neutral-0">{{__(' в экосистеме')}} <br class="d-none d-lg-block">{{__('НЕКСУС')}}</h2>
            <p class="text-md neutral-300 mb-55">{{__(' умный блокчейн с ГОСТ‑криптографией, встроенным комплаенсом и AI‑управлением, ')}}<br class="d-none d-lg-block">{{__('созданный для токенизации реальных активов в российской юрисдикции.')}}</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card-features-5">
                    <div class="card-image"> <i class="fi-rr-layout-fluid color-green"></i></div>
                    <div class="card-info">
                        <h6>{{__('Смарт‑блокчейн для российской токенизации')}}</h6>
                        <p class="text-sm neutral-500">{{__('ГАНИМЕД изначально спроектирован под российский контур цифровых финансовых активов и ГОСТ‑криптографию, совмещая закрытый/открытый блокчейн и требования локального регулятора.')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-features-5">
                    <div class="card-image"> <i class="fi-rr-chart-network color-green"></i></div>
                    <div class="card-info">
                        <h6>{{__('Стандарт токенов GNDst‑1 с KYC «из коробки»')}}</h6>
                        <p class="text-sm neutral-500">{{__('В стандарте токена сразу зашиты параметры проверки клиентов, белые и чёрные списки и фиксация прав, поэтому выпуск токенов под реальные активы не превращается в отдельный комплаенс‑проект.')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-features-5">
                    <div class="card-image"> <i class="fi-rr-flip-horizontal color-green"></i></div>
                    <div class="card-info">
                        <h6>{{__('PoSA: гибридный консенсус для цифровых активов')}}</h6>
                        <p class="text-sm neutral-500">{{__('Уникальная схема гибридного консенсуса (доля участия + полномочия проверенных узлов) связывает экономическую ответственность валидаторов и роль надёжных операторов, что важно для инфраструктурных и регулируемых активов.')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-features-5">
                    <div class="card-image"> <i class="fi-rr-head-side-thinking color-green"></i></div>
                    <div class="card-info">
                        <h6>{{__('Искусственный интеллект как «мозг» сети')}}</h6>
                        <p class="text-sm neutral-500">{{__('Сеть изначально задумана с интеллект‑слоем на основе графовых нейросетей: он анализирует поведение узлов и транзакций и помогает управлять рисками, нагрузкой и параметрами консенсуса в реальном времени.')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-features-5">
                    <div class="card-image"> <i class="fi-rr-shield-check color-green"></i></div>
                    <div class="card-info">
                        <h6>{{__('Встроенные предохранители для DeFi‑экосистемы')}}</h6>
                        <p class="text-sm neutral-500">{{__('В протокол включены механизмы аварийного торможения и штрафов для узлов, которые работают как элементы защиты на уровне всей сети, а не только отдельного смарт‑контракта.')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-features-5">
                    <div class="card-image"> <i class="fi-rr-resources color-green"></i></div>
                    <div class="card-info">
                        <h6>{{__('Три виртуальные машины в одном блокчейне')}}</h6>
                        <p class="text-sm neutral-500">{{__('Поддержка трёх сред исполнения смарт‑контрактов (аналог Ethereum‑VM, среда на основе WebAssembly и виртуальная машина языка Move) позволяет запускать разные типы приложений в одной сети без смены инфраструктуры.')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-80">
            <p class="text-xl neutral-0">{{__('Блокчейн для ')}}<span class="color-green">{{__('реальных активов и реального права')}}</span></p>
            <a class="btn btn-brand-5 mt-2 uppercase" href="{{ url('https://scan.gnd-net.com') }}" target="_blank" rel="noopener noreferrer">{{__('Сканер ГАНИМЕД - scan.gnd-net.com')}}</a>
        </div>
    </div>
</section>
{{-- Особенности --}}
<section class="section-box box-all-in-one animated box-pricing-2" id="ganimed-features">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-lg-4 mb-30">
                <h2 class="header-2 neutral-1000 uppercase">{{ __('Особенности') }}</h2>
            </div>
            <div class="col-12 col-lg-8 mb-30">
                <p class="text-lg neutral-700">{{ __('ГАНИМЕД (GANIMED) — высокопроизводительная распределённая вычислительная платформа, разработанная на языке Go, с гибридным консенсусом PoSA (Proof-of-Stake / Proof-of-Authority), EVM-совместимой виртуальной машиной, поддержкой WASM и MoveVM и двухтокеновой экономической моделью (GND + GANI).') }}</p>
            </div>
        </div>
        <div class="row mt-40">
            <div class="col-12 col-lg-5">
                <div class="card-design">
                    <div class="card-image"><img alt="{{__('Блокчейн для реальных активов')}}" src="{{ asset('assets/imgs/page/homepage6/ready.png') }}"></div>
                    <div class="card-info">
                        <p class=" text-xl mb-30">{{__('Блокчейн для реальных активов')}}</p>
                        <p class="text-lg card-desc">{{__('ГАНИМЕД создан как основа для токенизации «понятных» вещей — недвижимости, бизнеса, инфраструктурных проектов и других реальных активов, а не ради спекуляций «ради токена»')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="card-design card-design-style2">
                    <div class="card-image"><img alt="{{__('Интеллектуальный слой')}}" src="{{__(asset('assets/imgs/page/homepage6/integration.png'))}}"></div>
                    <div class="card-info">
                        <p class=" text-xl mb-30">{{__('Интеллектуальный слой на основе ИИ анализирует своё состояние с помощью моделей искусственного интеллекта, чтобы лучше управлять нагрузкой, рисками и параметрами работы блокчейна по мере роста экосистемы.')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card-design card-design-style4">
                    <div class="card-image"><img alt="{{__('Экосистема - не одиночная сеть')}}" src="{{ asset('assets/imgs/page/homepage6/design.png') }}"></div>
                    <div class="card-info">
                        <p class=" text-xl mb-30">{{__('Экосистема - не одиночная сеть')}}</p>
                        <p class="text-lg card-desc">{{__('ГАНИМЕД реализован как технологическое ядро для целой экосистемы: инвестиционная платформа, вторичный рынок, депозитарий, маркетплейс — всё работает на одной технологической базе.')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card-design card-design-style3">
                    <div class="card-image"><img alt="{{__('Прозрачные правила')}}" src="{{__('assets/imgs/page/homepage6/fast.png')}}"></div>
                    <div class="card-info">
                        <p class=" text-xl mb-30">{{__('Прозрачные правила')}}</p>
                        <p class="text-lg card-desc">{{__('Условия выпуска токенов, ограничения, права и роли участников, данные системы смягчения заранее зашиваются в протокол и смарт‑контракты, поэтому участники видят правила и могут им доверять, а не полагаться на чьи‑то обещания.')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card-design card-design-style5">
                    <div class="card-image"><img alt="{{__('Токены')}}" src="{{ asset('assets/imgs/page/homepage6/power.png') }}"></div>
                    <div class="card-info">
                        <p class=" text-xl mb-30">{{__('Токены в сети могут отражать долю в проекте, право на доход или актив, который стоит за сделкой, убирая часть бумажной волокиты и делая учёт прозрачным в онлайне.')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-sm neutral-700">{{ __('Платформа предназначена для: создания и функционирования децентрализованных приложений (dApps); токенизации проектного инвестирования, токенизации реальных активов (RWA) — недвижимости, долговых и долевых инструментов; выпуска и обращения цифровых финансовых активов (ЦФА) по 259-ФЗ; обеспечения работы DeFi-протоколов; интеграции с IoT для автоматизированных расчётов; предоставления инфраструктуры для корпоративных и государственных заказчиков.') }}</p>
                <p class="text-sm neutral-700">{{ __('ГАНИМЕД входит в единую инфраструктуру платформы НЕКСУС вместе с каталогом проектов, вторичным рынком СФОРДЕКС, цифровым депозитарием НЕКСУС-ДЕПО и маркетплейсом НЕКСУС.') }}</p>
                <p class="text-sm neutral-700">{{ __('Проект функционирует в двойной юрисдикции: РФ (259-ФЗ, ЦБ РФ) и международные площадки.') }}</p>
            </div>
        </div>
    </div>
</section>
{{-- Характеристики --}}
<section class="section-box wow animate__animated animate__fadeIn box-preparing-3 animated" style="visibility: visible;">
    <div class="container">
        <div class="text-center">
            <h2 class="neutral-0 mb-20 uppercase">{{__('Характеристики')}}</h2>
            <p class="text-lg neutral-700">{{__('Техническая основа блокчейна: скорость и надёжность, используемая криптография, поддержка разных сред для смарт‑контрактов, механизм консенсуса и многослойная архитектура, на которой строятся приложения и сервисы')}}</p>
        </div>
        <div class="row mt-90">
            <div class="col-12 col-md-4">
                <div class="card-preparing-3">
                    <div class="card-image card-image-center ">
                        <i class="fi-rr-time-fast text-green h2 h"></i>
                    </div>
                    <div class="card-info">
                            <h5 class="text-22-bold">{{__('Производительность')}}</h5>
                        <p class="text-start neutral-200">{{ __('Целевые показатели: ') }}</p>
                   <p class="text-start">{{ __('- 1 000–5 000 TPS') }}</p>
                   <p class="text-start">{{ __('- время блока 3 секунды') }}</p>
                   <p class="text-start">{{ __('- финализация ≤ 10 секунд') }}</p>
                   <p class="text-start">{{ __('- uptime ≥ 99,9%') }}</p>
                   <p class="text-start">{{ __('- до 1 000 000 активных адресов без деградации') }}</p>
                   <p class="text-start">{{ __('- API до 10 000 RPS при задержке 500 ms') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3">
                    <div class="card-image card-image-center ">
                        <i class="fi-rr-shield text-green h2 h"></i>
                    </div>
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Криптография по ГОСТ')}}</h5>
                        <p class="text-start">{{ __('- ГОСТ 34.10-2018 (подпись ECGOST') }}</p>
                        <p class="text-start">{{ __('- 34.11-2018 (хэш Стрибог)') }}</p>
                        <p class="text-start">{{ __('- 34.12-2018 (Кузнечик/Магма)') }}</p>
                        <p class="text-start">{{ __('- интеграция через КриптоПро CSP') }}</p>
                        <p class="text-start">{{ __('- сертификация ФСБ (СКЗИ)') }}</p>
                        <p class="text-start">{{ __('- Соответствие 259-ФЗ, 289-ФЗ, 115-ФЗ, 152-ФЗ, 187-ФЗ') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3">
                    <div class="card-image card-image-center ">
                        <i class="fi-rr-compress-alt text-green h2 h"></i>
                    </div>
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Мульти-VM и смарт‑контракты')}}</h5>
                        <p class="text-start">{{ __('- EVM (Solidity)') }}</p>
                        <p class="text-start">{{ __('- WASM (Rust, C++, AssemblyScript)') }}</p>
                        <p class="text-start">{{ __('- Совместимость с Ethereum (ETH/Tron)') }}</p>
                        <p class="text-start">{{ __('- миграция dApps') }}</p>
                        <p class="text-start">{{ __('- cмарт‑контракты для выпуска токенов, iGND, ЦФА, УЦП, эскроу, купона и погашения') }}</p>
                        <p class="text-start">{{ __('- песочница исполнения и аудит кода') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card-preparing-3">
                    <div class="card-image card-image-center ">
                        <i class="fi-rr-shuffle h2"></i>
                    </div>
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Консенсус PoSA')}}</h5>
                        <p class="text-start">{{ __('- гибридный консенсус Proof-of-Stake / Proof-of-Authority') }}</p>
                        <p class="text-start">{{ __('- динамическое переключение PoS ↔ PoA по встроенному алгоритму') }}</p>
                        <p class="text-start">{{ __('- epoch 6 часов') }}</p>
                        <p class="text-start">{{ __('- ≥ 100 валидаторов в PoS') }}</p>
                        <p class="text-start">{{ __('- slashing 1,5% при сбое') }}</p>
                        <p class="text-start">{{ __('- финализация с криптографической необратимостью') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card-preparing-3">
                    <div class="card-image card-image-center ">
                        <i class="fi-rr-layers h2"></i>
                    </div>
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Пятислойная архитектура')}}</h5>
                        <p class="text-start">{{ __('- СЛОЙ 0 — физическая инфраструктура и сеть (libp2p, ГОСТ-шифрование)') }}</p>
                        <p class="text-start">{{ __('- СЛОЙ 1 — данные (блоки, DAG-подграфы, снапшоты)') }}</p>
                        <p class="text-start">{{ __('- СЛОЙ 2 — консенсус (PoSA)') }}</p>
                        <p class="text-start">{{ __('- СЛОЙ 3 — исполнение (EVM, WASM, MoveVM)') }}</p>
                        <p class="text-start">{{ __('- СЛОЙ 4 — приложения (REST, RPC, WebSocket API, блок-обозреватель, кошельки)') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Монеты --}}
<section class="section-box wow fadeIn box-our-track box-pricing-2">
    <div class="container">
        <div class="row align-items-lg-start align-items-center">
            <div class="col-12 mb-40 order-1 order-lg-2">
                <div class="box-padding-left-50">
                    <div class="btn btn-brand-4-sm mb-20">{{ __('Нативные монеты ГАНИМЕД') }}</div>
                    <h2 class="heading-2 mb-20 uppercase">{{ __('Токены и стандарт GNDst-1') }}</h2>
                    <p class="text-lg neutral-700">
                        {{__('Создать единую цифровую инфраструктуру для привлечения капитала в реальные проекты (бизнес,девелопмент, инфраструктура, ГЧП).') }}
                        <br>{{__('Обеспечить законный, технологичный и ликвидный рынок цифровых активов, доступный как для частных, так и для институциональных инвесторов.') }}
                        <br>{{__('Предоставить возможность реализации продукции и услуг, запущенных через экосистему, проектов, возможность постпроектного сопровождения.') }}
                    </p>

                    {{-- Как это работает --}}
                    <p class="text-lg neutral-500 mb-55">{{ __('Простой старт и достижение ваших целей.') }}</p>
                    <div class="row block-steps-badges">
                        <div class="col-12 col-lg-4">
                            <div class="box-border-rounded">
                                <div class="card-casestudy">
                                    <div class="card-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                                            <h6 class="mb-0">{{ __('Двухтокеновая модель GND + GANI') }}</h6>
                                            <a href="{{ route('ganimed.tokens') }}" class="btn btn-sm btn-brand-4-medium">{{ __('Подробнее') }}</a>
                                        </div>
                                    <div class="card-desc">
                                        <div class="card-title"><h6><span class="number">1</span>{{ __('Токен GND (утилитарный)') }}</h6></div>
                                        <div class="card-desc">
                                            <p class="text-md neutral-800 mb-0">{{ __('Нативный утилитарный токен сети.') }}</p>
                                            <p class="mb-0">{{ __('Общая эмиссия 1 млрд. ') }}</p>
                                            <p class="text-md  neutral-800">{{ __('Функции:') }}</p>
                                            <p class="mb-0">{{ __('- oплата комиссий (gas). ') }}</p>
                                            <p class="mb-0">{{ __('- стейкинг валидаторов') }}</p>
                                            <p class="mb-0">{{ __('- обеспечение DeFi') }}</p>
                                            <p class="mb-0">{{ __('- обеспечение мостов (оракулов)') }}</p>
                                            <p class="mb-0">{{ __('Деривативный токен на проектные токены и активы в СФОРДЕКС') }}</p>
                                            <p class="mb-2">{{ __('Инфляционная модель +2–5% в год для вознаграждения валидаторов, 50% комиссий сжигается, создавая дефляционное давление.') }}</p>
                                            </div>
                                        <div class="card-title"><h6><span class="number">2</span>{{ __('Токен GANI (управление)') }}</h6></div>
                                        <div class="card-desc">
                                            <p class="text-md neutral-800">{{ __('Токен управления сетью, используемый для голосования и управления экосистемой.') }}</p>
                                            <p>{{ __('Фиксированная эмиссия 100 млн. ') }}</p>
                                            <p>{{ __('Право голоса в DAO по параметрам протокола, казначейству, стратегическим партнёрствам. ') }}</p>
                                            <p>{{ __('Механика vote-escrow: блокировка до 4 лет даёт множитель до 2× к силе голоса. ') }}</p>
                                            <p>{{ __('Кворум ≥ 10% GANI при подтверждении эскроу.') }}</p>
                                            <p>{{ __('Критические решения принимаются при ≥ 66%.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="box-border-rounded">
                                <div class="card-casestudy">
                                    <div class="card-title"><h6>{{ __('Стандарт токенов GNDst-1') }}</h6></div>
                                    <div class="card-desc">
                                        <p class="text-md neutral-700">{{ __('GNDst-1 (GANIMED Standard Token v1) — расширенный стандарт токенов, совместимый с ERC-20 и дополненный функциями для токенизации RWA и соблюдения регуляторных требований. ') }}</p>
                                        <p class="text-md neutral-700">{{ __('Модули:') }}</p>
                                        <p>{{ __('KYC/AML (whitelist/blacklist') }}</p>
                                        <p>{{ __('Интеграция Sumsub/Blockpass через оракулы') }}</p>
                                        <p>{{ __('Travel Rule (данные отправителя/получателя для переводов свыше порога) ') }}</p>
                                        <p>{{ __('Кросс-чейн (мосты GANIMED-cross (собственный), IBC, LayerZero, Wormhole V2).') }}</p>
                                        <p>{{ __('Снапшоты состояний для начисления дивидендов/дохода.') }}</p>
                                        <p>{{ __('Модель управления доступом RBAC (Owner, Compliance Officer, Minter, Pauser).') }}</p>
                                        <p class="text-md neutral-700">{{ __('Стандарт обеспечивает совместимость с экосистемой НЕКСУС, вторичным рынком СФОРДЕКС и цифровым депозитарием. ') }}</p>
                                        <p class="text-md neutral-700">{{ __('Техническая документация (API v1.0) доступна в разделе ')}} <a href="{{route('documentation')}}"> {{__('«Документация».') }}</a> {{__('.') }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <img class="wow fadeInUp w-80" src="{{ asset('assets/imgs/page/homepage1/gndgani.png') }}" alt="{{ config('app.name') }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- Процесс реализации --}}
<section class="section-box wow fadeIn" id="ignd-steps">
    <div class="container">
        <div class="text-center mb-60">
            <h2 class="heading-2 neutral-0 mb-20">{{ __('Процесс реализации') }}</h2>
            <p class="text-lg neutral-600">{{ __('Внедрение ГАНИМЕД в рамках экосистемы НЕКСУС и соответствие регуляторике') }}</p>
        </div>
        <div class="ignd-steps-list">
            <x-guest.ignd-step
                :number="1"
                :title="__('Регистрация как оператор информационной системы в реестре ЦБ РФ (259-ФЗ), минимальный размер собственных средств 50 млн руб., правила ИС, утверждённые ЦБ.')"
                :paragraphs="[
                    __(''),
                ]"
            />
            <x-guest.ignd-step
                :number="2"
                :title="__('Сертификация ФСБ (СКЗИ)')"
                :paragraphs="[
                    __('криптоядро, архитектура, хранение ключей; испытания и выдача сертификата соответствия.'),
                ]"
            />
            <x-guest.ignd-step
                :number="3"
                :title="__('Соответствие')"
                :paragraphs="[
                    __('115-ФЗ (ПОД/ФТ).'),
                    __('152-ФЗ (персональные данные).'),
                    __('187-ФЗ (КИИ).'),
                    __('289-ФЗ (цифровые платформы).'),
                ]"
            />
            <x-guest.ignd-step
                :number="4"
                :title="__('Критический этап (0–6 мес):')"
                :paragraphs="[
                    __('завершение Core, Tokens, VM.'),
                    __('нагрузочные тесты 1000 TPS; ГОСТ-интеграция.'),
                    __('бата запуск - тестовая сеть запущена.'),
                ]"
            />
            <x-guest.ignd-step
                :number="5"
                :title="__('Средний этап (6–12 мес):')"
                :paragraphs="[
                    __('zk-EVM, DAG-оптимизация.'),
                    __('UI (Explorer, Wallet, DevPanel).'),
                    __('полная документация API.'),
                ]"
            />
            <x-guest.ignd-step
                :number="6"
                :title="__('Долгосрочный этап (12–24 мес):')"
                :paragraphs="[
                    __('шардинг, мосты (IBC, LayerZero, Wormhole), 5000+ TPS, 100+ валидаторов.'),
                ]"
            />
            <x-guest.ignd-step
                :number="7"
                :title="__('Стратегический этап (24–36 мес):')"
                :paragraphs="[
                    __('полная децентрализация DAO.'),
                    __('подготовка и начало экспансии СНГ/БРИКС'),
                ]"
            />
        </div>
    </div>
</section>
@endsection
