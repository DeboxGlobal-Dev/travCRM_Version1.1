<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrainRateMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_TRAIN_RATE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('TrainNumber',100);
            $table->string('JourneyType',100);
            $table->string('TrainClasses',100);
            $table->integer('Currency');
            $table->integer('AdultCost');
            $table->integer('childCost');
            $table->integer('InfantCost');
            $table->text('Remarks');
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
