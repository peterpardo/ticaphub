<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupExhibitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_exhibit', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Project Title');
            $table->text('description')->default('Project Description');
            $table->string('banner_name')->nullable();
            $table->string('banner_path')->nullable();
            $table->string('video_name')->nullable();
            $table->string('video_path')->nullable();
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
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
        Schema::dropIfExists('group_exhibit');
    }
}
