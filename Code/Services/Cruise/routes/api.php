<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//===============================CRUISE CONTROLLERS============================
use App\Http\Controllers\Master\CruiseRateMasterController;
use App\Http\Controllers\Master\SearchCruiseRateController;
use App\Http\Controllers\Master\FilterCruiseRateController;
//===============================END HERE===================================

//===============================CRUISE CONTROLLERS============================
Route::post('/searchcruiserate',[SearchCruiseRateController::class,'index']);
Route::post('/filtercruiserate',[FilterCruiseRateController::class,'index']);
Route::post('/addupdatecruiseratemaster',[CruiseRateMasterController::class,'store']);
Route::post('/cruiseratemasterlist',[CruiseRateMasterController::class,'index']);
//===============================END HERE===================================