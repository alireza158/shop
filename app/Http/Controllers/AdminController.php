<?php

namespace App\Http\Controllers;

use App\Support\CatalogRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(private readonly CatalogRepository $catalog)
    {
    }

    public function index()
    {
        $products = $this->catalog->products();
        $categories = $this->catalog->categories();

        return view('admin.dashboard', compact('products', 'categories'));
    }

    public function updateCategories(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'categories' => ['nullable', 'string'],
        ]);

        $categories = preg_split('/\r\n|\r|\n/', (string) ($validated['categories'] ?? '')) ?: [];

        $this->catalog->saveCategories($categories);

        return back()->with('status', 'دسته‌بندی‌ها با موفقیت ذخیره شدند.');
    }

    public function editProduct(string $slug)
    {
        $product = $this->catalog->findProductBySlug($slug);
        $categories = $this->catalog->categories();

        abort_unless($product, 404);

        return view('admin.edit-product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, string $slug): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'image' => ['required', 'url'],
            'price' => ['required', 'string', 'max:255'],
            'old_price' => ['required', 'string', 'max:255'],
            'badge' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'specs' => ['required', 'string'],
        ]);

        $this->catalog->updateProduct($slug, $validated);

        return redirect()->route('admin.index')->with('status', 'اطلاعات محصول با موفقیت بروزرسانی شد.');
    }
}
