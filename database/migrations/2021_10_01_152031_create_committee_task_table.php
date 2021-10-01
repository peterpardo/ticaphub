<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteeTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_task', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->foreignId('committee_id')->constrained('committees')->onDelete('cascade');
            $table->enum('status', ['ongoing', 'completed'])->default('ongoing');
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
        Schema::dropIfExists('committee_task');
    }
}
