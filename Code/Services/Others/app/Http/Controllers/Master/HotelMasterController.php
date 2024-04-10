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
                    "HotelName" => $post->HotelName,
                    "HotelCountry" =>$post->HotelCountry,
                    "HotelCity" => $post->HotelCity,
                    "HotelBasicDetails" => json_decode($post->HotelBasicDetails),
                    "HotelContactDetails" => json_decode($post->HotelContactDetails),
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
     public function hotelImport(Request $request){

        call_logger('REQUEST COMES FROM Hotel Import: '.$request->getContent());

        //try{

            $requestData = $request->all();
             // $SuccessCount = 0;
             // $FailureCount = 0;
             
                $insertedCount = 0;
            foreach ($requestData as $data) {
                
                $Status = 1;
                $ErrorMessage = "";
    
                if ($data['Hotel Name'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|HotelName is missing";
                } elseif (strlen($data['Hotel Name']) > 150) {
                    $Status *= 0;
                    $ErrorMessage .= "|HotelName should not contain more than 150 words";
                }
    
                if ($data['Self Supplier'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|SelfSupplier is Missing";
                }
    
                if ($data['Hotel Country'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|HotelCountry is Missing";
                }
                if ($data['Hotel Chain'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|Hotel Chain is missing";
                }
    
                if ($data['Weekend Name'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|Weekend Name is missing";
                }
    
                if ($data['Room Type'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|Room Type is missing";
                }

                if($Status == 1){

            $hotelMaster = new HotelMaster();
            $hotelMaster->HotelName = $data['Hotel Name'];
            $hotelMaster->SelfSupplier = $data['Self Supplier'];
            $hotelMaster->HotelCountry = $data['Hotel Country'];
            $hotelMaster->HotelCity = $data['City'];
            $hotelMaster->created_at = now();
            $hotelMaster->HotelBasicDetails = json_encode([
            'Pin Code' => $data['Pin Code'],
            'Hotel Address' => $data['Hotel Address'],
            'GSTN' =>$data['GSTN'],
            'Hotel Type' => $data['Hotel Type'],
            'Hotel Category' => $data['Hotel Category'],
            'Hotel Website Link' => $data['Hotel Website Link'],
            'Hotel Information' => $data['Hotel Information'],
            'Policy' => $data['Policy'],
            'T&C' => $data['T&C'],
            'Room Type' => $data['Room Type'],
            'State' => $data['State'],
            'Weekend Name' => $data['Weekend Name'],
            'Hotel Chain' => $data['Hotel Chain']
            ], JSON_PRETTY_PRINT);
            $hotelMaster->HotelContactDetails = json_encode([
                'Division' => $data['Division'],
                'Contact Person' => $data['Contact Person'],
                'Designation' => $data['Designation'],
                'Mobile no' => $data['Mobile no'],
                'Contact Person Email Id' => $data['Contact Person Email Id']
                ], JSON_PRETTY_PRINT);
            $hotelMaster->save();
            $insertedCount++;
        
         return response()->json(['Status' => '1','Message' => 'Hotels saved successfully','Count' => $insertedCount]);
    }else{
        return response()->json(['Status'=> '1', 'Message' => 'Validation Error: ' . $ErrorMessage]);
    }
}
    
    
    
    //  }catch (\Exception $e){
        //     call_logger("Exception Error  ===>  ". $e->getMessage());
        //     return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }
}

