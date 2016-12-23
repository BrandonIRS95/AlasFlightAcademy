<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlasPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alas_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('success')->nullable();
            $table->integer('user_id');
            $table->string('payment_id')->nullable();
            $table->string('token')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('serial');
            $table->string('type');
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
        Schema::dropIfExists('alas_payments');
    }
}
