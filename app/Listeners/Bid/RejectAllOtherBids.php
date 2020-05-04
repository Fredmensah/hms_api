<?php

namespace App\Listeners\Bid;

use App\Events\Request\BidAccepted;
use App\Models\Bid\Bid;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class RejectAllOtherBids
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
     * @param  BidAccepted  $event
     * @return void
     */
    public function handle(BidAccepted $event)
    {
        $bid = $event->bid;
        $request = $event->request;

        $bidTable = (new Bid())->getTable();

        DB::table($bidTable)->where('request_uuid', $request->uuid)
            ->where('uuid' , '!=' , $bid->uuid)
            ->update(array('status' => 'rejected'));
    }
}
