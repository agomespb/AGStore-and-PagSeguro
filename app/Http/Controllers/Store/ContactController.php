<?php

namespace AGStore\Http\Controllers\Store;

use AGStore\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Http\Request;

use AGStore\Http\Requests;
use AGStore\Http\Controllers\Controller;
use AGStore\Http\Requests\ContactRequest;

class ContactController extends Controller
{

    protected $contact;

    public function __construct(ContactRepositoryInterface $contactRepositoryInterface)
    {
        $this->contact = $contactRepositoryInterface;
    }

    /**
     * Show the contact application.
     *
     * @return Response
     */
    public function getContact()
    {
        return view('user.contact');
    }

    public function postContact(ContactRequest $request)
    {
        $this->contact->insertContact($request->all());

        set_flash_message('success', 'Agradecemos seu contanto! Uma cópia foi enviada para o e-mail informado.');
        return redirect()->route('contact');
    }
}
