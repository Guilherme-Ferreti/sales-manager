<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(15)->has(Supplier::factory(2))->create();
        
        $orders = Order::factory(5)->has(Address::factory())->create();

        foreach ($orders as $order) {
            $products->random(3)->each(fn ($product) =>
                $order->products()->attach($product->id, [
                    'quantity' => rand(1, 5),
                    'selling_price' => rand(1, 5000) / 10,
                ])
            );
        }
    }
}
