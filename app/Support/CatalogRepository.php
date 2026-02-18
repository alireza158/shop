<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogRepository
{
    private string $productsPath = 'catalog/products.json';

    private string $categoriesPath = 'catalog/categories.json';

    private string $postsPath = 'catalog/posts.json';

    /**
     * @return array<int, array<string, mixed>>
     */
    public function products(): array
    {
        if (! Storage::exists($this->productsPath)) {
            $this->seedProducts();
        }

        $products = json_decode(Storage::get($this->productsPath), true);

        return is_array($products) ? $products : [];
    }

    /**
     * @return array<int, string>
     */
    public function categories(): array
    {
        if (! Storage::exists($this->categoriesPath)) {
            $this->seedCategories();
        }

        $categories = json_decode(Storage::get($this->categoriesPath), true);

        return collect(is_array($categories) ? $categories : [])
            ->filter(fn ($category) => is_string($category) && $category !== '')
            ->values()
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
            ->values()
            ->all();

        Storage::put($this->categoriesPath, json_encode($cleaned, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
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
        $name = trim((string) $payload['name']);
        $products = $this->products();

        $baseSlug = Str::slug($name);
        $existingSlugs = collect($products)->pluck('slug')->filter()->all();
        $slug = $this->generateUniqueSlug($baseSlug, $existingSlugs);

        $products[] = [
            'slug' => $slug,
            'name' => $name,
            'brand' => trim((string) $payload['brand']),
            'category' => trim((string) $payload['category']),
            'image' => trim((string) $payload['image']),
            'price' => trim((string) $payload['price']),
            'old_price' => trim((string) ($payload['old_price'] ?? '')),
            'badge' => trim((string) $payload['badge']),
            'description' => trim((string) $payload['description']),
            'specs' => $this->normalizeSpecs((string) $payload['specs']),
        ];

        Storage::put($this->productsPath, json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findProductBySlug(string $slug): ?array
    {
        return collect($this->products())->firstWhere('slug', $slug);
    }

    /**
     * @param array<string, mixed> $payload
     */
    public function updateProduct(string $slug, array $payload): void
    {
        $products = collect($this->products())
            ->map(function ($product) use ($slug, $payload) {
                if (($product['slug'] ?? null) !== $slug) {
                    return $product;
                }

                $name = trim((string) $payload['name']);

                return [
                    ...$product,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'brand' => trim((string) $payload['brand']),
                    'category' => trim((string) $payload['category']),
                    'image' => trim((string) $payload['image']),
                    'price' => trim((string) $payload['price']),
                    'old_price' => trim((string) $payload['old_price']),
                    'badge' => trim((string) $payload['badge']),
                    'description' => trim((string) $payload['description']),
                    'specs' => $this->normalizeSpecs((string) $payload['specs']),
                ];
            })
            ->values()
            ->all();

        Storage::put($this->productsPath, json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    /**
     * @return \Illuminate\Support\Collection<int, array<string, mixed>>
     */
    public function relatedProducts(string $slug, int $limit = 3): Collection
    {
        return collect($this->products())
            ->where('slug', '!=', $slug)
            ->take($limit)
            ->values();
    }

    /**
     * @return array<string, string>|null
     */
    public function findPostBySlug(string $slug): ?array
    {
        return collect($this->posts())->firstWhere('slug', $slug);
    }

    /**
     * @param array<string, mixed> $payload
     */
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

    /**
     * @param array<string, mixed> $payload
     */
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

    private function seedProducts(): void
    {
        Storage::put(
            $this->productsPath,
            json_encode(config('products.items', []), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
    }

    private function seedCategories(): void
    {
        $categories = collect(config('products.items', []))
            ->pluck('category')
            ->filter()
            ->unique()
            ->values()
            ->all();

        Storage::put($this->categoriesPath, json_encode($categories, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
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

    /**
     * @param array<int, mixed> $existingSlugs
     */
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
}
