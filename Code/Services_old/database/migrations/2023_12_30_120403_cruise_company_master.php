<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CruiseCompanyMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_CRUISE_COMPANY_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('CruiseCompanyName', 100);
            $table->string('Destination', 100);
            $table->string('Country', 100);
            $table->string('State', 100);
            $table->string('City', 100);
            $table->string('PinCode', 100);
            $table->string('Address', 100);
            $table->string('Website', 100);
            $table->string('GST', 100);
            $table->string('SelfSupplier', 100);
            $table->string('Type', 100);
            $table->string('Phone', 12);
            $table->string('Email', 100);
            $table->string('Status')->default(0);
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
