<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_produto', function (Blueprint $table) {
            $table->integer('produto_id')->unsigned();
            $table->integer('pedido_id')->unsigned();
            $table->double('valor_unitario',8,2)->unsigned();

            $table->foreign('produto_id')->references('id')->on('produtos')->onUpdated('cascade')->onDelete('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdated('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_produto');
    }
}
