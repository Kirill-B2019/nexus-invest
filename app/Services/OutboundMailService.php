<?php

namespace App\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Универсальная отправка исходящих писем по ключу маршрута из config('mail.recipients').
 */
class OutboundMailService
{
    /**
     * @param  string  $route  Ключ из config('mail.recipients'), например contact
     */
    public function send(
        string $route,
        Mailable $mailable,
        ?string $replyToEmail = null,
        ?string $replyToName = null,
    ): void {
        $recipients = config('mail.recipients.'.$route, []);

        if (! is_array($recipients) || $recipients === []) {
            Log::warning('OutboundMailService: получатели не заданы', ['route' => $route]);

            return;
        }

        $useQueue = (bool) config('mail.queue_outbound', false);

        foreach ($recipients as $address) {
            if (! is_string($address) || $address === '') {
                continue;
            }

            $instance = clone $mailable;

            if ($replyToEmail !== null && $replyToEmail !== '') {
                $instance->replyTo($replyToEmail, $replyToName);
            }

            if ($useQueue) {
                Mail::to($address)->queue($instance);
            } else {
                Mail::to($address)->send($instance);
            }
        }
    }
}
