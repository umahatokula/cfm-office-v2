<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_families', function (Blueprint $table) {
            $table->integer('member_id')->unsigned();
            $table->integer('family_id')->unsigned();
            $table->integer('is_parent');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->primary(['member_id', 'family_id']);
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
        Schema::table('member_families', function(Blueprint $table) {
            $table->dropForeign('member_families_member_id_foreign');
            $table->dropForeign('member_families_family_id_foreign');
        });
        Schema::dropIfExists('member_families');
    }
}
