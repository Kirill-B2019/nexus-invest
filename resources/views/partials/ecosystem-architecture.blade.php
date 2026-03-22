{{-- Архитектура экосистемы НЕКСУС / ГАНИМЕД — в контейнер, отступы ≥10px, масштаб 80% --}}
<section class="section-box wow animate__animated animate__fadeIn box-ecosystem-arch animated" id="ecosystem-architecture" style="visibility: visible;">
    <div class="container">
        <div class="text-center mb-50">
            <h2 class="heading-2 neutral-0 mb-20 uppercase">{{ __('Архитектура экосистемы НЕКСУС / ГАНИМЕД') }}</h2>
            <p class="text-lg neutral-500">{{ __('Взаимосвязь компонентов российской юрисдикции и мультиюрисдикционной инфраструктуры') }}</p>
        </div>
        <div class="ecosystem-arch-svg-wrap">
            <img
                src="{{ asset('assets/imgs/page/ecosystem-architecture.svg') }}?v={{ filemtime(public_path('assets/imgs/page/ecosystem-architecture.svg')) }}"
                alt="{{ __('Архитектура экосистемы НЕКСУС / ГАНИМЕД') }}"
                class="ecosystem-arch-svg"
                loading="lazy"
            />
        </div>
    </div>
</section>
