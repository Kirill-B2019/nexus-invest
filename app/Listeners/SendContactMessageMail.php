<?php

namespace App\Listeners;

use App\Events\ContactMessageSubmitted;
use App\Mail\ContactMessageReceivedMail;
use App\Services\OutboundMailService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactMessageMail implements ShouldQueue
{
    public function __construct(
        private readonly OutboundMailService $outboundMail
    ) {}

    public function handle(ContactMessageSubmitted $event): void
    {
        $message = $event->message;

        $this->outboundMail->send(
            route: 'contact',
            mailable: new ContactMessageReceivedMail($message),
            replyToEmail: $message->email,
            replyToName: $message->name,
        );
    }
}
