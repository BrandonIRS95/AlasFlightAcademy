<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonLegalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_legal_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('citizenship');
            $table->string('country_of_passport_issuance')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('passport_expiration_date')->nullable();
            $table->integer('person_id');
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
        Schema::dropIfExists('person_legal_informations');
    }
}
