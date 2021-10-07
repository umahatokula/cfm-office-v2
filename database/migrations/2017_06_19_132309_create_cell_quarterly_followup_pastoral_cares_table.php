<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellQuarterlyFollowupPastoralCaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_quarterly_followup_pastoral_cares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cell_quarterly_followup_id');
            $table->string('pc_name');
            $table->string('pc_phone');
            $table->string('pc_address');
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
        Schema::dropIfExists('cell_quarterly_followup_pastoral_cares');
    }
}
