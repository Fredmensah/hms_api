<?php

namespace App\Listeners\Auth;

use App\Events\Auth\CreateAccount;
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

        $code = $tokenUser->token;

        $contact = $event->user->contact;

        $message = "Hi {$event->user->firstName}, your verification code is {$code}";

        $smsResponse = new SMSService($contact , $message);

        $smsResponse->sendMessage();
    }
}
