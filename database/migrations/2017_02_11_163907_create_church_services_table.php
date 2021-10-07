<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChurchServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id')->unsigned();
            $table->string('service_date');
            $table->integer('service_type_id')->unsigned();
            $table->string('special_service')->nullable();
            $table->integer('attendance_men')->unsigned();
            $table->integer('attendance_women')->unsigned();
            $table->integer('attendance_children')->unsigned();
            $table->integer('attendance_total')->unsigned();
            $table->integer('first_timers_men')->unsigned();
            $table->integer('first_timers_women')->unsigned();
            $table->integer('first_timers_children')->unsigned();
            $table->integer('first_timers_total')->unsigned();
            $table->integer('born_again_men')->unsigned();
            $table->integer('born_again_women')->unsigned();
            $table->integer('born_again_children')->unsigned();
            $table->integer('born_again_total')->unsigned();
            $table->integer('filled_men')->unsigned();
            $table->integer('filled_women')->unsigned();
            $table->integer('filled_children')->unsigned();
            $table->integer('filled_total')->unsigned();
            $table->integer('regular_offering')->unsigned();
            $table->integer('tithes')->unsigned();
            $table->integer('connection')->unsigned();
            $table->integer('honourarium')->unsigned();
            $table->integer('first_fruit')->unsigned();
            $table->integer('thanksgiving_offering')->unsigned();
            $table->integer('special_offering')->unsigned();
            $table->integer('project_offering')->unsigned();
            $table->integer('pos')->unsigned();
            $table->integer('others')->unsigned();
            $table->integer('total_offering')->unsigned();
            $table->integer('submitted_by')->unsigned();
            $table->integer('admin_pastor_approval')->unsigned();
            $table->integer('head_pastor_approval')->unsigned();
            $table->integer('ref_number')->nullable();
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
        Schema::dropIfExists('church_services');
    }
}
