<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id');
            $table->integer('cell_id');
            $table->string('year');
            $table->integer('month_id');
            $table->integer('cell_member_id');
            $table->string('name');
            $table->integer('wk1_sun')->default(0);
            $table->integer('wk1_wed')->default(0);
            $table->integer('wk1_cell')->default(0);
            $table->integer('wk1_others')->default(0);
            $table->integer('wk2_sun')->default(0);
            $table->integer('wk2_wed')->default(0);
            $table->integer('wk2_others')->default(0);
            $table->integer('wk3_sun')->default(0);
            $table->integer('wk3_wed')->default(0);
            $table->integer('wk3_cell')->default(0);
            $table->integer('wk3_others')->default(0);
            $table->integer('wk4_sun')->default(0);
            $table->integer('wk4_wed')->default(0);
            $table->integer('wk4_others')->default(0);
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('cell_attendances');
    }
}
