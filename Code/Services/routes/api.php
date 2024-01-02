<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//===============================OTHERS CONTROLLERS==================================
use App\Http\Controllers\Others\Master\CityMasterController;
use App\Http\Controllers\Others\Master\RoomMasterController;
use App\Http\Controllers\Others\Master\HotelMasterController;
use App\Http\Controllers\Others\Master\StateMasterController;
use App\Http\Controllers\Others\Master\MarketMasterController;
use App\Http\Controllers\Others\Master\SeasonMasterController;
use App\Http\Controllers\Others\Master\CountryMasterController;
use App\Http\Controllers\Others\Master\WeekendMasterController;
use App\Http\Controllers\Others\Master\ContactDetailsController;
use App\Http\Controllers\Others\Master\CurrencyMasterController;
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
use App\Http\Controllers\Others\Master\ItineraryInfoMasterController;
use App\Http\Controllers\Others\Master\LetterMasterController;
use App\Http\Controllers\Others\Master\AdditionalRequirementMasterController;
use App\Http\Controllers\Others\Master\ImageGalleryMasterController;
use App\Http\Controllers\Others\Master\QueryMasterController;


//===============================HOTEL CONTROLLERS==================================
use App\Http\Controllers\Hotel\Master\HotelRateMasterController;
use App\Http\Controllers\Hotel\Master\SearchHotelRateController;

//===============================TRANSPORT CONTROLLERS==================================
use App\Http\Controllers\Transport\Master\VehicleTypeMasterController;
use App\Http\Controllers\Transport\Master\VehicleBrandMasterController;
use App\Http\Controllers\Transport\Master\TransferTypeMasterController;
use App\Http\Controllers\Transport\Master\VehicleMasterController;
use App\Http\Controllers\Transport\Master\CabinCategoryMasterController;
use App\Http\Controllers\Transport\Master\CabinTypeMasterController;
use App\Http\Controllers\Transport\Master\CruiseMasterController;
use App\Http\Controllers\Transport\Master\CruiseCompanyMasterController;
use App\Http\Controllers\Transport\Master\CruiseNameMasterController;

// =================================SIGHTSEENING CONTROLLER===============================
use App\Http\Controllers\Sightseeing\Master\AirlineMasterController;
use App\Http\Controllers\Sightseeing\Master\MonumentMasterController;
use App\Http\Controllers\Sightseeing\Master\SightseeingMasterController;
use App\Http\Controllers\Sightseeing\Master\TrainMasterController;
use App\Http\Controllers\Sightseeing\Master\MonumentRateMasterController;
use App\Http\Controllers\Sightseeing\Master\AirRateMasterController;
use App\Http\Controllers\Sightseeing\Master\ActivityRateMasterController;
use App\Http\Controllers\Sightseeing\Master\TrainRateMasterController;

//===============================VISA CONTROLLERS==================================
use App\Http\Controllers\Visa\Master\VisaMasterController;
use App\Http\Controllers\Visa\Master\UserMasterController;







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

Route::post('/currencymasterlist',[CurrencyMasterController::class,'index']);
Route::post('/addupdatecurrencymaster',[CurrencyMasterController::class,'store']);

Route::post('/hotellist',[HotelMasterController::class,'index']);
Route::post('/addupdatehotel',[HotelMasterController::class,'store']);

Route::post('/contactlist',[ContactDetailsController::class,'index']);
Route::post('/addupdatecontact',[ContactDetailsController::class,'store']);

Route::post('/marketlist',[MarketMasterController::class,'index']);
Route::post('/addupdatemarket',[MarketMasterController::class,'store']);

Route::post('/itineraryinfomasterlist',[ItineraryInfoMasterController::class,'index']);
Route::post('/addupdateitineraryinfomaster',[ItineraryInfoMasterController::class,'store']);

Route::post('/lettermasterlist',[LetterMasterController::class,'index']);
Route::post('/addupdatelettermaster',[LetterMasterController::class,'store']);

Route::post('/imagegallerylist',[ImageGalleryMasterController::class,'index']);
Route::post('/addupdateimagegallery',[ImageGalleryMasterController::class,'store']);

Route::post('/querymasterlist',[QueryMasterController::class,'index']);
Route::post('/addupdatequerymaster',[QueryMasterController::class,'store']);

