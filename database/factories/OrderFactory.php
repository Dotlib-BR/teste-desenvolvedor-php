<?php

namespace Database\Factories;

use App\Models\{Customer, Product};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'id_customer' => $this->faker->randomElement(Customer::all()->pluck('id')),
            'id_product' => $this->faker->randomElement(Product::all()->pluck('id')),
        ];
    }
}
