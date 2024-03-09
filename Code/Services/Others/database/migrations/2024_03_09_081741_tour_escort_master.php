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
        Schema::create(_TOUR_ESCORT_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('ServiceType');
            $table->string('Name');
            $table->string('MobileNumber');
            $table->string('WhatsAppNumber');
            $table->string('AlternateNumber');
            $table->string('Email');
            $table->string('TourEscortLicenseOne');
            $table->string('LicenseExpiry');
            $table->string('Destination');
            $table->string('Language');
            $table->string('TourEscortImageName');
            $table->text('TourEscortImageData');
            $table->string('Supplier');
            $table->string('TourEscortLicenseTwo');
            $table->string('ContactPerson');
            $table->string('Designation');
            $table->string('Country');
            $table->string('State');
            $table->string('City');
            $table->string('PinCode');
            $table->string('Detail');
            $table->string('Address');
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
