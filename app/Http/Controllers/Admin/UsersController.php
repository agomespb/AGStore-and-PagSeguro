<?php

namespace AGStore\Http\Controllers\Admin;

use AGStore\Http\Requests\UserRequest;
use AGStore\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

use AGStore\Http\Requests;
use AGStore\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $users;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->users = $userRepositoryInterface;
    }

    public function index()
    {
        $usuarios = $this->users->paginateUser(5);
        return view('user.index', compact('usuarios'));
    }

    public function show($id)
    {
        $usuario = $this->users->findUser($id);
        return view('user.show', compact('usuario'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        $usuario = $this->users->insertUser($request->all());
        return redirect()->route('users');
    }

    public function destroy($id)
    {
        $usuario = $this->users->deleteUser($id);
        return redirect()->route('users');
    }

    public function edit($id)
    {
        $usuario = $this->users->findUser($id);
        return view('user.edit', compact('usuario'));
    }

    public function update(UserRequest $request, $id)
    {
        $this->users->updateUser($id, $request->all());
        return redirect()->route('users');
    }

}
