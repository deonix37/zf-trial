@extends('layouts.app')

@section('title', 'Cart')

@section('content')
@if ($items)
    <div class="row row-cols-2 row-cols-lg-3 g-3">
        @foreach ($items as $item)
            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        {{ $item['title'] }}
                        (x{{ $item['quantity']}})
                    </div>
                    <div class="card-body">Price: {{ $item['price'] }} ₽</div>
                    <form class="card-footer" action="{{ route('cart.remove-product') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger">Remove</button>
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-3 h4">Total: {{ $totalCost }} ₽</div>
    <form class="mt-3" action="{{ route('orders.store') }}" method="POST">
        @csrf
        <button class="btn btn-lg btn-primary">Place order</button>
    </form>
@else
    <div>Empty</div>
@endif
@endsection
