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
        Schema::create(_QUERY_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('QueryId', 50);
            $table->string('FDCode', 50);
            $table->string('PackageCode', 50);
            $table->string('PackageName', 50);
            $table->string('ClientType');
            $table->string('AgentId', 50);
            $table->string('LeadPax', 100);
            $table->string('Subject', 100);
            $table->string('AddEmail', 50);
            $table->string('AdditionalInfo', 50);
            $table->string('QueryType');
            $table->json('ValueAddedServices', 50);
            $table->string('TravelInfo', 50);
            $table->string('PaxType', 50);
            $table->json('TravelDate', 50);
            $table->json('PaxInfo', 50);
            $table->json('RoomInfo', 50);
            $table->string('Priority');
            $table->string('TAT');
            $table->string('TourType', 50);
            $table->string('LeadSource');
            $table->string('LeadRefrenceId', 50);
            $table->string('HotelPrefrence', 50);
            $table->string('HotelType', 50);
            $table->string('MealPlan', 50);
            $table->string('AddedBy');
            $table->string('UpdatedBy');
            //$table->json('QueryJson');
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
