@props([
    'id',
    'number' => 1,
    'title',
    'description' => [],
    'links' => [], // [['href' => '...', 'label' => '...'], ...]
])

<div class="card-casestudy">
    <div class="card-title">
        <h6 id="{{ $id }}">
            <span class="number">{{ $number }}</span>{{ __($title) }}
        </h6>
    </div>

    <div class="card-desc">
        @foreach($description as $paragraph)
            <p>{{ __($paragraph) }}</p>
        @endforeach
    </div>

    @if(!empty($links))
        <ul class="list-check-black-column pt-3">
            @foreach($links as $link)
                <li>
                    <a href="{{ $link['href'] }}"
                       target="_blank" rel="noopener noreferrer">
                        {{ __($link['label']) }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
