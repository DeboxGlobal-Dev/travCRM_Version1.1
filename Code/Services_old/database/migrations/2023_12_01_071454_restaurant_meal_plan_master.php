<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RestaurantMealPlanMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(_RESTAURANT_MEAL_PLAN_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->string('Name', 100);
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
