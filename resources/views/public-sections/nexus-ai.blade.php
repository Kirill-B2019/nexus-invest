@extends('layouts.guest.guest')

@section('metaDescription')
{{ __('НЕКСУС ИИ — интеллектуальный контур экосистемы: анализ проектов, оценка рисков, комплаенс и поддержка участников. Обучаемая модель на данных платформы, без подмены решений специалистов.') }}
@endsection

@section('metaKeywords')
{{ __('НЕКСУС ИИ, анализ проектов, скоринг, KYC AML, риск‑менеджмент, токенизация, интеллектуальный контур, экосистема НЕКСУС') }}
@endsection

@section('content')
{{-- 1. Первый экран --}}
<section class="section-box wow animate__animated animate__fadeIn nexus-ai-hero animated pt-130" style="visibility: visible;" id="nexus-ai-hero">
    <div class="container">
        <div class="nexus-ai-hero__content text-center">
            <a class="btn btn-brand-5" href="#nexus-ai-about">{{ __('Интеллектуальный контур') }}</a>
            <h1 class="display-1 neutral-0 text-semibold pt-3">{{ __('НЕКСУС ИИ') }}</h1>
            <h2 class="mb-25 mt-15 neutral-0">{{ __('интеллектуальный контур экосистемы') }} <br class="d-none d-lg-block">{{ __('НЕКСУС‑ИНВЕСТ ФОНД') }}</h2>
            <p class="text-lg neutral-200 mb-20 nexus-ai-hero__lead">{{ __('Собственная обучаемая модель для анализа проектов, оценки рисков, комплаенса и поддержки участников платформы.') }}</p>
            <p class="text-md neutral-300 mb-35 nexus-ai-hero__lead">{{ __('НЕКСУС ИИ объединяет данные экосистемы и помогает принимать более обоснованные решения по проектам, токенизации и инвестиционному портфелю.') }}</p>


        </div>
    </div>
</section>

{{-- 2. Что такое НЕКСУС ИИ / главный смысл --}}
<section class="section-box wow fadeIn box-pricing-2 nexus-ai-section" id="nexus-ai-about">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-lg-5 mb-30">
                <div class="strate-icon"><span></span> {{ __('О продукте') }}</div>
                <h2 class="heading-2 mb-20">{{ __('ИИ для анализа проектов, инвестиций и рисков') }}</h2>
            </div>
            <div class="col-12 col-lg-7 mb-30">
                <p class="text-lg neutral-700 mb-20">{{ __('НЕКСУС ИИ анализирует информацию о проектах, инвестиционных инструментах, транзакциях и портфелях. Система формирует оценки, рекомендации и предупреждения, а итоговые решения остаются за ответственными специалистами и утверждёнными регламентами.') }}</p>
                <p class="text-md neutral-700 mb-0">{{ __('Это специализированная обучаемая система экосистемы НЕКСУС: она работает с данными и правилами платформы и не является универсальным публичным чат‑ботом.') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- 3. Преимущества --}}
