<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CruiseNameMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_CRUISE_NAME_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('CruiseCompany', 100);
            $table->string('CruiseName', 100);
            $table->string('Status')->default(0);
            $table->string('ImageName', 100);
            $table->text('ImageData');
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
