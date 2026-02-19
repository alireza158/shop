<?php

namespace App\Support;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogRepository
{
    private string $postsPath = 'catalog/posts.json';

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
        if (! Storage::exists($this->postsPath)) {
            $this->seedPosts();
        }

        $posts = json_decode(Storage::get($this->postsPath), true);

        return collect(is_array($posts) ? $posts : [])
            ->filter(fn ($post) => is_array($post) && ! empty($post['title']))
            ->values()
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
        return collect($this->posts())->firstWhere('slug', $slug);
    }

    /** @param array<string, mixed> $payload */
    public function createPost(array $payload): void
    {
        $posts = $this->posts();
        $title = trim((string) $payload['title']);

        $baseSlug = Str::slug($title);
        $existingSlugs = collect($posts)->pluck('slug')->filter()->all();
        $slug = $this->generateUniqueSlug($baseSlug, $existingSlugs);

        $posts[] = [
            'slug' => $slug,
            'title' => $title,
            'category' => trim((string) $payload['category']),
            'excerpt' => trim((string) $payload['excerpt']),
            'image' => trim((string) $payload['image']),
        ];

        Storage::put($this->postsPath, json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    /** @param array<string, mixed> $payload */
    public function updatePost(string $slug, array $payload): void
    {
        $posts = collect($this->posts());
        $title = trim((string) $payload['title']);
        $baseSlug = Str::slug($title);
        $existingSlugs = $posts->where('slug', '!=', $slug)->pluck('slug')->filter()->all();
        $newSlug = $this->generateUniqueSlug($baseSlug, $existingSlugs);

        $updatedPosts = $posts
            ->map(function ($post) use ($slug, $payload, $title, $newSlug) {
                if (($post['slug'] ?? null) !== $slug) {
                    return $post;
                }

                return [
                    ...$post,
                    'slug' => $newSlug,
                    'title' => $title,
                    'category' => trim((string) $payload['category']),
                    'excerpt' => trim((string) $payload['excerpt']),
                    'image' => trim((string) $payload['image']),
                ];
            })
            ->values()
            ->all();

        Storage::put($this->postsPath, json_encode($updatedPosts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function deletePost(string $slug): void
    {
        $posts = collect($this->posts())
            ->reject(fn ($post) => ($post['slug'] ?? null) === $slug)
            ->values()
            ->all();

        Storage::put($this->postsPath, json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
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

    private function seedPosts(): void
    {
        Storage::put(
            $this->postsPath,
            json_encode(config('blog.posts', []), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
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
}
