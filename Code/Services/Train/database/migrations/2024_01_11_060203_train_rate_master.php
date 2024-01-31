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
        Schema::create(_TRAIN_RATE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('ClientId');
            $table->integer('TrainId');
            $table->string('TrainNumber');
            $table->string('TrainClass');
            $table->string('JourneyType');
            $table->string('Currency');
            $table->string('ValidFrom');
            $table->string('ValidTo');
            $table->string('AdultCost');
            $table->integer('ChildCost');
            $table->integer('InfantCost');
            $table->integer('Remarks');
            $table->integer('Status')->default(0);
            $table->json('JsonItem');
            $table->integer('Destination');
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