Route::post('/additionalrequirementmasterlist',[AdditionalRequirementMasterController::class,'index']);
Route::post('/addupdateadditionalrequirementmaster',[AdditionalRequirementMasterController::class,'store']);
//===========================================END HERE========================================

// ========================================Hotel API ROUTE===================================
Route::post('/hotelratelist',[HotelRateMasterController::class,'index']);
Route::post('/addupdatehotelrate',[HotelRateMasterController::class,'store']);

Route::post('/searchhotelratelist',[SearchHotelRateController::class,'index']);
Route::post('/addupdatesearchhotelrate',[SearchHotelRateController::class,'store']);
// ===========================================END HERE=======================================

// ========================================Transport API ROUTE===============================
Route::post('/vehicletypemasterlist',[VehicleTypeMasterController::class,'index']);
Route::post('/addupdatevehicletypemaster',[VehicleTypeMasterController::class,'store']);

Route::post('/vehiclebrandmasterlist',[VehicleBrandMasterController::class,'index']);
Route::post('/addupdatevehiclebrandmaster',[VehicleBrandMasterController::class,'store']);

Route::post('/transfertypemasterlist',[TransferTypeMasterController::class,'index']);
Route::post('/addupdatetransfertypemaster',[TransferTypeMasterController::class,'store']);

Route::post('/vehiclemasterlist',[VehicleMasterController::class,'index']);
Route::post('/addupdatevehiclemaster',[VehicleMasterController::class,'store']);

Route::post('/cabincategorymasterlist',[CabinCategoryMasterController::class,'index']);
Route::post('/addupdatecabincategorymaster',[CabinCategoryMasterController::class,'store']);

Route::post('/cabintypemasterlist',[CabinTypeMasterController::class,'index']);
Route::post('/addupdatecabintypemaster',[CabinTypeMasterController::class,'store']);

Route::post('/cruisemasterlist',[CruiseMasterController::class,'index']);
Route::post('/addupdatecruisemaster',[CruiseMasterController::class,'store']);

Route::post('/cruisecompanymasterlist',[CruiseCompanyMasterController::class,'index']);
Route::post('/addupdatecruisecompanymaster',[CruiseCompanyMasterController::class,'store']);

Route::post('/cruisenamemasterlist',[CruiseNameMasterController::class,'index']);
Route::post('/addupdatecruisenamemaster',[CruiseNameMasterController::class,'store']);
// ===========================================END HERE=======================================

// =============================================SIGHTSEENING API ROUTE================================
Route::post('/airlinemasterlist',[AirlineMasterController::class,'index']);
Route::post('/addupdateairlinemaster',[AirlineMasterController::class,'store']);

Route::post('/trainMasterlist',[TrainMasterController::class,'index']);
Route::post('/addupdatetrainmaster',[TrainMasterController::class,'store']);

Route::post('/sightseeingmasterlist',[SightseeingMasterController::class,'index']);
Route::post('/addupdatesightseeingmaster',[SightseeingMasterController::class,'store']);

Route::post('/monumentmasterlist',[MonumentMasterController::class,'index']);
Route::post('/addupdatemonumentmaster',[MonumentMasterController::class,'store']);

Route::post('/monumentratemasterlist',[MonumentRateMasterController::class,'index']);
Route::post('/addupdatemonumentratemaster',[MonumentRateMasterController::class,'store']);

Route::post('/trainratemasterlist',[TrainRateMasterController::class,'index']);
Route::post('/addupdatetrainratemaster',[TrainRateMasterController::class,'store']);

Route::post('/activityratemasterlist',[ActivityRateMasterController::class,'index']);
Route::post('/addupdateactivityratemaster',[ActivityRateMasterController::class,'store']);

Route::post('/airratemasterlist',[AirRateMasterController::class,'index']);
Route::post('/addupdateairratemaster',[AirRateMasterController::class,'store']);

// ===========================================END HERE=======================================

// =============================================SIGHTSEENING API ROUTE================================
Route::post('/visamasterlist',[VisaMasterController::class,'index']);
Route::post('/addupdatevisamaster',[VisaMasterController::class,'store']);

Route::post('/adduser',[UserMasterController::class,'store']);
Route::post('/userlist',[UserMasterController::class,'index']);



