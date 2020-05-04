<?php

namespace App\Listeners\Auth;

use App\Events\Auth\CreateAccount;
use App\Services\SMSService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationCode
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
        /*
         * @todo
         * Queue sms sending...
         * */
        /*$name = $event->user->firstName;
        $code = $event->user->otp->token;*/
        //$contact = $event->user->contact;

        //$message = "Hi {$event->user->firstName}, your verification code is {$event->user->otp->token}";

        /*$smsResponse = new SMSService('233241441749' , 'hey there');

        $smsResponse->sendMessage();*/
    }
}
