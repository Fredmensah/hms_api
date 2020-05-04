<?php

namespace App\Http\Controllers\Api\v1\Bid;

use App\Http\Controllers\Controller;
use App\Http\Resources\Bid\BidResource;
use App\Models\Bid\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidStatusController extends Controller
{
    public function changeStatus(Request $req, $uuid)
    {
        $request = Bid::where('user_uuid' , Auth::user()->uuid)
            ->where('uuid' , $uuid)->first();

        $request->status = $req->status;

        if($request->save()){
            return $request;
            return new BidResource($request);
        }

        return response()->json([
            'error' => 'OOPS! Something went wrong saving bid status. Please try again.'
        ], 500);
    }
}
