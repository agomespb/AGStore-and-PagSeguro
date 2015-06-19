<?php


namespace AGStore\Http\Controllers\User;

use AGStore\Http\Controllers\Controller;
use AGStore\Http\Requests;
use AGStore\Http\Requests\AddressRequest;
use AGStore\Repositories\Contracts\AddressRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    protected $auth;
    protected $address;

    public function __construct(AddressRepositoryInterface $address)
    {
        $this->address = $address;
    }

    /**
     * Exibe formulário para o usuário registrar seu(s) endereço(s)
     *
     * @return Response
     */
    public function create()
    {
        $partial = 'form-endereco';
        return view('user.account', compact('partial'));
    }

    /**
     * Grava o endereço do usuário
     *
     * @return Response
     */
    public function store(AddressRequest $request)
    {
        $Inputs = $request->all();
        $Inputs['user_id'] = Auth::User()->id;

        $endereco = $this->address->insertAddress($Inputs);

        return redirect()->route('user_index');
    }

    /**
     * Exclui o endereço especifica pelo id.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $address = $this->address->deleteAddress($id);
        return redirect()->route('user_index');
    }
}
