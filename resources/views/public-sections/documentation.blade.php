@extends('layouts.guest.guest')

@section('metaDescription')
{{ config('app.name') }} — {{ __('Документация: условия использования платформы, политики и соглашения.') }}
@endsection

@section('metaKeywords')
{{ __('документация, НЕКСУС, правила, политики, условия использования') }}
@endsection

@push('styles')
<style>
@media (min-width: 992px) {
    .doc-sidebar-inner.is-fixed {
        position: fixed !important;
        top: 100px !important;
        z-index: 100;
    }
}
</style>
@endpush

@push('scripts')
<script>
(function() {
    var sidebar = document.getElementById('doc-sidebar-nav');
    var column = document.querySelector('.doc-sticky-section .doc-sidebar-col');
    var section = document.querySelector('.doc-sticky-section');
    if (!sidebar || !column || !section) return;

    var stickyTop = 100;
    var savedLeft = null;
    var savedWidth = null;

    function update() {
        if (window.innerWidth < 992) {
            sidebar.classList.remove('is-fixed');
            sidebar.style.width = '';
            sidebar.style.left = '';
            savedLeft = null;
            savedWidth = null;
            return;
        }
        var sectionRect = section.getBoundingClientRect();
        var scrollY = window.pageYOffset || document.documentElement.scrollTop;
        var sectionTop = sectionRect.top + scrollY;
        var sectionBottom = sectionTop + section.offsetHeight;
        var sidebarHeight = sidebar.offsetHeight;
        var triggerTop = sectionTop - stickyTop;
        var maxScroll = sectionBottom - sidebarHeight - stickyTop;
        var inZone = scrollY > triggerTop && scrollY < maxScroll;

        if (inZone) {
            if (savedLeft === null || savedWidth === null) {
                var colRect = column.getBoundingClientRect();
                savedLeft = colRect.left;
                savedWidth = colRect.width;
            }
            sidebar.classList.add('is-fixed');
            sidebar.style.width = savedWidth + 'px';
            sidebar.style.left = savedLeft + 'px';
        } else {
            sidebar.classList.remove('is-fixed');
            sidebar.style.width = '';
            sidebar.style.left = '';
            savedLeft = null;
            savedWidth = null;
        }
    }

    function onScroll() {
        requestAnimationFrame(update);
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', function() {
        savedLeft = null;
        savedWidth = null;
        requestAnimationFrame(update);
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(update, 150);
        });
    } else {
        setTimeout(update, 150);
    }
})();
</script>
@endpush

@section('content')
<x-guest.public-page-banner
    :pageTitle="$title"
    :bannerDescription="$description ?? ''"
/>

