<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HotelChainMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create(_HOTEL_CHAIN_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 100);
            $table->string('Location', 100)->nullable();
            $table->text('HotelWebsite')->nullable();
            $table->integer('SelfSupplier')->default(0);
            $table->integer('ContactType')->default(0);
            $table->string('ContactName', 100)->nullable();
            $table->string('ContactDesignation', 150)->nullable();
            $table->string('ContactCountryCode', 10)->nullable();
            $table->integer('ContactMobile', 15);
            $table->string('ContactEmail', 100);
            $table->integer('Status')->default(0);
            $table->integer('AddedBy')->default(0);
            $table->integer('UpdatedBy')->default(0);
            $table->timestamps();
        });*/
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
