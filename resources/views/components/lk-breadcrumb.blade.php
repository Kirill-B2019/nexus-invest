@props([
    'items' => [],
    'separatorMargin' => 'mb-4',
])

<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
    <ol class="breadcrumb pt-0">
        @foreach($items as $item)
            @if(! empty($item['url'] ?? null))
                <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
<div class="separator {{ $separatorMargin }}"></div>
