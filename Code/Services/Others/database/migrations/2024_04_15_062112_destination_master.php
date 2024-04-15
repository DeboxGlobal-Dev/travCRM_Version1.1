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
        Schema::create(_DESTINATION_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('CountryId');
            $table->string('StateId');
            $table->string('Name', 50);
            $table->string('Description', 150);
            $table->string('SetDefault', 50);
            $table->string('Status');
            $table->string('AddedBy')->default('0');
            $table->string('UpdatedBy')->default('0');
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
