<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->string('fam');
            // $table->string('im');
            // $table->string('otch');
            $table->unsignedBigInteger('person_id');
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->string('defaultToken')->nullable();
            $table->string('role')->default('user');
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('profile_photo_path')->nullable();
            $table->rememberToken();
            
            $table->foreign('person_id')->references('id')->on('people');
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
        Schema::dropIfExists('users');
    }
}
