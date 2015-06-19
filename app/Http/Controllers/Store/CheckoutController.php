<?php

namespace AGStore\Http\Controllers\Store;

use AGStore\Events\CheckoutEvent;
use AGStore\Http\Controllers\Controller;
use AGStore\Http\Requests;
use AGStore\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class CheckoutController extends Controller
{
    protected $car;
    protected $order;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->middleware('auth');

        if (Session::has('cart')) {
            $this->cart = Session::get('cart');
        }

        $this->order = $orderRepositoryInterface;
    }

    public function place(CheckoutService $checkoutService)
    {
        if (!$this->cart->getTotal()) {
            return redirect()->route('cart');
        }

        $data = [
            'user_id' => Auth::User()->id,
            'total' => $this->cart->getTotal()
        ];

        $order = $this->order->insertOrder($data);
        $checkout = $checkoutService->createCheckoutBuilder();

        foreach ($this->cart->all() as $id => $item) {

            $order->items()->create([
                'product_id' => $id,
                'qtde' => $item['qtde'],
                'price' => $item['price']
            ]);

            $checkout->addItem(new Item($id, $item['name'], number_format($item['price'], 2, ".", ""), $item['qtde']));
        }

        $this->cart->clear();

        $response = $checkoutService->checkout($checkout->getCheckout());

        return redirect($response->getRedirectionUrl());


//        return redirect()->route('checkout');

    }

    public function test(CheckoutService $checkoutService)
    {
        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

        return redirect($response->getRedirectionUrl());
    }

    public function checkout()
    {
        event(new CheckoutEvent(Auth::User()));

        $orders = Auth::User()->orders()->get();
        return view('store.checkout', compact('orders'));
    }
}
