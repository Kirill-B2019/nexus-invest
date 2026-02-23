@props([
    'number' => 1,
    'title' => '',
    'paragraphs' => [],
])

<div class="ignd-step-item">
    <div class="ignd-step-line"></div>
    <div class="ignd-step-card">
        <span class="ignd-step-badge" aria-hidden="true">{{ $number }}</span>
        <h4 class="ignd-step-title">{{ $title }}</h4>
        @foreach ($paragraphs as $index => $paragraph)
            <p class="ignd-step-body {{ $index < count($paragraphs) - 1 ? 'mb-2' : 'mb-0' }}">{{ $paragraph }}</p>
        @endforeach
    </div>
</div>
