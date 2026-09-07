{{--
  Общие SEO-теги публичных страниц: title, description, canonical, Open Graph, Twitter, JSON-LD.
  Переопределение: @section('metaDescription'|'metaKeywords'|'ogImage'|'robots'|'canonical')
--}}
@php
    $seoAppName = config('app.name');
    $seoTitle = isset($title) && $title !== ''
        ? $title . ' - ' . $seoAppName
        : $seoAppName;
    $seoDefaultDescription = __('Платформа проектного финансирования и токенизации активов. НЕКСУС — экосистема для запуска проектов через ЦФА, RWA и блокчейн ГАНИМЕД. Соответствие 259-ФЗ, 289-ФЗ.');
    $seoDefaultKeywords = __('проектное финансирование, токенизация, ЦФА, RWA, блокчейн ГАНИМЕД, НЕКСУС, инвестиции, цифровые активы, 259-ФЗ');
    $seoDescription = trim($__env->yieldContent('metaDescription', $seoDefaultDescription));
    $seoKeywords = trim($__env->yieldContent('metaKeywords', $seoDefaultKeywords));
    $seoCanonical = trim($__env->yieldContent('canonical', url()->current()));
    $seoRobots = trim($__env->yieldContent('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'));
    $seoOgImageDefault = asset('assets/imgs/page/homepage1/img-review.png');
    $seoOgImage = trim($__env->yieldContent('ogImage', $seoOgImageDefault));
    $seoLocale = str_replace('_', '-', app()->getLocale());
@endphp
<meta name="description" content="{{ $seoDescription }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="robots" content="{{ $seoRobots }}">
<link rel="canonical" href="{{ $seoCanonical }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $seoAppName }}">
<meta property="og:locale" content="{{ $seoLocale === 'ru' ? 'ru_RU' : $seoLocale }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:image" content="{{ $seoOgImage }}">
<meta property="og:image:alt" content="{{ $seoAppName }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoOgImage }}">

<title>{{ $seoTitle }}</title>

@php
    $seoOrganization = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $seoAppName,
        'url' => url('/'),
        'logo' => asset('assets/imgs/template/logo-head.svg'),
        'description' => $seoDefaultDescription,
        'sameAs' => [
            'https://dzen.ru/digital_fintech',
            'https://t.me/dipp_NEXUS',
        ],
    ];
    $seoWebsite = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $seoAppName,
        'url' => url('/'),
        'inLanguage' => $seoLocale,
        'publisher' => [
            '@type' => 'Organization',
            'name' => $seoAppName,
            'url' => url('/'),
        ],
    ];
    $seoWebPage = [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => $seoTitle,
        'description' => $seoDescription,
        'url' => $seoCanonical,
        'isPartOf' => [
            '@type' => 'WebSite',
            'name' => $seoAppName,
            'url' => url('/'),
        ],
        'inLanguage' => $seoLocale,
    ];
@endphp
<script type="application/ld+json">{!! json_encode($seoOrganization, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($seoWebsite, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($seoWebPage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
