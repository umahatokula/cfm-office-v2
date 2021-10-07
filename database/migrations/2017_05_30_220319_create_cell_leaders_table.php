<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_leaders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id');
            $table->integer('cell_id');
            $table->integer('member_id');
            $table->integer('attended_clot')->default(0)->coment('Has this cell leader attended any Cell Leaders Orientation Training?');
            $table->integer('is_leader');
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
        Schema::dropIfExists('cell_leaders');
    }
}
