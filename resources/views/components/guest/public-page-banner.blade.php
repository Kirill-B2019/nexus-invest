{{--
  Единый баннер заголовка публичной страницы.
  Пропсы: pageTitle (заголовок H1 и последний элемент хлебных крошек), bannerDescription (подзаголовок),
  breadcrumbParents (массив [['label' => ..., 'url' => ...], ...] — опциональные родители перед pageTitle).
--}}
<section class="section-box">
    <div class="banner-hero hero-4">
        <div class="banner-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('Главная') }}</a></li>
                                @if(!empty($breadcrumbParents))
                                    @foreach($breadcrumbParents as $parent)
                                        <li class="breadcrumb-item"><a href="{{ $parent['url'] }}">{{ $parent['label'] }}</a></li>
                                    @endforeach
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                            </ol>
                        </nav>
                        <h1 class="heading-banner neutral-0">{{ $pageTitle }}</h1>
                        @if(!empty($bannerDescription))
                            <p class="banner-description text-lg neutral-200">{{ $bannerDescription }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
