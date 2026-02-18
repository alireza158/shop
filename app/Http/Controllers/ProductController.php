<?php

namespace App\Http\Controllers;

use App\Support\CatalogRepository;

class ProductController extends Controller
{
    public function __construct(private readonly CatalogRepository $catalog)
    {
    }

    public function index()
    {
        $products = $this->catalog->products();
        $categories = $this->catalog->categories();
        $posts = $this->catalog->posts();

        return view('welcome', compact('products', 'categories', 'posts'));
    }

    public function show(string $slug)
    {
        $product = $this->catalog->findProductBySlug($slug);

        abort_unless($product, 404);

        $relatedProducts = $this->catalog->relatedProducts($slug);
        $categories = $this->catalog->categories();

        return view('products.show', compact('product', 'relatedProducts', 'categories'));
    }
}
