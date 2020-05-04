<?php

namespace App\Listeners\Request;

use App\Events\Request\BidAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BidAcceptedNotification
{
    /**
     * Create the event listener.
     * @todo handle notification send to user here
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BidAccepted  $event
     * @return void
     */
    public function handle(BidAccepted $event)
    {
        //
    }
}
