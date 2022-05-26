<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellChurchColoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_church_colonies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('leader')->nullable();
            $table->string('venue')->nullable();
            $table->foreignId('church_id')->nullable();
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
        Schema::dropIfExists('cell_church_colonies');
    }
}
