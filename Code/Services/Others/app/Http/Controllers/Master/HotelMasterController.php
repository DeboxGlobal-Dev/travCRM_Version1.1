<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\HotelMaster;

class HotelMasterController extends Controller
{
    public function index(Request $request){
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM HOTEL   MASTER LIST: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('HotelStatus');

        $posts = HotelMaster::when($Search, function ($query) use ($Search) {
            return $query->where('HotelName', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('HotelStatus',$Status);
        })->select('*')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "HotelChain" =>$post->HotelChain,
                    "HotelName" => $post->HotelName,
                    "HotelCode" => $post->HotelCode,
                    "HotelCategory" =>$post->HotelCategory,
                    "HotelType" => $post->HotelType,
                    "HotelCountry" =>$post->HotelCountry,
                    "HotelState" => $post->HotelState,
                    "HotelCity" => $post->HotelCity,
                    "HotelPinCode" => $post->HotelPinCode,
                    "HotelAddress" => $post->HotelAddress,
                    "HotelLocality" => $post->HotelLocality,
                    "HotelGSTN" => $post->HotelGSTN,
                    "HotelWeekend" => $post->HotelWeekend,
                    "CheckIn" => $post->CheckIn,
                    "CheckOut" => $post->CheckOut,
                    "HotelLink" => $post->HotelLink,
                    "HotelInfo" => $post->HotelInfo,
                    "HotelPolicy" => $post->HotelPolicy,
                    "HotelTC" => $post->HotelTC,
                    "HotelAmenties" => $post->HotelAmenties,
                    "HotelRoomType" => $post->HotelRoomType,
                    "HotelStatus" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "SelfSupplier" => ($post->SelfSupplier==0) ? 'No' : 'Yes',
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                    "Created_at" => $post->created_at,
                    "Updated_at" => $post->updated_at
                ];
            }

            return response()->json([
                'Status' => 200,
                'TotalRecord' => $posts->count('id'),
                'DataList' => $arrayDataRows
            ]);

        }else {
            return response()->json([
                "Status" => 0,
                "TotalRecord" => $posts->count('id'),
                "Message" => "No Record Found."
            ]);
        }
    }

    public function store(Request $request){

        call_logger('REQUEST COMES FROM ADD/UPDATE Hotel Rate: '.$request->getContent());

        try{
            $id = $request->input('id');
            if($id == '') {
               // $validatordata = validator::make($request->all(), $businessvalidation);

                // if($validatordata->fails()){
                //     return $validatordata->errors();
                // }else{
                    $dataList = $request->DataList;
                    $hotelData = [];
                    foreach ($dataList as $data) {
                        $hotelData[] = [
                            "HotelChain" => $data['HotelChain'],
                            "HotelName" => $data['HotelName'],
                            "HotelCode" => $data['HotelCode'],
                            "HotelCategory" => $data['HotelCategory'],
                            "HotelType" => $data['HotelType'],
                            "HotelCountry" => $data['HotelCountry'],
                            "HotelState" => $data['HotelState'],
                            "HotelCity" => $data['HotelCity'],
                            "HotelPinCode" => $data['HotelPinCode'],
                            "HotelAddress" => $data['HotelAddress'],
                            "HotelLocality" => $data['HotelLocality'],
                            "HotelGSTN" => $data['HotelGSTN'],
                            "HotelWeekend" => $data['HotelWeekend'],
                            "CheckIn" => $data['CheckIn'],
                            "CheckOut" => $data['CheckOut'],
                            "HotelLink" => $data['HotelLink'],
                            "HotelInfo" => $data['HotelInfo'],
                            "HotelPolicy" => $data['HotelPolicy'],
                            "HotelTC" => $data['HotelTC'],
                            "HotelAmenties" => $data['HotelAmenties'],
                            "HotelRoomType" => $data['HotelRoomType'],
                            "SelfSupplier" => $data['SelfSupplier'],
                            "HotelStatus" => $data['HotelStatus'],
                            "AddedBy" => $data['AddedBy'],
                            'created_at' => now(),
                            'updated_at' => now(), // Assuming you want to update 'updated_at' field as well
                        ];
                    }
                    
                    // Bulk insert the data into the table
                    $count = count($hotelData);
                    $savedata = HotelMaster::insert($hotelData);
                
                if ($savedata) {
                    return response()->json([
                    'Status' => 1, 
                    'TotalSuccess'=> $count,
                    'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 0, 'Message' =>'Failed to add data.'], 500);
                }
             // }

            }else{

                $id = $request->input('id');
                $edit = HotelMaster::find($id);

                $businessvalidation =array(
                    'HotelName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->HotelChain = $request->input('HotelChain');
                        $edit->HotelName = $request->input('HotelName');
                        $edit->HotelCode = $request->input('HotelCode');
                        $edit->HotelCategory = $request->input('HotelCategory');
                        $edit->HotelType = $request->input('HotelType');
                        $edit->HotelCountry = $request->input('HotelCountry');
                        $edit->HotelState = $request->input('HotelState');
                        $edit->HotelCity = $request->input('HotelCity');
                        $edit->HotelPinCode = $request->input('HotelPinCode');
                        $edit->HotelAddress = $request->input('HotelAddress');
                        $edit->HotelLocality = $request->input('HotelLocality');
                        $edit->HotelGSTN = $request->input('HotelGSTN');
                        $edit->HotelWeekend = $request->input('HotelWeekend');
                        $edit->CheckIn = $request->input('CheckIn');
                        $edit->CheckOut = $request->input('CheckOut');
                        $edit->HotelLink = $request->input('HotelLink');
                        $edit->HotelInfo = $request->input('HotelInfo');
                        $edit->HotelPolicy = $request->input('HotelPolicy');
                        $edit->HotelTC = $request->input('HotelTC');
                        $edit->HotelAmenties = $request->input('HotelAmenties');
                        $edit->HotelRoomType = $request->input('HotelRoomType');
                        $edit->SelfSupplier = $request->input('SelfSupplier');
                        $edit->HotelStatus = $request->input('HotelStatus');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->updated_at = now();
                        $edit->save();

                        return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                }
            }
        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }
}
