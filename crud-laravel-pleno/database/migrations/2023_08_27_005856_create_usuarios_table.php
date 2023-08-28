<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Roda as migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Cjave Primária
            $table->string('nome');
            $table->string('email')->unique(); //Email do usuário
            $table->string('senha');
            $table->enum('nivel_acesso', ['Administrador', 'Usuario']);
            $table->timestamps(); // Data de criação e modificações
        });
    }

    /**
     * Reverte as migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
