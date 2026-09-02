<?php

namespace App\Listeners;

use App\Events\ContactMessageSubmitted;
use App\Mail\ContactMessageReceivedMail;
use App\Services\OutboundMailService;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendContactMessageMail
{
    public function __construct(
        private readonly OutboundMailService $outboundMail
    ) {}

    public function handle(ContactMessageSubmitted $event): void
    {
        $message = $event->message;

        try {
            $this->outboundMail->send(
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
    }
}

