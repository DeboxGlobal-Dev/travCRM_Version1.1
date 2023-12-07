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
use App\Http\Controllers\Others\Master\DivisionMasterController;
use App\Http\Controllers\Others\Master\LeadSourceMasterController;

use App\Http\Controllers\Hotel\Master\HotelTypeMasterController;
use App\Http\Controllers\Hotel\Master\HotelCategoryMasterController;
use App\Http\Controllers\Hotel\Master\MealPlanMasterController;
use App\Http\Controllers\Hotel\Master\AmenitiesMasterController;
use App\Http\Controllers\Hotel\Master\TourTypeMasterController;
use App\Http\Controllers\Hotel\Master\SeasonMasterController;
use App\Http\Controllers\Hotel\Master\RestaurantMealPlanMasterController;
use App\Http\Controllers\Hotel\Master\HotelAdditionalMasterController;
use App\Http\Controllers\Hotel\Master\RestaurantMasterController;

Route::post('/countrylist',[CountryMasterController::class,'index']);
Route::post('/addupdatecountry',[CountryMasterController::class,'store']);

Route::post('statelist',[StateMasterController::class,'index']);
Route::post('addupdatestate',[StateMasterController::class,'store']);
Route::post('deletestate',[StateMasterController::class,'destroy']);

Route::post('/citylist',[CityMasterController::class,'index']);
Route::post('/addupdatecity',[CityMasterController::class,'store']);

Route::post('/destinationlist',[DestinationMasterController::class,'index']);
Route::post('/addupdatedestination',[DestinationMasterController::class,'store']);

Route::post('/businesslist',[BusinessTypeMasterController::class,'index']);
Route::post('/addupdatebusiness',[BusinessTypeMasterController::class,'store']);

Route::post('/languagelist',[LanguageMasterController::class,'index']);
Route::post('/addupdatelanguage',[LanguageMasterController::class,'store']);

Route::post('/querylist',[QueryMasterController::class,'index']);
Route::post('/addupdatequery',[QueryMasterController::class,'save']);

Route::post('/divisionlist',[DivisionMasterController::class,'index']);
Route::post('/addupdatedivision',[DivisionMasterController::class,'store']);

Route::post('/leadlist',[LeadSourceMasterController::class,'index']);
Route::post('/addupdatelead',[LeadSourceMasterController::class,'store']);

Route::post('/users-api',[ExampleController::class,'apidata']);

// ========================Hotel API ROUTE========================

Route::post('/hoteltypelist',[HotelTypeMasterController::class,'index']);
Route::post('/addupdatehoteltype',[HotelTypeMasterController::class,'store']);

Route::post('/hotelcategorylist',[HotelCategoryMasterController::class,'index']);
Route::post('/addupdatehotelcategory',[HotelCategoryMasterController::class,'store']);

Route::post('/meallist',[MealPlanMasterController::class,'index']);
Route::post('/addupdatemeal',[MealPlanMasterController::class,'store']);

Route::post('/amenitieslist',[AmenitiesMasterController::class,'index']);
Route::post('/addupdateamenities',[AmenitiesMasterController::class,'store']);

Route::post('/tourlist',[TourTypeMasterController::class,'index']);
Route::post('/addupdatetour',[TourTypeMasterController::class,'store']);

Route::post('/seasonlist',[SeasonMasterController::class,'index']);
Route::post('/addupdateseason',[SeasonMasterController::class,'store']);

Route::post('/restaurantlist',[RestaurantMealPlanMasterController::class,'index']);
Route::post('/addupdaterestaurant',[RestaurantMealPlanMasterController::class,'store']);

Route::post('/hotellist',[HotelAdditionalMasterController::class,'index']);
Route::post('/addupdatehotel',[HotelAdditionalMasterController::class,'store']);

Route::post('/restaurantmasterlist',[RestaurantMasterController::class,'index']);
Route::post('/addupdaterestaurantmaster',[RestaurantMasterController::class,'store']);