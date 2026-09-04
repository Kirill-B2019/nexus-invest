@extends('layouts.guest.guest')

@section('metaDescription')
{{ __('НЕКСУС ИИ — собственная обучаемая модель экосистемы: скоринг проектов, комплаенс, риск‑менеджмент, инвест‑стратегии и поддержка. Compliance by design, 259‑ФЗ, 152‑ФЗ.') }}
@endsection

@section('metaKeywords')
{{ __('НЕКСУС ИИ, скоринг проектов, KYC AML, риск‑менеджмент, токенизация, машинное обучение, экосистема НЕКСУС') }}
@endsection

@section('content')
{{-- 1. Hero: бренд + нейрофон, без сетки карточек --}}
<section class="section-box wow animate__animated animate__fadeIn nexus-ai-hero animated pt-130" style="visibility: visible;" id="nexus-ai-hero">
    <div class="container">
        <div class="nexus-ai-hero__content text-center">
            <a class="btn btn-brand-5" href="#nexus-ai-domains">{{ __('Собственная модель ИИ') }}</a>
            <h1 class="display-1 neutral-0 text-semibold pt-3">{{ __('НЕКСУС ИИ') }}</h1>
            <h2 class="mb-25 mt-15 neutral-0">{{ __('мозг экосистемы') }} <br class="d-none d-lg-block">{{ __('НЕКСУС‑ИНВЕСТ ФОНД') }}</h2>
            <p class="text-md neutral-300 mb-40 nexus-ai-hero__lead">{{ __('Собственная обучаемая модель — единый сервис скоринга, комплаенса, рисков, стратегий и поддержки для всех модулей экосистемы через API и события блокчейна.') }}</p>
            <p class="text-xl neutral-0 mb-30">{{ __('ИИ для ') }}<span class="color-green">{{ __('решений по проектам и портфелю') }}</span></p>
            <div class="nexus-ai-hero__cta">
                <a class="btn btn-brand-5 uppercase me-2 mb-2" href="#" data-bs-toggle="modal" data-bs-target="#contactFormModal">{{ __('Связаться с нами') }}</a>
                <a class="btn btn-brand-4-sm mb-2" href="#nexus-ai-principles">{{ __('Принципы') }}</a>
            </div>
        </div>
    </div>
</section>

