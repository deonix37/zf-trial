<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CatalogController extends Controller
{
    public function __invoke()
    {
        return view('catalog', [
            'products' => Product::all(),
        ]);
    }
}
