<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderService extends Model
{
    public function __construct(
        protected CartService $cart,
    ) {}

    public function createOrder(Request $request): Order
    {
        return DB::transaction(function () use ($request) {
            $cartItems = $this->cart->getItems();
            $totalCost = $this->cart->getTotalCost();

            $order = new Order(['total_cost' => $totalCost]);
            $order->customer()->associate($request->user());
            $order->save();
            $order->items()->createMany(
                $cartItems->map(function ($cartItem) {
                    return [
                        'title' => $cartItem['title'],
                        'price' => $cartItem['price'],
                        'quantity' => $cartItem['quantity'],
                    ];
                })
            );

            $this->cart->clear();

            return $order;
        });
    }
}