<section class="section-box wow fadeIn box-our-track-2 nexus-ai-section" id="nexus-ai-advantages">
    <div class="container">
        <div class="text-center mb-50">
            <h2 class="heading-2 mb-15">{{ __('Как устроен интеллектуальный контур') }}</h2>
            <p class="text-lg neutral-700">{{ __('Ключевые принципы работы НЕКСУС ИИ — с пояснением технологий и границ применения.') }}</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="card-features-5 h-100 nexus-ai-adv-card">
                    <div class="card-image"><i class="fi-rr-layers color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Гибридная архитектура') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('НЕКСУС ИИ сочетает машинное обучение (ML), большие языковые модели (LLM) и формализованные правила. Каждый тип технологии используется для своей задачи: аналитика, работа с документами или контроль требований.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="card-features-5 h-100 nexus-ai-adv-card">
                    <div class="card-image"><i class="fi-rr-chart-network color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Работа с данными экосистемы') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('Модель обучается и совершенствуется на данных платформы: заявках, финансовых показателях, выплатах, результатах проектов и событиях блокчейна.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <div class="card-features-5 h-100 nexus-ai-adv-card">
                    <div class="card-image"><i class="fi-rr-lock color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Защищённый контур') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('Чувствительные данные обрабатываются внутри контролируемой инфраструктуры экосистемы. Содержимое документов не передаётся во внешние публичные чат‑сервисы.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 mb-30">
                <div class="card-features-5 h-100 nexus-ai-adv-card">
                    <div class="card-image"><i class="fi-rr-shield-check color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Комплаенс на этапе проектирования') }} <span class="text-sm neutral-500">(compliance by design)</span></h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('Требования комплаенса учитываются на этапе проектирования процессов, а не добавляются после запуска системы. НЕКСУС ИИ поддерживает процедуры KYC/AML (идентификация клиента и противодействие отмыванию средств) и контроль операций.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 mb-30">
                <div class="card-features-5 h-100 nexus-ai-adv-card">
                    <div class="card-image"><i class="fi-rr-resources color-green"></i></div>
                    <div class="card-info">
                        <h6>{{ __('Интеграция с платформой') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('Система взаимодействует с модулями экосистемы через программные интерфейсы (API), внутренние сервисы и события блокчейна.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. Функции --}}
<section class="section-box wow fadeIn box-preparing-3 nexus-ai-section" id="nexus-ai-functions">
    <div class="container">
        <div class="text-center mb-50">
            <h2 class="neutral-0 mb-20 uppercase">{{ __('Функции НЕКСУС ИИ') }}</h2>
            <p class="text-lg neutral-700">{{ __('Какие задачи решает система для проектов, инвесторов и операционного контура платформы.') }}</p>
        </div>
        <div class="row nexus-ai-domains-grid">
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">01</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-head-side-thinking color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Анализ проектов') }}</h3>
                    <p class="text-sm mb-0">{{ __('Оценивает финансовые, операционные и рыночные параметры проекта, выявляет сильные и слабые стороны, а также формирует предварительный индекс привлекательности.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">02</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-chart-network color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Проектный скоринг') }}</h3>
                    <p class="text-sm mb-0">{{ __('Рассчитывает оценку проекта на основе заданных критериев и доступных данных. Скоринг используется как аналитический инструмент и не является гарантией доходности или успешности проекта.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">03</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-resources color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Анализ токенизации') }}</h3>
                    <p class="text-sm mb-0">{{ __('Помогает определить подходящую структуру цифрового инструмента, параметры выпуска и основные ограничения с учётом характеристик проекта и требований платформы.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">04</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-shield color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Управление рисками') }}</h3>
                    <p class="text-sm mb-0">{{ __('Выявляет факторы, которые могут повлиять на сроки, выплаты, ликвидность и устойчивость проекта. Система формирует предупреждения и сценарии для дальнейшего анализа.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">05</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-shield-check color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Комплаенс и мониторинг') }}</h3>
                    <p class="text-sm mb-0">{{ __('Поддерживает процедуры KYC/AML, выявляет нетипичные операции и передаёт потенциально рискованные случаи на проверку ответственным специалистам.') }}</p>
                </article>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-30">
                <article class="nexus-ai-domain-card">
                    <span class="nexus-ai-domain-num" aria-hidden="true">06</span>
                    <div class="nexus-ai-domain-icon"><i class="fi-rr-layout-fluid color-green"></i></div>
                    <h3 class="text-22-bold">{{ __('Интеллектуальная поддержка') }}</h3>
                    <p class="text-sm mb-0">{{ __('Отвечает на вопросы по материалам экосистемы, помогает работать с документами и объясняет результаты анализа понятным языком.') }}</p>
                </article>
            </div>
        </div>
    </div>
</section>

{{-- 5. Как работает / каждая технология --}}
<section class="section-box wow fadeIn box-pricing-2 nexus-ai-section" id="nexus-ai-how">
    <div class="container">
        <div class="row align-items-start mb-40">
            <div class="col-12 col-lg-5 mb-30">
                <div class="strate-icon"><span></span> {{ __('Архитектура') }}</div>
                <h2 class="heading-2 mb-15">{{ __('Каждая технология решает свою задачу') }}</h2>
                <p class="text-md neutral-700 mb-0">{{ __('LLM — большая языковая модель, предназначенная для работы с текстом и документами. RAG — технология, при которой модель формирует ответ на основе подключённой базы документов, а не только на основе предварительного обучения.') }}</p>
            </div>
            <div class="col-12 col-lg-7">
                <ul class="nexus-ai-tech-list list-unstyled mb-0">
                    <li class="nexus-ai-tech-item">
                        <strong class="color-green">{{ __('Машинное обучение (ML)') }}</strong>
                        <span>{{ __('анализирует показатели проектов и оценивает риски.') }}</span>
                    </li>
                    <li class="nexus-ai-tech-item">
                        <strong class="color-green">{{ __('Языковая модель (LLM)') }}</strong>
                        <span>{{ __('работает с документами, вопросами и пояснениями.') }}</span>
                    </li>
                    <li class="nexus-ai-tech-item">
                        <strong class="color-green">{{ __('Формализованные правила') }}</strong>
                        <span>{{ __('проверяют обязательные условия комплаенса.') }}</span>
                    </li>
                    <li class="nexus-ai-tech-item">
                        <strong class="color-green">{{ __('Событийная архитектура') }}</strong>
                        <span>{{ __('передаёт данные между модулями платформы через API и события блокчейна.') }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="nexus-ai-flow nexus-ai-flow--animated" role="list" id="nexus-ai-flow" aria-label="{{ __('Процесс: от данных к интерфейсам') }}">
            <div class="nexus-ai-flow__step" role="listitem" data-step="1">
                <span class="nexus-ai-flow__num">1</span>
                <h3 class="text-22-bold">{{ __('Данные') }}</h3>
                <p class="text-sm mb-0">{{ __('Источники экосистемы и внешние реестры') }}</p>
            </div>
            <div class="nexus-ai-flow__arrow" aria-hidden="true"><i class="fi-rr-arrow-right"></i></div>
            <div class="nexus-ai-flow__step" role="listitem" data-step="2">
                <span class="nexus-ai-flow__num">2</span>
                <h3 class="text-22-bold">{{ __('Признаки') }}</h3>
                <p class="text-sm mb-0">{{ __('Единое хранилище признаков для анализа') }}</p>
            </div>
            <div class="nexus-ai-flow__arrow" aria-hidden="true"><i class="fi-rr-arrow-right"></i></div>
            <div class="nexus-ai-flow__step" role="listitem" data-step="3">
                <span class="nexus-ai-flow__num">3</span>
                <h3 class="text-22-bold">{{ __('Модели') }}</h3>
                <p class="text-sm mb-0">{{ __('Скоринг, риск, правила, LLM с RAG') }}</p>
            </div>
            <div class="nexus-ai-flow__arrow" aria-hidden="true"><i class="fi-rr-arrow-right"></i></div>
            <div class="nexus-ai-flow__step" role="listitem" data-step="4">
                <span class="nexus-ai-flow__num">4</span>
                <h3 class="text-22-bold">{{ __('Сервисы') }}</h3>
                <p class="text-sm mb-0">{{ __('API и события блокчейна') }}</p>
            </div>
            <div class="nexus-ai-flow__arrow" aria-hidden="true"><i class="fi-rr-arrow-right"></i></div>
            <div class="nexus-ai-flow__step" role="listitem" data-step="5">
                <span class="nexus-ai-flow__num">5</span>
                <h3 class="text-22-bold">{{ __('Интерфейсы') }}</h3>
                <p class="text-sm mb-0">{{ __('Кабинеты, дашборды, алерты') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- 6. Данные для обучения --}}
<section class="section-box wow fadeIn box-our-track-2 nexus-ai-section" id="nexus-ai-data">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-lg-5 mb-40">
                <div class="strate-icon"><span></span> {{ __('Данные') }}</div>
                <h2 class="heading-2 mb-20">{{ __('На каких данных обучается система') }}</h2>
                <p class="text-lg neutral-700 mb-0">{{ __('НЕКСУС ИИ использует структурированные данные экосистемы. Обучение проводится только при наличии законных оснований и с учётом требований к защите персональных и конфиденциальных данных.') }}</p>
            </div>
            <div class="col-12 col-lg-7 mb-40">
                <ul class="nexus-ai-data-list">
                    <li>{{ __('заявки и бизнес‑модели проектов;') }}</li>
                    <li>{{ __('финансовые показатели и планы выплат;') }}</li>
                    <li>{{ __('результаты финансирования;') }}</li>
                    <li>{{ __('сведения о задержках и дефолтах;') }}</li>
                    <li>{{ __('данные инвестиционных портфелей;') }}</li>
                    <li>{{ __('обезличенные поведенческие признаки;') }}</li>
                    <li>{{ __('события и операции блокчейн‑модулей.') }}</li>
                </ul>
                <div class="box-border-rounded border-warning nexus-ai-disclaimer mt-30">
                    <div class="card-casestudy">
                        <div class="card-title"><h4 class="neutral-800 uppercase mb-0">{{ __('Ограничение по персональным данным') }}</h4></div>
                        <div class="card-desc">
                            <p class="neutral-700 mb-0 text-sm">{{ __('Персональные данные не должны использоваться для обучения без соответствующего правового основания и внутренних процедур контроля.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 7. Не чат-бот --}}
<section class="section-box wow fadeIn box-pricing-2 nexus-ai-section" id="nexus-ai-not-chatbot">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6 mb-40 order-1">
                <div class="nexus-ai-callout nexus-ai-callout--compact">
                    <h2 class="heading-2 mb-20">{{ __('НЕКСУС ИИ — это не обычный чат‑бот') }}</h2>
                    <p class="text-lg neutral-700 mb-15">{{ __('НЕКСУС ИИ не является универсальным публичным помощником. Это специализированная система для задач проектного финансирования, токенизации, управления рисками и комплаенса.') }}</p>
                    <p class="text-md neutral-700 mb-0">{{ __('Она работает с данными и правилами экосистемы, формирует аналитические выводы и рекомендации, но не принимает юридически значимые решения самостоятельно. Чат‑интерфейс — лишь один из способов взаимодействия с системой.') }}</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-40 order-2">
                <div class="nexus-ai-not-chatbot-visual text-center">
                    <img
                        src="{{ asset('assets/imgs/page/homepage1/nexus-ai-not-chatbot.png') }}"
                        alt="{{ __('НЕКСУС ИИ — специализированная аналитическая система, а не обычный чат‑бот') }}"
                        class="img-fluid nexus-ai-not-chatbot-img"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 8. Связь с iGND и ГАНИМЕД --}}
<section class="section-box wow fadeIn box-our-track-2 nexus-ai-section" id="nexus-ai-ecosystem">
    <div class="container">
        <div class="text-center mb-50">
            <h2 class="heading-2 mb-15">{{ __('Единый интеллектуальный контур экосистемы') }}</h2>
            <p class="text-lg neutral-700">{{ __('Связанные системы с разными функциями — не одна универсальная модель.') }}</p>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 mb-30">
                <div class="card-features-5 h-100 nexus-ai-adv-card">
                    <div class="card-info">
                        <h6>{{ __('НЕКСУС ИИ') }}</h6>
                        <p class="text-sm neutral-500 mb-0">{{ __('Отвечает за анализ проектов, инвестиционных портфелей, комплаенс и пользовательскую поддержку.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-30">
                <div class="card-features-5 h-100 nexus-ai-adv-card">
                    <div class="card-info">
                        <h6>{{ __('iGND') }}</h6>
                        <p class="text-sm neutral-500 mb-15">{{ __('Использует отдельные модели для формирования риск‑профиля и анализа мер по снижению рисков.') }}</p>
                        <a class="btn btn-brand-4-sm" href="{{ route('ignd') }}">{{ __('Система iGND') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-30">
                <div class="card-features-5 h-100 nexus-ai-adv-card">
                    <div class="card-info">
                        <h6>{{ __('ГАНИМЕД') }}</h6>
                        <p class="text-sm neutral-500 mb-15">{{ __('Применяет собственный интеллект‑слой для анализа состояния сети, нагрузки на узлы и технических параметров блокчейна.') }}</p>
                        <a class="btn btn-brand-4-sm" href="{{ route('ganimed') }}">{{ __('Блокчейн ГАНИМЕД') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-md neutral-700 text-center mt-10 mb-0">{{ __('Эти системы могут обмениваться данными через согласованные интерфейсы, но выполняют разные функции.') }}</p>
    </div>
</section>

{{-- 9. Безопасность, ограничения --}}
<section class="section-box wow fadeIn box-pricing-2 nexus-ai-section" id="nexus-ai-risks">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-12 col-lg-8">
                <div class="strate-icon"><span></span> {{ __('Безопасность и роль специалистов') }}</div>
                <h2 class="heading-2 mb-15">{{ __('Ограничения и контроль') }}</h2>
                <p class="text-lg neutral-700 mb-0">{{ __('Система формирует оценки, рекомендации и предупреждения. Юридически значимые, инвестиционные и комплаенс‑решения принимают уполномоченные специалисты.') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="nexus-ai-risk-card">
                    <h3 class="text-22-bold">{{ __('Дрейф моделей') }}</h3>
                    <p class="text-sm mb-0">{{ __('Мониторинг качества, переобучение и A/B‑тесты на пилотных проектах.') }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="nexus-ai-risk-card">
                    <h3 class="text-22-bold">{{ __('Регуляторика') }}</h3>
                    <p class="text-sm mb-0">{{ __('Обновление правил KYC/AML без ожидания полного переобучения моделей.') }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="nexus-ai-risk-card">
                    <h3 class="text-22-bold">{{ __('152‑ФЗ') }}</h3>
                    <p class="text-sm mb-0">{{ __('Локальная языковая модель и шифрование контура данных.') }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-30">
                <div class="nexus-ai-risk-card">
                    <h3 class="text-22-bold">{{ __('Человеческий надзор') }}</h3>
                    <p class="text-sm mb-0">{{ __('Эскалация алертов специалистам — алгоритм не заменяет решение.') }}</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-10">
            <a class="btn btn-brand-4-sm" href="{{ route('compliance') }}">{{ __('Комплаенс платформы') }}</a>
        </div>
    </div>
</section>

{{-- 10. Этапы разработки / MVP --}}
<section class="section-box wow fadeIn box-preparing-3 nexus-ai-section" id="nexus-ai-roadmap">
    <div class="container">
        <div class="text-center mb-40">
            <h2 class="neutral-0 mb-20 uppercase">{{ __('Первый этап разработки') }}</h2>
            <p class="text-lg neutral-700">{{ __('В рамках MVP планируется реализовать базовый контур анализа и интеграции с платформой НЕКСУС.') }}</p>
        </div>
        <div class="row justify-content-center mb-40">
            <div class="col-12 col-lg-8">
                <ul class="nexus-ai-mvp-list text-start">
                    <li>{{ __('проектный скоринг;') }}</li>
                    <li>{{ __('базовые проверки KYC/AML;') }}</li>
                    <li>{{ __('интеграцию с платформой НЕКСУС;') }}</li>
                    <li>{{ __('формирование аналитических рекомендаций и уведомлений.') }}</li>
                </ul>
                <p class="text-lg neutral-0 mt-30 mb-20"><strong>{{ __('Ориентировочный срок MVP — IV квартал 2026 года.') }}</strong></p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="box-border-rounded border-warning nexus-ai-disclaimer nexus-ai-mvp-notice">
                    <div class="card-casestudy">
                        <div class="card-title"><h4 class="neutral-800 uppercase mb-0">{{ __('Важно о сроках') }}</h4></div>
                        <div class="card-desc">
                            <p class="neutral-700 mb-0 text-sm">{{ __('Указанные сроки являются предварительными и могут изменяться в процессе разработки. Они не являются публичной офертой или гарантией запуска функциональности до официального объявления НЕКСУС‑ИНВЕСТ ФОНД.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ignd-steps-list mt-60">
            <x-guest.ignd-step
                :number="1"
                :title="__('Сбор и разметка данных')"
                :paragraphs="[
                    __('Данные модулей экосистемы поступают в единый контур: заявки, выплаты, результаты проектов и события получают разметку для обучения при наличии законных оснований.'),
                ]"
            />
            <x-guest.ignd-step
                :number="2"
                :title="__('Подготовка признаков и обучение')"
                :paragraphs="[
                    __('Формируются признаки проектов и портфелей, проводится обучение с проверкой на исторических данных, A/B‑тестами и аудитом моделей.'),
                ]"
            />
            <x-guest.ignd-step
                :number="3"
                :title="__('MVP · IV квартал 2026')"
                :paragraphs="[
                    __('Проектный скоринг, базовые проверки KYC/AML, интеграция с НЕКСУС, аналитические рекомендации и уведомления.'),
                ]"
            />
            <x-guest.ignd-step
                :number="4"
                :title="__('Дальнейшие этапы')"
                :paragraphs="[
                    __('Расширение риск‑менеджмента, интеграция с ГАНИМЕД и СФОРДЕКС, депозитарий, LLM‑поддержка и персонализация — по дорожной карте экосистемы.'),
                ]"
            />
        </div>
    </div>
</section>

{{-- 11. FAQ --}}
<section class="section-box box-faqs-3 faq-section-light nexus-ai-section" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-40 mb-lg-0">
                <div class="box-faq-left box-faq-left--intro">
                    <a class="btn btn-brand-4-sm" href="#faq">{{ __('Часто задаваемые вопросы') }}</a>
                    <h2 class="heading-2 mb-20 mt-20">{{ __('Вопросы о НЕКСУС ИИ') }}</h2>
                    <p class="text-lg neutral-700">{{ __('Роль специалистов, данные, отличие от чат‑бота и сроки MVP.') }}</p>
                </div>
            </div>
            <div class="col-lg-7">
                <x-guest.faq-accordion :items="[
                    [
                        'question' => 'Заменяет ли НЕКСУС ИИ специалистов?',
                        'answer' => 'Нет. Система формирует оценки, рекомендации и предупреждения. Юридически значимые, инвестиционные и комплаенс‑решения принимаются уполномоченными специалистами в соответствии с внутренними регламентами платформы.',
                        'open' => true,
                    ],
                    [
                        'question' => 'Передаются ли данные во внешние ИИ‑сервисы?',
                        'answer' => 'Чувствительные данные обрабатываются в контролируемом контуре экосистемы. Для работы с документами может использоваться локальная языковая модель с технологией RAG (ответ на основе подключённой базы документов). Содержимое не передаётся во внешние публичные чат‑сервисы.',
                    ],
                    [
                        'question' => 'Что такое НЕКСУС ИИ?',
                        'answer' => 'Это специализированная обучаемая система для задач экосистемы НЕКСУС: проектного скоринга, анализа рисков, комплаенса, токенизации и поддержки пользователей. Чат‑интерфейс является только одним из способов взаимодействия с системой.',
                    ],
                    [
                        'question' => 'Как НЕКСУС ИИ связан с iGND и ГАНИМЕД?',
                        'answer' => 'НЕКСУС ИИ отвечает за анализ проектов, портфелей, комплаенс и поддержку. iGND использует отдельные модели для риск‑профиля и снижения рисков. ГАНИМЕД применяет интеллект‑слой для состояния сети и технических параметров блокчейна. Системы связаны интерфейсами, но выполняют разные функции.',
                    ],
                    [
                        'question' => 'Когда планируется MVP?',
                        'answer' => 'Ориентировочный срок MVP — IV квартал 2026 года: проектный скоринг, базовые проверки KYC/AML, интеграция с НЕКСУС, аналитические рекомендации. Сроки предварительные и не являются публичной офертой до официального объявления.',
                    ],
                ]" :accordionId="'accordionNexusAi'" />
            </div>
        </div>
    </div>
</section>

@endsection
