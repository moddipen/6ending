<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMatcheventypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matchtypeevents', function (Blueprint $table) {
            $table->integer('type')->comment("0=Enable, 1=Disable")->nullable()->default(0);   
            $table->integer('is_settled')->comment("0=No, 1=Yes")->nullable()->default(0);   
        });
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
