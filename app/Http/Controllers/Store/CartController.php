<?php

namespace AGStore\Http\Controllers\Store;

use AGStore\Helpers\Cart;
use AGStore\Http\Requests;
use Illuminate\Support\Facades\Session;
use AGStore\Http\Controllers\Controller;
use AGStore\Repositories\Contracts\ProductRepositoryInterface;

class CartController extends Controller
{
    private $cart;
    private $product;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart, ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->cart = $cart;
        $this->product = $productRepositoryInterface;
    }

    public function index()
    {
        if (!Session::has('cart')) {
            Session::set('cart', $this->cart);
        }

        return view('store.cart', ['cart' => Session::get('cart')]);
    }

    public function add($id)
    {
        $cart = $this->getCart();
        $produto = $this->product->findProduct($id);
        $image = $produto->images->first()->imageFileName;

        $cart->add($id, $produto->name, $produto->price, $image);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    public function minus($id)
    {
        $cart = $this->getCart();
        $cart->minus($id);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    public function destroy($id)
    {
        $cart = $this->getCart();
        $cart->remove($id);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    private function getCart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = $this->cart;
        }

        return $cart;
    }
}
