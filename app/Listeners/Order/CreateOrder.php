<?php

namespace App\Listeners\Order;

use App\Events\Request\BidAccepted;
use App\Models\Order\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrder
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

        Order::create([
            'request_uuid' => $request->uuid,
            'bid_uuid' => $bid->uuid,
            'request_user_uuid' => $request->user_uuid,
            'shipper_user_uuid' => $bid->user_uuid,
            'amount' => $bid->amount,
            'pickup_date' => $bid->updated_at,
            'arrived_date' => $request->delivery_date,
        ]);

        /*
         * @todo send notification here
         * @todo set pickup date and track progress of order
         * */
    }
}
