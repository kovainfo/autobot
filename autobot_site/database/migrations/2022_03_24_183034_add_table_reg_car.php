<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_cars', function (Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('num_car');
            $table->string('add_info');
            $table->dateTime('date_time');
            $table->string('address');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('comment');
            $table->string('status');
            $table->integer('approved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_cars');
    }
};
