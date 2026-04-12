<?php

namespace App\Providers;

use App\Events\ProjectApproved;
use App\Events\ProjectRejected;
use App\Events\ProjectSubmitted;
use App\Listeners\SendProjectApprovedNotification;
use App\Listeners\SendProjectRejectedNotification;
use App\Listeners\SendProjectSubmittedNotifications;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
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
