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
        Schema::table('reg_cars', function (Blueprint $table) {
            $table->dropColumn('owner');
        });

        Schema::table('reg_cars', function (Blueprint $table) {
            $table->boolean('owner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_cars', function (Blueprint $table) {
            $table->dropColumn('owner');
        });

        Schema::table('reg_cars', function (Blueprint $table) {
            $table->string('owner');
        });
    }
};
