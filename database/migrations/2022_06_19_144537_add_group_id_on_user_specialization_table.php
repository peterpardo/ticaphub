<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupIdOnUserSpecializationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_specialization', function (Blueprint $table) {
            $table->foreignId('group_id')
                ->constrained('groups')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_specialization', function (Blueprint $table) {
            $table->dropColumn('group_id');
        });
    }
}
