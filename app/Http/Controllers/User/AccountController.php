<?php

namespace AGStore\Http\Controllers\User;

use AGStore\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use AGStore\Http\Controllers\Controller;

class AccountController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = [];
        $auth = $this->auth->user();
        $orders = $auth->orders()->orderBy('created_at', 'desc')->get();

        if (count($orders)) {
            $items = $orders->first()->items()->get();
        }

        return view('user.account', compact('auth', 'orders', 'items'));
    }
}
