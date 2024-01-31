<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MonumentRateMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_MONUMENT_RATE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('SupplierName',100);
            $table->string('Nationality',100);
            $table->string('TraficType',100);
            $table->string('RateValidFrom',100);
            $table->string('RateValidTo',100);
            $table->string('TransferType',100);
            $table->integer('Currency');
            $table->integer('AdultTicketCost');
            $table->integer('ChildTicketCost');
            $table->integer('InfantTicketCost');
            $table->Integer('MarkupType');
            $table->Integer('MarkupCost');
            $table->Integer('TaxSlab');
            $table->float('Policy');
            $table->float('TAC');
            $table->text('Remarks');
            $table->Integer('Status')->default(0);
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
