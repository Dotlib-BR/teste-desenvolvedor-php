<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('orders_id')->unsigned();
            $table->foreign('orders_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');

            $table->string('name', 100);
            $table->string('barcode',20);
            $table->unsignedSmallInteger('amount');
            $table->float('unit-price', 8, 2);

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
        Schema::dropIfExists('products');
    }
}
