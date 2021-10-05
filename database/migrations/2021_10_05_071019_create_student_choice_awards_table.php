<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentChoiceAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_choice_awards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('specialization_id')->constrained('specializations')->onDelete('cascade');
            $table->foreignId('ticap_id')->constrained('ticaps')->onDelete('cascade');
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
        Schema::dropIfExists('student_choice_awards');
    }
}
