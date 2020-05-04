<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResendSMSTokenRequest;
use App\Models\User\User;
use App\Models\User\VerifyAccountToken;
use App\Services\SMSService;
use Illuminate\Http\Request;

class ResendTokenController extends Controller
{
    public function resendSMS(ResendSMSTokenRequest $request)
    {
        try {
            $user = User::where('contact' , $request->contact)->first();

            if($user){
                $tokenUser = VerifyAccountToken::create([
                    "user_uuid" => $user->uuid,
                    "token" => random_code(),
                ]);

                $code = $tokenUser->token;

                $contact = $user->contact;

                $message = "Hi {$user->firstName}, your verification code is {$code}";

                $smsResponse = new SMSService($contact , $message);

                $smsResponse->sendMessage();

                return response()->json([
                    'success' => 'Token has been sent',
                    'token' => $code,
                    'contact' => $contact,
                    'userId' => $user->uuid,
                ], 200);
            }else{
                return response()->json([
                    'error' => 'User does not exist'
                ], 200);
            }
        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }
}
