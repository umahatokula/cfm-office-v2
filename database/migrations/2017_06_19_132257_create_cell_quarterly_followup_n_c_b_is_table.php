<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellQuarterlyFollowupNCBIsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_quarterly_followup_ncbi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cell_quarterly_followup_id');
            $table->string('ncbi_name');
            $table->string('ncbi_phone');
            $table->string('ncbi_level');
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
        Schema::dropIfExists('cell_quarterly_followup_ncbi');
    }
}
