<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_requisitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id');
            $table->integer('requisition_number');
            $table->integer('account_type_id')->comment('account to withdraw from');
            $table->integer('expense_head_id');
            $table->text('description');
            $table->integer('requisition_by');
            $table->decimal('requested_amount', 15, 2)->default(0.00);
            $table->decimal('approved_amount', 15, 2)->default(0.00);
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_paid')->default(0);
            $table->decimal('paid_amount', 15, 2)->default(0.00);
            $table->integer('processed_by')->nullable()->comment('Who approved/disapproved this requisition');
            $table->integer('paid_by')->nullable()->comment('Who gave out funds for this requisition');
            $table->integer('status_id')->default(4);
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
        Schema::dropIfExists('special_requisitions');
    }
}
