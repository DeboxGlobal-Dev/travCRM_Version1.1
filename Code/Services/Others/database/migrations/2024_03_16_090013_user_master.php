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
            $table->bigInteger('CompanyKey');
            $table->string('UserCode', 20);
            $table->string('FirstName', 50);
            $table->string('LastName', 50);
            $table->string('Email', 50);
            $table->string('Phone', 50);
            $table->string('Mobile', 50);
            $table->string('Password', 50);
            $table->decimal('PIN');
            $table->integer('Role');
            $table->string('Street', 20);
            $table->string('LanguageKnown', 10);
            $table->integer('TimeFormat');
            $table->integer('Profile');
            $table->string('Destination', 20);
            $table->integer('UsersDepartment');
            $table->integer('ReportingManager');
            $table->integer('UserType');
            $table->integer('UserLoginType');
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
