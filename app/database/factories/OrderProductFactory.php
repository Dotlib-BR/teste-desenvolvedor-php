<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => $this->faker->unique()->numberBetween(1, Order::count()),
            'product_id' => $this->faker->numberBetween(1, Product::count()),
            'quantity' => $this->faker->randomNumber(2),
            'unit_price' => $this->faker->randomNumber(3),
        ];
    }
}
