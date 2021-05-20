<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plane_model_id');
            $table->unsignedBigInteger('airline_id');
            $table->unsignedDecimal('cost_econom');
            $table->unsignedDecimal('cost_business');
            $table->unsignedDecimal('cost_first');


            $table->foreign('plane_model_id')->references('id')->on('plane_models');
            $table->foreign('airline_id')->references('id')->on('airlines');
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
        Schema::dropIfExists('planes');
    }
}
