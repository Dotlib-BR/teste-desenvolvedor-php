<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProduto');
            $table->integer('quantidadeProduto')->default(1);
            $table->unsignedBigInteger('idPedido');
            $table->timestamps();

            $table->foreign('idProduto')->references('id')->on('produtos');
            $table->foreign('idPedido')->references('id')->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_produtos');
    }
}
