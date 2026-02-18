<footer class="footer footer-style-3 footer-style-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-30">
                <a href="{{ route('welcome') }}">
                    <img alt="{{ config('app.name') }}" src="{{ asset('assets/imgs/template/logo.svg') }}" class="w-85">
                </a>
                <div class="mt-20 mb-20">
                    <p class="text-md neutral-600 mb-10">{{ config('app.name') }}</p>

                </div>

                <div class="row align-items-end">
                    <div class="col-12 mb-20" id="newsletter-form">
                        <h5 class="text-18-semibold neutral-0">{{ __('Подписаться на рассылку') }}</h5>
                        <p class="text-sm neutral-600 mb-20">{{ __('Без рекламы. Без ограничений. Без обязательств') }}</p>
                        <div class="form-newsletter form-newsletter-2">
                            <form action="{{ route('newsletter.store') }}" method="post">
                                @csrf
                                <input class="form-control" type="email" name="email" placeholder="{{ __('Адрес электронной почты') }}" value="{{ old('email') }}" required>
                                <button class="btn btn-brand-4-medium" type="submit">{{ __('Подписаться') }}
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 11.0003L18.4791 7.47949V10.3074H0V11.6933H18.4791V14.5213L22 11.0003Z" fill=""></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-12 col-sm-6 mb-30">
                        <h5 class="neutral-0 mb-10 text-18-semibold">{{ __('Документы') }}</h5>
                        <ul class="menu-footer text-sm">
                            <li><a href="{{ asset('doc/NexusPrivacyPolicy-14022026.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('Политика конфиденциальности') }}</a></li>
                            <li><a href="{{ asset('doc/NexusUserAgreement-15022026.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('Пользовательское соглашение') }}</a></li>
                            <li><a href="{{ asset('doc/NEXUS-KYCAMLPolicy-17022026 .pdf') }}">{{ __('KYC/AML‑политика НЕКСУС') }}</a></li>
                        </ul>
                    </div>

                    <div class="col-12 col-sm-6 mb-30">
                        <h5 class="neutral-0 mb-10 text-18-semibold">{{ __('Поддержка') }}</h5>
                        <ul class="menu-footer">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#contactFormModal">{{ __('Связаться с нами') }}</a></li>
                            <li><a href="{{ route('lk') }}">{{ __('Ваш кабинет') }}&nbsp;<i class="fi-rr-sign-in-alt"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="row footer-progress-row py-4">
                    <div class="col-12">
                        <h5 class="neutral-0 mb-15 text-18-semibold">{{ __('Прогресс реализации') }}</h5>
                        <p class="text-sm neutral-500 mb-20">{{ now()->translatedFormat('d F Y') }}</p>
                        <div class="footer-progress-list">
                            <div class="footer-progress-item mb-20">
                                <div class="d-flex justify-content-between align-items-center mb-8">
                                    <span class="text-sm neutral-500">{{ __('MVP НЕКСУС') }}</span>
                                    <span class="text-sm neutral-0 fw-semibold">47%</span>
                                </div>
                                <div class="progress footer-progress-bar">
                                    <div class="progress-bar" role="progressbar" style="width: 47%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="footer-progress-item">
                                <div class="d-flex justify-content-between align-items-center mb-8">
                                    <span class="text-sm neutral-500">{{ __('MVP мастер-нода ГАНИМЕД') }}</span>
                                    <span class="text-sm neutral-0 fw-semibold">84%</span>
                                </div>
                                <div class="progress footer-progress-bar">
                                    <div class="progress-bar" role="progressbar" style="width: 84%" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>
                                <a href="https://github.com/Kirill-B2019/GND_v1/tree/main/docs" target="_blank" rel="noopener noreferrer">
                                    <span class="small neutral-800 text-right">{{ __('GND_v1/tree/main/docs') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom mt-0 border-top pt-4" style="border-color: rgba(255,255,255,0.08) !important;">
            <div class="row align-items-start mb-20">
                <div class="col-12 col-md-4 mb-20 mb-md-0 text-center text-md-start">
                    <div class="text-start d-inline-block">
                        <p class="text-lg title-follow neutral-0 mb-0">
                            {{ __('Нативные токены платформы (UTILITY)') }}
                        </p>
                        <p class="small neutral-100 text-left">{{ __('Стандарт GNDst-1 (расширенный ERC | TRC)') }}</p>
                        <p class="small neutral-700 text-left">{{ __('GND (Utility токен ГАНИМЕД) ') }}</p>
                        <p class="small neutral-700 text-left">{{ __('GANI (Governance токен - управление) ') }}</p>
                        <p class="small neutral-700 text-left">{{ __('iGND (Токен программы смягчения инвестиционных рисков)') }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-20 mb-md-0 text-center text-md-start">
                    <h5 class="neutral-0 mb-10 text-18-semibold">{{ __('Канал Дзен') }}</h5>
                    <p class="text-sm neutral-600 mb-15">{{ __('Новости и материалы о цифровых финансах и финтехе') }}</p>
                    <a href="https://dzen.ru/digital_fintech" target="_blank" rel="noopener noreferrer" class="btn btn-brand-4-medium hover-up">
                        {{ __('Перейти в канал') }}
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-1" style="vertical-align: -0.2em;">
                            <path d="M14 5l7 7-7 7M3 12h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <div class="col-12 col-md-4 text-center text-md-start">
                    <h5 class="neutral-0 mb-10 text-18-semibold">{{ __('Канал Telegram') }}</h5>
                    <p class="text-sm neutral-600 mb-15">{{ __('Официальный канал NEXUS — анонсы и обновления') }}</p>
                    <a href="https://t.me/dipp_NEXUS" target="_blank" rel="noopener noreferrer" class="btn btn-brand-4-medium hover-up">
                        {{ __('Перейти в канал') }}
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-1" style="vertical-align: -0.2em;">
                            <path d="M14 5l7 7-7 7M3 12h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="row align-items-center mb-20 pb-3" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                <div class="col-12 col-md-2 col-lg-1 text-center text-md-start mb-15 mb-md-0">
                    <img alt="{{ config('app.name') }}" src="{{ asset('assets/imgs/template/logo-only.svg') }}" class="footer-logo-small" style="max-width: 56px; height: auto;">
                </div>
                <div class="col-12 col-md-10 col-lg-11">
                    <p class="small text-sm neutral-500 mb-0" style="line-height: 1.5;">
                        {{ __('Осьминог ассоциируется с интеллектом, гибкостью и многозадачностью, каждая «рука» может работать отдельно, но вся система действует слаженно, как модули НЕКСУС, ГАНИМЕД, СФОРДЕКС, депозитарий, маркетплейс.
                            Щупальца напоминают ветвящуюся сеть или блокчейн‑граф - множество точек взаимодействия с проектами, инвесторами, регуляторами и сервисами.
                            Надпись «НЕКСУС» закрепляет идею: осьминог — это не просто животное, а образ «узла» и «связей», цифрового хаба, который объединяет участников рынка.') }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-sm neutral-600 mb-0">{{ __('©') }} {{ date('Y') }} {{ config('app.name') }}. {{ __('Все права защищены.') }} | KB @CerbeRus - Nexus Invest Team  </p>
                </div>
            </div>
        </div>
    </div>
</footer>
