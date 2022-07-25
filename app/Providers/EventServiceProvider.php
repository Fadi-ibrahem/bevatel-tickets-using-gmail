<?php

namespace App\Providers;

use App\Events\CreateTicketEvent;
use App\Events\ReplyMessageEvent;
use App\Listeners\AcknowledgeEmailListener;
use App\Listeners\ReplyMessageListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateTicketEvent::class =>[
            AcknowledgeEmailListener::class,
        ],
        ReplyMessageEvent::class =>[
            ReplyMessageListener::class,
        ],
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
