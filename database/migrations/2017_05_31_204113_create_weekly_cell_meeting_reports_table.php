<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyCellMeetingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_cell_meeting_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date_held');
            $table->integer('church_id');
            $table->integer('cell_id');
            $table->integer('week')->comment('Week number eg 1');
            $table->string('program');
            $table->string('venue');
            $table->string('start_time');
            $table->string('end_time');
            $table->integer('total_attendance');
            $table->integer('first_time_guests');
            $table->decimal('offering_and_seeds', 15, 2)->default(0.00);
            $table->text('message_summary');
            $table->text('other_reports')->nullable();
            $table->text('cell_leader_comment')->nullable();
            $table->text('pastor_in_charge_comment')->nullable();
            $table->text('resident_pastor_comment')->nullable();
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
        Schema::dropIfExists('weekly_cell_meeting_reports');
    }
}
