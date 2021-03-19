<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('orders_id');
            $table->foreign('orders_id')
                    ->references('id')
                    ->on('orders')
                    ->onDelete('cascade');
            

            $table->string('name', 100);
            $table->integer('cpf')->unique();
            $table->string('email',50);

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
        Schema::dropIfExists('clients');
    }
}
