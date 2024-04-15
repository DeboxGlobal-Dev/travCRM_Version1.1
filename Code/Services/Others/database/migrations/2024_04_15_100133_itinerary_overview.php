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
        Schema::create(_ITINERARY_OVERVIEW_, function (Blueprint $table) {
            $table->id();
            $table->string('OverviewName');
            $table->text('OverviewInformation');
            $table->text('HighlightInformation');
            $table->text('ItineraryIntroduction');
            $table->text('ItinerarySummary');
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
