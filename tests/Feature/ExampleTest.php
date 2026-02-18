<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_page_loads_products(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('پرفروش‌ترین محصولات');
        $response->assertSee('مشاهده جزئیات محصول');
    }

    public function test_product_details_page_is_accessible(): void
    {
        $response = $this->get('/products/iphone-15-pro-max-256');

        $response->assertOk();
        $response->assertSee('iPhone 15 Pro Max 256GB');
        $response->assertSee('مشخصات کلیدی');
    }

    public function test_product_page_returns_404_for_invalid_slug(): void
    {
        $response = $this->get('/products/not-found');

        $response->assertNotFound();
    }
}
