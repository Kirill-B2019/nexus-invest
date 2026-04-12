<?php

namespace App\Listeners;

use App\Events\ProjectSubmitted;
use App\Services\ProjectNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendProjectSubmittedNotifications implements ShouldQueue
{
    public function __construct(
        private readonly ProjectNotificationService $notifications
    ) {}

    public function handle(ProjectSubmitted $event): void
    {
        $this->notifications->notifyModeratorsNewProject($event->project);
        $this->notifications->notifyInitiatorSubmitted($event->project);
    }
}
