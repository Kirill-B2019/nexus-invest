@props(['title' => '', 'subtitle' => '', 'mapData' => [], 'faqItems' => []])

{{-- Горизонтальный темный блок: FAQ 1/3 + Карта 2/3 (объединенный фрейм) --}}
<section class="section-box wow fadeIn map-faq-block">
    <div class="map-faq-block__frame">
        <div class="map-faq-block__grid">
            {{-- Левая часть 1/3: FAQ --}}
            <div class="map-faq-block__faq">
                <div class="map-faq-block__faq-header">
                    <h3 class="map-faq-block__faq-title">{{ __('ОСТАЛИСЬ ВОПРОСЫ?') }}</h3>
                </div>
                <div class="map-faq-block__faq-content">
                    <x-guest.faq-accordion :items="$faqItems" accordionId="mapFaqAccordion" />
                </div>
            </div>

            {{-- Правая часть 2/3: Карта --}}
            <div class="map-faq-block__map">
                <div class="map-faq-block__map-header">
                    <h3 class="map-faq-block__map-title">{{ $title ?: __('КАРТА ИНВЕСТИЦИЙ') }}</h3>
                    @if($subtitle)
                        <p class="map-faq-block__map-subtitle">{{ $subtitle }}</p>
                    @endif
                </div>
                <div class="map-faq-block__map-content">
                    <div class="map-faq-block__map-placeholder">
                        <div class="map-faq-block__map-placeholder-inner">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <p>{{ __('Интерактивная карта') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.map-faq-block {
    position: relative;
    width: 100vw;
    max-width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    padding: 48px var(--site-gutter, 15px) 20px;
    background-color: var(--color-dark, #191919);
    box-sizing: border-box;
}

.map-faq-block__frame {
    padding: 36px 32px 32px;
    border: 1px solid rgba(236, 238, 242, 0.18);
    border-radius: var(--radius-md, 16px);
    background:
        radial-gradient(ellipse 45% 60% at 30% 40%, rgba(var(--color-primary-rgb, 197, 255, 65), 0.06), transparent 68%),
        var(--color-dark, #191919);
    animation: map-faq-block-in 0.7s ease both;
}

.map-faq-block__grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 32px;
    align-items: start;
}

.map-faq-block__map {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.map-faq-block__map-header {
    margin-bottom: 8px;
}

.map-faq-block__map-title {
    margin: 0 0 8px;
    color: #fff;
    font-size: clamp(20px, 1.8vw, 24px);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: 0.02em;
}

.map-faq-block__map-subtitle {
    margin: 0;
    color: rgba(255, 255, 255, 0.62);
    font-size: 14px;
    line-height: 1.45;
    font-weight: 500;
}

.map-faq-block__map-content {
    min-height: 300px;
    border-radius: var(--radius-sm, 8px);
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(236, 238, 242, 0.1);
    overflow: hidden;
}

.map-faq-block__map-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    min-height: 300px;
    color: rgba(255, 255, 255, 0.4);
}

.map-faq-block__map-placeholder-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    text-align: center;
}

.map-faq-block__map-placeholder svg {
    width: 64px;
    height: 64px;
    opacity: 0.5;
}

.map-faq-block__faq {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.map-faq-block__faq-header {
    margin-bottom: 8px;
}

.map-faq-block__faq-title {
    margin: 0;
    color: #fff;
    font-size: clamp(18px, 1.5vw, 22px);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: 0.02em;
}

.map-faq-block__faq-content {
    max-height: 400px;
    overflow-y: auto;
    padding-right: 8px;
}

.map-faq-block__faq-content::-webkit-scrollbar {
    width: 6px;
}

.map-faq-block__faq-content::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 3px;
}

.map-faq-block__faq-content::-webkit-scrollbar-thumb {
    background: rgba(var(--color-primary-rgb, 197, 255, 65), 0.5);
    border-radius: 3px;
}

.map-faq-block__faq-content::-webkit-scrollbar-thumb:hover {
    background: rgba(var(--color-primary-rgb, 197, 255, 65), 0.7);
}

.map-faq-block .accordion-style-2 .accordion-button {
    background: rgba(255, 255, 255, 0.05);
    color: #fff;
    border: 1px solid rgba(236, 238, 242, 0.1);
    margin-bottom: 8px;
    border-radius: var(--radius-sm, 8px);
    padding: 16px;
}

.map-faq-block .accordion-style-2 .accordion-button:not(.collapsed) {
    background: rgba(var(--color-primary-rgb, 197, 255, 65), 0.1);
    color: var(--color-primary, #C5FF41);
    border-color: rgba(var(--color-primary-rgb, 197, 255, 65), 0.3);
}

.map-faq-block .accordion-style-2 .accordion-body {
    background: rgba(255, 255, 255, 0.03);
    color: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(236, 238, 242, 0.1);
    border-top: none;
    border-radius: 0 0 var(--radius-sm, 8px) var(--radius-sm, 8px);
    margin-top: -8px;
    margin-bottom: 8px;
    padding: 16px;
}

@keyframes map-faq-block-in {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 991.98px) {
    .map-faq-block {
        padding-top: 32px;
        padding-bottom: 16px;
    }

    .map-faq-block__frame {
        padding: 24px 16px 20px;
    }

    .map-faq-block__grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .map-faq-block__map-content {
        min-height: 250px;
    }

    .map-faq-block__faq-content {
        max-height: 350px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .map-faq-block__frame {
        animation: none;
    }
}
</style>
@endpush