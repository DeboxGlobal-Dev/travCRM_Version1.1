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
        Schema::create(_QUERY_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('QueryId', 50);
            $table->integer('ClientType')->default(0);
            $table->string('LeadPax', 100);
            $table->string('Subject', 100);
            $table->integer('QueryType')->default(0);
            $table->integer('Priority')->default(0);
            $table->string('TAT');
            $table->string('LeadSource');
            $table->date('FromDate');
            $table->date('ToDate');
            $table->integer('AddedBy');
            $table->integer('UpdatedBy');
            $table->json('QueryJson');
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
