<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_up_reports', function (Blueprint $table) {
            $table->id();
            $table->longText('report')->nullable();
            $table->longText('pastors_comment')->nullable();
            $table->integer('life_coach_id')->nullable();
            $table->integer('follow_up_target_id')->nullable();
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
        Schema::dropIfExists('follow_up_reports');
    }
}
