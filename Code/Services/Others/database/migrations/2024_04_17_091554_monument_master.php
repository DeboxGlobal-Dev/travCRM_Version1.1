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
        Schema::create(_MONUMENT_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('MonumentName');
            $table->integer('Destination');
            $table->integer('TransferType');
            $table->string('ClosedOnDays');
            $table->integer('DefaultQuotation')->default(0);
            $table->integer('DefaultProposal')->default(0);
            $table->string('WeekendDays');
            $table->text('Description');
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
