<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\TempUpload;
use App\Models\Master\HotelMaster;


class HotelImportController extends Controller
{

    public function store(Request $request) {
        call_logger('REQUEST COMES FROM Hotel Import: ' . $request->getContent());
    
            $requestData = TempUpload::select('*')->where('ServiceType', 'hotel')->get();
    
            $insertedCount = 0;
            foreach ($requestData as $data) {

                $uploadJson = json_decode($data->UploadJson);

                $existingHotel = HotelMaster::where('HotelName', $uploadJson->{'Hotel Name'})
                                        ->where('HotelCity', $uploadJson->{'City'})
                                        ->first();

            if ($existingHotel) {
                $existingContactDetails = json_decode($existingHotel->HotelContactDetails, true);

                if (!is_array($existingContactDetails)) {
                    $existingContactDetails = []; // Initialize as an empty array if not already an array
                }
                array_push($existingContactDetails, [
                    'Division' => $uploadJson->{'Division'},
                    'Contact Person' => $uploadJson->{'Contact Person'},
                    'Designation' => $uploadJson->{'Designation'},
                    'Mobile no' => $uploadJson->{'Mobile no'},
                    'Contact Person Email Id' => $uploadJson->{'Contact Person Email Id'}
                ]);

                

                // Encode the modified contact details back to JSON
                $existingHotel->HotelContactDetails = json_encode($existingContactDetails, JSON_PRETTY_PRINT);
                // Save the changes
                $existingHotel->save();
            } else {
                $hotelMaster = new HotelMaster();
                $hotelMaster->HotelName = $uploadJson->{'Hotel Name'};
                $hotelMaster->SelfSupplier = $uploadJson->{'Self Supplier'};
                $hotelMaster->HotelCountry = $uploadJson->{'Hotel Country'};
                $hotelMaster->HotelCity = $uploadJson->{'City'};
                $hotelMaster->created_at = now();
                $hotelMaster->HotelBasicDetails = json_encode([
                    'Pin Code' => $uploadJson->{'Pin Code'},
                    'Hotel Address' => $uploadJson->{'Hotel Address'},
                    'GSTN' => $uploadJson->{'GSTN'},
                    'Hotel Type' => $uploadJson->{'Hotel Type'},
                    'Hotel Category' => $uploadJson->{'Hotel Category'},
                    'Hotel Website Link' => $uploadJson->{'Hotel Website Link'},
                    'Hotel Information' => $uploadJson->{'Hotel Information'},
                    'Policy' => $uploadJson->{'Policy'},
                    'T&C' => $uploadJson->{'T&C'},
                    'Room Type' => $uploadJson->{'Room Type'},
                    'State' => $uploadJson->{'State'},
                    'Weekend Name' => $uploadJson->{'Weekend Name'},
                    'Hotel Chain' => $uploadJson->{'Hotel Chain'}
                ], JSON_PRETTY_PRINT);
                $hotelMaster->HotelContactDetails = json_encode([
                   [ 
                    'Division' => $uploadJson->{'Division'},
                    'Contact Person' => $uploadJson->{'Contact Person'},
                    'Designation' => $uploadJson->{'Designation'},
                    'Mobile no' => $uploadJson->{'Mobile no'},
                    'Contact Person Email Id' => $uploadJson->{'Contact Person Email Id'}
                    ]
                ], JSON_PRETTY_PRINT);
                $hotelMaster->save();
                $insertedCount++;
            }
        }
            return response()->json(['Status' => 1, 'Message' => 'Hotels saved successfully', 'Count' => $insertedCount]);
    
    }
}
