<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followup_targets', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable()->comment('First name of the person who needs to be followed up');
            $table->string('lname')->nullable()->comment('Last name of the person who needs to be followed up');
            $table->string('phone')->nullable()->comment('Phone number of the person who needs to be followed up');
            $table->string('email')->nullable()->comment('Email the person who needs to be followed up');
            $table->string('notes')->nullable();
            $table->integer('age_profile_id')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('church_id')->nullable();
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
        Schema::dropIfExists('followup_targets');
    }
}
