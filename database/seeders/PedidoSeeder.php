<?php

namespace Database\Seeders;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produtos = array();
        $valor = 0;
        for($i = 1; $i<=3 ; $i++) {
            $produto = Produto::find($i);
            $valor += $produto->Valor;
            array_push($produtos, $i);
        }
        $pedido = Pedido::create([
            'cliente_id' => 1,
            'ValorTotal' => $valor
        ]);
        foreach ($produtos as $produto){
            $pedido->produtos()->attach($produto,['quantidade' => 1]);
        }
        $pedido->save();


    }
}
