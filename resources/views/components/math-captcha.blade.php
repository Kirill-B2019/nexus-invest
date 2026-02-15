@php
    $id = 'math-captcha-' . uniqid();
@endphp
<div class="math-captcha" id="{{ $id }}">
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
<script>
(function() {
    var container = document.getElementById('{{ $id }}');
    if (!container) return;
    var questionEl = container.querySelector('[data-question-placeholder]');
    var tokenInput = container.querySelector('[data-captcha-token]');
    var answerInput = container.querySelector('[data-captcha-answer]');
    if (!questionEl || !tokenInput || !answerInput) return;

    fetch('{{ url("/api/captcha/new") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        credentials: 'same-origin',
        body: JSON.stringify({})
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        questionEl.textContent = data.question || '{{ __('Ошибка загрузки капчи') }}';
        tokenInput.value = data.token || '';
    })
    .catch(function() {
        questionEl.textContent = '{{ __('Ошибка загрузки капчи') }}';
    });
})();
</script>
