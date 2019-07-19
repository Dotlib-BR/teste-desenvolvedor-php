<?php

use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
        // factory(App\Produto::class, 50)->create(); 
        factory(App\Cliente::class, 50)->create()->each(function ($cliente){
            $cliente->pedidos()->saveMany(factory(App\Pedido::class, 5)->make())->each(function($pedido){
                $pedido->itensPedidos()->saveMany(factory(App\ItensPedido::class,3)->make())->each(function($itens){
                    $itens->produtos()->make();
                });
            });
        });    
               
        //factory(App\Pedido::class, 30)->create();     
        factory(App\Cliente::class, 1)->create([
            'email' => 'user@user.com'
        ]);
    }
}
