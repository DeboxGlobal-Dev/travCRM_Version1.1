<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//===============================TRAIN CONTROLLERS============================
use App\Http\Controllers\Master\TrainRateMasterController;
use App\Http\Controllers\Master\SearchTrainRateController;
use App\Http\Controllers\Master\FilterTrainRateController;
//===============================END HERE===================================

//===============================TRAIN CONTROLLERS============================
Route::post('/searchtrainrate',[SearchTrainRateController::class,'index']);
Route::post('/filtertrainrate',[FilterTrainRateController::class,'index']);
Route::post('/addupdatetrainratemaster',[TrainRateMasterController::class,'store']);
Route::post('/trainratemasterlist',[TrainRateMasterController::class,'index']);

//===============================END HERE===================================

