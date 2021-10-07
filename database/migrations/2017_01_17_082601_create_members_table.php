<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unique_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname')->nullable();
            $table->string('full_name');
            $table->integer('gender_id');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('dob')->nullable();
            $table->string('address')->nullable();
            $table->integer('local_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('age_profile_id')->nullable();
            $table->integer('marital_id')->nullable();
            $table->integer('cell_id')->nullable();
            $table->integer('service_team_id')->nullable();
            $table->string('occupation')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('picture_path')->nullable();
            $table->integer('church_id');
            $table->integer('region_id')->nullable()->comment('Region where member lives');
            $table->integer('status_id')->default(1);
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
        Schema::dropIfExists('members');
    }
}
