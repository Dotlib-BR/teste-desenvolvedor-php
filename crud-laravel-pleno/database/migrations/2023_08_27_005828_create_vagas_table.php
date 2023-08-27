<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rodar as migrations
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('tipo', ['CLT', 'Pessoa Jurídica', 'Freelancer']);  // Enumeração
            $table->enum('status', ['Ativa', 'Pausada', 'Encerrada']);  // Enumeração
            $table->timestamps();  // Campos de dta de criação e modificação
        });
    }

    /**
     * Reverter as migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas');
    }
};
