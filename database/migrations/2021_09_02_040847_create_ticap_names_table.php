<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicapNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticaps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('invitation_is_set')->default(0);
            $table->boolean('election_has_started')->default(0);
            $table->boolean('election_updated')->default(0);
            $table->boolean('election_review')->default(0);
            $table->boolean('has_new_election')->default(0);
            $table->boolean('election_finished')->default(0);
            $table->boolean('awards_is_set')->default(0);
            $table->boolean('evaluation_finished')->default(0);
            $table->boolean('is_done')->default(0);
            $table->string('folder')->nullable();
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
        Schema::dropIfExists('ticaps');
    }
}
