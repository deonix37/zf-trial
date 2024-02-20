@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<h4 class="mb-3">Total: {{ $orders->pluck('total_cost')->sum() }} ₽</h4>
<div class="row row-cols-2 row-cols-lg-3 g-3">
    @foreach ($orders as $order)
        <div class="col">
            <div class="card h-100">
                <div class="card-header fw-bold">
                    Order #{{ $order->id }}
                    ({{ $order->created_at }})
                </div>
                <ul class="list-group list-group-flush h-100">
                    @foreach ($order->items as $item)
                        <li class="list-group-item">
                            {{ $item->title }}
                            ({{ $item->price }} ₽ × {{ $item->quantity }})
                        </li>
                    @endforeach
                </ul>
                <div class="card-footer">
                    <div>Total: {{ $order->total_cost }} ₽</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
