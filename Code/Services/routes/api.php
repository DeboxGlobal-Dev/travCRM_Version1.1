<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Others\Master\ExampleController;
use App\Http\Controllers\Others\Master\BusinessTypeMasterController;
use App\Http\Controllers\Others\Master\CountryMasterController;
use App\Http\Controllers\Others\Master\StateMasterController;
use App\Http\Controllers\Others\Master\CityMasterController;
use App\Http\Controllers\Others\Master\DestinationMasterController;
use App\Http\Controllers\Others\Master\LanguageMasterController;

Route::post('/CountryMaster',[CountryMasterController::class,'save']);

Route::post('statelist',[StateMasterController::class,'index']);
Route::post('addupdatestate',[StateMasterController::class,'store']);
Route::post('deletestate',[StateMasterController::class,'destroy']);

Route::post('/CityMaster',[CityMasterController::class,'save']);

Route::post('/DestinationMaster',[DestinationMasterController::class,'save']);

Route::post('/BusinessTypeMaster',[BusinessTypeMasterController::class,'save']);

Route::post('/LanguageMaster',[LanguageMasterController::class,'save']);

Route::post('/users-api',[ExampleController::class,'apidata']);

