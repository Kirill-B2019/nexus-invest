@extends('layouts.guest.guest')

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
@php
    $pageTitle = __('Документация');
@endphp
{{-- Page header (как на features) --}}
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
                        <p class="banner-description text-lg neutral-200">{{ __('Условия использования платформы, политики и соглашения.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Контент документации (структура как на features: section-box + container) --}}
<section class="section-box wow fadeIn box-preparing-2 doc-sticky-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-9 order-2 order-lg-1">
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-1"><span class="number">1</span>{{ __('Правила платформы') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Правила платформы НЕКСУС определяют порядок использования сервиса, права и обязанности участников (инициаторов проектов и инвесторов), а также требования к размещаемым проектам и сделкам.') }}</p>
                        <p>{{ __('Платформа оставляет за собой право ограничивать или прекращать доступ при нарушении правил или при выявлении рисков для других участников и экосистемы.') }}</p>
                    </div>
                    <ul class="list-check-black-column pt-3">
                        <li><a href="{{ asset('doc/NexusPrivacyPolicy-14022026.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('Политика конфиденциальности') }}</a></li>
                        <li><a href="{{ asset('doc/NexusUserAgreement-15022026.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('Пользовательское соглашение') }}</a></li>
                        <li><a href="{{ asset('doc/NEXUS-KYCAMLPolicy-17022026 .pdf') }}">{{ __('KYC/AML‑политика НЕКСУС') }}</a></li>
                    </ul>
                </div>
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-2"><span class="number">2</span>{{ __('Договора пользования (образцы)') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Пользователь может ознакомиться с образцами договоров оказания услуг, договоров на выпуск и обращение цифровых прав, соглашений с Эмитентами и Инвесторами, а также с шаблонами иных юридически значимых документов, применяемых при работе в информационной системе. Образцы предназначены для предварительного ознакомления и не являются публичной офертой; актуальная редакция конкретного договора предоставляется Пользователю при присоединении к нему в личном кабинете.') }}</p>
                    </div>
                    <ul class="list-check-black-column pt-3">
                        <li><a href="{{ asset('doc/NexusInvestorAgreement.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('НЕКСУС - Договор инвестора (образец)') }}</a></li>
                        <li><a href="{{ asset('doc/NexusInitiatorAgreement.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('НЕКСУС - Договор инициатора проекта (образец)') }}</a></li>
                    </ul>
                </div>
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-3"><span class="number">3</span>{{ __('Техническая документация') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('В этом разделе размещены материалы для разработчиков и интеграторов платформы. Документация описывает структуру и форматы запросов, используемые протоколы безопасности, порядок аутентификации и авторизации, а также примеры интеграции внешних сервисов и информационных систем с НЕКСУС и блокчейном ГАНИМЕД.') }}</p>
                    </div>
                    <ul class="list-check-black-column pt-3">
                        <li><a href="" target="_blank" rel="noopener noreferrer">{{ __('НЕКСУС API v1.0') }}</a></li>
                        <li><a href="" target="_blank" rel="noopener noreferrer">{{ __('ГАНИМЕД API v1.0 (REST API, WebSocket API, RPC API) ') }}</a></li>
                    </ul>
                </div>
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-4"><span class="number">4</span>{{ __('Прочее') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Дополнительные материалы о платформе НЕКСУС – ГАНИМЕД. В этом разделе собраны обзоры отличий платформы от существующих решений, пояснения по выбору архитектуры и методологии разработки, описание продуктовой линейки для разных типов пользователей, а также документы об авторских правах и интеллектуальной собственности и другие материалы.') }}</p>
                    </div>
                    <ul class="list-check-black-column pt-3">
                        <li><a href="{{ asset('doc/NexusDifferencesPlatform.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('Отличия платформы НЕКСУС – ГАНИМЕД от существующих конкурентов') }}</a></li>
                        <li><a href="{{ asset('doc/WhyCantJustBuy.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('Почему нельзя просто купить готовое решение') }}</a></li>
                        <li><a href="{{ asset('doc/PlatformProductsByUserTypes.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('Продукты платформы по типам пользователей') }}</a></li>
                        <li><a href="{{ asset('doc/SCRUMvs.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('AGILE (SCRUM) против стандартного ТЗ') }}</a></li>
                        <li><a href="{{ asset('') }}" target="_blank" rel="noopener noreferrer">{{ __('НЕКСУС - расширенное юридическое заключение по соответствию законодательству РФ') }}</a></li>
                        <li><a href="{{ asset('doc/NexusGeneralDifferencesCrowdfunding.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('НЕКСУС - общее и отличия от краундфайдинга') }}</a></li>
                        <li><a href="{{ asset('doc/NexusCopyright.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('НЕКСУС- авторские права и интеллектуальная собственность') }}</a></li>
                    </ul>
                </div>
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
