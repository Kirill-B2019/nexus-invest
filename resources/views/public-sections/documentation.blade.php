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
                        <p>{{ __('Design comps, layouts, wireframes—will your clients accept that you go about things the facile way? Authorities in our business will tell in no uncertain terms that Lorem Ipsum is that huge, huge no no to forswear forever.') }}</p>
                        <p>{{ __('Not so fast, I\'d say, there are some redeeming factors in favor of greeking text, as its use is merely the symptom of a worse problem to take into consideration.') }}</p>
                        <p>{{ __('The toppings you may chose for that TV dinner pizza slice when you forgot to shop for foods, the paint you may slap on your face to impress the new boss is your business. But what about your daily bread?') }}</p>
                    </div>
                </div>
                <ul class="list-check-black">
                    <li>5,000 {{ __('Лимит слов в месяц') }}</li>
                    <li>50+ {{ __('Языков') }}</li>
                    <li>{{ __('Продвинутый редактор') }}</li>
                    <li>50 {{ __('Аккаунтов') }}</li>
                </ul>
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-2"><span class="number">2</span>{{ __('Политика конфиденциальности') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Design comps, layouts, wireframes—will your clients accept that you go about things the facile way? Authorities in our business will tell in no uncertain terms that Lorem Ipsum is that huge, huge no no to forswear forever.') }}</p>
                        <p>{{ __('Not so fast, I\'d say, there are some redeeming factors in favor of greeking text, as its use is merely the symptom of a worse problem to take into consideration.') }}</p>
                    </div>
                </div>
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-3"><span class="number">3</span>{{ __('Политика пользователя') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Design comps, layouts, wireframes—will your clients accept that you go about things the facile way? Authorities in our business will tell in no uncertain terms that Lorem Ipsum is that huge, huge no no to forswear forever.') }}</p>
                    </div>
                </div>
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-4"><span class="number">4</span>{{ __('Авторские права') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Design comps, layouts, wireframes—will your clients accept that you go about things the facile way? Authorities in our business will tell in no uncertain terms that Lorem Ipsum is that huge, huge no no to forswear forever.') }}</p>
                    </div>
                </div>
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-5"><span class="number">5</span>{{ __('Файлы cookie') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Design comps, layouts, wireframes—will your clients accept that you go about things the facile way? Authorities in our business will tell in no uncertain terms that Lorem Ipsum is that huge, huge no no to forswear forever.') }}</p>
                    </div>
                </div>
                <hr>
                <div class="card-casestudy">
                    <div class="card-title">
                        <h6 id="step-6"><span class="number">6</span>{{ __('Аккаунт и оплата') }}</h6>
                    </div>
                    <div class="card-desc">
                        <p>{{ __('Design comps, layouts, wireframes—will your clients accept that you go about things the facile way? Authorities in our business will tell in no uncertain terms that Lorem Ipsum is that huge, huge no no to forswear forever.') }}</p>
                    </div>
                </div>
                <hr>
                <h6>{{ config('app.name') }}</h6>
                <p class="text-sm neutral-700">{{ __('Последнее обновление:') }} {{ now()->translatedFormat('d F Y') }}</p>
            </div>
            <div class="col-12 col-md-4 col-lg-3 order-1 order-lg-2 doc-sidebar-col">
                <div id="doc-sidebar-nav" class="sidebar-border-left doc-sidebar-inner">
                    <ul class="list-categories">
                        <li><a href="#step-1">{{ __('Правила платформы') }}</a></li>
                        <li><a href="#step-2">{{ __('Договора пользования') }}</a></li>
                        <li><a href="#step-3">{{ __('Техническая документация') }}</a></li>
                        <li><a href="#step-4">{{ __('Прочее') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