{{-- Контент документации (структура как на features: section-box + container) --}}
<section class="section-box wow fadeIn box-preparing-2 doc-sticky-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-9 order-2 order-lg-1">
                <x-guest.documentation-list-card
                    id="step-1"
                    :number="1"
                    title="Правила платформы"
                    :description="[
                        'Правила платформы НЕКСУС определяют порядок использования сервиса, права и обязанности участников (инициаторов проектов и инвесторов), а также требования к размещаемым проектам и сделкам.',
                        'Платформа оставляет за собой право ограничивать или прекращать доступ при нарушении правил или при выявлении рисков для других участников и экосистемы.',
                    ]"
                    :links="[
                        [
                            'href'  => asset('doc/NexusPrivacyPolicy-14022026.pdf'),
                            'label' => 'Политика конфиденциальности',
                        ],
                        [
                            'href'  => asset('doc/NexusUserAgreement-15022026.pdf'),
                            'label' => 'Пользовательское соглашение',
                        ],
                        [
                            'href'  => asset('doc/NEXUS-KYCAMLPolicy-17022026 .pdf'),
                            'label' => 'KYC/AML‑политика НЕКСУС',
                        ],
                    ]"
                />
                <hr>
                <x-guest.documentation-list-card
                    id="step-2"
                    :number="2"
                    title="Договора пользования (образцы)"
                    :description="[
                    'Пользователь может ознакомиться с образцами договоров оказания услуг, договоров на выпуск и обращение цифровых прав, соглашений с Эмитентами и Инвесторами, а также с шаблонами иных юридически значимых документов, применяемых при работе в информационной системе. Образцы предназначены для предварительного ознакомления и не являются публичной офертой; актуальная редакция конкретного договора предоставляется Пользователю при присоединении к нему в личном кабинете.',
                     ]"
                    :links="[
                        [
                            'href'  => asset('doc/NexusInvestorAgreement.pdf'),
                            'label' => 'НЕКСУС - Договор инвестора (образец)',
                        ],
                        [
                            'href'  => asset('doc/NexusInitiatorAgreement.pdf'),
                            'label' => 'НЕКСУС - Договор инициатора проекта (образец)',
                        ],
                    ]"
                />

                <hr>
                <x-guest.documentation-list-card
                    id="step-3"
                    :number="3"
                    :title="__('Техническая документация')"
                    :description="[
                        __('В этом разделе размещены материалы для разработчиков и интеграторов платформы. Документация описывает структуру и форматы запросов, используемые протоколы безопасности, порядок аутентификации и авторизации, а также примеры интеграции внешних сервисов и информационных систем с НЕКСУС и блокчейном ГАНИМЕД.'),
                    ]"
                    :links="[
                        ['href' => '', 'label' => __('НЕКСУС API v1.0')],
                        ['href' => '', 'label' => __('ГАНИМЕД API v1.0 (REST API, WebSocket API, RPC API)')],
                    ]"
                />
                <hr>
                <x-guest.documentation-list-card
                    id="step-4"
                    :number="4"
                    :title="__('Прочее')"
                    :description="[
                        __('Дополнительные материалы о платформе НЕКСУС – ГАНИМЕД. В этом разделе собраны обзоры отличий платформы от существующих решений, пояснения по выбору архитектуры и методологии разработки, описание продуктовой линейки для разных типов пользователей, а также документы об авторских правах и интеллектуальной собственности и другие материалы.'),
                    ]"
                    :links="[
                        ['href' => asset('doc/NexusDifferencesPlatform.pdf'), 'label' => __('Отличия платформы НЕКСУС – ГАНИМЕД от существующих конкурентов')],
                        ['href' => asset('doc/WhyCantJustBuy.pdf'), 'label' => __('Почему нельзя просто купить готовое решение')],
                        ['href' => asset('doc/PlatformProductsByUserTypes.pdf'), 'label' => __('Продукты платформы по типам пользователей')],
                        ['href' => asset('doc/SCRUMvs.pdf'), 'label' => __('AGILE (SCRUM) против стандартного ТЗ')],
                        ['href' => asset('doc/NexusCompliance.pdf'), 'label' => __('НЕКСУС - расширенное юридическое заключение по соответствию законодательству РФ')],
                        ['href' => asset('doc/NexusGeneralDifferencesCrowdfunding.pdf'), 'label' => __('НЕКСУС - общее и отличия от краундфайдинга')],
                        ['href' => asset('doc/NexusCopyright.pdf'), 'label' => __('НЕКСУС- авторские права и интеллектуальная собственность')],
                    ]"
                />
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6>{{ __('Файлы cookie') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Мы используем cookie строго в рамках действующего законодательства, в том числе для обеспечения корректной работы сайта, аналитики и улучшения пользовательского опыта. Некоторые cookie являются обязательными для функционирования сервиса, часть может использоваться для статистики и маркетинга. Пользователь в любой момент может ограничить или отключить использование файлов cookie в настройках браузера, однако это может повлиять на корректность отображения отдельных разделов и функций сайта.') }}</p>
                    </div>
                </div>
                <hr>
                <h6 class="text-sm text-end">{{ config('app.name') }}</h6>
                <p class="small neutral-700 pb-3 text-end">{{ __('Последнее обновление:') }} {{ now()->translatedFormat('d F Y') }}</p>
            </div>
            <div class="col-12 col-md-4 col-lg-3 order-1 order-lg-2 doc-sidebar-col">
                <div id="doc-sidebar-nav" class="sidebar-border-left doc-sidebar-inner">
                    <ul class="list-categories">
                        <li><a href="#step-1">{{ __('Правила платформы') }}</a></li>
                        <li><a href="#step-2">{{ __('Договора пользования') }}</a></li>
                        <li><a href="#step-3">{{ __('Техническая документация') }}</a></li>
                        <li><a href="#step-4">{{ __('Прочее') }}</a></li>
                    </ul>
                <img src="{{ asset('assets/imgs/page/homepage1/doc-image.png') }}" alt="{{ __('Документация и договоры') }}" class="doc-sidebar-image mt-4 w-60" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
