<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('airline_service_id');
            $table->unsignedBigInteger('ticket_id');

            $table->foreign('airline_service_id')->references('id')->on('airline_services');
            $table->foreign('ticket_id')->references('id')->on('tickets');
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
        Schema::dropIfExists('service_tickets');
    }
}
