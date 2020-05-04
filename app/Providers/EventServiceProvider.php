<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\Auth\CreateAccount' => [
            'App\Listeners\Auth\CreateAccountProcess',
        ],

        'App\Events\Auth\ForgotPassword' => [
            'App\Listeners\Auth\SendForgotPasswordMessage'
        ],

        'App\Events\Request\BidAccepted' => [
            'App\Listeners\Request\BidAcceptedNotification',
            'App\Listeners\Bid\RejectAllOtherBids',
            'App\Listeners\Order\CreateOrder',

        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
