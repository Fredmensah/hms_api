<?php

namespace App\Listeners\Auth;

use App\Events\Auth\ForgotPassword;
use App\Models\User\PasswordReset;
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendForgotPasswordMessage
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
     * @param  ForgotPassword  $event
     * @return void
     */
    public function handle(ForgotPassword $event)
    {
        $tokenUser = PasswordReset::create([
            "contact" => $event->user->contact,
            "token" => random_code(),
            "created_at" => Carbon::now()->toDateTimeString()
        ]);

        $code = $tokenUser->token;

        $contact = $event->user->contact;

        $message = "Hi {$event->user->firstName}, your reset password code is {$code}";

        $smsResponse = new SMSService($contact , $message);

        $smsResponse->sendMessage();
    }
}
