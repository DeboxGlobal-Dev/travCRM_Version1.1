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
        Schema::create(_GUIDE_RATE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('ClientId');
            $table->integer('GuideId');
            $table->string('SupplierName');
            $table->string('ValidFrom');
            $table->string('ValidTo');
            $table->string('PaxRange');
            $table->string('DayType');
            $table->string('UniversalCost');
            $table->string('Currency');
            $table->string('ServiceCost');
            $table->string('LanguageAllowance');
            $table->string('OtherCost');
            $table->string('GST');
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
