<?php

namespace App\Providers;

use App\Events\LoginHistory;
use App\Events\SendSMS;
use App\Listeners\LoginHistoryLog;
use App\Listeners\SendComposedSMS;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendSMS::class => [
            SendComposedSMS::class,
        ],
        LoginHistory::class => [
            LoginHistoryLog::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
