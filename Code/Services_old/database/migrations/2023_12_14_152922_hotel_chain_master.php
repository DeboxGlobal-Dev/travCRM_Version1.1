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
        Schema::create(_HOTEL_CHAIN_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 100)->default(null);
            $table->string('Location', 100)->default(null);
            $table->string('HotelWebsite', 255)->default(null);
            $table->integer('SelfSupplier')->default(0);
            $table->integer('ContactType')->default(0);
            $table->string('ContactName', 100)->default(null);
            $table->string('ContactDesignation', 150)->default(null);
            $table->string('ContactCountryCode', 10)->default(null);
            $table->string('ContactMobile', 20)->default(null);
            $table->string('ContactEmail', 100)->default(null);
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
