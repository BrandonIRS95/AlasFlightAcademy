<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_tests', function (Blueprint $table) {
            $table->increments('id');
//            $table->date('date');
//            $table->time('start');
//            $table->time('end');
            $table->text('description')->nullable();
            $table->decimal('cost')->nullable();
            /*$table->string('status');*/
            $table->integer('flight_route_id');
            $table->integer('student_id')->nullable();
            /*$table->integer('instructor_id');*/
            $table->integer('airplane_id');
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
        Schema::dropIfExists('flight_tests');
    }
}
