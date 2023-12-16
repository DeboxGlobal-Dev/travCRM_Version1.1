<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HotelMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_HOTEL_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('HotelChain');
            $table->string('HotelName', 100)->default(null);
            $table->string('HotelCode', 125)->default(null);
            $table->integer('HotelCategory');
            $table->integer('HotelType');
            $table->integer('HotelCountry');
            $table->integer('HotelState');
            $table->integer('HotelCity');
            $table->integer('HotelPinCode');
            $table->string('HotelAddress', 225)->default(null);
            $table->string('HotelLocality', 225)->default(null);
            $table->string('HotelGSTN', 225)->default(null);
            $table->string('HotelWeekend', 55)->default(null);
            $table->string('CheckIn', 100)->default(null);
            $table->string('CheckOut', 100)->default(null);
            $table->string('HotelLink', 225)->default(null);
            $table->text('HotelInfo');
            $table->text('HotelPolicy');
            $table->text('HotelTC');
            $table->string('HotelAmenties', 50)->default(null);
            $table->string('HotelRoomType', 50)->default(null);
            $table->integer('SelfSupplier')->default(0);
            $table->integer('HotelStatus')->default(0);
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
