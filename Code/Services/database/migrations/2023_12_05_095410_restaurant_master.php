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
            $table->integer('DestinationId');
            $table->text('Address');
            $table->integer('CountryId');
            $table->integer('StateId');
            $table->integer('CityId');
            $table->integer('SelfSupplier');
            $table->integer('PinCode');
            $table->string('GSTN',100);
            $table->integer('ContactType');
            $table->string('ContactName',100);
            $table->string('ContactDesignation',100);
            $table->string('CountryCode',100);
            $table->integer('Phone1');
            $table->integer('Phone2');
            $table->integer('Phone3');
            $table->string('ContactEmail',100);
            $table->string('Image',100);
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
