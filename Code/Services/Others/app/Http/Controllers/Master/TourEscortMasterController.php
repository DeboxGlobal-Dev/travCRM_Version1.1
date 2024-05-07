<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\TourEscortMaster;


class TourEscortMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $id = $request->input('Id');
        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = TourEscortMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when($id, function ($query) use ($id) {
            return $query->where('id',  $id );
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){

                $arrayDataRows[] = [
                    "id" => $post->id,
                    "ServiceType" => $post->ServiceType,
                    "Name" => $post->Name,
                    "MobileNumber" => $post->MobileNumber,
                    "WhatsAppNumber" => $post->WhatsAppNumber,
                    "AlternateNumber" => $post->AlternateNumber,
                    "Email" => $post->Email,
                    "TourEscortLicenseOne" => $post->TourEscortLicenseOne,
                    "LicenseExpiry" => $post->LicenseExpiry,
                    "Destination" => $post->Destination,
                    "Language" => $post->Language,
                    "TourEscortImageName" => asset('storage/' . $post->TourEscortImageData),
                    "Supplier" => $post->Supplier,
                    "TourEscortLicenseTwo" => $post->TourEscortLicenseTwo,
                    "ContactPerson" => $post->ContactPerson,
                    "Designation" => $post->Designation,
                    "Country" => $post->Country,
                    "State" => $post->State,
                    "City" => $post->City,
                    "PinCode" => $post->PinCode,
                    "Detail" => $post->Detail,
                    "Address" => $post->Address,
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
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
        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'Name' => 'required|unique:'._DB_.'.'._TOUR_ESCORT_MASTER_.',Name',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{

                    $ServiceType = $request->input('ServiceType');
                    $Name = $request->input('Name');
                    $MobileNumber = $request->input('MobileNumber');
                    $WhatsAppNumber = $request->input('WhatsAppNumber');
                    $AlternateNumber = $request->input('AlternateNumber');
                    $Email = $request->input('Email');
                    $TourEscortLicenseOne = $request->input('TourEscortLicenseOne');
                    $LicenseExpiry = $request->input('LicenseExpiry');
                    $Destination = $request->input('Destination');
                    $Language = $request->input('Language');
                    $TourEscortImageName = $request->input('TourEscortImageName');
                    $base64Image = $request->input('TourEscortImageData');
                    $TourEscortImageData = base64_decode($base64Image);
                    $Supplier = $request->input('Supplier');
                    $TourEscortLicenseTwo = $request->input('TourEscortLicenseTwo');
                    $ContactPerson = $request->input('ContactPerson');
                    $Designation = $request->input('Designation');
                    $Country = $request->input('Country');
                    $State = $request->input('State');
                    $City = $request->input('City');
                    $PinCode = $request->input('PinCode');
                    $Detail = $request->input('Detail');
                    $Address = $request->input('Address');
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = time().'_'.$TourEscortImageName;

                    Storage::disk('public')->put($filename, $TourEscortLicenseTwo);



                 $savedata = TourEscortMaster::create([
                    'ServiceType' => $request->ServiceType,
                    'Name' => $request->Name,
                    'MobileNumber' => $request->MobileNumber,
                    'WhatsAppNumber' => $request->WhatsAppNumber,
                    'AlternateNumber' => $request->AlternateNumber,
                    'Email' => $request->Email,
                    'TourEscortLicenseOne' => $request->TourEscortLicenseOne,
                    'LicenseExpiry' => $request->LicenseExpiry,
                    'Destination' => $request->Destination,
                    'Language' => $request->Language,
                    'TourEscortImageName' => $filename,
                    'Supplier' => $request->Supplier,
                    'TourEscortLicenseTwo' => $request->TourEscortLicenseTwo,
                    'ContactPerson' => $request->ContactPerson,
                    'Designation' => $request->Designation,
                    'Country' => $request->Country,
                    'State' => $request->State,
                    'City' => $request->City,
                    'PinCode' => $request->PinCode,
                    'Detail' => $request->Detail,
                    'Address' => $request->Address,
                    'Status' => $request->Status,
                    'AddedBy' => $request->AddedBy,
                    'created_at' => now(),
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 1, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 0, 'Message' =>'Failed to add data.'], 500);
                }
              }

            }else{

                $id = $request->input('id');
                $edit = TourEscortMaster::find($id);

                $businessvalidation =array(
                    'Name' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        $ServiceType = $request->input('ServiceType');
                        $Name = $request->input('Name');
                        $MobileNumber = $request->input('MobileNumber');
                        $WhatsAppNumber = $request->input('WhatsAppNumber');
                        $AlternateNumber = $request->input('AlternateNumber');
                        $Email = $request->input('Email');
                        $TourEscortLicenseOne = $request->input('TourEscortLicenseOne');
                        $LicenseExpiry = $request->input('LicenseExpiry');
                        $Destination = $request->input('Destination');
                        $Language = $request->input('Language');
                        $TourEscortImageName = $request->input('TourEscortImageName');
                        $base64Image = $request->input('TourEscortImageData');
                        if($base64Image!=''){
                            $TourEscortImageData = base64_decode($base64Image);
                            $filename = time().'_'.$TourEscortImageName;
                            Storage::disk('public')->put($filename, $TourEscortImageData);
                        }
                        $Supplier = $request->input('Supplier');
                        $TourEscortLicenseTwo = $request->input('TourEscortLicenseTwo');
                        $ContactPerson = $request->input('ContactPerson');
                        $Designation = $request->input('Designation');
                        $Country = $request->input('Country');
                        $State = $request->input('State');
                        $City = $request->input('City');
                        $PinCode = $request->input('PinCode');
                        $Detail = $request->input('Detail');
                        $Address = $request->input('Address');
                        $Status = $request->input('Status');
                        $AddedBy = $request->input('AddedBy');
                        $UpdatedBy = $request->input('UpdatedBy');

                        

                        $edit->ServiceType = $request->input('ServiceType');
                        $edit->Name = $request->input('Name');
                        $edit->MobileNumber = $request->input('MobileNumber');
                        $edit->WhatsAppNumber = $request->input('WhatsAppNumber');
                        $edit->AlternateNumber = $request->input('AlternateNumber');
                        $edit->Email = $request->input('Email');
                        $edit->TourEscortLicenseOne = $request->input('TourEscortLicenseOne');
                        $edit->LicenseExpiry = $request->input('LicenseExpiry');
                        $edit->Destination = $request->input('Destination');
                        $edit->Language = $request->input('Language');
                        if($base64Image!=''){
                            $edit->TourEscortImageName = $filename;
                        }
                        $edit->Supplier = $request->input('Supplier');
                        $edit->TourEscortLicenseTwo = $request->input('TourEscortLicenseTwo');
                        $edit->ContactPerson = $request->input('ContactPerson');
                        $edit->Designation = $request->input('Designation');
                        $edit->Country = $request->input('Country');
                        $edit->State = $request->input('State');
                        $edit->City = $request->input('City');
                        $edit->PinCode = $request->input('PinCode');
                        $edit->Detail = $request->input('Detail');
                        $edit->Address = $request->input('Address');
                        $edit->Status = $request->input('Status');
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
            print_r( $e->getMessage());
            exit;
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }

}
