<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellQuarterlyFollowupFollowedUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_quarterly_followup_followed_ups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cell_quarterly_followup_id');
            $table->string('fu_name');
            $table->string('fu_phone');
            $table->string('fu_address');
            $table->string('fu_followed_up_by');
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
        Schema::dropIfExists('cell_quarterly_followup_followed_ups');
    }
}
