<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('email', 100);
            $table->string('CPF', 11);
            $table->string('product');
            $table->integer('qty');
            $table->decimal('cost', 10,2);
            $table->decimal('discount', 10,2)->nullable();
            $table->string('status')->default('Em aberto.');
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
        Schema::dropIfExists('orders');
    }
}
