<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->string('phone_number');
            $table->string('telegram_id')->unique();
            $table->integer('approved');
            $table->foreignId('id_role')->references('id_role')->on('roles');
            $table->foreignId('id_essence')->references('id_essence')->on('essences')->uniqid();
            $table->foreignId('id_address')->references('id_address')->on('addresses');
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
};
