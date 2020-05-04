<?php

namespace App\Http\Controllers\Api\v1\User\Account;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountDeleteController extends Controller
{
    public function delete($uuid)
    {
        /*
         * @todo
         * Authentication failure returns server error 500. Check on it.
         * */
        try{
            $user = User::where('uuid' , $uuid)->first();

            if($user->uuid === Auth::user()->uuid){
                if($user->delete()){
                    return response()->json([
                        'success' => 'Account deletion process has been initiated. A mail will be sent to your account when account has been closed.'
                    ]);
                }

                return response()->json([
                    'error' => 'Account deletion was not successful. Please try again later.'
                ], 500);
            }

            return response()->json([
                'error' => 'You dont have permission to delete this account'
            ], 400);
        }catch (\Illuminate\Database\QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }

    }
}
