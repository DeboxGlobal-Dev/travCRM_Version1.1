<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//===============================SIGHTSEEING CONTROLLERS============================
use App\Http\Controllers\Master\ActivityRateMasterController;
use App\Http\Controllers\Master\SearchActivityRateController;
use App\Http\Controllers\Master\FilterActivityRateController;
//===============================END HERE===================================

//===============================SIGHTSEEING CONTROLLERS============================
Route::post('/searchactivityrate',[SearchActivityRateController::class,'index']);
Route::post('/filteractivityrate',[FilterActivityRateController::class,'index']);
Route::post('/addupdateactivityratemaster',[ActivityRateMasterController::class,'store']);
Route::post('/activityratemasterlist',[ActivityRateMasterController::class,'index']);
//===============================END HERE===================================
