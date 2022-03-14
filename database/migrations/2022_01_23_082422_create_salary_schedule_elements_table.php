<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryScheduleElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_schedule_elements', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullabel();
            $table->boolean('increase_net_salary')->nullable()->comment('Does this element increase on decrease the net pay');
            $table->boolean('status')->nullabel();
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
        Schema::dropIfExists('salary_schedule_elements');
    }
}
