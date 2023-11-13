<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\ExampleController;
use App\Http\Controllers\Master\BusinessTypeMasterController;
use App\Http\Controllers\Master\CountryMasterController;
use App\Http\Controllers\Master\StateMasterController;
use App\Http\Controllers\Master\CityMasterController;
use App\Http\Controllers\Master\DestinationMasterController;
use App\Http\Controllers\Master\LanguageMasterController;

Route::post('/CountryMaster',[CountryMasterController::class,'save']);
Route::delete('/CountryMaster/{id}',[CountryMasterController::class,'destroy']);

Route::get('Statemasterlist',[StateMasterController::class,'index']);
Route::post('StateMaster',[StateMasterController::class,'save']);
Route::delete('/StateMaster/{id}',[StateMasterController::class,'destroy']);

Route::post('/CityMaster',[CityMasterController::class,'save']);
Route::delete('/CityMaster/{id}',[CityMasterController::class,'destroy']);

Route::post('/DestinationMaster',[DestinationMasterController::class,'save']);
Route::delete('/DestinationMaster/{id}',[DestinationMasterController::class,'destroy']);

Route::post('/BusinessTypeMaster',[BusinessTypeMasterController::class,'save']);
Route::delete('/BusinessTypeMaster/{id}',[BusinessTypeMasterController::class,'destroy']);

Route::post('/LanguageMaster',[LanguageMasterController::class,'save']);
Route::delete('/LanguageMaster/{id}',[LanguageMasterController::class,'destroy']);

Route::post('/users-api',[ExampleController::class,'apidata']);
Route::delete('/user-api/{id}',[ExampleController::class,'destroy']);
