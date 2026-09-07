@props(['items' => [], 'accordionId' => 'accordionFAQS'])
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
@endphp
@if (count($faqEntities) > 0)
@push('seo-jsonld')
<script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
@endif
<div class="accordion accordion-flush accordion-style-2" id="{{ $accordionId }}">
    @foreach ($items as $index => $item)
        @php
            $itemIndex = $index + 1;
            $headingId = 'flush-heading-' . $itemIndex;
            $collapseId = 'flush-collapse-' . $itemIndex;
            $isOpen = $item['open'] ?? ($index === 0);
        @endphp
        <div class="accordion-item">
            <h2 class="accordion-header" id="{{ $headingId }}">
                <button class="accordion-button {{ $isOpen ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $isOpen ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">{{ __($item['question']) }}</button>
            </h2>
            <div class="accordion-collapse collapse {{ $isOpen ? 'show' : '' }}" id="{{ $collapseId }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#{{ $accordionId }}">
                <div class="accordion-body">
                    @if (is_array($item['answer']))
                        @foreach ($item['answer'] as $paragraph)
                            <p class="mb-2">{{ __($paragraph) }}</p>
                        @endforeach
                    @else
                        <p class="mb-0">{{ __($item['answer']) }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
