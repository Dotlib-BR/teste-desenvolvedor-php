<?php

namespace Database\Factories;

use App\Models\Tecnologia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TecnologiaFactory extends Factory
{

    protected $model = Tecnologia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $tag = $this->faker->unique()->randomElement(['JAVA', 'PHP', 'LARAVEL', 'C/C++', 'C#', 'JAVASCRIPT', 'REACT', 'REACT NATIVE', 'VUEJS', 'ANGULAR', 'NEXTJS', 'AMAZON AWS', 'MS AZURE', 'GOOGLE CLOUD', 'FIREBASE', 'QUASAR', 'GRAPHQL', 'NODEJS', 'CSS', 'SASS', 'SCSS']);

        return [
            'nome' => $tag,
            'slug' => Str::slug($tag),
        ];
    }
}
