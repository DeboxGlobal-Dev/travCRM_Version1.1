<?php

namespace App\Http\Controllers\Hotel\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;


class SearchHotelRateController extends Controller
{
    public function index(){

        $users = DB::table(_HOTEL_RATE_MASTER_)->get();
 
foreach ($users as $user) {

    $startDate = Carbon::parse($user->ValidFrom);
    $endDate = Carbon::parse($user->ValidTo);

    $JsonItem = $user->JsonItem;

    $res = getCodes($startDate,$endDate,$user->Destination);

    $collection = collect($res);

    $collection->each(function ($value) use ($JsonItem) {
            $existingRecord = DB::table(_SEARCH_HOTEL_RATE_)->where('RateCode', $value)->first();
            if ($existingRecord) {

            $existingData = json_decode($existingRecord->JsonResult,true);

            $newData = json_decode($JsonItem,true);

            $a = array_push($existingData,$newData);

            $finalData = json_encode($existingData, JSON_PRETTY_PRINT);

            try {
                $updateQuery = DB::table(_SEARCH_HOTEL_RATE_)
                ->where('RateCode', $value)
                ->update(['JsonResult' => $finalData]);
                    call_logger('Updated: '.$value);
                    // Return "yes" if the insertion is successful
                } catch (QueryException $exception) {
                    call_logger('Not Updated: '.$value);
                }           

        // 'JsonResult' => DB::raw("JSON_ARRAY_APPEND(JsonResult, '$', CAST('".json_encode($existingData)."' AS JSON))"),
    // ]);

            // YourModel::where('id', $id)->update([
                // 'json_column' => DB::raw("JSON_ARRAY_APPEND(json_column, '$', CAST('".json_encode($newData)."' AS JSON))")
            // ]);



        
            } else {
                try {
                    DB::table(_SEARCH_HOTEL_RATE_)->insert([
                        'RateCode' => $value,
                        'JsonResult' => "[".trim($JsonItem)."]"
                    ]);
                    call_logger('Successfull: '.$value);
                    // Return "yes" if the insertion is successful
                } catch (QueryException $exception) {
                    call_logger('Not Successfull: '.$value);
                }
                
              
            }

    });

    }

    }

}
