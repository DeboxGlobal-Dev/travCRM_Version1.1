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
        Schema::create(_USERS_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('CompanyKey', 250);
            $table->string('UserCode', 250);
            $table->string('FirstName', 50);
            $table->string('LastName', 50);
            $table->string('Email', 50);
            $table->string('Phone', 50);
            $table->string('Mobile', 50);
            $table->string('Password', 50);
            $table->string('PIN', 50);
            $table->string('Role', 250);
            $table->string('Street', 250);
            $table->string('LanguageKnown', 250);
            $table->string('TimeFormat', 250);
            $table->string('Profile', 250);
            $table->string('Destination', 250);
            $table->string('UsersDepartment', 250);
            $table->string('ReportingManager', 250);
            $table->string('UserType', 250);
            $table->string('UserLoginType', 250);
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
