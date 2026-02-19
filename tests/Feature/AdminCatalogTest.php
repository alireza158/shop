<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
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

        $this->assertDatabaseHas('categories', ['name' => 'موبایل']);
        $this->assertDatabaseHas('categories', ['name' => 'لپ‌تاپ']);
        $this->assertDatabaseCount('categories', 2);
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

        $this->assertDatabaseHas('products', [
            'name' => 'iPhone 15 Pro Max New',
            'slug' => 'iphone-15-pro-max-new',
        ]);
    }

    public function test_admin_can_create_product_with_uploaded_image(): void
    {
        $file = UploadedFile::fake()->image('phone.jpg');

        $response = $this->post('/admin/products', [
            'name' => 'Test Phone',
            'brand' => 'Test Brand',
            'category' => 'تست',
            'image_file' => $file,
            'price' => '۱۰۰۰',
            'old_price' => '۱۲۰۰',
            'badge' => 'جدید',
            'description' => 'توضیح تست',
            'specs' => "اول\nدوم",
        ]);

        $response->assertRedirect();

        $product = \App\Models\Product::query()->where('name', 'Test Phone')->first();

        $this->assertNotNull($product);
        $this->assertStringStartsWith('/storage/products/', $product->image);

        Storage::disk('public')->assertExists(str_replace('/storage/', '', $product->image));
    }
}
