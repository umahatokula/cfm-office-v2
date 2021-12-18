<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifeCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('life_coaches', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable()->comment('First name of the person who follows targets up');
            $table->string('lname')->nullable()->comment('Last name of the person who follows targets up');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('church_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('life_coaches');
    }
}
