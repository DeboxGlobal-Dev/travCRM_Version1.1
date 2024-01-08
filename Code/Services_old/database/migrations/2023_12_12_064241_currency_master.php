<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CurrencyMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_CURRENCY_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('CountryId')->length(50);
            $table->string('CountryCode', 50);
            $table->string('CurrencyName', 50);
            $table->integer('Status')->default(0);
            $table->integer('SetDefault')->default(0);
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
