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
        Schema::create(_QUOTATION_INFO_, function (Blueprint $table) {
            $table->id();
            $table->integer('QueryId');
            $table->string('Subject');
            $table->string('FromDate');
            $table->string('ToDate');
            $table->string('Adult');
            $table->string('Child');
            $table->string('TotalPax');
            $table->string('LeadPaxName');
            $table->json('JsonData');
            $table->json('Version');
            $table->json('IsSave');
            $table->integer('Status')->default(0);
            $table->integer('AddedBy')->default(0);
            $table->integer('AddedBy')->default(0);
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
