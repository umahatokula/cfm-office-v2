<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstTimersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_timers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->integer('church_id');
            $table->integer('service_type_id');
            $table->string('service_date');
            $table->integer('is_new');
            $table->integer('title_id');
            $table->string('name');
            $table->integer('is_first_timer');
            $table->string('address')->nullable();
            $table->string('prayer_request')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('phone_home')->nullable();
            $table->string('phone_office')->nullable();
            $table->string('no_of_visits')->nullable();
            $table->string('guest_of')->nullable();
            $table->boolean('inviter_is_member')->default(0);
            $table->integer('member_id')->nullable();
            $table->integer('marital_status_id')->nullable();
            $table->integer('age_profile_id')->nullable();
            $table->integer('no_of_children')->nullable();
            $table->string('children_names')->nullable();
            $table->string('hear_about_us')->nullable();
            $table->string('interested_in')->nullable();
            $table->string('more_info')->nullable();
            $table->integer('status_id');
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
        Schema::dropIfExists('first_timers');
    }
}
