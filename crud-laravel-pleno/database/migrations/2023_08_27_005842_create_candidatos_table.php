<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rodar as migrations.
     */
    public function up(): void
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id(''); //Primária
            $table->string('nome');
            $table->string('email');
            $table->text('experiencia_profissional')->nullable();
            $table->text('habilidades')->nullable();
            $table->string('disponibilidade')->nullable();
            $table->timestamps(); //data de criação e modificação
        });
    }

    /**
     * Reverter as migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatos');
    }
};
