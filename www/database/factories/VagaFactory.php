<?php

namespace Database\Factories;

use App\Models\Vaga;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VagaFactory extends Factory
{

    protected $model = Vaga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(25);

        return [
            'slug' => Str::slug($title),
            'titulo' => $title,
            'descricao' => '<p>'.$this->faker->text(1000).'</p>',
            'nivel' => $this->faker->randomElement(['junior', 'pleno', 'senior']),
            'categoria' => $this->faker->randomElement(['CLT', 'PJ', 'Freelancer']),
            'regime' => $this->faker->randomElement(['remoto', 'presencial']),
            'salario' => $this->faker->randomFloat(2, 2500, 10000),
            'is_paused' => $this->faker->numberBetween(0,1),
        ];
    }
}
