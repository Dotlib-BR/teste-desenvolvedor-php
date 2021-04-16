<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class CategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nome_categoria = $this->faker->unique()->words($nb=2,$asText=true);
        $slug = Str::slug($nome_categoria);
        return [
            'name'=> $nome_categoria,
            'slug' =>$slug
        ];
    }
}
