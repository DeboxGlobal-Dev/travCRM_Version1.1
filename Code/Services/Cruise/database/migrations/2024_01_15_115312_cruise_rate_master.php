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
        Schema::create(_CRUISE_RATE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('ClientId');
            $table->integer('CruiseId');
            $table->string('MarketType');
            $table->string('SupplierName');
            $table->string('TariffType');
            $table->string('ValidFrom');
            $table->string('ValidTo');
            $table->integer('TaxSlab');
            $table->string('CruiseName');
            $table->string('CabinType');
            $table->string('Currency');
            $table->string('AdultCost');
            $table->string('ChildCost');
            $table->string('InfantCost');
            $table->string('Margin');
            $table->integer('Value');
            $table->string('Remarks');
            $table->integer('Status')->default(0);
            $table->json('JsonItem');
            $table->string('Destination');
            $table->integer('AddedBy')->default(0);
            $table->integer('UpdatedBy')->default(0);
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
