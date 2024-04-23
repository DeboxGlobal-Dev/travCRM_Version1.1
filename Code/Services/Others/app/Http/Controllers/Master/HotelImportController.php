<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\TempUpload;
use App\Models\Master\HotelMaster;


class HotelImportController extends Controller
{
    // public function hotelImport(){
    //     $posts = TempUpload::select('*')->where('ServiceType', 'hotel')->get();
        
    //     if ($posts->isNotEmpty()) {
    //         $arrayDataRows = [];
    //         foreach ($posts as $post){
                
    //             $arrayDataRows[] = [
    //                 "Id" => $post->id,
    //                 "ServiceType" => $post->ServiceType,
    //                 "UploadJson" => json_decode($post->UploadJson),
    //                 "Status" => ($post->Status==0) ? 'InActive' : 'Active',
    //                 "AddedBy" => $post->AddedBy,
    //                 "UpdatedBy" => $post->UpdatedBy,
    //                 "Created_at" => $post->created_at,
    //                 "Updated_at" => $post->updated_at
    //             ];
    //         }

    //         return response()->json([
    //             'Status' => 200,
    //             'DataList' => $arrayDataRows
    //         ]);

    //     }else {
    //         return response()->json([
    //             "Status" => 0,
    //             "Message" => "No Record Found."
    //         ]);
    //     }
    // }

    public function store(Request $request) {
        call_logger('REQUEST COMES FROM Hotel Import: ' . $request->getContent());
    
       // try {
            $requestData = TempUpload::select('*')->where('ServiceType', 'hotel')->get();
    
            $insertedCount = 0;
            foreach ($requestData as $data) {

                $uploadJson = json_decode($data->UploadJson);

                $destination = getColumnValue("others.destination_master","Name",$uploadJson->{'DESTINATION'},"id");
                $division = getColumnValue("others.division_master","Name",$uploadJson->{'DIVISION'},"id");
                $country = getColumnValue("others.country_master","Name",$uploadJson->{'HOTEL_COUNTRY'},"id");
                $hotelchain = getColumnValue("others.hotel_chain_master","Name",$uploadJson->{'HOTEL_CHAIN'},"id");
                $weekend = getColumnValue("others.weekend_master","Name",$uploadJson->{'WEEKEND_NAME'},"id");
                $state = getColumnValue("others.state_master","Name",$uploadJson->{'STATE'},"id");
                $roomtype = getColumnValue("others.room_type_master","Name",$uploadJson->{'ROOM_TYPE'},"id");
                $hoteltype = getColumnValue("others.hotel_type_master","Name",$uploadJson->{'HOTEL_TYPE'},"id");

                $existingHotel = HotelMaster::where('HotelName', $uploadJson->{'HOTEL_NAME'})
                                        ->where('HotelCity', $destination)
                                        ->first();

            if ($existingHotel) {
                $existingContactDetails = json_decode($existingHotel->HotelContactDetails, true);

                if (!is_array($existingContactDetails)) {
                    $existingContactDetails = []; // Initialize as an empty array if not already an array
                }
                
                array_push($existingContactDetails, [
                    'Division' => $division,
                    'Contact Person' => $uploadJson->{'CONTACT_PERSON'},
                    'Designation' => $uploadJson->{'DESIGNATION'},
                    'Mobile no' => $uploadJson->{'MOBILE_NO'},
                    'Contact Person Email Id' => $uploadJson->{'CONTACT_PERSON_EMAIL'}
                ]);

                

                // Encode the modified contact details back to JSON
                $existingHotel->HotelContactDetails = json_encode($existingContactDetails, JSON_PRETTY_PRINT);
                // Save the changes
                $existingHotel->save();
            } else {

                $hotelMaster = new HotelMaster();
                $hotelMaster->HotelName = $uploadJson->{'HOTEL_NAME'};
                $hotelMaster->SelfSupplier = $uploadJson->{'SELF_SUPPLIER'} == "Yes"?1:0;
                $hotelMaster->HotelCountry = $country;
                $hotelMaster->HotelCity = $destination;
                ;
                $hotelMaster->created_at = now();
                $hotelMaster->HotelBasicDetails = json_encode([
                    //'Pin Code' => $uploadJson->{'Pin Code'} == ""?"":$uploadJson->{'Pin Code'} ,
                    'Hotel Address' => $uploadJson->{'HOTEL_ADDRESS'},
                    //'GSTN' => $uploadJson->{'GSTN'}  == ""?"":$uploadJson->{'GSTN'},
                    'Hotel Type' => $hoteltype,
                   // 'Hotel Category' => $uploadJson->{'Hotel Category'} == ""?"":$uploadJson->{'Hotel Category'},
                    'Hotel Website Link' => $uploadJson->{'HOTEL_WEB_LINK'},
                    //'Hotel Information' => $uploadJson->{'Hotel Information'} == ""?"":$uploadJson->{'Hotel Information'},
                    // 'Policy' => $uploadJson->{'Policy'} == ""?"":$uploadJson->{'Policy'},
                    // 'T&C' => $uploadJson->{'T&C'} == ""?"":$uploadJson->{'T&C'},
                    'Room Type' => $roomtype,
                    'State' => $state,
                    'Weekend Name' => $weekend,
                    'Hotel Chain' => $hotelchain,
                ], JSON_PRETTY_PRINT);
                $hotelMaster->HotelContactDetails = json_encode([
                   [ 
                    'Division' => $division,
                    'Contact Person' => $uploadJson->{'CONTACT_PERSON'},
                    'Designation' => $uploadJson->{'DESIGNATION'},
                    'Mobile no' => $uploadJson->{'MOBILE_NO'},
                    'Contact Person Email Id' => $uploadJson->{'CONTACT_PERSON_EMAIL'}
                    ]
                ], JSON_PRETTY_PRINT);
                $hotelMaster->save();
                $insertedCount++;
            }
        }
            return response()->json(['Status' => 1, 'Message' => 'Hotels saved successfully', 'Count' => $insertedCount]);
    
        // } catch (\Exception $e) {
        //     call_logger("Exception Error  ===>  " . $e->getMessage());
        //     return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }
}
