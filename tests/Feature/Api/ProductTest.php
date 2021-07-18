<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        Parent::setUp();

        $this->seed();
    }

    public function test_products_can_be_searched()
    {
        $product = Product::with('suppliers')->find(1);

        $response = $this->get(route('api.products.index', ['search' => $product->name]));

        $response->assertStatus(200);
        $response->assertJson(['data' => [$product->toArray()]]);
    }
}
