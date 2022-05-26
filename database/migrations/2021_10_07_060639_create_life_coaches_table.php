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
            $table->foreignId('gender_id')->nullable();
            $table->foreignId('marital_status_id')->nullable();
            $table->string('residential_address')->nullable();
            $table->foreignId('cell_id')->nullable();
            $table->foreignId('c3_id')->nullable();
            $table->foreignId('service_team_id')->nullable();
            $table->string('occupation')->nullable();
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
