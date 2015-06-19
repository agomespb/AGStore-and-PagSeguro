<?php

namespace AGStore\Listeners;

use AGStore\Events\CheckoutEvent;
use Illuminate\Support\Facades\Mail;

class SendEmailCheckout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct( )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        $auth = $event->getAuth();
        $order = $auth->orders()->get();

        $data = [
            'auth' => $auth,
            'order' => $order,
        ];

        Mail::send('emails.welcome', $data, function ($message) use ($auth) {
            $message->to($auth->email, $auth->name)->subject('AtelierJa - Informativo');
        });
    }

}
