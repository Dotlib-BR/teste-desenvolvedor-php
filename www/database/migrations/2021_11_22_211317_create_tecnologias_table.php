<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTecnologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnologias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('slug');

        });
    }

    public function down()
    {
        Schema::dropIfExists('tecnologias');
    }
}
