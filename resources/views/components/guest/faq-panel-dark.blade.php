@props([
    'items' => [],
    'accordionId' => 'accordionFaqDark',
    'title' => 'Остались вопросы?',
    'lead' => null,
    'allQuestionsUrl' => null,
    'allQuestionsLabel' => 'Все вопросы',
])
@php
    $faqEntities = [];
    foreach ($items as $item) {
        $answerText = is_array($item['answer'] ?? null)
            ? implode(' ', array_map(static fn ($p) => (string) __($p), $item['answer']))
            : (string) __($item['answer'] ?? '');
        $faqEntities[] = [
            '@type' => 'Question',
            'name' => (string) __($item['question'] ?? ''),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $answerText,
            ],
        ];
    }
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqEntities,
    ];
    $faqCount = count($items);
    $faqCountWord = match (true) {
        $faqCount % 10 === 1 && $faqCount % 100 !== 11 => 'вопрос',
        in_array($faqCount % 10, [2, 3, 4], true) && ! in_array($faqCount % 100, [12, 13, 14], true) => 'вопроса',
        default => 'вопросов',
    };
@endphp
@if (count($faqEntities) > 0)
@push('seo-jsonld')
<script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
@endif

<div {{ $attributes->class(['faq-panel-dark']) }}>
    <div class="faq-panel-dark__intro">
        <h3 class="faq-panel-dark__title">{{ __($title) }}</h3>
        @if ($lead)
            <p class="faq-panel-dark__lead">{!! $lead !!}</p>
        @endif
    </div>

    @if ($faqCount > 0)
        <div class="faq-panel-dark__summary">
            <p class="faq-panel-dark__summary-count">
                <span class="faq-panel-dark__summary-num">{{ $faqCount }}</span>
                {{ __($faqCountWord) }} {{ __('в разделе') }}
            </p>
            @if ($allQuestionsUrl)
                <a class="faq-panel-dark__summary-link" href="{{ $allQuestionsUrl }}">
                    {{ __($allQuestionsLabel) }}
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            @endif
        </div>
    @endif

    <div class="faq-panel-dark__list accordion" id="{{ $accordionId }}">
        @foreach ($items as $index => $item)
            @php
                $itemIndex = $index + 1;
                $num = str_pad((string) $itemIndex, 2, '0', STR_PAD_LEFT);
                $headingId = $accordionId . '-heading-' . $itemIndex;
                $collapseId = $accordionId . '-collapse-' . $itemIndex;
                $isOpen = $item['open'] ?? ($index === 0);
                $tags = $item['tags'] ?? [];
            @endphp
            <div class="faq-panel-dark__item accordion-item">
                <h4 class="faq-panel-dark__heading accordion-header" id="{{ $headingId }}">
                    <button
                        class="faq-panel-dark__button accordion-button {{ $isOpen ? '' : 'collapsed' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $collapseId }}"
                        aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                        aria-controls="{{ $collapseId }}"
                    >
                        <span class="faq-panel-dark__num" aria-hidden="true">{{ $num }}</span>
                        <span class="faq-panel-dark__question">{{ __($item['question']) }}</span>
                        <span class="faq-panel-dark__toggle" aria-hidden="true">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M4 6l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </button>
                </h4>
                <div
                    class="faq-panel-dark__collapse accordion-collapse collapse {{ $isOpen ? 'show' : '' }}"
                    id="{{ $collapseId }}"
                    aria-labelledby="{{ $headingId }}"
                    data-bs-parent="#{{ $accordionId }}"
                >
                    <div class="faq-panel-dark__body accordion-body">
                        @if (is_array($item['answer']))
                            @foreach ($item['answer'] as $paragraph)
                                <p>{{ __($paragraph) }}</p>
                            @endforeach
                        @else
                            <p>{{ __($item['answer']) }}</p>
                        @endif
                        @if (! empty($tags))
                            <div class="faq-panel-dark__tags">
                                @foreach ($tags as $tag)
                                    <span class="faq-panel-dark__tag">{{ __($tag) }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@once
@push('scripts')
<script>
(function () {
    var TOP_INSET = 12;

    function clampScroll(list, top) {
        var max = Math.max(0, list.scrollHeight - list.clientHeight);
        if (top < 0) return 0;
        if (top > max) return max;
        return top;
    }

    /** Прокрутка списка так, чтобы верх карточки был ниже края на TOP_INSET (не уезжал за клип). */
    function focusFaqCard(list, item, smooth) {
        if (!list || !item) return;
        var listRect = list.getBoundingClientRect();
        var itemRect = item.getBoundingClientRect();
        var delta = (itemRect.top - listRect.top) - TOP_INSET;
        var next = clampScroll(list, list.scrollTop + delta);
        list.scrollTo({ top: next, behavior: smooth === false ? 'auto' : 'smooth' });
        var btn = item.querySelector('.faq-panel-dark__button');
        if (btn && typeof btn.focus === 'function') {
            try { btn.focus({ preventScroll: true }); } catch (e) { btn.focus(); }
        }
    }

    function scheduleFocus(list, item) {
        // После раскрытия и после схлопывания соседней карточки позиция меняется
        requestAnimationFrame(function () {
            focusFaqCard(list, item, true);
            window.setTimeout(function () {
                focusFaqCard(list, item, false);
            }, 380);
        });
    }

    function bindFaqPanel(list) {
        if (!list || list.dataset.faqFocusBound === '1') return;
        list.dataset.faqFocusBound = '1';
        list.addEventListener('shown.bs.collapse', function (event) {
            var collapse = event.target;
            if (!collapse || !collapse.classList.contains('faq-panel-dark__collapse')) return;
            var item = collapse.closest('.faq-panel-dark__item');
            scheduleFocus(list, item);
        });
    }

    function initAll() {
        document.querySelectorAll('.faq-panel-dark__list').forEach(bindFaqPanel);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }
})();
</script>
@endpush
@endonce
