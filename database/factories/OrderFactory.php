<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::all()->pluck('id')->random();
        $client = Client::all()->pluck('id')->random();
       
        return [
            'client_id' => $client,
            'product_id' => $product,
            'amount' => $this->faker->numberBetween(1,5)
        ];
    }
}
