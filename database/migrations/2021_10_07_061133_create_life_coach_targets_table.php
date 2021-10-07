<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifeCoachTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('life_coach_targets', function (Blueprint $table) {
            $table->integer('life_coach_id')->nullable()->comment('Person to conduct the follow up');
            $table->integer('followup_target_id')->nullable()->comment('Person to be followed up');
            $table->integer('reason_id')->nullable()->comment('Reason for follow up');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('life_coach_targets');
    }
}
