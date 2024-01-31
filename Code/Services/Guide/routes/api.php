<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//===============================GUIDE CONTROLLERS============================
use App\Http\Controllers\Master\GuideRateMasterController;
use App\Http\Controllers\Master\SearchGuideRateController;
use App\Http\Controllers\Master\FilterGuideRateController;
//===============================END HERE===================================

//===============================GUIDE CONTROLLERS============================
Route::post('/searchguiderate',[SearchGuideRateController::class,'index']);
Route::post('/filterguiderate',[FilterGuideRateController::class,'index']);
Route::post('/addupdateguideratemaster',[GuideRateMasterController::class,'store']);
Route::post('/guideratemasterlist',[GuideRateMasterController::class,'index']);
//===============================END HERE===================================

