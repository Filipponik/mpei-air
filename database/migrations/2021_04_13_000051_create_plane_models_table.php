<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaneModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plane_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('cols_econom')->default(0);
            $table->unsignedInteger('seats_econom')->default(0);
            $table->unsignedInteger('cols_business')->default(0);
            $table->unsignedInteger('seats_business')->default(0);
            $table->unsignedInteger('cols_first')->default(0);
            $table->unsignedInteger('seats_first')->default(0);
            
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
        Schema::dropIfExists('plane_models');
    }
}
