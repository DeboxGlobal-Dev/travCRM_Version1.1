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
        Schema::create(_ISO_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->integer('Status');
            $table->integer('AddedBy');
            $table->integer('UpdatedBy');
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
