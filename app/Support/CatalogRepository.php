<?php

namespace App\Support;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CatalogRepository
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function products(): array
    {
        $this->seedProductsIfNeeded();

        return Product::query()
            ->with('category')
            ->latest('id')
            ->get()
            ->map(fn (Product $product) => $this->mapProduct($product))
            ->all();
    }

    /**
     * @return array<int, string>
     */
    public function categories(): array
    {
        $this->seedProductsIfNeeded();

        return Category::query()
            ->orderBy('name')
            ->pluck('name')
            ->all();
    }

    /**
     * @param array<int, string> $categories
     */
    public function saveCategories(array $categories): void
    {
        $cleaned = collect($categories)
            ->map(fn ($category) => trim((string) $category))
            ->filter()
            ->unique()
            ->values();

        Category::query()->whereNotIn('name', $cleaned->all())->delete();

        $cleaned->each(function (string $name): void {
            Category::query()->firstOrCreate(['name' => $name]);
        });
    }

    /**
     * @return array<int, array<string, string>>
     */
    public function posts(): array
    {
        $this->seedPostsIfNeeded();

        return Post::query()
            ->latest('id')
            ->get()
            ->map(fn (Post $post) => $this->mapPost($post))
            ->all();
    }

    /**
     * @param array<string, mixed> $payload
     */
    public function createProduct(array $payload): void
    {
        $this->seedProductsIfNeeded();

        $name = trim((string) $payload['name']);
        $baseSlug = Str::slug($name);
        $existingSlugs = Product::query()->pluck('slug')->all();
        $slug = $this->generateUniqueSlug($baseSlug, $existingSlugs);

        $category = $this->resolveCategory((string) $payload['category']);

        Product::query()->create([
            'slug' => $slug,
            'name' => $name,
            'brand' => trim((string) $payload['brand']),
            'category_id' => $category?->id,
            'image' => trim((string) $payload['image']),
            'price' => trim((string) $payload['price']),
            'old_price' => trim((string) ($payload['old_price'] ?? '')),
            'badge' => trim((string) $payload['badge']),
            'description' => trim((string) $payload['description']),
            'specs' => $this->normalizeSpecs((string) $payload['specs']),
        ]);
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findProductBySlug(string $slug): ?array
    {
        $this->seedProductsIfNeeded();

        $product = Product::query()->with('category')->where('slug', $slug)->first();

        return $product ? $this->mapProduct($product) : null;
    }

    /**
     * @param array<string, mixed> $payload
     */
    public function updateProduct(string $slug, array $payload): void
    {
        $this->seedProductsIfNeeded();

        $product = Product::query()->where('slug', $slug)->first();

        if (! $product) {
            return;
        }

        $name = trim((string) $payload['name']);
        $baseSlug = Str::slug($name);
        $existingSlugs = Product::query()->where('slug', '!=', $slug)->pluck('slug')->all();
        $newSlug = $this->generateUniqueSlug($baseSlug, $existingSlugs);
        $category = $this->resolveCategory((string) $payload['category']);

        $product->update([
            'name' => $name,
            'slug' => $newSlug,
            'brand' => trim((string) $payload['brand']),
            'category_id' => $category?->id,
            'image' => trim((string) $payload['image']),
            'price' => trim((string) $payload['price']),
            'old_price' => trim((string) ($payload['old_price'] ?? '')),
            'badge' => trim((string) $payload['badge']),
            'description' => trim((string) $payload['description']),
            'specs' => $this->normalizeSpecs((string) $payload['specs']),
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection<int, array<string, mixed>>
     */
    public function relatedProducts(string $slug, int $limit = 3): Collection
    {
        $this->seedProductsIfNeeded();

        return Product::query()
            ->with('category')
            ->where('slug', '!=', $slug)
            ->latest('id')
            ->take($limit)
            ->get()
            ->map(fn (Product $product) => $this->mapProduct($product));
    }

    /**
     * @return array<string, string>|null
     */
    public function findPostBySlug(string $slug): ?array
    {
        $this->seedPostsIfNeeded();

        $post = Post::query()->where('slug', $slug)->first();

        return $post ? $this->mapPost($post) : null;
    }

    /** @param array<string, mixed> $payload */
    public function createPost(array $payload): void
    {
        $this->seedPostsIfNeeded();

        $title = trim((string) $payload['title']);
        $baseSlug = Str::slug($title);
        $existingSlugs = Post::query()->pluck('slug')->all();
        $slug = $this->generateUniqueSlug($baseSlug, $existingSlugs);

        Post::query()->create([
            'slug' => $slug,
            'title' => $title,
            'category' => trim((string) $payload['category']),
            'excerpt' => trim((string) $payload['excerpt']),
            'image' => trim((string) $payload['image']),
        ]);
    }

    /** @param array<string, mixed> $payload */
    public function updatePost(string $slug, array $payload): void
    {
        $post = Post::query()->where('slug', $slug)->first();

        if (! $post) {
            return;
        }

        $title = trim((string) $payload['title']);
        $baseSlug = Str::slug($title);
        $existingSlugs = Post::query()->where('slug', '!=', $slug)->pluck('slug')->all();
        $newSlug = $this->generateUniqueSlug($baseSlug, $existingSlugs);

        $post->update([
            'slug' => $newSlug,
            'title' => $title,
            'category' => trim((string) $payload['category']),
            'excerpt' => trim((string) $payload['excerpt']),
            'image' => trim((string) $payload['image']),
        ]);
    }

    public function deletePost(string $slug): void
    {
        Post::query()->where('slug', $slug)->delete();
    }

    private function seedProductsIfNeeded(): void
    {
        if (Product::query()->exists()) {
            return;
        }

        collect(config('products.items', []))->each(function (array $item): void {
            $category = $this->resolveCategory((string) ($item['category'] ?? ''));

            Product::query()->create([
                'slug' => (string) ($item['slug'] ?? Str::slug((string) ($item['name'] ?? 'item'))),
                'name' => (string) ($item['name'] ?? ''),
                'brand' => (string) ($item['brand'] ?? ''),
                'category_id' => $category?->id,
                'image' => (string) ($item['image'] ?? ''),
                'price' => (string) ($item['price'] ?? ''),
                'old_price' => (string) ($item['old_price'] ?? ''),
                'badge' => (string) ($item['badge'] ?? ''),
                'description' => (string) ($item['description'] ?? ''),
                'specs' => collect($item['specs'] ?? [])->filter()->values()->all(),
            ]);
        });
    }

    private function seedPostsIfNeeded(): void
    {
        if (Post::query()->exists()) {
            return;
        }

        collect(config('blog.posts', []))->each(function (array $item): void {
            $title = trim((string) ($item['title'] ?? ''));

            Post::query()->create([
                'slug' => (string) ($item['slug'] ?? Str::slug($title !== '' ? $title : 'post')),
                'title' => $title,
                'category' => trim((string) ($item['category'] ?? '')),
                'excerpt' => trim((string) ($item['excerpt'] ?? '')),
                'image' => trim((string) ($item['image'] ?? '')),
            ]);
        });
    }

    /**
     * @return array<int, string>
     */
    private function normalizeSpecs(string $specs): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $specs) ?: [])
            ->map(fn ($spec) => trim($spec))
            ->filter()
            ->values()
            ->all();
    }

    /** @param array<int, mixed> $existingSlugs */
    private function generateUniqueSlug(string $baseSlug, array $existingSlugs): string
    {
        $normalizedBase = $baseSlug !== '' ? $baseSlug : 'item';
        $slug = $normalizedBase;
        $counter = 1;

        while (in_array($slug, $existingSlugs, true)) {
            $counter++;
            $slug = sprintf('%s-%d', $normalizedBase, $counter);
        }

        return $slug;
    }

    private function resolveCategory(string $name): ?Category
    {
        $cleanedName = trim($name);

        if ($cleanedName === '') {
            return null;
        }

        return Category::query()->firstOrCreate(['name' => $cleanedName]);
    }

    /**
     * @return array<string, mixed>
     */
    private function mapProduct(Product $product): array
    {
        return [
            'slug' => $product->slug,
            'name' => $product->name,
            'brand' => $product->brand,
            'category' => $product->category?->name ?? '',
            'image' => $product->image,
            'price' => $product->price,
            'old_price' => $product->old_price ?? '',
            'badge' => $product->badge,
            'description' => $product->description,
            'specs' => collect($product->specs)->filter()->values()->all(),
        ];
    }

    /**
     * @return array<string, string>
     */
    private function mapPost(Post $post): array
    {
        return [
            'slug' => $post->slug,
            'title' => $post->title,
            'category' => $post->category,
            'excerpt' => $post->excerpt,
            'image' => $post->image,
        ];
    }
}
