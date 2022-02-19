<?php

namespace Database\Factories;

use App\Models\Clients;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_id = Products::pluck('id')->random();
        $client_id = Clients::pluck('id')->random();

        $amount = $this->faker->numberBetween(1, 10);
        while ($amount > Products::where('id', $product_id)->pluck('amount')->first()) {
            $amount = $this->faker->numberBetween(1, 10);
        }

        $value_un_product = Products::where('id', $product_id)->pluck('value')->first();
        
        return [
            'client_id' => $client_id,
            'product_id' => $product_id,

            'name_client' => Clients::where('id', $client_id)->pluck('name')->first(),
            'email_client' => Clients::where('id', $client_id)->pluck('email')->first(),
            'cpf_client' => Clients::where('id', $client_id)->pluck('cpf')->first(),
            'cod_bars_product' => Products::where('id', $product_id)->pluck('cod_bars')->first(),
            'name_product' => Products::where('id', $product_id)->pluck('name')->first(),
            'value_un_product' => Products::where('id', $product_id)->pluck('value')->first(),

            'amount' => $amount,
            'value_total' => $amount * $value_un_product,
            'date_pedido' => $this->faker->dateTime(),
            'stats' => $this->faker->numberBetween(0, 2),
        ];
    }
}
