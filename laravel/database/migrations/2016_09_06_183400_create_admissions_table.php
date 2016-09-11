<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->date('start_date');
            $table->boolean('requesting_financial_aid');
            $table->boolean('elegible_va_benefits')->nullable();
            $table->boolean('english_native_language');
            $table->boolean('convicted_crime');
            $table->text('flight_certificates_rating')->nullable();
            $table->text('schools_rating_obtained')->nullable();
            $table->string('ffa_medical')->nullable();
            $table->boolean('information_application_factual');
            $table->string('electronic_signature');
            $table->date('todays_date');
            $table->integer('pilot_program_id');
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
        Schema::dropIfExists('admissions');
    }
}
