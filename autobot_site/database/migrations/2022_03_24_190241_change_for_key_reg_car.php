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
        Schema::table('reg_cars', function (Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->foreignId('telegram_user_id')->references('id')->on('telegram_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_cars', function (Blueprint $table){
            $table->foreignId('user_id')->references('id')->on('users');
        });
    }
};
