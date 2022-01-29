<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupTargetFtginformationNeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followup_target_ftginformation_need', function (Blueprint $table) {
            $table->id();
            $table->foreignId('followup_target_id');
            $table->foreignId('ftg_information_need_id');
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
        Schema::dropIfExists('followup_target_ftginformation_need');
    }
}
