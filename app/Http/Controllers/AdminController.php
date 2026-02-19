<?php

namespace App\Http\Controllers;

use App\Support\CatalogRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct(private readonly CatalogRepository $catalog)
    {
    }

    public function index()
    {
        $products = $this->catalog->products();
        $categories = $this->catalog->categories();
        $posts = $this->catalog->posts();

        return view('admin.dashboard', compact('products', 'categories', 'posts'));
    }

    public function storeProduct(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'url', 'required_without:image_file'],
            'image_file' => ['nullable', 'image', 'max:5120', 'required_without:image'],
            'price' => ['required', 'string', 'max:255'],
            'old_price' => ['nullable', 'string', 'max:255'],
            'badge' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'specs' => ['required', 'string'],
        ]);

        $validated['image'] = $this->resolveProductImage($request, $validated['image'] ?? null);

        $this->catalog->createProduct($validated);

        return back()->with('status', 'محصول جدید با موفقیت افزوده شد.');
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
            'image' => ['nullable', 'url'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'price' => ['required', 'string', 'max:255'],
            'old_price' => ['nullable', 'string', 'max:255'],
            'badge' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'specs' => ['required', 'string'],
        ]);

        $currentProduct = $this->catalog->findProductBySlug($slug);
        $validated['image'] = $this->resolveProductImage($request, $validated['image'] ?? null, $currentProduct['image'] ?? null);

        $this->catalog->updateProduct($slug, $validated);

        return redirect()->route('admin.index')->with('status', 'اطلاعات محصول با موفقیت بروزرسانی شد.');
    }

    public function storePost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'image' => ['required', 'url'],
        ]);

        $this->catalog->createPost($validated);

        return back()->with('status', 'نوشته جدید بلاگ با موفقیت افزوده شد.');
    }

    public function editPost(string $slug)
    {
        $post = $this->catalog->findPostBySlug($slug);

        abort_unless($post, 404);

        return view('admin.edit-post', compact('post'));
    }

    public function updatePost(Request $request, string $slug): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'image' => ['required', 'url'],
        ]);

        $this->catalog->updatePost($slug, $validated);

        return redirect()->route('admin.index')->with('status', 'نوشته بلاگ با موفقیت بروزرسانی شد.');
    }

    public function destroyPost(string $slug): RedirectResponse
    {
        $this->catalog->deletePost($slug);

        return back()->with('status', 'نوشته بلاگ با موفقیت حذف شد.');
    }

    private function resolveProductImage(Request $request, ?string $imageUrl, ?string $currentImage = null): string
    {
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');

            if ($currentImage && str_starts_with($currentImage, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $currentImage));
            }

            return Storage::url($path);
        }

        if (is_string($imageUrl) && trim($imageUrl) !== '') {
            return trim($imageUrl);
        }

        return $currentImage ?? '';
    }
}
