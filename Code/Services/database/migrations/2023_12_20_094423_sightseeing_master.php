<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SightseeingMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_SIGHTSEEING_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 100);
            $table->integer('DestinationId');
            $table->string('TransferType', 100);
            $table->string('DefaultQuotation', 100);
            $table->string('DefaultProposal', 100);
            $table->integer('CurrencyId');
            $table->string('AdultCost', 100);
            $table->string('ChildCost', 100);
            $table->string('Details', 100);
            $table->string('InclusionsExclusionsTiming', 100);
            $table->string('ImportantNote', 100);
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
