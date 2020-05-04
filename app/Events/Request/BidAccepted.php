<?php

namespace App\Events\Request;

use App\Models\Bid\Bid;
use App\Models\Request\User_Request;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BidAccepted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bid;
    public $request;
    /**
     * Create a new event instance.
     * @var bid
     * @var request
     * @return object
     */
    public function __construct(Bid $bid , User_Request $request)
    {
        $this->bid = $bid;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
