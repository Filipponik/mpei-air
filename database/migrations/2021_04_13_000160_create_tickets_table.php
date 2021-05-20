<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('row');
            $table->unsignedSmallInteger('col');
            $table->string('class')->default('econom');
            $table->unsignedBigInteger('flight_id');
            $table->unsignedBigInteger('ticket_status_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('order_id');

            $table->foreign('flight_id')->references('id')->on('flights');
            $table->foreign('ticket_status_id')->references('id')->on('ticket_statuses');
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('tickets');
    }
}
