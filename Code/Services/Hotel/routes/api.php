<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Master\HotelRateMasterController;
use App\Http\Controllers\Master\SearchHotelRateController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/hotelratelist',[HotelRateMasterController::class,'index']);
Route::post('/addupdatehotelrate',[HotelRateMasterController::class,'store']);

Route::post('/searchhotelratelist',[SearchHotelRateController::class,'index']);
Route::post('/addupdatesearchhotelrate',[SearchHotelRateController::class,'store']);
