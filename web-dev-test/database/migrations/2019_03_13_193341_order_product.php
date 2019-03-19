<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating products to orders (Many-to-Many)
        Schema::create('order_product', function (Blueprint $table) {
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->integer('qtd_order')->nullable();
        });

        Schema::table('order_product', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')
            ->on('orders')->onDelete('cascade');

            $table->foreign('product_id')->references('id')
                    ->on('products')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
