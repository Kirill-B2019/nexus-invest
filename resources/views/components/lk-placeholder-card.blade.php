@props([
    'title',
    'description',
    'badge' => __('В разработке'),
])

<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-start justify-content-between gap-2 mb-2">
            <h5 class="card-title mb-0">{{ $title }}</h5>
            @if($badge !== false && $badge !== '')
                <span class="badge badge-secondary">{{ $badge }}</span>
            @endif
        </div>
        <p class="text-muted mb-3">{{ $description }}</p>
        {{ $slot }}
    </div>
</div>
