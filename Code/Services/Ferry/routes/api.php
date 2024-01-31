<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//===============================FERRY CONTROLLERS============================
use App\Http\Controllers\Master\FerryRateMasterController;
use App\Http\Controllers\Master\SearchFerryRateController;
use App\Http\Controllers\Master\FilterFerryRateController;
//===============================END HERE===================================

//===============================FERRY CONTROLLERS============================
Route::post('/searchferryrate',[SearchFerryRateController::class,'index']);
Route::post('/filterferryrate',[FilterFerryRateController::class,'index']);
Route::post('/addupdateferryratemaster',[FerryRateMasterController::class,'store']);
Route::post('/ferryratemasterlist',[FerryRateMasterController::class,'index']);
//===============================END HERE===================================


