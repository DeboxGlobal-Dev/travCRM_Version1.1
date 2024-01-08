<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrainMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_TRAIN_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 100);
            $table->string('ImageName', 100);
            $table->string('ImageData', 100);
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
