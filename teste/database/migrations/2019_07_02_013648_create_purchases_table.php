<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->foreign('discount_id')
                ->references('id')
                ->on('discounts')
                ->onDelete('cascade');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('cascade');
            $table->char('invoice_number', 9);
            $table->decimal('total', 10, 2);
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
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['discount_id']);
            $table->dropForeign(['status_id']);
            $table->dropIfExists();
        });
    }
}
