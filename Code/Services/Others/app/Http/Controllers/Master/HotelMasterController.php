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

        call_logger('REQUEST COMES FROM Hotel Import: '.$request->getContent());

        //try{
            $id = $request->input('id');
            

            $requestData = $request->all();
             
             
                $insertedCount = 0;                
                $Status = 1;
                $ErrorMessage = "";
    
                if ($requestData['Hotel Name'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|HotelName is missing";
                } elseif (strlen($requestData['Hotel Name']) > 150) {
                    $Status *= 0;
                    $ErrorMessage .= "|HotelName should not contain more than 150 words";
                }
    
                if ($requestData['Self Supplier'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|SelfSupplier is Missing";
                }
    
                if ($requestData['Hotel Country'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|HotelCountry is Missing";
                }
                if ($requestData['Hotel Chain'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|Hotel Chain is missing";
                }
    
                if ($requestData['Weekend Name'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|Weekend Name is missing";
                }
    
                if ($requestData['Room Type'] == "") {
                    $Status *= 0;
                    $ErrorMessage .= "|Room Type is missing";
                }

                if($Status == 1){
                    if($id == '') {

            $hotelMaster = new HotelMaster();
            $hotelMaster->HotelName = $requestData['Hotel Name'];
            $hotelMaster->SelfSupplier = $requestData['Self Supplier'];
            $hotelMaster->HotelCountry = $requestData['Hotel Country'];
            $hotelMaster->HotelCity = $requestData['City'];
            $hotelMaster->AddedBy = $requestData['AddedBy'];
            $hotelMaster->created_at = now();
            $hotelMaster->HotelBasicDetails = json_encode([
            'Pin Code' => $requestData['Pin Code'],
            'Hotel Address' => $requestData['Hotel Address'],
            'GSTN' =>$requestData['GSTN'],
            'Hotel Type' => $requestData['Hotel Type'],
            'Hotel Category' => $requestData['Hotel Category'],
            'Hotel Website Link' => $requestData['Hotel Website Link'],
            'Hotel Information' => $requestData['Hotel Information'],
            'Policy' => $requestData['Policy'],
            'T&C' => $requestData['T&C'],
            'Room Type' => $requestData['Room Type'],
            'State' => $requestData['State'],
            'Weekend Name' => $requestData['Weekend Name'],
            'Hotel Chain' => $requestData['Hotel Chain']
            ], JSON_PRETTY_PRINT);
            $hotelMaster->HotelContactDetails = json_encode([
                'Division' => $requestData['Division'],
                'Contact Person' => $requestData['Contact Person'],
                'Designation' => $requestData['Designation'],
                'Mobile no' => $requestData['Mobile no'],
                'Contact Person Email Id' => $requestData['Contact Person Email Id']
                ], JSON_PRETTY_PRINT);
            $hotelMaster->save();
            $insertedCount++;
        
         return response()->json(['Status' => '1','Message' => 'Hotels saved successfully','Count' => $insertedCount]);
    
    
}else{
    $id = $request->input('id');
    $requestData = $request->all();

    
    if($id != '') {
        $hotelMaster = HotelMaster::find($id);
        if (!$hotelMaster) {
            return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
        }
        


        $hotelMaster->HotelName = $requestData['Hotel Name'];
        $hotelMaster->SelfSupplier = $requestData['Self Supplier'];
        $hotelMaster->HotelCountry = $requestData['Hotel Country'];
        $hotelMaster->HotelCity = $requestData['City'];
        $hotelMaster->UpdatedBy = $requestData['UpdatedBy'];
        $hotelMaster->updated_at = now();
        $hotelMaster->HotelBasicDetails = json_encode([
            'Pin Code' => $requestData['Pin Code'],
            'Hotel Address' => $requestData['Hotel Address'],
            'GSTN' =>$requestData['GSTN'],
            'Hotel Type' => $requestData['Hotel Type'],
            'Hotel Category' => $requestData['Hotel Category'],
            'Hotel Website Link' => $requestData['Hotel Website Link'],
            'Hotel Information' => $requestData['Hotel Information'],
            'Policy' => $requestData['Policy'],
            'T&C' => $requestData['T&C'],
            'Room Type' => $requestData['Room Type'],
            'State' => $requestData['State'],
            'Weekend Name' => $requestData['Weekend Name'],
            'Hotel Chain' => $requestData['Hotel Chain']
        ], JSON_PRETTY_PRINT);
        $hotelMaster->HotelContactDetails = json_encode([
            'Division' => $requestData['Division'],
            'Contact Person' => $requestData['Contact Person'],
            'Designation' => $requestData['Designation'],
            'Mobile no' => $requestData['Mobile no'],
            'Contact Person Email Id' => $requestData['Contact Person Email Id']
        ], JSON_PRETTY_PRINT);
        $hotelMaster->save();

        return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
    } else {
        
        return response()->json(['Status' => 0, 'Message' => 'Failed to update data. ID is missing.'], 400);
    }
    

}
}else{
    return response()->json(['Status'=> '1', 'Message' => 'Validation Error: ' . $ErrorMessage]);
}
    
    
    
    //  }catch (\Exception $e){
        //     call_logger("Exception Error  ===>  ". $e->getMessage());
        //     return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }
}

