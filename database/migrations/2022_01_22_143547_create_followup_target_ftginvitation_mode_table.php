<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupTargetFtginvitationModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followup_target_ftginvitation_mode', function (Blueprint $table) {
            $table->id();
            $table->foreignId('followup_target_id');
            $table->foreignId('ftg_invitation_mode_id');
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
        Schema::dropIfExists('followup_target_ftginvitation_mode');
    }
}
