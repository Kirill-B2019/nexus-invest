<?php

namespace App\Console\Commands;

use App\Mail\ContactMessageReceivedMail;
use App\Models\ContactMessage;
use App\Services\OutboundMailService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Проверка отправки писем обратной связи (диагностика на production).
 */
class TestContactMailCommand extends Command
{
    protected $signature = 'mail:test-contact
                            {--message-id= : ID записи contact_messages для повторной отправки}
                            {--to= : Отправить тест только на этот адрес (вместо MAIL_CONTACT_RECIPIENTS)}';

    protected $description = 'Проверить SMTP и отправку письма обратной связи';

    public function handle(OutboundMailService $outboundMail): int
    {
        $this->line('=== Конфигурация почты ===');
        $this->table(
            ['Параметр', 'Значение'],
            [
                ['MAIL_MAILER', (string) config('mail.default')],
                ['MAIL_HOST', (string) config('mail.mailers.smtp.host')],
                ['MAIL_PORT', (string) config('mail.mailers.smtp.port')],
                ['MAIL_USERNAME', (string) (config('mail.mailers.smtp.username') ?: '—')],
                ['MAIL_FROM', (string) config('mail.from.address')],
                ['MAIL_CONTACT_RECIPIENTS', implode(', ', config('mail.recipients.contact', [])) ?: '—'],
                ['MAIL_QUEUE_OUTBOUND', config('mail.queue_outbound') ? 'true' : 'false'],
            ]
        );

        if (config('mail.default') === 'log') {
            $this->warn('MAIL_MAILER=log — письма пишутся в storage/logs/laravel.log, а не на почту.');
        }

        if (config('mail.recipients.contact', []) === [] && ! $this->option('to')) {
            $this->error('Получатели не заданы. Укажите MAIL_CONTACT_RECIPIENTS в .env и выполните: php artisan config:cache');

            return self::FAILURE;
        }

        $message = $this->resolveMessage();
        if (! $message) {
            return self::FAILURE;
        }

        $to = $this->option('to');
        if ($to) {
            $this->info("Тестовая отправка на {$to}...");
            try {
                Mail::to($to)->send(new ContactMessageReceivedMail($message));
                $this->info('OK: письмо отправлено через Mail::send().');
            } catch (Throwable $e) {
                $this->error('Ошибка: '.$e->getMessage());
                Log::error('mail:test-contact failed', ['error' => $e->getMessage()]);

                return self::FAILURE;
            }

            return self::SUCCESS;
        }

        $this->info('Отправка через OutboundMailService (маршрут contact)...');
        try {
            $outboundMail->send(
                route: 'contact',
                mailable: new ContactMessageReceivedMail($message),
                replyToEmail: $message->email,
                replyToName: $message->name,
            );
            $this->info('OK: команда завершена без ошибок. Проверьте почту и storage/logs/laravel.log');
        } catch (Throwable $e) {
            $this->error('Ошибка: '.$e->getMessage());
            Log::error('mail:test-contact failed', ['error' => $e->getMessage()]);

            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    private function resolveMessage(): ?ContactMessage
    {
        $messageId = $this->option('message-id');
        if ($messageId) {
            $message = ContactMessage::find($messageId);
            if (! $message) {
                $this->error("Запись contact_messages #{$messageId} не найдена.");

                return null;
            }

            return $message;
        }

        $message = ContactMessage::query()->latest('id')->first();
        if ($message) {
            $this->line("Используется последняя запись #{$message->id} ({$message->email}).");

            return $message;
        }

        $this->line('Записей в contact_messages нет — создаётся тестовая.');
        return ContactMessage::create([
            'name' => 'Тест SMTP',
            'email' => 'test@example.com',
            'subject' => 'Тест отправки обратной связи',
            'message' => 'Проверка mail:test-contact',
            'ip' => '127.0.0.1',
        ]);
    }
}
