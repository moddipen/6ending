<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchtypeeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');



        Schema::create('matchtypeevents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matchtype_id');
            $table->foreign('matchtype_id')->references('id')->on('matchtypes')->onDelete('cascade');
            $table->unsignedBigInteger('eventtype_id');
            $table->foreign('eventtype_id')->references('id')->on('eventtypes')->onDelete('cascade');
            $table->float('bet_coin');
            $table->float('win_coin');
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchtypeevents');
    }
}
