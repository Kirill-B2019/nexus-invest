@props([
    'size' => 38,          // размер иконки (width/height)
    'bg'   => '#191919',   // цвет фона круга
    'color'=> '#C5FF55',   // цвет стрелки
])

<svg
    {{ $attributes }}
    width="{{ $size }}"
    height="{{ $size }}"
    viewBox="0 0 39 38"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
>
    <rect x="0.5" width="38" height="38" rx="19" fill="{{ $bg }}" />
    <g clip-path="url(#clip0_1_376)">
        <path
            d="M24.1537 16.8139L15.218 25.7497L13.75 24.2817L22.6847 15.3459H14.81V13.2695H26.2301V24.6897H24.1537V16.8139Z"
            fill="{{ $color }}"
        />
    </g>
    <defs>
        <clipPath id="clip0_1_376">
            <rect width="13" height="13" fill="white" transform="translate(13.5 13)" />
        </clipPath>
    </defs>
</svg>

{{--
 базовый вариант
<x-icons.svg-arrow />

меньший размер + доп. класс Tailwind/Bootstrap
<x-icons.svg-arrow size="24" class="inline-block align-middle" />

другой цвет стрелки (например, акцент бренда)
<x-icons.svg-arrow color="#00FF88" />

тёмный фон и светлая стрелка для hover-состояний
<x-icons.svg-arrow bg="#000000" color="#C5FF55" class="transition hover:opacity-80" />
--}}
