<?php

namespace Tests\Feature;

use App\Mail\ContactMessageReceivedMail;
use App\Models\ContactMessage;
use App\Services\CaptchaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_stores_message_and_sends_notification_mail(): void
    {
        config([
            'mail.recipients.contact' => ['nexus@nexus-invest.fund'],
            'mail.queue_outbound' => false,
        ]);
        Mail::fake();

        /** @var CaptchaService $captchaService */
        $captchaService = app(CaptchaService::class);
        $captcha = $captchaService->create();

        preg_match('/(\d+)\s([+\-])\s(\d+)/', $captcha['question'], $matches);
        $answer = $matches[2] === '+'
            ? (int) $matches[1] + (int) $matches[3]
            : (int) $matches[1] - (int) $matches[3];

        $response = $this->post(route('contact.store'), [
            'name' => 'Тест обратной связи',
            'email' => 'test@example.com',
            'subject' => 'Запрос обратной связи по показателям',
            'message' => 'Проверка отправки письма после заполнения формы.',
            'captcha_token' => $captcha['token'],
            'captcha_answer' => (string) $answer,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('alert_success');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'test@example.com',
            'subject' => 'Запрос обратной связи по показателям',
        ]);

        $message = ContactMessage::where('email', 'test@example.com')->first();
        $this->assertNotNull($message);

        Mail::assertSent(ContactMessageReceivedMail::class, function (ContactMessageReceivedMail $mail) use ($message) {
            return $mail->hasTo('nexus@nexus-invest.fund')
                && $mail->contactMessage->is($message);
        });
    }
}
