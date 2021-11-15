<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VagaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipoAlocacao = ['Home office','Híbrido','Presencial'];

        return
        [
            'titulo'=> 'Desenvolvedor PHP Pleno '.rand(1,100),
            'descricao'=> $this->faker->paragraph(),
            'requisito_obrigatorio'=> $this->faker->paragraph(),
            'requisito_diferencial'=> $this->faker->paragraph(),
            'beneficios'=> $this->faker->paragraph(),
            'salario'=> rand(4000,6000),
            'alocacao'=> $tipoAlocacao[rand(0,2)],
            'tipo_contratacao_id'=> rand(1,3)
        ];
    }
}
