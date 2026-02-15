@php
    $privacyUrl = config('cookie.consent.privacy_policy_url');
    $termsUrl = config('cookie.consent.terms_url');
    $privacyUrl = (str_starts_with($privacyUrl ?? '', 'http')) ? $privacyUrl : asset($privacyUrl);
    $termsUrl = (str_starts_with($termsUrl ?? '', 'http')) ? $termsUrl : asset($termsUrl);
@endphp
<div id="cookie-banner" class="cookie-banner" role="dialog" aria-label="{{ __('Уведомление о cookie') }}" aria-hidden="true">
    <div class="cookie-banner__inner">
        <div class="cookie-banner__content">
            <p class="cookie-banner__text">
                {{ __('Мы используем cookie для улучшения работы сайта и анализа трафика. Продолжая пользоваться сайтом, вы соглашаетесь с использованием cookie. Подробности см. в нашей') }}
                <a href="{{ $privacyUrl }}" target="_blank" rel="noopener noreferrer" class="cookie-banner__link">{{ __('Политике конфиденциальности') }}</a>
                {{ __('и') }}
                <a href="{{ $termsUrl }}" target="_blank" rel="noopener noreferrer" class="cookie-banner__link">{{ __('Правилах пользования сайтом') }}</a>.
                {{ __('Cookie для запоминания вашего выбора будут храниться 6 месяцев.') }}
            </p>
        </div>
        <div class="cookie-banner__actions">
            <button type="button" class="cookie-banner__btn cookie-banner__btn--reject" data-consent="rejected">{{ __('Отклонить') }}</button>
            <button type="button" class="cookie-banner__btn cookie-banner__btn--accept" data-consent="accepted">{{ __('Принять') }}</button>
        </div>
    </div>
</div>
