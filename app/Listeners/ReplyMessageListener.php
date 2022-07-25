<?php

namespace App\Listeners;

use App\Events\ReplyMessageEvent;
use App\Jobs\SendReplyJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReplyMessageListener
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
     * @param  \App\Events\ReplyMessageEvent  $event
     * @return void
     */
    public function handle(ReplyMessageEvent $event)
    {
        dispatch(new SendReplyJob($event->data));
    }
}
