<?php

namespace AGStore\Http\Controllers\Admin;

use AGStore\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

use AGStore\Http\Requests;
use AGStore\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class OrdersController extends Controller
{
    protected $orders;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orders = $orderRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = $this->orders->paginateOrder(10);
        return view('pedido.index', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $message = "Status modificado com Sucesso. ID: {$id}";
        $this->orders->updateOrder($id, $request->all());
        return Response::json($message, 200);
    }
}
