@php
    $id = 'math-captcha-' . uniqid();
@endphp
<div
    class="math-captcha"
    id="{{ $id }}"
    data-math-captcha
    data-captcha-endpoint="{{ url('/api/captcha/new') }}"
    data-loading-text="{{ __('Загрузка...') }}"
    data-error-text="{{ __('Ошибка загрузки капчи') }}"
>
    <div class="math-captcha__question mb-2" data-question-placeholder>{{ __('Загрузка...') }}</div>
    <input type="hidden" name="captcha_token" value="" data-captcha-token>
    <input type="text"
           name="captcha_answer"
           class="form-control"
           placeholder="{{ __('Введите ответ') }}"
           autocomplete="off"
           inputmode="numeric"
           pattern="[0-9\-]*"
           data-captcha-answer
           required>
</div>
