<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueryBuilder\QueryMasterController;
use App\Http\Controllers\QueryBuilder\NewQueryMasterController;
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

Route::post('/querymasterlist',[QueryMasterController::class,'index']);
Route::post('addupdatequerymaster',[QueryMasterController::class,'store']);
