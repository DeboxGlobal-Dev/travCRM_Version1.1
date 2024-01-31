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
        Schema::create(_FERRY_RATE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('ClientId');
            $table->integer('FerryId');
            $table->string('MarketType');
            $table->string('SupplierName');
            $table->string('ValidFrom');
            $table->string('ValidTo');
            $table->integer('TaxSlab');
            $table->string('FerryName');
            $table->string('FerrySeat');
            $table->string('Currency');
            $table->integer('AdultCost');
            $table->integer('ChildCost');
            $table->integer('InfantCost');
            $table->string('ProcessingFee');
            $table->string('MiscCost');
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
