<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyCellMeetingProgramSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_cell_meeting_program_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weekly_cell_meeting_report_id');
            $table->string('event');
            $table->string('from');
            $table->string('to');
            $table->string('coordinator');
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
        Schema::dropIfExists('weekly_cell_meeting_program_summaries');
    }
}
