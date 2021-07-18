<?php

namespace Tests\Feature\Web;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        Parent::setUp();

        $this->seed();
    }

    public function test_orders_page_can_be_loaded()
    {
        $response = $this->get(route('orders.index'));

        $response->assertStatus(200);
    }

    public function test_an_order_can_be_created()
    {
        $order = [
            'sold_at' => '2021-05-25',
            'address' => [
                'cep' => '01001-000',
                'street' => 'Praça da Sé',
                'number' => '123',
                'neighborhood' => 'Sé',
                'city' => 'São Paulo',
                'state' => 'SP'
            ],
            'products' => [
                [
                    'id' => 1,
                    'quantity' => 5,
                    'selling_price' => 1
                ],
                [
                    'id' => 3,
                    'quantity' => 1,
                    'selling_price' => 2
                ]
            ],    
        ];

        $response = $this->post(route('api.orders.store'), $order);

        $response->assertCreated();
        $response->assertRedirect();
    }

    public function test_an_order_can_be_showed()
    {
        $order = Order::find(1);

        $response = $this->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertSee('Order # ' . $order->id);
    }
}
