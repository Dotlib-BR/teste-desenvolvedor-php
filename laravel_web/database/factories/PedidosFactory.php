<?php

namespace Database\Factories;

use App\Models\Clientes;
use App\Models\Pedidos;
use App\Models\Produtos;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidosFactory extends Factory
{
    protected $model = Pedidos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $produto_id = Produtos::pluck('id')->random();
        $cliente_id = Clientes::pluck('id')->random();

        $quantidade = $this->faker->numberBetween(1, 10);
        while ($quantidade > Produtos::where('id', $produto_id)->pluck('quantidade')->first()) {
            $quantidade = $this->faker->numberBetween(1, 10);
        }

        $valor_un_produto = Produtos::where('id', $produto_id)->pluck('valor')->first();
        
        return [
            'cliente_id' => $cliente_id,
            'produto_id' => $produto_id,

            'nome_cliente' => Clientes::where('id', $cliente_id)->pluck('nome')->first(),
            'cpf_cliente' => Clientes::where('id', $cliente_id)->pluck('cpf')->first(),
            'email_cliente' => Clientes::where('id', $cliente_id)->pluck('email')->first(),
            'cod_barras_produto' => Produtos::where('id', $produto_id)->pluck('cod_barras')->first(),
            'nome_produto' => Produtos::where('id', $produto_id)->pluck('nome')->first(),
            'valor_un_produto' => Produtos::where('id', $produto_id)->pluck('valor')->first(),

            'quantidade' => $quantidade,
            'valor_total' => $quantidade * $valor_un_produto,
            'data_pedido' => $this->faker->dateTime(),
            'status' => $this->faker->numberBetween(0, 2),
        ];
    }
}
