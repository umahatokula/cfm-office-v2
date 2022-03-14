<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryScheduleComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_schedule_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->nullable();
            $table->foreignId('salary_schedule_id')->nullable();
            $table->foreignId('salary_schedule_element_id')->nullable();
            $table->double('amount', 15, 2)->nullable();
            $table->double('percentage', 15, 2)->nullable();
            $table->boolean('status')->default(1)->nullable();
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
        Schema::dropIfExists('salary_schedule_components');
    }
}
