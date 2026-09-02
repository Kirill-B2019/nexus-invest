<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageReceivedMail;
use App\Models\ContactMessage;
use App\Rules\MathCaptcha;
use App\Services\CaptchaService;
use App\Services\OutboundMailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * |KB 2025-02-18 Приём сообщений обратной связи. Валидация и капча через сервис.
 */
class ContactController extends Controller
{
    public function store(
        Request $request,
        CaptchaService $captchaService,
        OutboundMailService $outboundMail,
    ): RedirectResponse {
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

        $message = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'ip' => $request->ip(),
        ]);

        try {
            $outboundMail->send(
                route: 'contact',
                mailable: new ContactMessageReceivedMail($message),
                replyToEmail: $message->email,
                replyToName: $message->name,
            );
        } catch (Throwable $e) {
            Log::error('Не удалось отправить письмо обратной связи', [
                'contact_message_id' => $message->id,
                'email' => $message->email,
                'error' => $e->getMessage(),
            ]);
        }

        return back()->with('alert_success', __('Спасибо! Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время.'));
    }
}