{{-- 2. Принципы + дисклеймер --}}
<section class="section-box wow fadeIn box-pricing-2" id="nexus-ai-principles">
    <div class="container">
        <div class="row align-items-end mb-50">
            <div class="col-12 col-lg-8">
                <div class="strate-icon"><span></span> {{ __('Основы') }}</div>
                <h2 class="heading-2 mb-15">{{ __('Принципы НЕКСУС ИИ') }}</h2>
                <p class="text-lg neutral-700 mb-0">{{ __('Гибридная архитектура, обучение на данных экосистемы и compliance by design — без передачи чувствительных данных во внешние публичные сервисы.') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-3 mb-30">
                <div class="card-features-5 h-100">
                    <div class="card-image"><i class="fi-rr-shield-check color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Compliance by design') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('Модели встроены в 259‑ФЗ, 152‑ФЗ и контуры KYC/AML.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-30">
                <div class="card-features-5 h-100">
                    <div class="card-image"><i class="fi-rr-layers color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Гибридная архитектура') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('ML для скоринга и риска, LLM для поддержки, правила для комплаенса.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-30">
                <div class="card-features-5 h-100">
                    <div class="card-image"><i class="fi-rr-chart-network color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Данные экосистемы') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('Обучение на заявках, выплатах, дефолтах и ончейн‑событиях модулей.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-30">
                <div class="card-features-5 h-100">
                    <div class="card-image"><i class="fi-rr-resources color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Модульность и API') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('Подмодели по доменам объединены через API и события блокчейна.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-20">
            <div class="col-12">
                <div class="box-border-rounded border-warning nexus-ai-disclaimer">
                    <div class="card-casestudy">
                        <div class="card-title"><h4 class="neutral-800 uppercase mb-0">{{ __('Важное ограничение') }}</h4></div>
                        <div class="card-desc">
                            <p class="neutral-700 mb-0 text-sm">{{ __('НЕКСУС ИИ — вспомогательный инструмент предварительного скоринга, подбора инструментов и раннего выявления аномалий. Модели участвуют в контроле параметров допуска и мониторинге обязательств без подмены юридического решения алгоритмом. Использование ИИ не является страховкой, финансовой гарантией, обещанием доходности или заменой комплаенс‑ и юридического заключения.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. Домены с нумерацией — визуальный якорь --}}
<section class="section-box wow fadeIn box-preparing-3" id="nexus-ai-domains">
    <div class="container">
        <div class="text-center mb-60">
            <h2 class="neutral-0 mb-20 uppercase">{{ __('Подмодели по доменам') }}</h2>
            <p class="text-lg neutral-700">{{ __('Семь контуров в одном сервисе. Результат для пользователя — без внутренних названий алгоритмов.') }}</p>
        </div>
        <div class="row nexus-ai-domains-grid">
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">01</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-chart-network color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Проектный скоринг') }}</h3>
                    <p class="text-sm mb-0">{{ __('Индекс привлекательности и рекомендация по структуре токенизации.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">02</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-resources color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Токеномика') }}</h3>
                    <p class="text-sm mb-0">{{ __('ЦФА, УЦП, RWA — параметры выпуска под юрисдикцию и инвесторов.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">03</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-shield-check color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('KYC / AML') }}</h3>
                    <p class="text-sm mb-0">{{ __('Статус верификации, риск‑скор и алерты по документам и транзакциям.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">04</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-shield color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Риск‑менеджмент') }}</h3>
                    <p class="text-sm">{{ __('Сценарии дефолта и стресс‑тесты портфеля.') }}</p>
                    <p class="text-sm mb-0"><a href="{{ route('ignd') }}">{{ __('Подробнее об iGND') }}</a></p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">05</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-head-side-thinking color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Инвест‑стратегии') }}</h3>
                    <p class="text-sm mb-0">{{ __('Аллокация капитала под горизонт, доходность и уровень риска.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">06</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-layout-fluid color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Поддержка') }}</h3>
                    <p class="text-sm mb-0">{{ __('Онбординг и ответы по документам на базе локальной LLM с RAG.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30 mx-lg-auto">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">07</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-time-fast color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Операционная аналитика') }}</h3>
                    <p class="text-sm mb-0">{{ __('Прогнозы потоков, узкие места воронки и операционные алерты.') }}</p>
                </article>
            </div>
        </div>
    </div>
</section>

{{-- 4. Pipeline архитектуры --}}
<section class="section-box wow fadeIn box-pricing-2" id="nexus-ai-flow">
    <div class="container">
        <div class="text-center mb-50">
            <div class="btn btn-brand-4-sm mb-20">{{ __('Архитектура') }}</div>
            <h2 class="heading-2 mb-20 uppercase">{{ __('От данных к решению') }}</h2>
            <p class="text-lg neutral-700">{{ __('Единый контур: данные модулей → признаки → модели → сервисы → интерфейсы кабинетов и алертов.') }}</p>
        </div>
        <div class="nexus-ai-flow" role="list">
            <div class="nexus-ai-flow__step" role="listitem">
                <span class="nexus-ai-flow__num">1</span>
                <h3 class="text-22-bold">{{ __('Данные') }}</h3>
                <p class="text-sm mb-0">{{ __('НЕКСУС, ГАНИМЕД, СФОРДЕКС, депозитарий, маркетплейс, реестры') }}</p>
            </div>
            <div class="nexus-ai-flow__arrow" aria-hidden="true"><i class="fi-rr-arrow-right"></i></div>
            <div class="nexus-ai-flow__step" role="listitem">
                <span class="nexus-ai-flow__num">2</span>
                <h3 class="text-22-bold">{{ __('Feature Store') }}</h3>
                <p class="text-sm mb-0">{{ __('Признаки проектов, инвесторов, транзакций, комплаенса') }}</p>
            </div>
            <div class="nexus-ai-flow__arrow" aria-hidden="true"><i class="fi-rr-arrow-right"></i></div>
            <div class="nexus-ai-flow__step" role="listitem">
                <span class="nexus-ai-flow__num">3</span>
                <h3 class="text-22-bold">{{ __('Модели') }}</h3>
                <p class="text-sm mb-0">{{ __('Скоринг, риск, правила, LLM с RAG') }}</p>
            </div>
            <div class="nexus-ai-flow__arrow" aria-hidden="true"><i class="fi-rr-arrow-right"></i></div>
            <div class="nexus-ai-flow__step" role="listitem">
                <span class="nexus-ai-flow__num">4</span>
                <h3 class="text-22-bold">{{ __('Сервисы') }}</h3>
                <p class="text-sm mb-0">{{ __('API и события блокчейна') }}</p>
            </div>
            <div class="nexus-ai-flow__arrow" aria-hidden="true"><i class="fi-rr-arrow-right"></i></div>
            <div class="nexus-ai-flow__step" role="listitem">
                <span class="nexus-ai-flow__num">5</span>
                <h3 class="text-22-bold">{{ __('Интерфейсы') }}</h3>
                <p class="text-sm mb-0">{{ __('Кабинеты, дашборды, алерты') }}</p>
            </div>
        </div>
        <p class="text-sm neutral-700 text-center mt-40 mb-0">{{ __('ГАНИМЕД — интеллект протокола (узлы, нагрузка, консенсус). НЕКСУС ИИ — решения по проектам, комплаенсу и портфелю.') }} <a href="{{ route('ganimed') }}">{{ __('ГАНИМЕД') }}</a></p>
    </div>
</section>

{{-- 5. Мосты к продуктам --}}
<section class="section-box wow fadeIn box-our-track-2" id="nexus-ai-bridges">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-12 col-lg-8">
                <div class="strate-icon"><span></span> {{ __('Экосистема') }}</div>
                <h2 class="heading-2 mb-15">{{ __('Уже заложено в продуктах') }}</h2>
                <p class="text-lg neutral-700 mb-0">{{ __('Возможности ИИ уже описаны в разделах платформы — здесь они собраны в один продукт.') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="card-features-5 h-100">
                    <div class="card-image"><i class="fi-rr-shield color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('iGND') }}</h6>
                        <p class="text-sm neutral-500 mb-15">{{ __('Риск‑профиль, диверсификация и AI‑скоринг проектов.') }}</p>
                        <a class="btn btn-brand-4-sm" href="{{ route('ignd') }}">{{ __('Система iGND') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="card-features-5 h-100">
                    <div class="card-image"><i class="fi-rr-chart-network color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('ГАНИМЕД') }}</h6>
                        <p class="text-sm neutral-500 mb-15">{{ __('Интеллект‑слой сети: нагрузка, узлы, параметры протокола.') }}</p>
                        <a class="btn btn-brand-4-sm" href="{{ route('ganimed') }}">{{ __('Блокчейн') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="card-features-5 h-100">
                    <div class="card-image"><i class="fi-rr-layout-fluid color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Витрина') }}</h6>
                        <p class="text-sm neutral-500 mb-15">{{ __('Подборки и рекомендации по профилю инвестора.') }}</p>
                        <a class="btn btn-brand-4-sm" href="{{ route('features') }}">{{ __('Особенности') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="card-features-5 h-100">
                    <div class="card-image"><i class="fi-rr-head-side-thinking color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Главная') }}</h6>
                        <p class="text-sm neutral-500 mb-15">{{ __('Тизер стратегий, скоринга и plan/fact‑дашбордов.') }}</p>
                        <a class="btn btn-brand-4-sm" href="{{ route('welcome') }}">{{ __('На главную') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 6. Обучение + roadmap --}}
<section class="section-box wow fadeIn" id="nexus-ai-training">
    <div class="container">
        <div class="text-center mb-60">
            <h2 class="heading-2 neutral-0 mb-20">{{ __('Обучение модели и дорожная карта') }}</h2>
            <p class="text-lg neutral-600">{{ __('От сбора данных до этапов MVP–V4. Сроки ориентировочные.') }}</p>
        </div>
        <div class="ignd-steps-list">
            <x-guest.ignd-step
                :number="1"
                :title="__('Сбор и разметка')"
                :paragraphs="[
                    __('Данные модулей экосистемы поступают в единый контур: заявки, выплаты, дефолты, нарушения и успешные кейсы получают разметку для обучения.'),
                ]"
            />
            <x-guest.ignd-step
                :number="2"
                :title="__('Feature engineering')"
                :paragraphs="[
                    __('Формируются признаки: финансовые метрики проектов, поведенческие паттерны инвесторов, сетевые и комплаенс‑признаки.'),
                ]"
            />
            <x-guest.ignd-step
                :number="3"
                :title="__('Обучение, валидация и деплой')"
                :paragraphs="[
                    __('Кросс‑валидация и бэктестинг, A/B‑тесты и аудит, затем выкат с мониторингом дрейфа и эскалацией отклонений операторам ML.'),
                ]"
            />
            <x-guest.ignd-step
                :number="4"
                :title="__('MVP · Q4 2026')"
                :paragraphs="[
                    __('Скоринг проектов и базовый KYC/AML, интеграция с проектной платформой НЕКСУС.'),
                ]"
            />
            <x-guest.ignd-step
                :number="5"
                :title="__('V2 · Q2 2027')"
                :paragraphs="[
                    __('Полноценный риск‑менеджмент, интеграция с ГАНИМЕД и площадкой СФОРДЕКС.'),
                ]"
            />
            <x-guest.ignd-step
                :number="6"
                :title="__('V3 · Q1 2028')"
                :paragraphs="[
                    __('Депозитарий, автоматическая отчётность и LLM‑поддержка пользователей.'),
                ]"
            />
            <x-guest.ignd-step
                :number="7"
                :title="__('V4 · 2028+')"
                :paragraphs="[
                    __('Маркетплейс, персонализация и регулярное дообучение на новых данных и ончейн‑событиях.'),
                ]"
            />
        </div>
    </div>
</section>

{{-- 7. Риски + FAQ + CTA --}}
<section class="section-box wow fadeIn box-pricing-2" id="nexus-ai-risks">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-12 col-lg-8">
                <div class="strate-icon"><span></span> {{ __('Безопасность') }}</div>
                <h2 class="heading-2 mb-15">{{ __('Риски моделей и митигация') }}</h2>
                <p class="text-lg neutral-700 mb-0">{{ __('Дрейф, регуляторика, защита данных и человеческий надзор.') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="nexus-ai-risk-card">
                    <h3 class="text-22-bold">{{ __('Дрейф') }}</h3>
                    <p class="text-sm mb-0">{{ __('Мониторинг качества, переобучение и A/B‑тесты.') }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="nexus-ai-risk-card">
                    <h3 class="text-22-bold">{{ __('Регуляторика') }}</h3>
                    <p class="text-sm mb-0">{{ __('Compliance‑gate и обновление правил KYC/AML.') }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="nexus-ai-risk-card">
                    <h3 class="text-22-bold">{{ __('152‑ФЗ') }}</h3>
                    <p class="text-sm mb-0">{{ __('Локальная LLM и шифрование контура данных.') }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="nexus-ai-risk-card">
                    <h3 class="text-22-bold">{{ __('Надзор') }}</h3>
                    <p class="text-sm mb-0">{{ __('Эскалация алертов специалистам — алгоритм не заменяет решение.') }}</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-10">
            <a class="btn btn-brand-4-sm" href="{{ route('compliance') }}">{{ __('Комплаенс платформы') }}</a>
        </div>
    </div>
</section>

<section class="section-box box-faqs-3 faq-section-light" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="box-faq-left box-faq-left--intro">
                    <a class="btn btn-brand-4-sm" href="#faq">{{ __('Часто задаваемые вопросы') }}</a>
                    <h2 class="heading-2 mb-20 mt-20">{{ __('Вопросы о НЕКСУС ИИ') }}</h2>
                    <p class="text-lg neutral-700">{{ __('Границы решений, данные, связь с iGND и ГАНИМЕД, сроки MVP.') }}</p>
                </div>
            </div>
            <div class="col-lg-7">
                <x-guest.faq-accordion :items="[
                    [
                        'question' => 'Принимает ли ИИ юридически значимые решения?',
                        'answer' => 'Нет. НЕКСУС ИИ готовит скоринг, рекомендации и алерты. Юридически значимые и комплаенс‑решения принимают уполномоченные специалисты и регламенты платформы — алгоритм их не подменяет.',
                        'open' => true,
                    ],
                    [
                        'question' => 'Где обрабатываются данные и как соблюдается 152‑ФЗ?',
                        'answer' => 'Чувствительные данные обрабатываются в контролируемом контуре экосистемы. Для поддержки используется локальная LLM с RAG, без передачи содержимого документов во внешние публичные чат‑сервисы.',
                    ],
                    [
                        'question' => 'Чем НЕКСУС ИИ отличается от внешнего ChatGPT?',
                        'answer' => 'Это собственная обучаемая модель под домены экосистемы (скоринг, комплаенс, риски, стратегии), обученная на внутренних данных и встроенная в регуляторные правила платформы, а не универсальный публичный чат.',
                    ],
                    [
                        'question' => 'Как ИИ связан с iGND и «мозгом сети» ГАНИМЕД?',
                        'answer' => 'НЕКСУС ИИ — мозг экосистемы: проекты, портфель, комплаенс. iGND применяет ИИ в контуре риск‑профиля и смягчения рисков. ГАНИМЕД использует отдельный интеллект‑слой для узлов, нагрузки и параметров сети. Это связанные, но разные контуры.',
                    ],
                    [
                        'question' => 'Когда появится MVP НЕКСУС ИИ?',
                        'answer' => 'Ориентир MVP — Q4 2026: скоринг проектов и базовый KYC/AML в интеграции с НЕКСУС. Сроки согласованы с дорожной картой экосистемы на главной и не являются публичной офертой до отдельного официального объявления.',
                    ],
                ]" :accordionId="'accordionNexusAi'" />
            </div>
        </div>
    </div>
</section>

@endsection
