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
            $table->string('access_level')->after('remember_token');
        });

        Schema::create('jobs', function (Blueprint $table) { 
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('type');
            $table->string('status');
            $table->timestamps();
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
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('candidate_id');
            $table->timestamp('application_date');
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
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
