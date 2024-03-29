<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuotationRule\QuotationRuleController;
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

Route::post('/quotationinfolist',[QuotationRuleController::class,'index']);
Route::post('/addquotationinfo',[QuotationRuleController::class,'store']);
Route::post('/updatequotationinfo',[QuotationRuleController::class,'updatedata']);
//Route::post('/increamentquotation',[QuotationRuleController::class,'increamentcolumn']);