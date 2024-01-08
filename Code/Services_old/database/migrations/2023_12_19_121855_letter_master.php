<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LetterMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_LETTER_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('FromDestination', 100);
            $table->string('ToDestination', 100);
            $table->string('TransferMode', 100);
            $table->string('Name', 100);
            $table->string('GreetingNote', 255);
            $table->string('WelcomeNote', 255);
            $table->string('Status')->default(0);
            $table->string('AddedBy')->default(0);
            $table->string('UpdatedBy')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
