<?php

namespace App\Listeners\Auth;

use App\Events\Auth\CreateAccount;
use App\Models\User\User;
use App\Models\User\VerifyAccountToken;
use App\Services\SMSService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateAccountProcess
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
     * @param  CreateAccount  $event
     * @return void
     */
    public function handle(CreateAccount $event)
    {
        $tokenUser = VerifyAccountToken::create([
           "user_uuid" => $event->user->uuid,
           "token" => random_code(),
        ]);

        $token = VerifyAccountToken::where('user_uuid' , $event->user->uuid)
            ->where('token' , $tokenUser->token)->orderBy('created_at' , 'desc')->first();

        if($token) {
            $user = User::find($token->user->id);
            //return $user;
            $user->status = 'active';
            $user->idVerified = 1;
            if($user->save()) {
            }
        }
        /*$code = $tokenUser->token;

        $contact = $event->user->contact;

        $message = "Hi {$event->user->firstName}, your verification code is {$code}";

        $smsResponse = new SMSService($contact , $message);

        $smsResponse->sendMessage();*/
    }
}
