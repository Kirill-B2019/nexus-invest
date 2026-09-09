<footer class="footer footer-style-3 footer-style-5">
    <div class="container">
        <div class="footer-top-grid">
            {{-- Бренд + инвестиционные показатели (вместо соцсетей) --}}
            <div class="footer-top-col footer-top-col--brand">
                <a href="{{ route('welcome') }}" class="footer-top-brand">
                    <img class="footer-top-brand__logo" alt="{{ config('app.name') }}" src="{{ asset('assets/imgs/template/logo-only.svg') }}" width="40" height="40">
                    <span class="footer-top-brand__name">{{ __('НЕКСУС') }}</span>
                </a>
                <p class="footer-top-brand__desc">
                    {{ __('Платформа полного цикла для токенизации проектов и инвестиций на базе блокчейна ГАНИМЕД, управления активами и цифровых сервисов для инвесторов и партнёров.') }}
                </p>
                <button type="button"
                        class="footer-top-metrics-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#projectMetricsModal">
                    {{ __('Инвестиционные показатели') }}
                </button>
            </div>

            {{-- Рассылка --}}
            <div class="footer-top-col footer-top-col--newsletter" id="newsletter-form">
                <h5 class="footer-top-col__title">{{ __('Подписаться на рассылку') }}</h5>
                <p class="footer-top-col__text">{{ __('Получайте новости экосистемы НЕКСУС и обновления платформы.') }}</p>
                <form class="footer-newsletter" action="{{ route('newsletter.store') }}" method="post">
                    @csrf
                    <input class="footer-newsletter__input" type="email" name="email" placeholder="{{ __('Ваш e-mail') }}" value="{{ old('email') }}" required autocomplete="email">
                    <button class="footer-newsletter__btn" type="submit">{{ __('Подписаться') }}</button>
                </form>
                <p class="footer-newsletter__note">{{ __('Без рекламы. Без ограничений. Без обязательств.') }}</p>
            </div>

            {{-- Документы --}}
            <div class="footer-top-col footer-top-col--docs">
                <h5 class="footer-top-col__title">{{ __('Документы') }}</h5>
                <ul class="footer-docs-list">
                    <li>
                        <a href="{{ asset('doc/NexusPublicOffer.pdf') }}" target="_blank" rel="noopener noreferrer">
                            <svg class="footer-docs-list__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" stroke="currentColor" stroke-width="1.6"/><path d="M14 3v5h5" stroke="currentColor" stroke-width="1.6"/></svg>
                            <span>{{ __('Публичная оферта') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ asset('doc/NexusPrivacyPolicy-14022026.pdf') }}" target="_blank" rel="noopener noreferrer">
                            <svg class="footer-docs-list__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" stroke="currentColor" stroke-width="1.6"/><path d="M14 3v5h5" stroke="currentColor" stroke-width="1.6"/></svg>
                            <span>{{ __('Политика конфиденциальности') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ asset('doc/NexusUserAgreement-15022026.pdf') }}" target="_blank" rel="noopener noreferrer">
                            <svg class="footer-docs-list__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" stroke="currentColor" stroke-width="1.6"/><path d="M14 3v5h5" stroke="currentColor" stroke-width="1.6"/></svg>
                            <span>{{ __('Пользовательское соглашение') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ asset('doc/NEXUS-KYCAMLPolicy-17022026.pdf') }}" target="_blank" rel="noopener noreferrer">
                            <svg class="footer-docs-list__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" stroke="currentColor" stroke-width="1.6"/><path d="M14 3v5h5" stroke="currentColor" stroke-width="1.6"/></svg>
                            <span>{{ __('KYC/AML‑политика') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ asset('doc/NexusGeneralDifferencesCrowdfunding.pdf') }}" target="_blank" rel="noopener noreferrer">
                            <svg class="footer-docs-list__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" stroke="currentColor" stroke-width="1.6"/><path d="M14 3v5h5" stroke="currentColor" stroke-width="1.6"/></svg>
                            <span>{{ __('Отличия от краудфандинга') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Поддержка --}}
            <div class="footer-top-col footer-top-col--support">
                <h5 class="footer-top-col__title">{{ __('Поддержка') }}</h5>
                <p class="footer-top-col__text">{{ __('Мы на связи и готовы помочь вам.') }}</p>
                <button type="button"
                        class="footer-top-support-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#contactFormModal">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                        <path d="M4 14v-2a8 8 0 0 1 16 0v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                        <path d="M4 14a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1v-5H4zm16 0h-1v5h1a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        <path d="M12 19v1a3 3 0 0 0 3 3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    <span>{{ __('Связаться с нами') }}</span>
                </button>
            </div>
        </div>

        {{-- Панели экосистемы: прогресс / статус / ресурсы + уведомления --}}
        <div class="footer-eco-panels">
            <div class="footer-eco-panel footer-eco-panel--metrics">
                <div class="footer-eco-panel__col footer-eco-panel__col--progress">
                    <h5 class="footer-eco-panel__title">{{ __('Прогресс реализации') }}</h5>
                    <p class="footer-eco-panel__date">{{ now()->translatedFormat('d F Y') }}</p>
                    <div class="footer-progress-list">
                        <div class="footer-progress-item">
                            <div class="footer-progress-item__head">
                                <span class="footer-progress-item__label">{{ __('MVP НЕКСУС') }}</span>
                                <span class="footer-progress-item__value">47%</span>
                            </div>
                            <div class="progress footer-progress-bar">
                                <div class="progress-bar" role="progressbar" style="width: 47%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="footer-progress-item">
                            <div class="footer-progress-item__head">
                                <span class="footer-progress-item__label">{{ __('MVP мастер-нода ГАНИМЕД') }}</span>
                                <span class="footer-progress-item__value">100%</span>
                            </div>
                            <div class="progress footer-progress-bar">
                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-eco-panel__links">
                        <a href="https://main-node.gnd-net.com" target="_blank" rel="noopener noreferrer">main-node.gnd-net.com</a>
                        <a href="https://github.com/Kirill-B2019/GND_v1/tree/main/docs" target="_blank" rel="noopener noreferrer">{{ __('GND-docs') }}</a>
                    </div>
                </div>

                <div class="footer-eco-panel__col footer-eco-panel__col--status">
                    <div id="ganimed-node-status"
                         class="footer-ganimed"
                         data-status-url="{{ route('api.ganimed.block') }}">
                        <h5 class="footer-eco-panel__title">{{ __('Статус блокчейна ГАНИМЕД') }}</h5>

                        <div class="footer-ganimed__status-row">
                            <span id="ganimed-status-loading" class="footer-ganimed__loading">{{ __('Загрузка…') }}</span>
                            <div id="ganimed-status-result" class="footer-ganimed__result d-none">
                                <span id="ganimed-status-checkbox" class="ganimed-status-checkbox" role="img" aria-hidden="true"></span>
                                <div class="footer-ganimed__status-text">
                                    <span id="ganimed-status-text" class="footer-ganimed__status-title"></span>
                                    <span id="ganimed-status-subtitle" class="footer-ganimed__status-sub"></span>
                                </div>
                            </div>

                        </div>

                        <div id="ganimed-block-details" class="footer-ganimed__grid d-none">
                            <div class="footer-ganimed__cell">
                                <span class="footer-ganimed__key">{{ __('Высота блока:') }}</span>
                                <span id="ganimed-block-height" class="footer-ganimed__val"></span>
                            </div>
                            <div class="footer-ganimed__cell">
                                <span class="footer-ganimed__key">{{ __('Валидатор:') }}</span>
                                <span id="ganimed-block-miner" class="footer-ganimed__val"></span>
                            </div>
                            <div class="footer-ganimed__cell">
                                <span class="footer-ganimed__key">{{ __('Hash:') }}</span>
                                <span id="ganimed-block-hash" class="footer-ganimed__val"></span>
                            </div>
                            <div class="footer-ganimed__cell">
                                <span class="footer-ganimed__key">{{ __('Финализирован:') }}</span>
                                <span id="ganimed-block-finalized" class="footer-ganimed__val"></span>
                            </div>
                            <div class="footer-ganimed__cell footer-ganimed__cell--wide">
                                <span class="footer-ganimed__key">{{ __('Время окончания генерации:') }}</span>
                                <span id="ganimed-block-updated" class="footer-ganimed__val"></span>
                            </div>
                            <div class="footer-ganimed__cell footer-ganimed__cell--wide">
                                <span class="footer-ganimed__key">{{ __('Метка:') }}</span>
                                <span id="ganimed-block-merkle" class="footer-ganimed__val"></span>
                            </div>
                        </div>

                        <div class="footer-ganimed__actions">
                            <button type="button" id="ganimed-status-refresh" class="footer-ganimed__btn">
                                {{ __('Проверить') }}
                            </button>
                            <a href="https://scan.gnd-net.com" target="_blank" rel="noopener noreferrer">scan.gnd-net.com</a>
                        </div>
                    </div>
                </div>

                <div class="footer-eco-panel__col footer-eco-panel__col--resources">
                    <h5 class="footer-eco-panel__title">{{ __('Ресурсы экосистемы') }}</h5>
                    <ul class="footer-eco-resources">
                        <li><a href="https://nexus-invest.fund" target="_blank" rel="noopener noreferrer">nexus-invest.fund</a></li>
                        <li><a href="https://main-node.gnd-net.com" target="_blank" rel="noopener noreferrer">main-node.gnd-net.com</a></li>
                        <li><a href="https://scan.gnd-net.com" target="_blank" rel="noopener noreferrer">scan.gnd-net.com</a></li>
                        <li><a href="https://mess.nexus-invest.fund" target="_blank" rel="noopener noreferrer">mess.nexus-invest.fund</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-eco-panel footer-eco-panel--info">
                <div class="footer-eco-info">
                    <span class="footer-eco-info__icon footer-eco-info__icon--warn" aria-hidden="true">!</span>
                    <div class="footer-eco-info__body">
                        <p class="footer-eco-info__title">{{ __('Важное уведомление для резидентов РФ') }}</p>
                        <p class="footer-eco-info__text">{{ __('GND, GANI, mGND, iGND — технические токены протокола блокчейна ГАНИМЕД, используемые исключительно для обеспечения работы блокчейн‑инфраструктуры. Они не подлежат прямой продаже, покупке или иному обороту резидентам Российской Федерации в соответствии с российским законодательством (ФЗ‑259 «О цифровых финансовых активах»).') }}</p>
                        <p class="footer-eco-info__text">{{ __('Проектные утилити токены (GND-RWA) — утилитарные цифровые права (УЦП) и учётные токены без денежных прав/доходности (до получения лицензии оператора). Право на услуги, участие в проектах RWA (токенизация активов) или информацию.') }}</p>
                    </div>
                </div>

                <a class="footer-eco-info footer-eco-info--link" href="https://dzen.ru/digital_fintech" target="_blank" rel="noopener noreferrer">
                    <span class="footer-eco-info__icon footer-eco-info__icon--mono" aria-hidden="true">
                        <img class="footer-eco-info__logo" src="{{ asset('assets/imgs/template/icons/dzen.svg') }}" alt="" width="28" height="28" decoding="async">
                    </span>
                    <div class="footer-eco-info__body">
                        <p class="footer-eco-info__title">{{ __('Канал Дзен от авторов НЕКСУС') }}</p>
                        <p class="footer-eco-info__text">{{ __('Новости и материалы о цифровых финансах и финтехе') }}</p>
                        <span class="footer-eco-info__cta">
                            {{ __('Перейти в канал') }}
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                <path d="M14 5h5v5M19 5l-9 9M10 5H5v14h14v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </a>

                <a class="footer-eco-info footer-eco-info--link" href="https://t.me/dipp_NEXUS" target="_blank" rel="noopener noreferrer">
                    <span class="footer-eco-info__icon footer-eco-info__icon--mono" aria-hidden="true">
                        <img class="footer-eco-info__logo" src="{{ asset('assets/imgs/template/icons/telegram.svg') }}" alt="" width="28" height="28" decoding="async">
                    </span>
                    <div class="footer-eco-info__body">
                        <p class="footer-eco-info__title">{{ __('Канал Telegram') }}</p>
                        <p class="footer-eco-info__text">{{ __('Официальный канал NEXUS — анонсы и обновления') }}</p>
                        <span class="footer-eco-info__cta">
                            {{ __('Перейти в канал') }}
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                <path d="M14 5h5v5M19 5l-9 9M10 5H5v14h14v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </a>

                <div class="footer-eco-info footer-eco-info--legal">
                    <div class="footer-eco-info__body">
                        <p class="footer-eco-info__title">{{ __('Разграничение правового статуса') }}</p>
                        <p class="footer-eco-info__text">{{ __('ГАНИМЕД предоставляет технологическую инфраструктуру, которую будет использовать российский оператор ЦФА и оператор обмена ЦФА — платформа «НЕКСУС» (после регистрации в качестве ОИС), действующая в соответствии с требованиями Банка России (ФЗ-259).') }}</p>
                        <p class="footer-eco-info__text">{{ __('Информационная система блокчейна ГАНИМЕД является децентрализованной и мультиюрисдикционной сетью и самостоятельно не осуществляет выпуск ЦФА в смысле ФЗ-259.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom mt-0 pt-4">
            {{-- Отечественное ПО + осьминог в одной горизонтальной строке --}}
            <div class="footer-row footer-row--about">
                <div class="footer-row__item footer-row__item--static">
                    <span class="footer-row__icon footer-row__icon--badge" role="img" aria-label="{{ __('Отечественное программное обеспечение — разработано в РФ') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" width="56" height="56" focusable="false" aria-hidden="true">
                            <path d="M60 14 C78 18 94 22 98 24 V58 C98 78 82 94 60 106 C38 94 22 78 22 58 V24 C26 22 42 18 60 14Z" fill="#2B2C2D" stroke="#9AA3AB" stroke-width="2"/>
                            <path d="M60 22 C74 25 88 28 91 30 V56 C91 72 78 86 60 96 C42 86 29 72 29 56 V30 C32 28 46 25 60 22Z" fill="#1E1E1E" stroke="#6E777F" stroke-width="1"/>
                            <g transform="translate(42 32)">
                                <rect width="36" height="22" fill="#D5D8DC"/>
                                <rect y="7.3333" width="36" height="7.3333" fill="#5A6E84"/>
                                <rect y="14.6667" width="36" height="7.3333" fill="#8A5A5A"/>
                                <rect width="36" height="22" fill="none" stroke="#9AA3AB" stroke-width="0.8" opacity="0.85"/>
                            </g>
                            <path d="M48 78 L56 86 L74 68" fill="none" stroke="#A8AFB6" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div class="footer-row__body">
                        <p class="footer-row__title">{{ __('Отечественное программное обеспечение') }}</p>
                        <p class="footer-row__text">
                            {{ __('Ключевые программные компоненты платформы разработаны в Российской Федерации. Персональные данные граждан РФ обрабатываются в соответствии с 152‑ФЗ. Базы данных, используемые для записи, хранения и извлечения таких данных, находятся на территории Российской Федерации.') }}
                        </p>
                    </div>
                </div>
                <div class="footer-row__item footer-row__item--static">
                    <span class="footer-row__icon" aria-hidden="true">
                        <img alt="" src="{{ asset('assets/imgs/template/logo-only.svg') }}" width="56" height="56" decoding="async">
                    </span>
                    <div class="footer-row__body">
                        <p class="footer-row__text">
                            {{ __('Осьминог ассоциируется с интеллектом, гибкостью и многозадачностью, каждая «рука» может работать отдельно, но вся система действует слаженно, как модули НЕКСУС, ГАНИМЕД, СФОРДЕКС, депозитарий, маркетплейс.
                                Щупальца напоминают ветвящуюся сеть или блокчейн‑граф - множество точек взаимодействия с проектами, инвесторами, регуляторами и сервисами.
                                Надпись «НЕКСУС» закрепляет идею: осьминог — это не просто животное, а образ «узла» и «связей», цифрового хаба, который объединяет участников рынка.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center pt-3">
                    <p class="text-sm neutral-600 mb-0">{{ __('©') }} {{ date('Y') }} {{ config('app.name') }}. {{ __('Все права защищены.') }} | KB @CerberRus00 - Nexus Invest Team  </p>
                </div>
            </div>
        </div>
    </div>
</footer>
