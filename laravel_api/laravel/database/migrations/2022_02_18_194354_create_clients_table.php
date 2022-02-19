<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name', 45);
            $table->string('cpf', 14)->unique();
            $table->string('email', 45)->unique();
            $table->string('phone', 17);
            $table->char('sex', 1);
            $table->string('cep', 9);
            $table->string('address', 45);
            $table->string('complement', 45);
            $table->string('city', 20);
            $table->date('date_birth');
            $table->integer('stats');
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
