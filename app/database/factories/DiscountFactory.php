<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bool = $this->faker->boolean();
        return [
            'code' => $this->faker->unique()->lexify("???????"),
            'percent_off' => $bool ? $this->faker->numberBetween(1, 100) : null,
            'value_off' => $bool ? null : $this->faker->numberBetween(10, 150),
        ];
    }
}
