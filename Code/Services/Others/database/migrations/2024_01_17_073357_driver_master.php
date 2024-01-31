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
        Schema::create(_DRIVER_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Country');
            $table->string('DriverName');
            $table->string('MobileNumber');
            $table->string('AlternateMobileNo');
            $table->string('WhatsappNumber');
            $table->string('LicenseNumber');
            $table->string('BirthDate');
            $table->string('LicenseName');
            $table->text('LicenseData');
            $table->string('PassportNumber');
            $table->string('Address');
            $table->string('ValidUpto');
            $table->string('ImageName');
            $table->text('ImageData');
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
