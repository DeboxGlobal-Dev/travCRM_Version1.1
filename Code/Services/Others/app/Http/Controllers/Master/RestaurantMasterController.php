<?php

namespace App\Http\Controllers\master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\RestaurantMaster;

class RestaurantMasterController extends Controller
{
    public function index(Request $request){

        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = RestaurantMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%')
                         ->orwhere('DestinationId', 'like', '%' . $Search . '%')
                         ->orwhere('Address', 'like', '%' . $Search . '%')
                         ->orwhere('CountryId', 'like', '%' . $Search . '%')
                         ->orwhere('CityId', 'like', '%' . $Search . '%')
                         ->orwhere('StateId', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "id" => $post->id,
                    "Name" => $post->Name,
                    "DestinationId" => $post->DestinationId,
                    "Address" => $post->Address,
                    "CountryId" => $post->CountryId,
                    "StateId" => $post->StateId,
                    "CityId" => $post->CityId,
                    "SelfSupplier" => $post->SelfSupplier,
                    "PinCode" => $post->PinCode,
                    "GSTN" => $post->GSTN,
                    "ContactType" => getName(_DIVISION_MASTER_,$post->ContactType),
                    "ContactName" => $post->ContactName,
                    "ContactDesignation" => $post->ContactDesignation,
                    "CountryCode" => $post->CountryCode,
                    "Phone1" => $post->Phone1,
                    "Phone2" => $post->Phone2,
                    "Phone3" => $post->Phone3,
                    "ContactEmail" => $post->ContactEmail,
                    "ImageName" => asset('storage/' . $post->ImageName),
                    "ShowHide" => $post->ShowHide,
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
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

    public function store(Request $request)
    {
        call_logger('REQUEST COMES FROM ADD/UPDATE STATE: '.$request->getContent());

        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'Name' => 'required|unique:'._DB_.'.'._RESTAURANT_MASTER_.',Name',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{

                    $Name = $request->input('Name');
                    $DestinationId = $request->input('DestinationId');
                    $Address = $request->input('Address');
                    $CountryId = $request->input('CountryId');
                    $StateId = $request->input('StateId');
                    $CityId = $request->input('CityId');
                    $SelfSupplier = $request->input('SelfSupplier');
                    $PinCode = $request->input('PinCode');
                    $GSTN = $request->input('GSTN');
                    $ContactType = $request->input('ContactType');
                    $ContactName = $request->input('ContactName');
                    $ContactDesignation = $request->input('ContactDesignation');
                    $CountryCode = $request->input('CountryCode');
                    $Phone1 = $request->input('Phone1');
                    $Phone2 = $request->input('Phone2');
                    $Phone3 = $request->input('Phone3');
                    $ContactEmail = $request->input('ContactEmail');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = time().'_'.$ImageName;

                    Storage::disk('public')->put($filename, $ImageData);
                 $savedata = RestaurantMaster::create([
                    "Name" => $request->Name,
                    "DestinationId" => $request->DestinationId,
                    "Address" => $request->Address,
                    "CountryId" => $request->CountryId,
                    "StateId" => $request->StateId,
                    "CityId" => $request->CityId,
                    "SelfSupplier" => $request->SelfSupplier,
                    "PinCode" => $request->PinCode,
                    "GSTN" => $request->GSTN,
                    "ContactType" => $request->ContactType,
                    "ContactName" => $request->ContactName,
                    "ContactDesignation" => $request->ContactDesignation,
                    "CountryCode" => $request->CountryCode,
                    "Phone1" => $request->Phone1,
                    "Phone2" => $request->Phone2,
                    "Phone3" => $request->Phone3,
                    "ContactEmail" => $request->ContactEmail,
                    "ImageName" => $filename,
                    "Status" => $request->Status,
                    "AddedBy" => $request->AddedBy,
                    "created_at" => now(),
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 1, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 0, 'Message' =>'Failed to add data.'], 500);
                }
              }

            }else{

                $id = $request->input('id');
                $edit = RestaurantMaster::find($id);

                $businessvalidation =array(
                    'Name' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        $Name = $request->input('Name');
                    $DestinationId = $request->input('DestinationId');
                    $Address = $request->input('Address');
                    $CountryId = $request->input('CountryId');
                    $StateId = $request->input('StateId');
                    $CityId = $request->input('CityId');
                    $SelfSupplier = $request->input('SelfSupplier');
                    $PinCode = $request->input('PinCode');
                    $GSTN = $request->input('GSTN');
                    $ContactType = $request->input('ContactType');
                    $ContactName = $request->input('ContactName');
                    $ContactDesignation = $request->input('ContactDesignation');
                    $CountryCode = $request->input('CountryCode');
                    $Phone1 = $request->input('Phone1');
                    $Phone2 = $request->input('Phone2');
                    $Phone3 = $request->input('Phone3');
                    $ContactEmail = $request->input('ContactEmail');
                    $ImageName = $request->input('ImageName');
                        $base64Image = $request->input('ImageData');
                        if($base64Image!=''){
                            $ImageData = base64_decode($base64Image);
                            $filename = time().'_'.$ImageName;
                            Storage::disk('public')->put($filename, $ImageData);
                        }
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    
                        $edit->Name= $request->input('Name');
                        $edit->DestinationId= $request->input('DestinationId');
                        $edit->Address= $request->input('Address');
                        $edit->CountryId= $request->input('CountryId');
                        $edit->StateId= $request->input('StateId');
                        $edit->CityId= $request->input('CityId');
                        $edit->SelfSupplier= $request->input('SelfSupplier');
                        $edit->PinCode= $request->input('PinCode');
                        $edit->GSTN= $request->input('GSTN');
                        $edit->ContactType= $request->input('ContactType');
                        $edit->ContactName= $request->input('ContactName');
                        $edit->ContactDesignation= $request->input('ContactDesignation');
                        $edit->CountryCode= $request->input('CountryCode');
                        $edit->Phone1= $request->input('Phone1');
                        $edit->Phone2= $request->input('Phone2');
                        $edit->Phone3= $request->input('Phone3');
                        $edit->ContactEmail= $request->input('ContactEmail');
                        if($base64Image!=''){
                            $edit->ImageName = $filename;
                        }
                        $edit->Status= $request->input('Status');
                        $edit->UpdatedBy= $request->input('UpdatedBy');
                        $edit->updated_at = now();
                        $edit->save();

                        return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                }
            }
        }
        catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }
}

