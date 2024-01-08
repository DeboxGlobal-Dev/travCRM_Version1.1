<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContactPersonMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_CONTACT_PERSON_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('ParentId');
            $table->integer('Title');
            $table->string('Name', 50)->default(null);
            $table->string('Designation', 125)->default(null);
            $table->string('CountryCode', 10)->default(null);
            $table->string('Phone1', 50)->default(null);
            $table->string('Phone2', 50)->default(null);
            $table->string('Phone3', 50)->default(null);
            $table->string('Email1', 100)->default(null);
            $table->string('Email2', 100)->default(null);
            $table->string('Type', 50)->default(null);
            $table->integer('SetDefault')->default(0);
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
