<?php

namespace App\Http\Controllers\Api\v1\User\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Account\ChangeAccountPasswordRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangeUserPasswordController extends Controller
{
    public function changePassword(ChangeAccountPasswordRequest $request)
    {
        $user = Auth::user();

        if(Hash::check($request->currentPassword , $user->getAuthPassword())){
            $user = User::find($user->id);

            if($user->update([
                'password' => Hash::make($request->password)
            ])){
                return new UserProfileResource($user);
            }

            return response()->json([
                'error' => 'Something went wrong trying to change password'
            ], 500);
        }

        return response()->json([
            'error' => 'Current password do not match'
        ], 500);
    }
}
