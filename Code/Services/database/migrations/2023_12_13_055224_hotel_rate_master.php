<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HotelRateMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_HOTEL_RATE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('ClientId');
            $table->integer('HotelId');
            $table->integer('MarketType');
            $table->integer('SupplierId');
            $table->integer('PaxType');
            $table->integer('TariffType');
            $table->integer('SeasonType');
            $table->integer('SeasonYear');
            $table->date('ValidFrom');
            $table->date('ValidTo');
            $table->Integer('RoomType');
            $table->Integer('MealType');
            $table->Integer('Currency');
            $table->float('SingleOccupancy');
            $table->float('DoubleOccupancy');
            $table->float('ExtraBedAdult');
            $table->float('ExtraBedChild');
            $table->float('ChildWithBed');
            $table->float('Breakfast');
            $table->float('Lunch');
            $table->float('Dinner');
            $table->float('TAC');
            $table->integer('RoomTaxSlab');
            $table->integer('MealTaxSlab');
            $table->integer('MarkUpType');
            $table->integer('MarkUpValue');
            $table->text('Remarks');
            $table->Integer('Status')->default(0);
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
