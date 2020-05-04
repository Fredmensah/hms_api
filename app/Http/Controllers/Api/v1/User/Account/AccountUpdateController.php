<?php

namespace App\Http\Controllers\Api\v1\User\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Account\UpdateAccountRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Models\User\User;
use Illuminate\Http\Request;

class AccountUpdateController extends Controller
{
    public function update(UpdateAccountRequest $request , $userId)
    {
        try {
            $user = User::where('uuid' , $userId)->first();

            //return $user;

            if($user->update([
                'firstName' => $request->firstName,
                'otherNames' => $request->otherNames,
                'contact' => $request->contact,
                'email' => $request->email,
            ])){
                return new UserProfileResource($user);
            }

            return response()->json([
                'error' => 'Something went wrong trying to update user. Please try again.'
            ], 500);
        } catch (\Illuminate\Database\QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }
}
