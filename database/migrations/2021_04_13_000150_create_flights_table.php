<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->timestamp('date_from');
            $table->timestamp('date_to');
            $table->unsignedBigInteger('flight_status_id');
            $table->unsignedBigInteger('airport_from_id');
            $table->unsignedBigInteger('airport_to_id');
            // $table->unsignedBigInteger('airline_id');
            $table->unsignedBigInteger('plane_id');

            $table->foreign('flight_status_id')->references('id')->on('flight_statuses');
            $table->foreign('airport_from_id')->references('id')->on('airports');
            $table->foreign('airport_to_id')->references('id')->on('airports');
            // $table->foreign('airline_id')->references('id')->on('airlines');
            $table->foreign('plane_id')->references('id')->on('planes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
