<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchEventResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_event_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_event_id');
            $table->foreign('match_event_id')->references('id')->on('match_events')->onDelete('cascade');
            $table->string('result', 155)->default(0);
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
        Schema::dropIfExists('match_event_results');
    }
}
