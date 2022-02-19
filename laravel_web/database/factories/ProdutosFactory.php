<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutosFactory extends Factory
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
            'cod_barras' => $this->faker->isbn13(),
            'nome' => $this->faker->randomElement($array),
            'valor' => $this->faker->randomFloat(1, 25, 250),
            'quantidade' => $this->faker->numberBetween(1, 90),
            'status' => $this->faker->numberBetween(0, 1)
        ];
    }
}
