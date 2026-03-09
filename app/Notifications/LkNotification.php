<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Уведомление ЛК (системное или ручное).
 * Хранится в канале database; в data — type, title, body, link, importance, expires_at, created_by.
 */
class LkNotification extends Notification
{
    use Queueable;

    /** Важность по умолчанию */
    public const IMPORTANCE_NORMAL = 'normal';

    /** Допустимые значения важности */
    public const IMPORTANCE_LEVELS = ['low', 'normal', 'high', 'urgent'];

    /** Типы уведомлений */
    public const TYPE_SYSTEM = 'system';
    public const TYPE_MANUAL = 'manual';

    public function __construct(
        public string $title,
        public string $body,
        public ?string $link = null,
        public string $type = self::TYPE_MANUAL,
        public string $importance = self::IMPORTANCE_NORMAL,
        public ?\DateTimeInterface $expiresAt = null,
        public ?int $createdBy = null,
    ) {
        if (! in_array($importance, self::IMPORTANCE_LEVELS, true)) {
            $importance = self::IMPORTANCE_NORMAL;
        }
        $this->importance = $importance;
    }

    /**
     * Каналы доставки.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Представление для канала database (сохраняется в data).
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type,
            'title' => $this->title,
            'body' => $this->body,
            'link' => $this->link,
            'importance' => $this->importance,
            'expires_at' => $this->expiresAt?->format(\DateTimeInterface::ATOM),
            'created_by' => $this->createdBy,
        ];
    }
}
