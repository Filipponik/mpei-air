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
            $table->timestamp('date');
            $table->unsignedSmallInteger('row');
            $table->unsignedSmallInteger('col');
            $table->enum('status', ['booked', 'free', 'sold']);
            $table->unsignedBigInteger('airport_from_id');
            $table->unsignedBigInteger('airport_to_id');
            $table->unsignedBigInteger('tariff_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('order_id');

            $table->foreign('airport_from_id')->references('id')->on('airports');
            $table->foreign('airport_to_id')->references('id')->on('airports');
            $table->foreign('tariff_id')->references('id')->on('tariffs');
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
