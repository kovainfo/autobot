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
        Schema::create('reg_cars', function (Blueprint $table) {
            $table->id('id_reg_car');
            $table->string('num_car');
            $table->string('model');
            $table->string('owner');
            $table->string('add_info');
            $table->dateTime('dateTime_order');
            $table->string('comment');
            $table->integer('approved');
            $table->foreignId('id_user')->references('id_user')->on('users');
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
