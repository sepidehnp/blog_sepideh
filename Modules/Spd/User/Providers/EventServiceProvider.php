<?php

namespace Spd\User\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spd\User\Events\SendEmailToUserEvent;
use Spd\User\Listeners\SendEmailToUserListener;
use Spd\User\Listeners\SendSmsToUserListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SendEmailToUserEvent::class => [
            SendEmailToUserListener::class,
            SendSmsToUserListener::class,
        ],
    ];
}
