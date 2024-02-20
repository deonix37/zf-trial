<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cart,
    ) {}

    public function index()
    {
        return view('cart', [
            'items' => $this->cart->getItems(),
            'totalCost' => $this->cart->getTotalCost(),
        ]);
    }

    public function addProduct(Request $request)
    {
        $product = $this->cart->addProduct(
            $request->post('id'),
            $request->post('quantity')
        );

        return back()->with(
            'message',
            "Added \"$product->title\" to cart"
        );
    }

    public function removeProduct(Request $request)
    {
        $product = $this->cart->removeProduct(
            $request->post('id'),
            $request->post('quantity')
        );

        return back()->with(
            'message',
            "Removed \"$product->title\" from cart"
        );
    }
}
