<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->default(' ');
            $table->string('region', 255)->nullable();
            $table->string('subregion', 255)->nullable();
            $table->string('currency', 255)->nullable();
            $table->string('ISO4217Code', 255)->nullable();
            $table->string('callingCode', 255)->nullable();
            $table->string('timezone', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
