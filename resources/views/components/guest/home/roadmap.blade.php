{{-- Дорожная карта — самостоятельный статичный блок главной страницы. --}}
<section class="section-box wow fadeIn box-imazing-features animated" id="Road">
    <div class="roadmap-shell">
        <div class="roadmap-shell__frame">
            <div class="roadmap-head">
                <h2 class="roadmap-head__title">{{ __('Дорожная карта платформы') }}</h2>
                <div class="roadmap-head__progress" aria-label="{{ __('Прогресс реализации MVP НЕКСУС') }}">
                    <span class="roadmap-head__progress-label">{{ __('Прогресс реализации MVP НЕКСУС') }}</span>
                    <div class="roadmap-head__progress-track">
                        <div class="roadmap-head__progress-fill" style="width: 47%"></div>
                    </div>
                    <span class="roadmap-head__progress-value">47%</span>
                </div>
            </div>

            <div class="roadmap-board">
                <article class="roadmap-card">
                    <div class="roadmap-card__meta">
                        <span class="roadmap-card__badge">{{ __('Стадия I') }}</span>
                        <span class="roadmap-card__version">V1.0.0 · Q1 2027</span>
                        <span class="roadmap-card__icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2.5 20.5 7v10L12 21.5 3.5 17V7L12 2.5Z" stroke="currentColor" stroke-width="1.5"/><path d="M12 12v9.5M12 12 3.5 7M12 12l8.5-5" stroke="currentColor" stroke-width="1.5"/></svg>
                        </span>
                    </div>
                    <h3 class="roadmap-card__title">{{ __('MVP запуск платформы НЕКСУС и блокчейна ГАНИМЕД') }}</h3>
                    <ul class="roadmap-card__list">
                        <li>{{ __('Архитектура блокчейна ГАНИМЕД — готова (MVP)') }}</li>
                        <li>{{ __('Мастер-нода запущена') }}</li>
                        <li>{{ __('Платформа НЕКСУС — в разработке (70%)') }}</li>
                        <li>{{ __('Регистрация ОИС НЕКСУС в ЦБ РФ — документы готовятся') }}</li>
                        <li>{{ __('Обучение НЕКСУС ИИ') }}</li>
                    </ul>
                    <div class="roadmap-card__status">
                        <div class="roadmap-card__status-row">
                            <span>{{ __('70% готово') }}</span>
                        </div>
                        <div class="roadmap-card__bar"><span style="width: 70%"></span></div>
                    </div>
                </article>

                <article class="roadmap-card">
                    <div class="roadmap-card__meta">
                        <span class="roadmap-card__badge">{{ __('Стадия II') }}</span>
                        <span class="roadmap-card__version">V2.0.0 · Q2 2027</span>
                        <span class="roadmap-card__icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M4 20h16M6 20V10l6-5 6 5v10M10 20v-5h4v5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 12h.01M15 12h.01M12 9h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </span>
                    </div>
                    <h3 class="roadmap-card__title">{{ __('MVP запуск площадки СФОРДЕКС и регистрация ОИС') }}</h3>
                    <ul class="roadmap-card__list">
                        <li>{{ __('Статус ОИС получен') }}</li>
                        <li>{{ __('Площадка СФОРДЕКС интегрирована с ГАНИМЕД и НЕКСУС') }}</li>
                        <li>{{ __('Торги активны 24/7') }}</li>
                        <li>{{ __('Расширенный функционал НЕКСУС реализован') }}</li>
                        <li>{{ __('ГАНИМЕД прошел лицензирование и аудит') }}</li>
                    </ul>
                    <div class="roadmap-card__status">
                        <div class="roadmap-card__status-row">
                            <span>{{ __('В разработке') }}</span>
                        </div>
                        <div class="roadmap-card__bar"><span style="width: 28%"></span></div>
                    </div>
                </article>

                <article class="roadmap-card">
                    <div class="roadmap-card__meta">
                        <span class="roadmap-card__badge">{{ __('Стадия III') }}</span>
                        <span class="roadmap-card__version">V3.0.0 · Q1 2028</span>
                        <span class="roadmap-card__icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="2.2" stroke="currentColor" stroke-width="1.5"/><circle cx="5" cy="7" r="1.8" stroke="currentColor" stroke-width="1.5"/><circle cx="19" cy="7" r="1.8" stroke="currentColor" stroke-width="1.5"/><circle cx="5" cy="17" r="1.8" stroke="currentColor" stroke-width="1.5"/><circle cx="19" cy="17" r="1.8" stroke="currentColor" stroke-width="1.5"/><path d="M6.6 8.2 10.2 10.8M13.8 10.8l3.6-2.6M6.6 15.8l3.6-2.6M13.8 13.2l3.6 2.6" stroke="currentColor" stroke-width="1.5"/></svg>
                        </span>
                    </div>
                    <h3 class="roadmap-card__title">{{ __('MVP запуск ЦИФРОВОГО ДЕПОЗИТАРИЯ И РЕГИСТРАЦИЯ ДЕПОЗИТАРНОЙ ЛИЦЕНЗИИ') }}</h3>
                    <ul class="roadmap-card__list">
                        <li>{{ __('Юридическое лицо депозитария создано и включено в периметр экосистемы НЕКСУС') }}</li>
                        <li>{{ __('Требования ЦБ РФ по 39‑ФЗ и 282‑ФЗ выполнены') }}</li>
                        <li>{{ __('MVP‑функционал: открытие счетов депо, учет прав, корпоративные действия, отчётность и API запущены') }}</li>
                        <li>{{ __('Расчётно‑клиринговая инфраструктура') }}</li>
                        <li>{{ __('ИБ‑аудит и стресс‑тесты, подтвержден уровень отказоустойчивости и соответствие требованиям по защите информации проведены') }}</li>
                    </ul>
                    <div class="roadmap-card__status">
                        <div class="roadmap-card__status-row">
                            <span>{{ __('Запланировано') }}</span>
                        </div>
                        <div class="roadmap-card__bar"><span style="width: 8%"></span></div>
                    </div>
                </article>

                <article class="roadmap-card">
                    <div class="roadmap-card__meta">
                        <span class="roadmap-card__badge">{{ __('Стадия IV') }}</span>
                        <span class="roadmap-card__version">V4.0.0 · 2028+</span>
                        <span class="roadmap-card__icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M3 5h2l2.2 9.2a2 2 0 0 0 2 1.5h7.6a2 2 0 0 0 2-1.6L20 8H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="10" cy="19" r="1.5" stroke="currentColor" stroke-width="1.5"/><circle cx="17" cy="19" r="1.5" stroke="currentColor" stroke-width="1.5"/></svg>
                        </span>
                    </div>
                    <h3 class="roadmap-card__title">{{ __('Маркетплейс, ЦИФРОВОЙ БАНКОВСКИЙ КОНТУР + IPO') }}</h3>
                    <ul class="roadmap-card__list">
                        <li>{{ __('Маркетплейс интегрирован с экосистемой: данные по проектам, статусам и лимитам подтягиваются автоматически') }}</li>
                        <li>{{ __('Реализована связка покупок на маркетплейсе с инвестиционными метриками проектов (выручка, LTV, другие KPI)') }}</li>
                        <li>{{ __('Платформа интегрирована с банком-оператором') }}</li>
                        <li>{{ __('Запуск маркетплейса') }}</li>
                        <li>{{ __('Запуск цифрового банковского контура') }}</li>
                        <li>{{ __('Подготовка к IPO НЕКСУС') }}</li>
                    </ul>
                    <div class="roadmap-card__status">
                        <div class="roadmap-card__status-row">
                            <span>{{ __('Запланировано') }}</span>
                        </div>
                        <div class="roadmap-card__bar"><span style="width: 8%"></span></div>
                    </div>
                </article>
            </div>

            <div class="roadmap-foot">
                <div class="roadmap-foot__metrics">
                    <div class="roadmap-metric">
                        <span class="roadmap-metric__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 20V10l8-6 8 6v10H4Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M10 20v-6h4v6" stroke="currentColor" stroke-width="1.6"/></svg>
                        </span>
                        <div class="roadmap-metric__text">
                            <strong>350 {{ __('тыс.+') }}</strong>
                            <span>{{ __('Проектов') }}</span>
                        </div>
                    </div>
                    <div class="roadmap-metric">
                        <span class="roadmap-metric__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.6"/><circle cx="16" cy="9" r="2.5" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 19c.6-3 2.8-4.5 5.5-4.5S14 16 14.5 19M14 14.6c1.7.2 3.3 1.2 4 3.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        </span>
                        <div class="roadmap-metric__text">
                            <strong>7 {{ __('млн.+') }}</strong>
                            <span>{{ __('Клиентов') }}</span>
                        </div>
                    </div>
                    <div class="roadmap-metric">
                        <span class="roadmap-metric__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M7 7h10M7 12h10M7 17h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><rect x="3.5" y="3.5" width="17" height="17" rx="3" stroke="currentColor" stroke-width="1.6"/></svg>
                        </span>
                        <div class="roadmap-metric__text">
                            <strong>700 {{ __('тыс.+') }}</strong>
                            <span>{{ __('Сделок в год') }}</span>
                        </div>
                    </div>
                    <div class="roadmap-metric">
                        <span class="roadmap-metric__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3v18M16.5 7.5c0-1.7-2-3-4.5-3s-4.5 1.3-4.5 3 2 3 4.5 3 4.5 1.3 4.5 3-2 3-4.5 3-4.5-1.3-4.5-3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        </span>
                        <div class="roadmap-metric__text">
                            <strong>7 {{ __('млрд.₽+') }}</strong>
                            <span>{{ __('Оборот в год') }}</span>
                        </div>
                    </div>
                </div>
                <a class="roadmap-foot__cta" href="#forWho">
                    <span>{{ __('Цель экосистемы к 2031 году') }}</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
