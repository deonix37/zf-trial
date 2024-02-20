<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
    ) {}

    public function index(Request $request)
    {
        return view('orders.index', [
            'orders' => Order::whereRelation(
                'customer',
                'id',
                $request->user()->id
            )->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $order = $this->orderService->createOrder($request);

        return to_route('orders.index')->with(
            'message',
            "Placed new order #$order->id"
        );
    }
}
