<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(_HOTEL_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('HotelName', 150);
            $table->string('HotelCode', 15);
            $table->integer('HotelCategory');
            $table->integer('HotelCountry');
            $table->integer('HotelState');
            $table->integer('HotelCity');
            $table->integer('HotelType');
            $table->string('HotelPinCode', 10);
            $table->text('HotelAddress');
            $table->text('HotelLink');
            $table->string('HotelGSTN', 20);
            $table->integer('HotelWeekend');
            $table->time('CheckIn');
            $table->time('CheckOut');
            $table->text('HotelInfo');
            $table->text('HotelPolicy');
            $table->text('HotelTC');
            $table->string('HotelAmenties', 30);
            $table->integer('HotelRoomType');
            $table->integer('HotelStatus');
            $table->integer('HotelChain');
            $table->string('HotelLocality', 30);
            $table->integer('SelfSupplier');
            $table->bigInteger('AddedBy')->default(0);
            $table->bigInteger('UpdatedBy')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
