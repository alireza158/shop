<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        $products = config('products.items', []);

        return view('welcome', compact('products'));
    }

    public function show(string $slug)
    {
        $products = collect(config('products.items', []));

        $product = $products->firstWhere('slug', $slug);

        abort_unless($product, 404);

        $relatedProducts = $products
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
