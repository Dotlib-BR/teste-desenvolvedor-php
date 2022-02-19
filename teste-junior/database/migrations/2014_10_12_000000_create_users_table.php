<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
          $table->id('Id_cliente');
          $table->string('name',100);
          $table->string('segundo_nome',100);
          $table->string('cpf',11);
          $table->string('email',10)->nullable()->unique();
          $table->string('password')->nullable();
          $table->string('email_verified_at')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
