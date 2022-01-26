<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchtypeeventResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchtypeevent_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matchtypeevent_id');
            $table->foreign('matchtypeevent_id')->references('id')->on('matchtypeevents')->onDelete('cascade');
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
        Schema::dropIfExists('matchtypeevent_results');
    }
}
