<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DestinationMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_DESTINATION_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('CountryId')->default(0);
            $table->integer('StateId')->default(0);
            $table->string('Name', 50)->default(null);
            $table->text('Description')->default(null);
            $table->integer('SetDefault')->default(0);
            $table->integer('Status')->default(0);
            $table->integer('AddedBy')->default(0);
            $table->integer('UpdatedBy')->default(0);
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
