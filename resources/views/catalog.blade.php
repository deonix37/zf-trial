@extends('layouts.app')

@section('title', 'Catalog')

@section('content')
<div class="row row-cols-2 row-cols-lg-3 g-3">
    @foreach ($products as $product)
        <div class="col">
            <div class="card h-100">
                <div class="card-header fw-bold">{{ $product->title }}</div>
                <div class="card-body">Price: {{ $product->price }} ₽</div>
                <form class="card-footer" action="{{ route('cart.add-product') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <button class="btn btn-primary">Add to cart</button>
                        <input class="form-control" name="quantity" type="number" value="1" min="1">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
