<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellQuarterlyFollowupSoulsWonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_quarterly_followup_souls_won', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cell_quarterly_followup_id');
            $table->string('sw_name');
            $table->string('sw_phone');
            $table->string('sw_address');
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
        Schema::dropIfExists('cell_quarterly_followup_souls_won');
    }
}
