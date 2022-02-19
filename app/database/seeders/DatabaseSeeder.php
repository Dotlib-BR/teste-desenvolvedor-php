<?php

namespace Database\Seeders;

use App\Models\Costumer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "email" => "usuario@exemplo.com",
            "password" => Hash::make("12345678")
        ]);

        $products = Product::factory(50)->create();

        Costumer::factory(50)
            ->create()
            ->random(20)
            ->each(function ($costumer) use ($products) {
                $costumer->orders()->saveMany(
                    Order::factory(random_int(1, 5))
                        ->create()
                        ->each(function ($order) use ($products) {
                            $products = $products->random(random_int(1, 10));
                            foreach ($products as $product) {
                                $order->products()->attach($product->id, [
                                    "quantity" => random_int(1, 10)
                                ]);
                            }
                        })
                );
            });

    }
}
