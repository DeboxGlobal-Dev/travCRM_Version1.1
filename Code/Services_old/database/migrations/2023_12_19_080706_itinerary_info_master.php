<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItineraryInfoMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_ITINERARY_INFO_MASTER_, function(Blueprint $table) {
            $table->id();
            $table->string('FromDestination', 100);
            $table->string('ToDestination', 100);
            $table->string('TransferMode', 100);
            $table->string('Title', 100);
            $table->string('DrivingDistance', 100);
            $table->string('Details', 100);
            $table->string('Status')->default(0);
            $table->string('AddedBy')->default(0);
            $table->string('UpdatedBy')->default(0);
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
