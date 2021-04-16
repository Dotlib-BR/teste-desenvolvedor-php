<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('identificador')->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nota_vendedor')->nullable();
            $table->enum('status_pedido',['completo','pendente','cancelado']);
            $table->enum('status_compra',['aprovada','pendente','cancelada']);
            $table->decimal('valor_total_pedido');
            $table->decimal('desconto_total_pedido');
            $table->unsignedInteger('quantidade_total_pedido');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
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
