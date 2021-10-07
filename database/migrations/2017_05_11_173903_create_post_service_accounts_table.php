<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostServiceAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_service_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('church_id');
            $table->integer('church_service_id');
            $table->integer('account_type_id');
            $table->decimal('amount', 15, 2)->default(0.00);
            $table->integer('posted_by');
            $table->integer('treasurer_approved')->default(0)->comment('Has the posting been approved by the treasurer?');
            $table->integer('resident_pastor_approved')->default(0)->comment('Has the posting been approved by the resident pastor?');
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
        Schema::dropIfExists('post_service_accounts');
    }
}
