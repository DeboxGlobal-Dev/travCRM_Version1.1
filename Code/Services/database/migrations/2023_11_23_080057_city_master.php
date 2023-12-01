<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CityMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_CITY_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 50);
            $table->integer('StateId');
            $table->integer('CountryId');
            $table->integer('Status');
            $table->integer('AddedBy')->default('0');
            $table->integer('UpdatedBy')->default('0');
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
