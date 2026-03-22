@extends('layouts.guest.guest')

@section('metaDescription')
{{ __('Операционная модель НЕКСУС: интерактивная карта проектов России, фильтры по отраслям и рискам, типы токенов и доходности. Рекомендации по профилю инвестора и связка с токенами.') }}
@endsection

@section('metaKeywords')
{{ __('НЕКСУС, особенности платформы, карта проектов, инвестиционные инструменты, токены, доходность, риск-профиль инвестора') }}
@endsection

@section('content')
<x-guest.public-page-banner
    :pageTitle="$title"
    :bannerDescription="$description ?? ''"
/>

{{-- ОПЕРАЦИОННАЯ МОДЕЛЬ И ОСОБЕННОСТИ --}}
<section class="section-box wow animate__animated animate__fadeIn box-how-it-work animated box-pricing-2" style="visibility: visible;">
    <div class="container">
    <a class="btn btn-brand-4-sm" href="#">{{__('Умный выбор')}}</a>
        <h2 class="mt-15 mb-20">{{__('Как устроена витрина проектов')}}</h2>
        <p class="text-lg neutral-500 mb-55">{{__('Ориентиры в экосистеме: интерактивная карта России, фильтры по отраслям, стадиям и риску, типы привлечения капитала и доходности, рекомендации по профилю инвестора и связка всех проектов с токенами НЕКСУС')}}</p>
        <div class="row">
            <div class="col-12 col-lg-8 text-center">
                <img class="wow fadeInUp w-50" src="{{ asset('assets/imgs/page/homepage1/map-rf.png') }}" alt="{{ config('app.name') }}">
            </div>
            <div class="col-12 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title">
                            <h6><span class="number">1</span>{{__('Интерактивная проектная карта России')}}</h6>
                        </div>
                        <div class="card-desc">
                            <p>{{__('На экране пользователь видит интерактивную карту РФ с метками всех проектов. ')}}</p>
                            <p>{{__('Каждый маркер отражает проект в регионе, масштаб и сектор экономики.')}}</p>
                            <p>{{__('Один клик по точке — и открывается карточка с ключевыми цифрами и токенами проекта.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title">
                            <h6><span class="number">2</span>{{__('Виды инструментов и доходности')}}</h6>
                        </div>
                        <div class="card-desc">
                            <p>{{__('В карточке сразу виден тип инструмента: долевой токен, долговой, дериватив на корзину проектов или токен смягчения риска и связанные с ним права.')}}</p>
                            <p>{{__('Дополнительные фильтры позволяют отобрать проекты по типу дохода: фиксированный процент, участие в прибыли, рост стоимости токена или комбинированные схемы, быстро отсекая всё, что не подходит под личную стратегию — от консервативного «купонного» портфеля до агрессивного роста.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title">
                            <h6><span class="number">3</span>{{__('Инвестиционный профиль и рекомендации')}}</h6>
                        </div>
                        <div class="card-desc">
                            <p>{{__('Платформа совместно с ИИ-модулем учитывает профиль инвестора: горизонт инвестиций, желаемую доходность, отношение к риску.')}}</p>
                            <p>{{__('На основе данного учета витрина предлагает подборки проектов и готовые корзины токенов.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title">
                            <h6><span class="number">4</span>{{__('Связка с экосистемой и токенами НЕКСУС')}}</h6>
                        </div>
                        <div class="card-desc">
                            <p>{{__('Каждый проект на витрине связан с токенами экосистемы НЕКСУС: базовыми, управляющими и страховыми.')}}</p>
                            <p>{{__('Пользователь видит, как распределяются риски и доходы между токенами, и может строить сложные стратегии — от простых вложений в один проект до участия во всей экосистеме.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="box-border-rounded">
                    <div class="card-casestudy">
                        <div class="card-title">
                            <h6><span class="number">5</span>{{__('Инвестиционный профиль и рекомендации')}}</h6>
                        </div>
                        <div class="card-desc">
                            <p>{{__('Платформа совместно с ИИ-модулем учитывает профиль инвестора: горизонт инвестиций, желаемую доходность, отношение к риску.')}}</p>
                            <p>{{__('На основе данного учета витрина предлагает подборки проектов и готовые корзины токенов.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 text-md">
                <p class="text-lg neutral-700">{{__('Благодаря единому интерфейсу витрина подходит всем участникам экосистемы:')}}
                    <span class="text-22-bold">{{ __('частные инвесторы ')}}</span>
                    {{__('получают понятные «карточки возможностей» без перегруза терминами,')}}
                    <span class="text-22-bold">{{ __('профессионалы')}}</span>
                    {{__('— доступ к глубокой аналитике, истории изменений и структуре токенов по каждому проекту. ')}}</p>
                <p class="text-lg neutral-700"><span class="text-22-bold">{{__('Инициаторы проектов ')}}</span>
                    {{__('и приглашённые ')}}
                    <span class="text-22-bold">{{ __('эксперты ')}}</span>
                    {{__('видят полный контекст по рынку и отзывам, могут оперативно дорабатывать условия размещения.')}}</p>
                <p class="text-lg neutral-700">{{__('Это снижает порог входа для новичков и одновременно даёт продвинутый инструмент структурирования сделок внутри экосистемы.')}}</p>
            </div>
        </div>
    </div>

</section>
@include('partials.ecosystem-architecture')


{{-- Компоненты --}}
<section class="section-box wow animate__animated animate__fadeIn box-preparing-3 animated" style="visibility: visible;">
    <div class="container">
        <div class="text-center">
            <h2 class="neutral-0 mb-20 uppercase">{{__('Компоненты экосистемы')}}</h2>
            <p class="text-lg neutral-700">{{__('Техническая основа блокчейна: скорость и надёжность, используемая криптография, поддержка разных сред для смарт‑контрактов, механизм консенсуса и многослойная архитектура, на которой строятся приложения и сервисы')}}</p>
        </div>
        <div class="row mt-90">
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Инвестиционная витрина и каталог проектов')}}</h5>
                        <p>{{ __('Единое окно доступа к токенизированным проектам по всей России: интерактивная карта, каталоги по отраслям, стадиям, риску, видам дохода и инструментов.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Блокчейн ГАНИМЕД')}}</h5>
                        <p>{{ __('Собственный гибридный блокчейн с поддержкой EVM/WASM/MoveVM, консенсусом на базе Go и PoSA/PoS/PoA, ориентированный на RWA‑токенизацию, DeFi и высокую пропускную способность сети.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Цифровой депозитарий активов (интеграция с НРД MOEX)')}}</h5>
                        <p>{{ __('Хранилище прав и токенов, где фиксируется структура владения, история операций и ограничения по каждому активу. Депозитарий обеспечивает юридическую «память» сделок и служит опорой для расчётов между участниками.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Площадка оборота цифровых активов СФОРДЕКС')}}</h5>
                        <p>{{ __('Платформа для торговли токенами проектов и производными инструментами, с AMM‑механикой, глубокой API‑интеграцией и возможностью подключения внешних провайдеров ликвидности.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Линейка токенов NEXUS (GND, GANI и др.)')}}</h5>
                        <p>{{ __('Базовые токены, токены управления и токены расчетов, которые распределяют риски и доходы между участниками, позволяют строить деривативы на корзины проектов и формировать комплексные инвестиционные стратегии.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Аналитика, отчётность и риск‑модели')}}</h5>
                        <p>{{ __('Дашборды по выручке, EBITDA, LTV/CAC, сценарные модели роста, прогнозные показатели по годам и портфельная аналитика для инвесторов и инициаторов проектов.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Система (модуль) KYC/AML и регуляторного соответствия')}}</h5>
                        <p>{{ __('Встроенные процедуры идентификации, проверка по требованиям 259‑ФЗ и смежных нормативных актов, законов,применяемых к экосистеме, интеграция с внешними сервисами и аудиториями, журнал действий и событий для регуляторов и партнёров.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Гранулированная система ролей и прав (RBAC)')}}</h5>
                        <p>{{ __('Роли владельца, комплаенс‑офицера, минтера, паузера и др., которые позволяют безопасно управлять контрактами, лимитами, заморозкой токенов и выпуском новых активов на уровне протокола.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Инфраструктура для эмитентов и интеграторов')}}</h5>
                        <p>{{ __('API‑шлюзы, SDK и white‑label‑решения для банков, финтех‑компаний и корпораций: выпуск собственных токенов, подключение витрины к своим продуктам, построение кастомных кабинетов и CRM‑сценариев.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4"></div>
            <div class="col-12 col-md-4">
                <div class="card-preparing-3 box-futures-component">
                    <div class="card-info">
                        <h5 class="text-22-bold">{{__('Мобильные и десктопные клиенты')}}</h5>
                        <p>{{ __('Приложения для iOS, Android и десктопа (Windows x64, Flutter‑клиенты) с единым UX: управление портфелем, уведомления, голосования и доступ к витрине «из кармана».') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4"></div>
        </div>
    </div>
</section>
@endsection
