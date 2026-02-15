<?php

namespace App\Services;

use App\Models\Captcha;
use Illuminate\Support\Str;

class CaptchaService
{
    private const TTL_MINUTES = 3;
    private const MIN_NUMBER = 3;
    private const MAX_NUMBER = 20;

    public function create(): array
    {
        $a = random_int(self::MIN_NUMBER, self::MAX_NUMBER);
        $b = random_int(self::MIN_NUMBER, self::MAX_NUMBER);
        $operation = random_int(0, 1) === 0 ? '+' : '-';

        if ($operation === '-') {
            $answer = $a - $b;
            if ($answer < 0) {
                [$a, $b] = [$b, $a];
                $answer = $a - $b;
            }
        } else {
            $answer = $a + $b;
        }

        $question = "Сколько будет {$a} {$operation} {$b}?";
        $answerHash = hash_hmac('sha256', (string) $answer, config('app.key'));
        $token = Str::random(64);

        Captcha::create([
            'token' => $token,
            'question' => $question,
            'answer_hash' => $answerHash,
            'expires_at' => now()->addMinutes(self::TTL_MINUTES),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return [
            'token' => $token,
            'question' => $question,
        ];
    }

    public function validate(string $token, string $answer): bool
    {
        $captcha = Captcha::where('token', $token)->first();

        if (! $captcha) {
            return false;
        }

        if ($captcha->isExpired()) {
            return false;
        }

        if ($captcha->isUsed()) {
            return false;
        }

        $answerHash = hash_hmac('sha256', trim($answer), config('app.key'));

        if (! hash_equals($captcha->answer_hash, $answerHash)) {
            $captcha->increment('failed_attempts');
            return false;
        }

        $captcha->update(['used_at' => now()]);

        return true;
    }
}
