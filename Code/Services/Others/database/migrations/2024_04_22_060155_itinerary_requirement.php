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
        Schema::create(_ITINERARY_REQUIREMENT_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('FromDestination');
            $table->string('ToDestination');
            $table->string('TransferMode');
            $table->text('Title');
            $table->text('Description');
            $table->integer('DrivingDistance')->default(0);
            $table->integer('Status')->default(0);
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
