<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nome_produto = $this->faker->unique()->words($nb=4,$asText=true);
        $slug = Str::slug($nome_produto);
        return [
            'nome_produto' => $nome_produto,
            'slug' => $slug,
            'descricao' => $this->faker->text(200),
            'valor_unitario' => $this->faker->numberBetween(10,500),
            'sku' => 'FAKE-'.$this->faker->unique()->numberBetween(100,500),
            'cod_barras' =>$this->faker->unique()->numberBetween(1000,5000),
            'status_estoque'=>'disponivel',
            'quantidade_estoque' =>$this->faker->numberBetween(50,100),
            'imagem' => 'produto'.$this->faker->numberBetween(1,8).'.jpg',
            'categoria_id' => $this->faker->numberBetween(1,5)
            //lembrar de colocar numberBetween(1,5) em categoria_id, quando for uma nova instalação
            //old - 27,31
        ];
    }
}
