<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array = [
            'Bom Bril', 'Leite Ninho', 'Chiclete', 'Band-Aid', 'Gillette',
            'Leite Moça', 'Miojo', 'Isopor', 'Cotonetes', 'Xerox',
            'Cândida', 'Durex', 'Maizena', 'Yakult', 'Sucrilhos',
            'Danone', 'Pó Royal', 'Nescau', 'Toddy', 'Catupiry',
            'Caldo Knor', 'SuperBonder', 'Toddynho', 'Pão Pullman', 'Comfort',
            'Zíper', 'Coca-Cola', 'Suco Tang', 'Monitor', 'Mouse',
        ];
        return [
            'cod_bars' => $this->faker->isbn10(),
            'name' => $this->faker->randomElement($array),
            'value' => $this->faker->randomFloat(2, 500, 2000),
            'amount' => $this->faker->numberBetween(1, 90),
            'stats' => $this->faker->numberBetween(0, 1)
        ];
    }
}
