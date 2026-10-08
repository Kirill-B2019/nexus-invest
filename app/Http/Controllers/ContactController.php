<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Mail\ContactMessageReceivedMail;
use App\Models\ContactMessage;
use App\Services\OutboundMailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * |KB 2025-02-18 Приём сообщений обратной связи. Валидация и капча через сервис.
 */
class ContactController extends Controller
{
    public function store(
        ContactMessageRequest $request,
        OutboundMailService $outboundMail,
    ): RedirectResponse {
        $validated = $request->validated();

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
