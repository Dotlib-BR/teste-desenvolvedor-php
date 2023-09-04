<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('access_level', ['admin', 'user'])->default('user');
        });

        Schema::create('jobs', function (Blueprint $table) { 
            $table->id();
            $table->unsignedBigInteger('user_id');  // Adicionando a coluna user_id
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['CLT', 'Pessoa Jurídica', 'Freelancer']);
            $table->enum('status', ['open', 'closed', 'paused'])->default('open');
            $table->timestamps();

            // Definindo user_id como chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->text('experience');
            $table->text('skills');
            $table->string('availability');
            $table->timestamps();
        });

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade');
            $table->date('application_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
        Schema::dropIfExists('candidates');
        Schema::dropIfExists('jobs');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('access_level');
        });
    }
};
