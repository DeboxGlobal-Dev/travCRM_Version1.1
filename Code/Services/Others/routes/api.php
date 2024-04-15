<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Master\AdditionalRequirementMasterController;
use App\Http\Controllers\Master\AmenitiesMasterController;
use App\Http\Controllers\Master\BusinessTypeMasterController;
use App\Http\Controllers\Master\CityMasterController;
use App\Http\Controllers\Master\ContactDetailsController;
use App\Http\Controllers\Master\CountryMasterController;
use App\Http\Controllers\Master\CurrencyMasterController;
use App\Http\Controllers\Master\DestinationMasterController;
use App\Http\Controllers\Master\DivisionMasterController;
use App\Http\Controllers\Master\HotelAdditionalMasterController;
use App\Http\Controllers\Master\HotelCategoryMasterController;
use App\Http\Controllers\Master\HotelChainMasterController;
use App\Http\Controllers\Master\HotelMasterController;
use App\Http\Controllers\Master\HotelTypeMasterController;
use App\Http\Controllers\Master\ImageGalleryMasterController;
use App\Http\Controllers\Master\ItineraryInfoMasterController;
use App\Http\Controllers\Master\LanguageMasterController;
use App\Http\Controllers\Master\LeadSourceMasterController;
use App\Http\Controllers\Master\LetterMasterController;
use App\Http\Controllers\Master\MarketMasterController;
use App\Http\Controllers\Master\MealPlanMasterController;
use App\Http\Controllers\Master\RestaurantMasterController;
use App\Http\Controllers\Master\RestaurantMealPlanMasterController;
use App\Http\Controllers\Master\RoomMasterController;
use App\Http\Controllers\Master\SeasonMasterController;
use App\Http\Controllers\Master\StateMasterController;
use App\Http\Controllers\Master\TourTypeMasterController;
use App\Http\Controllers\Master\WeekendMasterController;
use App\Http\Controllers\Master\AirlineMasterController;
use App\Http\Controllers\Master\MonumentMasterController;
use App\Http\Controllers\Master\SightseeingMasterController;
use App\Http\Controllers\Master\TrainMasterController;
use App\Http\Controllers\Master\CabinCategoryMasterController;
use App\Http\Controllers\Master\CabinTypeMasterController;
use App\Http\Controllers\Master\CruiseCompanyMasterController;
use App\Http\Controllers\Master\CruiseMasterController;
use App\Http\Controllers\Master\CruiseNameMasterController;
use App\Http\Controllers\Master\TransferTypeMasterController;
use App\Http\Controllers\Master\VehicleBrandMasterController;
use App\Http\Controllers\Master\VehicleMasterController;
use App\Http\Controllers\Master\VehicleTypeMasterController;
use App\Http\Controllers\Master\UserMasterController;
use App\Http\Controllers\Master\VisaMasterController;
use App\Http\Controllers\Master\PackagesMasterController;

use App\Http\Controllers\Master\FerrySearMasterController;
use App\Http\Controllers\Master\FerryNameMasterController;
use App\Http\Controllers\Master\FerryCompanyMasterController;
use App\Http\Controllers\Master\DriverMasterController;
use App\Http\Controllers\Master\ModuleMasterController;
use App\Http\Controllers\Master\VisaTypeMasterController;
use App\Http\Controllers\Master\VisaCostMasterController;
use App\Http\Controllers\Master\InsuranceTypeMasterController;
use App\Http\Controllers\Master\InsuranceCostMasterController;
use App\Http\Controllers\Master\TourEscortPriceMasterController;
use App\Http\Controllers\Master\TourEscortMasterController;
use App\Http\Controllers\Master\CompanyController;
use App\Http\Controllers\Master\CreateUpdateCompanyController;
use App\Http\Controllers\Master\CreateUpdateUserController;
use App\Http\Controllers\Master\TempUploadController;
use App\Http\Controllers\Master\HotelImportController;
use App\Http\Controllers\Master\RoomTypeController;
use App\Http\Controllers\Master\OperationRestrictionController;
use App\Http\Controllers\Master\SacCodeController;
use App\Http\Controllers\Master\PaymentTypeNameController;
use App\Http\Controllers\Master\ExpenseHeadMasterController;
use App\Http\Controllers\Master\ExpenseTypeMasterController;
use App\Http\Controllers\Master\TaxMasterController;
use App\Http\Controllers\Master\BankMasterController;
use App\Http\Controllers\Master\ItineraryOverviewController;
use App\Http\Controllers\Master\GitController;




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
Route::post('/importhotel',[HotelMasterController::class,'hotelImport']);

Route::post('/contactlist',[ContactDetailsController::class,'index']);
Route::post('/addupdatecontact',[ContactDetailsController::class,'store']);

Route::post('/marketlist',[MarketMasterController::class,'index']);
Route::post('/addupdatemarket',[MarketMasterController::class,'store']);

Route::post('/itineraryinfomasterlist',[ItineraryInfoMasterController::class,'index']);
Route::post('/addupdateitineraryinfomaster',[ItineraryInfoMasterController::class,'store']);

Route::post('/lettermasterlist',[LetterMasterController::class,'index']);
Route::post('/addupdatelettermaster',[LetterMasterController::class,'store']);

