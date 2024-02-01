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
            $table->string('QueryId');
            $table->string('Subject');
            $table->date('FromDate');
            $table->date('ToDate');
            $table->integer('TotalPax');
            $table->string('LeadPaxName');
            $table->integer('Adult');
            $table->integer('Child');
            $table->json('JsonData');
            $table->integer('Status')->default(0);
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
