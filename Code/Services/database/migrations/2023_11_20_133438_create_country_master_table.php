<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_master', function (Blueprint $table) {
            $table->id();
            $table->string('Name', 50);
            $table->string('ShortName', 10);
            $table->integer('SetDefault')->length(1);
            $table->integer('Status')->length(1);
            $table->integer('AddedBy')->default('0');
            $table->integer('UpdatedBy')->default('0');
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
        Schema::dropIfExists('country_master');
    }
}
