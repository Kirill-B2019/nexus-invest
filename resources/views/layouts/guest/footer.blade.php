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
                {{-- Статус блокчейна ГАНИМЕД по block/latest: статус + данные блока, блок прижат вправо --}}
                <div class="row footer-ganimed-status-row py-3">
                    <div class="col-12">
                        <div id="ganimed-node-status"
                             class="d-flex flex-column align-items-start gap-2 text-sm w-100"
                             data-status-url="{{ route('api.ganimed.block') }}">

                            <!-- строка статуса -->
                            <h5 class="neutral-0 mb-15 text-18-semibold">{{ __('Статус блокчейна ГАНИМЕД') }}</h5>
                            <div class="d-flex flex-wrap align-items-center gap-2 justify-content-start w-100">

                                <p></p><span id="ganimed-status-loading" class="text-sm neutral-500">{{ __('Загрузка…') }}</span>
                                <span id="ganimed-status-result" class="d-none d-flex align-items-center gap-1">
                                    <span id="ganimed-status-checkbox" class="ganimed-status-checkbox" role="img" aria-hidden="true"></span>
                                    <span id="ganimed-status-text" class="text-sm neutral-200"></span>
                                    https://scan.gnd-net.com
                                </span>
                            </div>

                            <!-- детали блока, тоже на всю ширину -->
                            <div id="ganimed-block-details"
                                 class="d-none text-start small neutral-500 w-100">
                                <div><span class="neutral-600">{{ __('Высота блока:') }}</span> <span id="ganimed-block-height" class="text-sm neutral-200"></span></div>
                                <div><span class="neutral-600">{{ __('Hash:') }}</span> <span id="ganimed-block-hash" class="text-sm neutral-200"></span></div>
                                <div><span class="neutral-600">{{ __('Маркле:') }}</span> <span id="ganimed-block-merkle" class="text-sm neutral-200"></span></div>
                                <div><span class="neutral-600">{{ __('Валидатор:') }}</span> <span id="ganimed-block-miner" class="text-sm neutral-200"></span></div>
                                <div><span class="neutral-600">{{ __('Время окончания генерации:') }}</span> <span id="ganimed-block-updated" class="text-sm neutral-200"></span></div>
                                <div class="d-flex align-items-center gap-1 justify-content-start">
                                    <span class="neutral-600">{{ __('Финализирован:') }}</span>
                                    <span id="ganimed-block-finalized" class="ganimed-status-checkbox ganimed-status-fail" role="img" aria-hidden="true"></span>
                                </div>

                            </div>

                            <!-- кнопка -->
                            <button type="button"
                                    id="ganimed-status-refresh"
                                    class="cookie-banner__btn cookie-banner__btn--reject">
                                {{ __('Проверить') }}
                            </button>
                            <a class="btn btn-sm btn-brand-5-new small uppercase" href="{{ url('https://scan.gnd-net.com') }}" target="_blank" rel="noopener noreferrer">{{ __('Сканер ГАНИМЕД - scan.gnd-net.com') }}</a>
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
                            <li><a href="{{ asset('doc/NexusUseragreement.pdf') }}" target="_blank" rel="noopener noreferrer">{{ __('НЕКСУС - Пользовательское соглашение (образец)') }}</a></li>
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
                                    <span class="text-sm neutral-0 fw-semibold">{{__('MVP запущен - ')}}100%</span>
                                </div>
                                <div class="progress footer-progress-bar">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>

                                </div><a href="https://main-node.gnd-net.com" target="_blank" rel="noopener noreferrer">
                                    <span class="small neutral-500 text-right">{{ __('main-node.gnd-net.com') }}</span>
                                    <span class="small neutral-0">|</span>
                                </a>
                                <a href="https://github.com/Kirill-B2019/GND_v1/tree/main/docs" target="_blank" rel="noopener noreferrer">
                                    <span class="small neutral-500 text-right">{{ __('GND_v1/tree/main/docs') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="footer-bottom mt-0 border-top pt-4" style="border-color: rgba(255,255,255,0.08) !important;">
            <div class="row align-items-start mb-20">
                <div class="col-12 col-md-6 mb-20 mb-md-0 text-center text-md-start">
                    <div  class="alert alert-footer">
                        <p class="neutral-400 uppercase text-md">{{ __('Важное уведомление для резидентов РФ') }}</p>
                        <p class="neutral-600 mb-0 small">{{ __('GND, GANI, iGND  — технические токены протокола ГАНИМЕД, используемые исключительно для обеспечения работы блокчейн‑инфраструктуры. Они не подлежат прямой продаже, покупке или иному обороту резидентам Российской Федерации в соответствии с российским законодательством (ФЗ‑259 «О цифровых финансовых активах»).') }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-20 mb-md-0 text-center text-md-start">
                    <h5 class="neutral-0 mb-10 text-18-semibold">{{ __('Канал Дзен от авторов НЕКСУС') }}</h5>
                    <a href="https://dzen.ru/digital_fintech" target="_blank" rel="noopener noreferrer" class="btn btn-brand-4-medium hover-up">
                        {{ __('Перейти в канал') }}
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-1" style="vertical-align: -0.2em;">
                            <path d="M14 5l7 7-7 7M3 12h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <p class="text-sm neutral-600 mb-15">{{ __('Новости и материалы о цифровых финансах и финтехе') }}</p>

                </div>
                <div class="col-12 col-md-3 text-center text-md-start">
                    <h5 class="neutral-0 mb-10 text-18-semibold">{{ __('Канал Telegram') }}</h5>
                    <a href="https://t.me/dipp_NEXUS" target="_blank" rel="noopener noreferrer" class="btn btn-brand-4-medium hover-up">
                        {{ __('Перейти в канал') }}
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-1" style="vertical-align: -0.2em;">
                            <path d="M14 5l7 7-7 7M3 12h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <p class="text-sm neutral-600 mb-15">{{ __('Официальный канал NEXUS — анонсы и обновления') }}</p>

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
