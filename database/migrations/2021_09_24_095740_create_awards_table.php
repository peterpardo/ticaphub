<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('specialization_id')
                ->constrained('specializations')
                ->onDelete('cascade');
            $table->timestamps();
            // $table->enum('type', ['individual', 'group']);
            // $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            // $table->foreignId('ticap_id')->constrained('ticaps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('awards');
    }
}
