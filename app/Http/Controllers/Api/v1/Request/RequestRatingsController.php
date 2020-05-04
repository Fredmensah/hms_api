<?php

namespace App\Http\Controllers\Api\v1\Request;

use App\Http\Controllers\Controller;
use App\Http\Resources\Request\RequestResource;
use App\Models\Request\User_Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestRatingsController extends Controller
{
    public function changeRatings(Request $req, $uuid)
    {
        $request = User_Request::where('user_uuid' , Auth::user()->uuid)
            ->where('uuid' , $uuid)->first();

        $request->status = $req->ratings;

        if($request->save()){
            return new RequestResource($request);
        }

        return response()->json([
            'error' => 'OOPS! Something went wrong saving request ratings. Please try again.'
        ], 500);
    }
}
