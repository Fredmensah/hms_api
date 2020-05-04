<?php

namespace App\Http\Controllers\Api\v1\Request;

use App\Events\Request\BidAccepted;
use App\Http\Controllers\Controller;
use App\Http\Resources\Request\RequestResource;
use App\Models\Bid\Bid;
use App\Models\Request\User_Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcceptRequestBidController extends Controller
{
    public function acceptBid($bid_uuid)
    {
        $bid = Bid::where('uuid' , $bid_uuid)->first();

        if($bid->request->user->uuid !== Auth::user()->uuid){
            return response()->json([
                'error' => 'You cant change the status of this bid. Request does not belong to this user.'
            ], 500);
        }

        $bid->status = 'accepted';


        if($bid->save()){
            event(new BidAccepted($bid , $bid->request));
            return new RequestResource(User_Request::where('uuid' , $bid->request->uuid)->first());
        }

        return response()->json([
            'error' => 'OOPS! Something went wrong saving bid status. Please try again.'
        ], 500);
    }
}
