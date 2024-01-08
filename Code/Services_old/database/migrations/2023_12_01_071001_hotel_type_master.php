<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HotelTypeMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_HOTEL_TYPE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 50);
            $table->string('UploadKeyword', 155)->nullable();
            $table->integer('Status')->default(0);
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
