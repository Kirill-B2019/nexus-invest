<div class="modal fade" id="projectMetricsModal" tabindex="-1" aria-labelledby="projectMetricsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
        <div class="modal-content modal-theme contact-form-modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-18-semibold neutral-0" id="projectMetricsModalLabel">{{ __('Показатели проекта') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('Закрыть') }}"></button>
            </div>
            <div class="modal-body pt-2">
                <p class="neutral-300 small mb-15">
                    {{ __('Стоимость реализации на период 2026–2031 годов в сумме 1,388 млрд ₽') }}
                </p>
                <ul class="neutral-600 small mb-20 ps-3" style="line-height: 1.6;">
                    <li class="mb-2">{{ __('Прогнозная выручка за 2027–2031 годы — 18,32 млрд ₽') }}</li>
                    <li class="mb-2">{{ __('Совокупная EBITDA 2026–2031 — 11,77 млрд ₽') }}</li>
                    <li class="mb-2">{{ __('Точка положительной EBITDA — 2029 год') }}</li>
                    <li class="mb-2">{{ __('Точка кассовой безубыточности — конец 2028 года') }}</li>
                    <li class="mb-2">
                        {{ __('Чистая прибыль') }}
                        <ul class="mt-1 mb-0 ps-3">
                            <li>{{ __('консервативно 5,0–6,0 млрд ₽') }}</li>
                            <li>{{ __('базовый сценарий 6,4–7,5 млрд ₽') }}</li>
                            <li>{{ __('оптимистично 9,0–9,3 млрд ₽') }}</li>
                        </ul>
                    </li>
                    <li class="mb-2">
                        {{ __('NPV') }}
                        <ul class="mt-1 mb-0 ps-3">
                            <li>{{ __('консервативно 0,8–1,2 млрд ₽') }}</li>
                            <li>{{ __('базовый сценарий 1,5–2,0 млрд ₽') }}</li>
                        </ul>
                    </li>
                    <li class="mb-2">
                        {{ __('IRR') }}
                        <ul class="mt-1 mb-0 ps-3">
                            <li>{{ __('консервативно 18–23%') }}</li>
                            <li>{{ __('базовый сценарий 25–35%') }}</li>
                        </ul>
                    </li>
                    <li class="mb-2">{{ __('Простая окупаемость 4 года') }}</li>
                    <li class="mb-2">{{ __('Дисконтированная окупаемость 5 лет') }}</li>
                    <li>{{ __('Остаточная стоимость 0 ₽ — консервативное допущение') }}</li>
                </ul>
                <div class="d-flex flex-wrap gap-2">
                    <button
                        type="button"
                        class="btn btn-sm btn-border-brand-7 small uppercase"
                        id="projectMetricsContactBtn"
                        data-contact-subject="{{ __('Запрос обратной связи по показателям') }}"
                    >{{ __('Связаться с нами') }}</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Закрыть') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var metricsBtn = document.getElementById('projectMetricsContactBtn');
        if (!metricsBtn || typeof bootstrap === 'undefined') {
            return;
        }

        metricsBtn.addEventListener('click', function () {
            var metricsEl = document.getElementById('projectMetricsModal');
            var contactEl = document.getElementById('contactFormModal');
            var subjectInput = document.getElementById('contact-subject');
            var subject = metricsBtn.getAttribute('data-contact-subject') || '';

            if (!metricsEl || !contactEl) {
                return;
            }

            var openContact = function () {
                if (subjectInput) {
                    subjectInput.value = subject;
                }
                bootstrap.Modal.getOrCreateInstance(contactEl).show();
            };

            if (metricsEl.classList.contains('show')) {
                metricsEl.addEventListener('hidden.bs.modal', openContact, { once: true });
                bootstrap.Modal.getOrCreateInstance(metricsEl).hide();
            } else {
                openContact();
            }
        });
    });
</script>
@endpush
