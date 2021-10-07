<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellQuarterlyFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_quarterly_followups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id');
            $table->integer('total_souls_won');
            $table->integer('total_by_pastoral_care');
            $table->integer('total_retained');
            $table->integer('total_constant_in_church');
            $table->integer('total_NCBI');
            $table->integer('total_followed_up');
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
        Schema::dropIfExists('cell_quarterly_followups');
    }
}
