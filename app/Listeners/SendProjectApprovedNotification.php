<?php

namespace App\Listeners;

use App\Events\ProjectApproved;
use App\Services\ProjectNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendProjectApprovedNotification implements ShouldQueue
{
    public function __construct(
        private readonly ProjectNotificationService $notifications
    ) {}

    public function handle(ProjectApproved $event): void
    {
        $this->notifications->notifyInitiatorApproved($event->project);
    }
}
