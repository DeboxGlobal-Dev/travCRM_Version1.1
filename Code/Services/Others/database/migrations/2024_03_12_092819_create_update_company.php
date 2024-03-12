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
        Schema::create(_CREATE_UPDATE_COMPANY_, function (Blueprint $table) {
            $table->id();
            $table->string('COMPANYNAME', 250);
            $table->string('LICENSEKEY', 1000);
            $table->boolean('ISACTIVE');
            $table->date('ACTIONDATE');
            $table->string('LUT', 50);
            $table->string('ZIP', 50);
            $table->string('PAN', 50);
            $table->string('TAN', 50);
            $table->string('CIN', 50);
            $table->string('ADDRESS1', 500);
            $table->string('ADDRESS2', 500);
            $table->integer('ADDEDBY')->default(0);
            $table->integer('UPDATEDBY')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_company');
    }
};
