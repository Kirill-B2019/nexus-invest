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
                            {{ __($paragraph) }}
                        @endforeach
                    @else
                        {{ __($item['answer']) }}
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
