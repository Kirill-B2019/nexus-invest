{{-- Модальное окно: предложение инвестору Seed-раунда (полный текст из WhitePaper). Публичная часть. --}}
<div class="modal fade" id="seedRoundOfferModal" tabindex="-1" aria-labelledby="seedRoundOfferModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content modal-theme">
            <div class="modal-header border-0 pb-0">
                <p class="text-lg display-4 modal-title neutral-0" id="seedRoundOfferModalLabel">{{ __('Предложение инвестору Seed-раунда') }}</p>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('Закрыть') }}"></button>
            </div>
            <div class="modal-body pt-2 seed-round-modal-body">
                <p class="text-xl-center display-6 neutral-0 mb-2">{{ __('Уважаемый партнер (инвестор) SEED раунда!') }}</p>
                <p class="neutral-200 mb-3">{{ __('Приглашаем вас присоединиться к стратегическому партнерству с НЕКСУС-ИНВЕСТ ФОНД — полнофункциональной платформой проектного финансирования через цифровые активы (ЦФА) на блокчейне ГАНИМЕД, соответствующей ФЗ-259 "О цифровых финансовых активах".') }}</p>
                <p class="text-xl-center neutral-0 mb-3 uppercase border-warning rounded">{{__('доля  инвестора SEED-раунда (постоянная): ')}}
                    <span class="display-5">{{__('17,5% ')}}</span>
                    {{__('за ')}}
                    <span class="display-5">{{__('28МЛН ')}}</span>
                    {{__('Руб РФ')}}</p>
                <h6 class="text-xl neutral-200 my-2">{{ __('Структура раундов финансирования') }}</h6>

                <div class="seed-round-cards mb-3">
                    <div class="seed-round-card seed-round-card-highlight">
                        <div class="seed-round-card-header">SEED</div>
                        <dl class="seed-round-card-body mb-0 small">
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Период') }}</dt><dd class="neutral-200 mb-0">{{ __('Март–Декабрь 2026') }}</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Бюджет') }}</dt><dd class="neutral-200 mb-0">28 млн ₽</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Доля') }}</dt><dd class="neutral-200 mb-0">17,5%</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">Post-money</dt><dd class="neutral-200 mb-0">160 млн ₽</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('ROI (к 2031)') }}</dt><dd class="neutral-200 mb-0">50x</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Цель') }}</dt><dd class="neutral-200 mb-0 text-end">{{ __('MVP платформы + testnet') }}</dd></div>
                        </dl>
                    </div>
                    <div class="seed-round-card">
                        <div class="seed-round-card-header">Series A</div>
                        <dl class="seed-round-card-body mb-0 small">
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Период') }}</dt><dd class="neutral-200 mb-0">2027</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Бюджет') }}</dt><dd class="neutral-200 mb-0">120 млн ₽</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Доля') }}</dt><dd class="neutral-200 mb-0">15%</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">Post-money</dt><dd class="neutral-200 mb-0">900 млн ₽</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('ROI (к 2031)') }}</dt><dd class="neutral-200 mb-0">15x</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Цель') }}</dt><dd class="neutral-200 mb-0 text-end">{{ __('Mainnet + первые проекты') }}</dd></div>
                        </dl>
                    </div>
                    <div class="seed-round-card">
                        <div class="seed-round-card-header">Series B</div>
                        <dl class="seed-round-card-body mb-0 small">
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Период') }}</dt><dd class="neutral-200 mb-0">2028</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Бюджет') }}</dt><dd class="neutral-200 mb-0">350 млн ₽</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Доля') }}</dt><dd class="neutral-200 mb-0">12%</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">Post-money</dt><dd class="neutral-200 mb-0">3 200 млн ₽</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('ROI (к 2031)') }}</dt><dd class="neutral-200 mb-0">6x</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Цель') }}</dt><dd class="neutral-200 mb-0 text-end">{{ __('100+ проектов в портфеле') }}</dd></div>
                        </dl>
                    </div>
                    <div class="seed-round-card">
                        <div class="seed-round-card-header">Series C</div>
                        <dl class="seed-round-card-body mb-0 small">
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Период') }}</dt><dd class="neutral-200 mb-0">2029–2030</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Бюджет') }}</dt><dd class="neutral-200 mb-0">800 млн ₽</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Доля') }}</dt><dd class="neutral-200 mb-0">10%</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">Post-money</dt><dd class="neutral-200 mb-0">8 000 млн ₽</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('ROI (к 2031)') }}</dt><dd class="neutral-200 mb-0">3x</dd></div>
                            <div class="d-flex justify-content-between"><dt class="neutral-500">{{ __('Цель') }}</dt><dd class="neutral-200 mb-0 text-end">{{ __('IPO/выход + международная экспансия') }}</dd></div>
                        </dl>
                    </div>
                </div>

                <h6 class="text-xl neutral-200 my-2">{{ __('Ваши преимущества как SEED партнера') }}</h6>
                <ul class="list-unstyled neutral-200 small mb-3 ps-0 seed-round-benefits-list">
                    <li class="mb-1 d-flex align-items-start gap-2"><span class="ganimed-status-checkbox ganimed-status-ok flex-shrink-0 mt-1" role="img" aria-hidden="true"></span><span>{{ __('Приоритетное право на участие во всех раундах (pro-rata)') }}</span></li>
                    <li class="mb-1 d-flex align-items-start gap-2"><span class="ganimed-status-checkbox ganimed-status-ok flex-shrink-0 mt-1" role="img" aria-hidden="true"></span><span>{{ __('Доля в управляющей компании НЕКСУС (2–5%) (НЕКСУС + КИК(ГАНИМЕД) + НЕКСУСДЕПО + НЕКСУС МАРКЕТ)') }}</span></li>
                    <li class="mb-1 d-flex align-items-start gap-2"><span class="ganimed-status-checkbox ganimed-status-ok flex-shrink-0 mt-1" role="img" aria-hidden="true"></span><span>{{ __('Доступ к софту оценки проектов (ИИ-скоринг)') }}</span></li>
                    <li class="mb-1 d-flex align-items-start gap-2"><span class="ganimed-status-checkbox ganimed-status-ok flex-shrink-0 mt-1" role="img" aria-hidden="true"></span><span>{{ __('Первые 10% портфеля ЦФА с гарантией выкупа') }}</span></li>
                    <li class="mb-1 d-flex align-items-start gap-2"><span class="ganimed-status-checkbox ganimed-status-ok flex-shrink-0 mt-1" role="img" aria-hidden="true"></span><span>{{ __('Whitelist на IDO токенов GANI/GND (Seedify/BlastUP)') }}</span></li>
                </ul>

                <h6 class="text-xl neutral-200 my-2">{{ __('Следующие шаги') }}</h6>
                <ul class="list-unstyled neutral-200 mb-3 ps-0">
                    <li class="mb-1">{{ __('Связаться с нами для переговоров') }}
                        <ul class="list-unstyled neutral-0 small mb-0 ps-0">
                            <li class="pl-20">{{ __('ТГ:') }} <a href="https://t.me/CerberRus00" target="_blank" rel="noopener noreferrer" class="text-decoration-underline">@CerberRus00</a></li>
                            <li class="pl-20">{{ __('WatsApp:') }} <a href="https://wa.me/79067017111" target="_blank" rel="noopener noreferrer" class="text-decoration-underline">+7 906 701-71-11</a></li>
                            <li class="pl-20">{{ __('почта:') }} <a href="mailto:k@nexus-invest.fund" class="text-decoration-underline">k@nexus-invest.fund</a></li>
                        </ul>
                    </li>
                    <li class="mb-1">{{ __('Подписать NDA (доступ к проектной документации)') }}</li>
                    <li class="mb-1">{{ __('Заключить SAFE или конвертируемый заем') }}</li>
                    <li class="mb-1">{{ __('Вступить в состав инвесторов (quarterly updates) - РФ Москва, ВТБ депозитарий') }}</li>
                </ul>
                <p class="text-xl-center neutral-0 mb-3 uppercase border-warning rounded">{{__('SEED раунд закрывается : ')}}
                    <span class="display-5">{{__('30 ')}}</span>
                    {{__('апреля ')}}
                    <span class="display-5">{{__('2026 ')}}</span>
                    {{__('г.')}}
                </p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn seed-round-modal-close" data-bs-dismiss="modal">{{ __('Закрыть') }}</button>
            </div>
        </div>
    </div>
</div>
<script>
(function() {
    var el = document.getElementById('seedRoundOfferModal');
    if (!el) return;
    el.addEventListener('show.bs.modal', function() { el.setAttribute('aria-hidden', 'false'); });
    el.addEventListener('hidden.bs.modal', function() { el.setAttribute('aria-hidden', 'true'); });
})();
</script>
