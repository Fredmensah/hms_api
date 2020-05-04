<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Events\Auth\ForgotPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CheckContactRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Models\User\PasswordReset;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function checkContact(CheckContactRequest $request)
    {
        try{
            $user = User::where('contact' , $request->contact)->first();

            //return $user;
            event(new ForgotPassword($user));

            //event(new ForgotPassword($user));

            return response()->json([
               'success' => 'Token has been sent to contact via SMS'
            ]);

        } catch (\Illuminate\Database\QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try{
            $token = PasswordReset::where('contact' , $request->contact)
                ->where('token' , $request->token)
                ->orderBy('created_at' , 'desc')
                ->first();

            $user = User::find($token->user->id);

            if($user->update([
                'password' => Hash::make($request->password)
            ])){
                /*
             * @todo send email to user to inform change in password
             * */

                return response()->json([
                    'success' => 'Password has successfully been changed. Please login'
                ]);
            }

            return response()->json([
                'error' => 'Password could not be changed. Please try again.'
            ], 500);

        } catch (\Illuminate\Database\QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }
}
