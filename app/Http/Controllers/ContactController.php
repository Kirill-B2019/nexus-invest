<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Rules\MathCaptcha;
use App\Services\CaptchaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * |KB 2025-02-18 Приём сообщений обратной связи. Валидация и капча через сервис.
 */
class ContactController extends Controller
{
    public function store(Request $request, CaptchaService $captchaService): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'captcha_token' => ['required', 'string'],
            'captcha_answer' => ['required', 'string', new MathCaptcha($captchaService)],
        ], [
            'name.required' => __('Укажите имя.'),
            'email.required' => __('Укажите адрес электронной почты.'),
            'email.email' => __('Укажите корректный адрес электронной почты.'),
            'message.required' => __('Введите сообщение.'),
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'ip' => $request->ip(),
        ]);

        return back()->with('alert_success', __('Спасибо! Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время.'));
    }
}
