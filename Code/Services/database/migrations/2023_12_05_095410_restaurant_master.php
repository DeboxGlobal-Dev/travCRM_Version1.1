<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RestaurantMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_RESTAURANT_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 50);
            $table->integer('DestinationId', 155);
            $table->text('Address');
            $table->integer('CountryId',155);
            $table->integer('StateId',155);
            $table->integer('CityId',155);
            $table->integer('SelfSupplier',155);
            $table->integer('PinCode',155);
            $table->string('GSTN',155);
            $table->integer('ContactType',155);
            $table->string('ContactName',155);
            $table->string('ContactDesignation',155);
            $table->string('CountryCOde',155);
            $table->integer('Phone1',155);
            $table->integer('Phone2',155);
            $table->integer('Phone3',155);
            $table->string('ContactEmail',155);
            $table->string('Image',500);
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
