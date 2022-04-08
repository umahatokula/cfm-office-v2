<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('code_cr')->nullable();
            // $table->foreign('code_cr')->references('code')->on('chart_of_accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->string('code_dr')->nullable();
            // $table->foreign('code_dr')->references('code')->on('chart_of_accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->double('amount', 15, 2);
            $table->string('description')->nullable();
            $table->dateTime('value_date')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
