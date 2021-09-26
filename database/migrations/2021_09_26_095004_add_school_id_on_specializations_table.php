<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolIdOnSpecializationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specializations', function (Blueprint $table) {
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('activity_id');
        });
    }
}
