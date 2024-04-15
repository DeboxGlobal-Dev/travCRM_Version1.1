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
        Schema::create(_BANK_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('BankName', 50);
            $table->bigInteger('AccountNumber');
            $table->string('BranchAddress');
            $table->string('UpiId', 50);
            $table->string('AccountType', 50);
            $table->string('BeneficiaryName', 50);
            $table->string('BranchIfsc', 50);
            $table->string('BranchSwiftCode', 50);
            $table->string('ImageName', 50);
            $table->text('ImageData');
            $table->integer('ShowHide', 50);
            $table->integer('Status')->default(0);
            $table->integer('SetDefault')->default(0);
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
