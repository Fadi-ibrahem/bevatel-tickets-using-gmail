<?php

namespace App\Listeners;

use App\Events\CreateTicketEvent;
use App\Jobs\AcknowledgeMailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AcknowledgeEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreateTicketEvent  $event
     * @return void
     */
    public function handle(CreateTicketEvent $event)
    {
        dispatch(new AcknowledgeMailJob($event->data));
    }
}
