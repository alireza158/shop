<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogRepository
{
    private string $productsPath = 'catalog/products.json';

    private string $categoriesPath = 'catalog/categories.json';

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
}
