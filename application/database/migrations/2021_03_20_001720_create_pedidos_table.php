<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('status_pedido_id')->unsigned();
            $table->bigInteger('cupom_desconto_id')->unsigned()->nullable();
            $table->string('numero_pedido', 100);
            $table->decimal('valor_pedido', 10, 2);
            $table->decimal('valor_desconto', 10, 2)->nullable();
            $table->decimal('valor_total', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('status_pedido_id')->references('id')->on('status_pedidos');
            $table->foreign('cupom_desconto_id')->references('id')->on('cupom_descontos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
