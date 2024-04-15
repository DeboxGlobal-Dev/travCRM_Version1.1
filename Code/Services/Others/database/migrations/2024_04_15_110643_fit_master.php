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
        Schema::create(_FIT_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Destination');
            $table->text('Inclusion');
            $table->text('Exclusion');
            $table->text('TermsCondition');
            $table->string('Cancelation');
            $table->string('ServiceUpgradation');
            $table->text('OptionalTour');
            $table->text('PaymentPolicy');
            $table->string('Remarks');
            $table->integer('Status')->default(0);
            $table->integer('SetDefault')->default(0);
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
