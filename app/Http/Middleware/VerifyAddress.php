<?php

namespace AGStore\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class VerifyAddress
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {

            $address = $this->auth->user()->enderecos()->get();

            if (!count($address)) {
                return redirect()->route('user_address_create');
            }
        }

        return $next($request);
    }
}
