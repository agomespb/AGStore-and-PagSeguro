<?php

namespace AGStore\Events;

use AGStore\User;
use Illuminate\Queue\SerializesModels;

class CheckoutEvent extends Event
{
    use SerializesModels;

    protected $auth;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->auth = $user;
//        dd('Estou em CheckoutEvent -> __construct'); // Funciona! Tá chegando aqui.
    }

    /**
     * @return User
     */
    public function getAuth()
    {
        return $this->auth;
    }
}
