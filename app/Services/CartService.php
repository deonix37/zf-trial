<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CartService extends Model
{
    public function addProduct(int $productId, int $quantity): Product
    {
        $product = Product::findOrFail($productId);

        if ($quantity < 1) {
            abort(400, 'Bad quantity');
        }

        $items = session('cart.products', []);
        $items[$product->id] = ($items[$product->id] ?? 0) + $quantity;

        session(['cart.products' => $items]);

        return $product;
    }

    public function removeProduct(int $productId): Product
    {
        $product = Product::findOrFail($productId);

        $cartProducts = session('cart.products', []);
        unset($cartProducts[$product->id]);

        session(['cart.products' => $cartProducts]);

        return $product;
    }

    public function clear(): void
    {
        session(['cart.products' => []]);
    }

    public function getItems(): Collection
    {
        $cartData = session('cart.products', []);

        return Product::whereIn('id', array_keys($cartData))
            ->get()
            ->map(function ($product) use ($cartData) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $cartData[$product->id],
                ];
            })
            ->collect();
    }

    public function getTotalCost(): int
    {
        return $this->getItems()->reduce(function ($result, $item) {
            return $result + $item['price'] * $item['quantity'];
        }, 0);
    }
}
