<?php

namespace App\Providers;

use App\Events\ContactMessageSubmitted;
use App\Events\ProjectApproved;
use App\Events\ProjectRejected;
use App\Events\ProjectSubmitted;
use App\Listeners\SendContactMessageMail;
use App\Listeners\SendProjectApprovedNotification;
use App\Listeners\SendProjectRejectedNotification;
use App\Listeners\SendProjectSubmittedNotifications;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ContactMessageSubmitted::class => [
            SendContactMessageMail::class,
        ],
        ProjectSubmitted::class => [
            SendProjectSubmittedNotifications::class,
        ],
        ProjectApproved::class => [
            SendProjectApprovedNotification::class,
        ],
        ProjectRejected::class => [
            SendProjectRejectedNotification::class,
        ],
    ];
}
