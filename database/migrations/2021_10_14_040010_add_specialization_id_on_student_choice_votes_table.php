<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpecializationIdOnStudentChoiceVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_choice_votes', function(Blueprint $table) {
            $table->foreignId('specialization_id')->constrained('specializations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_choice_votes', function(Blueprint $table) {
            $table->dropColumn('specialization_id');
        });
    }
}
