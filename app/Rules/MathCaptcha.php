<?php

namespace App\Rules;

use App\Services\CaptchaService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MathCaptcha implements ValidationRule
{
    public function __construct(
        private CaptchaService $captchaService
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $token = request()->input('captcha_token');
        $answer = request()->input('captcha_answer');

        if (! $token || ! $answer) {
            $fail(__('Неверное решение капчи или истёк срок действия.'));
            return;
        }

        if (! $this->captchaService->validate($token, $answer)) {
            $fail(__('Неверное решение капчи или истёк срок действия.'));
        }
    }
}
