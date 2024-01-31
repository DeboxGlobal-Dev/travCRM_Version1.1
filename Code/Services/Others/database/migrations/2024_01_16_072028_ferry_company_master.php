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
        Schema::create(_FERRY_COMPANY_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('FerryCompanyName');
            $table->string('Destination');
            $table->string('Website');
            $table->string('SelfSupplier');
            $table->string('Type');
            $table->string('ContactPers');
            $table->string('Designation');
            $table->string('Phone');
            $table->string('Email');
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
