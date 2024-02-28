<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditionalRequirementMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_ADDITIONAL_REQUIREMENT_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 100);
            $table->string('DestinationId', 100);
            $table->string('CurrencyId', 100);
            $table->string('CostType', 100);
            $table->string('AdultCost', 255);
            $table->string('ChildCost', 255);
            $table->string('InfantCost', 255);
            $table->string('ImageName', 255);
            $table->string('ImageData', 255);
            $table->string('Details', 255);
            $table->string('Status')->default(0);
            $table->string('AddedBy')->default(0);
            $table->string('UpdatedBy')->default(0);
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
