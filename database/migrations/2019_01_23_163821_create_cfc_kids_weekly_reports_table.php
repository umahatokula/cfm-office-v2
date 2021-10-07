<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfcKidsWeeklyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfc_kids_weekly_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id');
            $table->date('date');
            $table->string('lesson_taught');
            $table->string('memory_verse')->nullable();
            $table->integer('attendance_boys');
            $table->integer('attendance_girls');
            $table->integer('saved');
            $table->integer('holy_ghost');
            $table->double('offerings', 15, 2);
            $table->double('tithe', 15, 2);
            $table->string('teachers');
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
        Schema::dropIfExists('cfc_kids_weekly_reports');
    }
}
