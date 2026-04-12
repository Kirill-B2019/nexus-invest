<?php

namespace App\Listeners;

use App\Events\ProjectRejected;
use App\Services\ProjectNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendProjectRejectedNotification implements ShouldQueue
{
    public function __construct(
        private readonly ProjectNotificationService $notifications
    ) {}

    public function handle(ProjectRejected $event): void
    {
        $this->notifications->notifyInitiatorRejected($event->project);
    }
}
