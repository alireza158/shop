<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCatalogTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
    }

    public function test_admin_dashboard_is_accessible(): void
    {
        $response = $this->get('/admin');

        $response->assertOk();
        $response->assertSee('پنل ادمین فروشگاه');
    }

    public function test_admin_can_update_categories(): void
    {
        $response = $this->from('/admin')->put('/admin/categories', [
            'categories' => "موبایل\nلپ‌تاپ\nموبایل",
        ]);

        $response->assertRedirect('/admin');

        Storage::assertExists('catalog/categories.json');

        $savedCategories = json_decode(Storage::get('catalog/categories.json'), true);

        $this->assertSame(['موبایل', 'لپ‌تاپ'], $savedCategories);
    }

    public function test_admin_can_update_product(): void
    {
        $this->put('/admin/categories', [
            'categories' => "گوشی موبایل\nلپ‌تاپ",
        ]);

        $response = $this->put('/admin/products/iphone-15-pro-max-256', [
            'name' => 'iPhone 15 Pro Max New',
            'brand' => 'Apple',
            'category' => 'گوشی موبایل',
            'image' => 'https://example.com/image.jpg',
            'price' => '۱۰۰',
            'old_price' => '۱۲۰',
            'badge' => 'جدید',
            'description' => 'توضیح نمونه',
            'specs' => "مشخصه ۱\nمشخصه ۲",
        ]);

        $response->assertRedirect('/admin');

        $products = collect(json_decode(Storage::get('catalog/products.json'), true));

        $updated = $products->firstWhere('name', 'iPhone 15 Pro Max New');

        $this->assertNotNull($updated);
        $this->assertSame('iphone-15-pro-max-new', $updated['slug']);
        $this->assertSame(['مشخصه ۱', 'مشخصه ۲'], $updated['specs']);
    }
}