Route::get('/imagegallerylist',[ImageGalleryMasterController::class,'index']);
Route::post('/addupdateimagegallery',[ImageGalleryMasterController::class,'store']);

Route::post('/additionalrequirementmasterlist',[AdditionalRequirementMasterController::class,'index']);
Route::post('/addupdateadditionalrequirementmaster',[AdditionalRequirementMasterController::class,'store']);

Route::post('/ferrysearlist',[FerrySearMasterController::class,'index']);
Route::post('/addupdateferrysear',[FerrySearMasterController::class,'store']);

Route::post('/ferrynamelist',[FerryNameMasterController::class,'index']);
Route::post('/addupdateferryname',[FerryNameMasterController::class,'store']);

Route::post('/ferrycompanylist',[FerryCompanyMasterController::class,'index']);
Route::post('/addupdateferrycompany',[FerryCompanyMasterController::class,'store']);

// Route::post('/drivermasterlist',[DriverMasterController::class,'index']);
// Route::post('/addupdatedrivermaster',[DriverMasterController::class,'store']);

Route::post('/modulemasterlist',[ModuleMasterController::class,'index']);
Route::post('/addupdatemodulemaster',[ModuleMasterController::class,'store']);

Route::post('/visatypemasterlist',[VisaTypeMasterController::class,'index']);
Route::post('/addupdatevisatypemaster',[VisaTypeMasterController::class,'store']);

Route::post('/visacostmasterlist',[VisaCostMasterController::class,'index']);
Route::post('/addupdatevisacostmaster',[VisaCostMasterController::class,'store']);

Route::post('/insurancetypemasterlist',[InsuranceTypeMasterController::class,'index']);
Route::post('/addupdateinsurancetypemaster',[InsuranceTypeMasterController::class,'store']);

Route::post('/insurancecostmasterlist',[InsuranceCostMasterController::class,'index']);
Route::post('/addupdateinsurancecostmaster',[InsuranceCostMasterController::class,'store']);

Route::post('/tourescortpricelist',[TourEscortPriceMasterController::class,'index']);
Route::post('/addupdatetourescortprice',[TourEscortPriceMasterController::class,'store']);

Route::post('/tourescortmasterlist',[TourEscortMasterController::class,'index']);
Route::post('/addupdatetourescortmaster',[TourEscortMasterController::class,'store']);

Route::post('/healthcheck',[HealthCheckController::class,'index']);

Route::post('/createupdatecompany',[CreateUpdateCompanyController::class,'store']);
Route::post('/companylist',[CreateUpdateCompanyController::class,'index']);

Route::post('/usersall',[CreateUpdateUserController::class,'index']);
Route::post('/createupdateuser',[CreateUpdateUserController::class,'store']);

Route::post('/authuservalidate',[AuthoriseUserController::class,'authenticate']);

Route::post('/uploaddata',[TempUploadController::class,'store']);
//Route::post('/hotelimportlist',[HotelImportController::class,'hotelImport']);
Route::post('/importdata',[HotelImportController::class,'store']);

Route::post('/roomtypelist',[RoomTypeController::class,'index']);
Route::post('/addupdateroomtype',[RoomTypeController::class,'store']);

Route::post('/operationlist',[OperationRestrictionController::class,'index']);
Route::post('/addupdateoperation',[OperationRestrictionController::class,'store']);

Route::post('/saccodelist',[SacCodeController::class,'index']);
Route::post('/addupdatesaccode',[SacCodeController::class,'store']);

Route::post('/paymenttypelist',[PaymentTypeNameController::class,'index']);
Route::post('/addupdatepaymenttype',[PaymentTypeNameController::class,'store']);

Route::post('/expenseheadmasterlist',[ExpenseHeadMasterController::class,'index']);
Route::post('/addupdateexpensehead',[ExpenseHeadMasterController::class,'store']);

Route::post('/expensetypemasterlist',[ExpenseTypeMasterController::class,'index']);
Route::post('/addupdateexpensetype',[ExpenseTypeMasterController::class,'store']);

Route::post('/taxmasterlist',[TaxMasterController::class,'index']);
Route::post('/addupdatetax',[TaxMasterController::class,'store']);

Route::post('/bankmasterlist',[BankMasterController::class,'index']);
Route::post('/addupdatebank',[BankMasterController::class,'store']);

Route::post('/gitmasterlist',[GitController::class,'index']);
Route::post('/addupdategit',[GitController::class,'store']);

Route::post('/itineraryoverviewlist',[ItineraryOverviewController::class,'index']);
Route::post('/addupdateitineraryoverview',[ItineraryOverviewController::class,'store']);
//===========================================END HERE========================================

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

//===========================================END HERE=======================================

//=============================================VISA API ROUTE================================
Route::post('/visamasterlist',[VisaMasterController::class,'index']);
Route::post('/addupdatevisamaster',[VisaMasterController::class,'store']);

// Route::post('/adduser',[UserMasterController::class,'store']);
// Route::post('/userlist',[UserMasterController::class,'index']);

Route::post('/addpackage',[PackagesMasterController::class,'store']);
Route::post('/packagelist',[PackagesMasterController::class,'index']);



