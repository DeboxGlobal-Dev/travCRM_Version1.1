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

Route::post('/countrylist',[CountryMasterController::class,'index']);
Route::post('/addupdatecountry',[CountryMasterController::class,'store']);

Route::post('statelist',[StateMasterController::class,'index']);
Route::post('addupdatestate',[StateMasterController::class,'store']);
Route::post('deletestate',[StateMasterController::class,'destroy']);

Route::post('/citylist',[CityMasterController::class,'index']);
Route::post('/addupdatecity',[CityMasterController::class,'save']);

Route::post('/destinationlist',[DestinationMasterController::class,'index']);
Route::post('/addupdatedestination',[DestinationMasterController::class,'store']);

Route::post('/businesslist',[BusinessTypeMasterController::class,'index']);
Route::post('/addupdatebusiness',[BusinessTypeMasterController::class,'store']);

Route::post('/languagelist',[LanguageMasterController::class,'index']);
Route::post('/addupdatelanguage',[LanguageMasterController::class,'store']);

Route::post('/querylist',[QueryMasterController::class,'index']);
Route::post('/addupdatequery',[QueryMasterController::class,'save']);

Route::post('/users-api',[ExampleController::class,'apidata']);

