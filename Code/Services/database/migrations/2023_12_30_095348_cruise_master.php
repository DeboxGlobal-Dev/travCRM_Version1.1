<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CruiseMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_CRUISE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('CruisePackageName', 100);
            $table->string('Destination', 100);
            $table->string('RunningDays', 100);
            $table->string('ArrivalTime', 100);
            $table->string('DepartureTime', 100);
            $table->string('Status')->default(0);
            $table->string('Details');
            $table->integer('AddedBy')->default(0);
            $table->integer('UpdatedBy')->default(0);
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
        //
    }
}
