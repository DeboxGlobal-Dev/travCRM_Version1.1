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
        Schema::create(_EXPENSE_HEAD_MASTER, function (Blueprint $table) {
            $table->id();
            $table->string('ExpenseHead', 50);
            $table->integer('Status')->default(0);
            $table->bigInteger('AddedBy')->default(0);
            $table->bigInteger('UpdatedBy')->default(0);
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
