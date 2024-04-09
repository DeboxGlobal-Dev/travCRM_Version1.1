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
        Schema::create(_ROOM_TYPE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('RoomName', 20);
            $table->string('MaximumOccupancy');
            $table->integer('Bedding');
            $table->string('Size');
            $table->integer('Status')->default(0);
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
