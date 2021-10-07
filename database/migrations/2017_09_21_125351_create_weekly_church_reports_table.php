<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyChurchReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_church_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id');
            $table->integer('member_id')->comment('Resident pastor\'s name');
            $table->string('from');
            $table->string('to');
            $table->string('subject');
            $table->text('tasks_completed')->nullable();
            $table->integer('sunday_attendance')->nullable();
            $table->integer('sunday_salvation')->nullable();
            $table->integer('sunday_holy_ghost')->nullable();
            $table->integer('sunday_first_time_guests')->nullable();
            $table->integer('sunday_children_church')->nullable();
            $table->decimal('sunday_offering', 15, 2)->default(0.00)->nullable();
            $table->decimal('sunday_tithes', 15, 2)->default(0.00)->nullable();
            $table->decimal('sunday_church_tithes', 15, 2)->default(0.00)->nullable();
            $table->string('sunday_depositor')->nullable();
            $table->integer('wed_attendance')->nullable();
            $table->integer('wed_salvation')->nullable();
            $table->integer('wed_holy_ghost')->nullable();
            $table->integer('wed_first_time_guests')->nullable();
            $table->integer('wed_children_church')->nullable();
            $table->decimal('wed_offering', 15, 2)->default(0.00)->nullable();
            $table->decimal('wed_tithes', 15, 2)->default(0.00)->nullable();
            $table->decimal('wed_church_tithes', 15, 2)->default(0.00)->nullable();
            $table->string('wed_depositor')->nullable();
            $table->integer('others_attendance')->nullable();
            $table->integer('others_salvation')->nullable();
            $table->integer('others_holy_ghost')->nullable();
            $table->integer('others_first_time_guests')->nullable();
            $table->integer('others_children_church')->nullable();
            $table->decimal('others_offering', 15, 2)->default(0.00)->nullable();
            $table->decimal('others_tithes', 15, 2)->default(0.00)->nullable();
            $table->decimal('others_church_tithes', 15, 2)->default(0.00)->nullable();
            $table->string('others_depositor')->nullable();
            $table->text('issues')->nullable();
            $table->integer('filed_by')->nullable();
            $table->integer('checked_by')->nullable();
            $table->text('comments')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('weekly_church_reports');
    }
}
