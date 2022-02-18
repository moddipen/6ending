<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFieldsUpdateBetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
        Schema::table('bets', function (Blueprint $table) {
            $table->dropForeign('bets_match_id_foreign');
            $table->dropColumn('match_id');

            $table->dropForeign('bets_eventtype_id_foreign');
            $table->dropColumn('eventtype_id');
            $table->unsignedBigInteger('match_event_id');
            $table->foreign('match_event_id')->references('id')->on('match_events')->onDelete('cascade');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
