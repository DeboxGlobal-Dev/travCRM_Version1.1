<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Others\Master\ExampleController;
use App\Http\Controllers\Others\Master\CityMasterController;
use App\Http\Controllers\Others\Master\RoomMasterController;
use App\Http\Controllers\Others\Master\StateMasterController;
use App\Http\Controllers\Hotel\Master\WeekendMasterController;
use App\Http\Controllers\Others\Master\SeasonMasterController;
use App\Http\Controllers\Others\Master\CountryMasterController;
use App\Http\Controllers\Others\Master\DivisionMasterController;
use App\Http\Controllers\Others\Master\LanguageMasterController;
use App\Http\Controllers\Others\Master\MealPlanMasterController;
use App\Http\Controllers\Others\Master\TourTypeMasterController;
use App\Http\Controllers\Others\Master\AmenitiesMasterController;
use App\Http\Controllers\Others\Master\HotelTypeMasterController;
use App\Http\Controllers\Others\Master\HotelChainMasterController;
use App\Http\Controllers\Others\Master\LeadSourceMasterController;
use App\Http\Controllers\Others\Master\RestaurantMasterController;
use App\Http\Controllers\Others\Master\DestinationMasterController;
use App\Http\Controllers\Others\Master\BusinessTypeMasterController;
use App\Http\Controllers\Others\Master\HotelCategoryMasterController;
use App\Http\Controllers\Others\Master\HotelAdditionalMasterController;
use App\Http\Controllers\Others\Master\RestaurantMealPlanMasterController;

//====================================OTHERS COMMON API ROUTE======================================
Route::post('/amenitieslist',[AmenitiesMasterController::class,'index']);
Route::post('/addupdateamenities',[AmenitiesMasterController::class,'store']);

Route::post('/businesstypelist',[BusinessTypeMasterController::class,'index']);
Route::post('/addupdatebusinesstype',[BusinessTypeMasterController::class,'store']);

Route::post('/countrylist',[CountryMasterController::class,'index']);
Route::post('/addupdatecountry',[CountryMasterController::class,'store']);

Route::post('statelist',[StateMasterController::class,'index']);
Route::post('addupdatestate',[StateMasterController::class,'store']);
Route::post('deletestate',[StateMasterController::class,'destroy']);

Route::post('/citylist',[CityMasterController::class,'index']);
Route::post('/addupdatecity',[CityMasterController::class,'store']);

Route::post('/destinationlist',[DestinationMasterController::class,'index']);
Route::post('/addupdatedestination',[DestinationMasterController::class,'store']);

Route::post('/divisionlist',[DivisionMasterController::class,'index']);
Route::post('/addupdatedivision',[DivisionMasterController::class,'store']);

Route::post('/hoteladditionlist',[HotelAdditionalMasterController::class,'index']);
Route::post('/addupdatehoteladdition',[HotelAdditionalMasterController::class,'store']);

Route::post('/hotelcategorylist',[HotelCategoryMasterController::class,'index']);
Route::post('/addupdatehotelcategory',[HotelCategoryMasterController::class,'store']);

Route::post('/hoteltypelist',[HotelTypeMasterController::class,'index']);
Route::post('/addupdatehoteltype',[HotelTypeMasterController::class,'store']);

Route::post('/hotelchainlist',[HotelChainMasterController::class,'index']);
Route::post('/addupdatehotelchain',[HotelChainMasterController::class,'store']);

Route::post('/languagelist',[LanguageMasterController::class,'index']);
Route::post('/addupdatelanguage',[LanguageMasterController::class,'store']);

Route::post('/leadlist',[LeadSourceMasterController::class,'index']);
Route::post('/addupdatelead',[LeadSourceMasterController::class,'store']);

Route::post('/hotelmealplanlist',[MealPlanMasterController::class,'index']);
Route::post('/addupdatehotelmealplan',[MealPlanMasterController::class,'store']);

Route::post('/restaurantmasterlist',[RestaurantMasterController::class,'index']);
Route::post('/addupdaterestaurantmaster',[RestaurantMasterController::class,'store']);

Route::post('/restaurantmeallist',[RestaurantMealPlanMasterController::class,'index']);
Route::post('/addupdaterestaurantmeal',[RestaurantMealPlanMasterController::class,'store']);

Route::post('/roomlist',[RoomMasterController::class,'index']);
Route::post('/addupdateroom',[RoomMasterController::class,'store']);

Route::post('/seasonlist',[SeasonMasterController::class,'index']);
Route::post('/addupdateseason',[SeasonMasterController::class,'store']);

Route::post('/tourlist',[TourTypeMasterController::class,'index']);
Route::post('/addupdatetour',[TourTypeMasterController::class,'store']);

Route::post('/weekendlist',[WeekendMasterController::class,'index']);
Route::post('/addupdateweekend',[WeekendMasterController::class,'store']);
//===========================================END HERE========================================


// ========================================Hotel API ROUTE===================================

//code here


// ===========================================END HERE=======================================
