<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Client;
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
        $client_count = Client::count();
        $status = OrderStatus::getValues();
        return [
            'client_id' => $this->faker->numberBetween(1, $client_count),
            'status' => $this->faker->randomElement($status),
            'ordered_at' => now(),
        ];
    }
}
