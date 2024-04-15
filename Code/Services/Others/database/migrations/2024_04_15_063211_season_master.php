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
        Schema::create(_SEASON_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('SeasonName', 20);
            $table->string('Name', 50);
            $table->date('FromDate');
            $table->string('Status')->default(0);
            $table->date('ToDate');
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
