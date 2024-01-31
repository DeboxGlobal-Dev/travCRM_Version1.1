<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\DriverMaster;

class DriverMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = DriverMaster::when($Search, function ($query) use ($Search) {
            return $query->where('DriverName', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('DriverName')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "Country" => $post->Country,
                    "DriverName" => $post->DriverName,
                    "MobileNumber" => $post->MobileNumber,
                    "AlternateMobileNo" => $post->AlternateMobileNo,
                    "WhatsappNumber" => $post->WhatsappNumber,
                    "LicenseNumber" => $post->LicenseNumber,
                    "BirthDate" => $post->BirthDate,
                    "LicenseName" => $post->LicenseName,
                    "PassportNumber" => $post->PassportNumber,
                    "Address" => $post->Address,
                    "ValidUpto" => $post->ValidUpto,
                    "ImageName" => $post->ImageName,
                    "Status" => $post->Status,
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
                    'DriverName' => 'required|unique:'._DB_.'.'._DRIVER_MASTER_.',DriverName',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{

                    $Country = $request->input('Country');
                    $DriverName = $request->input('DriverName');
                    $MobileNumber = $request->input('MobileNumber');
                    $AlternateMobileNo = $request->input('AlternateMobileNo');
                    $WhatsappNumber = $request->input('WhatsappNumber');
                    $LicenseNumber = $request->input('LicenseNumber');
                    $BirthDate = $request->input('BirthDate');
                    $LicenseName = $request->input('LicenseName');
                    $base64License = $request->input('LicenseData');
                    $LicenseData = base64_decode('base64License');
                    $PassportNumber = $request->input('PassportNumber');
                    $Address = $request->input('Address');
                    $ValidUpto = $request->input('ValidUpto');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = uniqid() . '.png';
                    $foldername = uniqid() . '.png';

                    // print_r($filename);die();
                    Storage::disk('public')->put($filename, $ImageData);
                    Storage::disk('public')->put($foldername, $LicenseData);


                 $savedata = DriverMaster::create([
                    'Country' => $request->Country,
                    'DriverName' => $request->DriverName,
                    'MobileNumber' => $request->MobileNumber,
                    'AlternateMobileNo' => $request->AlternateMobileNo,
                    'WhatsappNumber' => $request->WhatsappNumber,
                    'LicenseNumber' => $request->LicenseNumber,
                    'BirthDate' => $request->BirthDate,
                    'LicenseName' => $LicenseName,
                    'LicenseData' => $foldername,
                    'PassportNumber' => $request->PassportNumber,
                    'Address' => $request->Address,
                    'ValidUpto' => $request->ValidUpto,
                    'ImageName' => $ImageName,
                    'ImageData' => $filename,
                    'Status' => $request->Status,
                    'AddedBy' => $request->AddedBy,
                    'created_at' => now(),
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
              }

            }else{

                $id = $request->input('id');
                $edit = DriverMaster::find($id);

                $businessvalidation =array(
                    'DriverName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        $Country = $request->input('Country');
                    $DriverName = $request->input('DriverName');
                    $MobileNumber = $request->input('MobileNumber');
                    $AlternateMobileNo = $request->input('AlternateMobileNo');
                    $WhatsappNumber = $request->input('WhatsappNumber');
                    $LicenseNumber = $request->input('LicenseNumber');
                    $BirthDate = $request->input('BirthDate');
                    $LicenseName = $request->input('LicenseName');
                    $base64License = $request->input('LicenseData');
                    $LicenseData = base64_decode('base64License');
                    $PassportNumber = $request->input('PassportNumber');
                    $Address = $request->input('Address');
                    $ValidUpto = $request->input('ValidUpto');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = uniqid() . '.png';
                    $foldername = uniqid() . '.png';

                    // print_r($filename);die();
                    Storage::disk('public')->put($filename, $ImageData);
                    Storage::disk('public')->put($foldername, $LicenseData);

                        
                    $edit->Country = $request->input('Country');
                    $edit->DriverName = $request->input('DriverName');
                    $edit->MobileNumber = $request->input('MobileNumber');
                    $edit->AlternateMobileNo = $request->input('AlternateMobileNo');
                    $edit->WhatsappNumber = $request->input('WhatsappNumber');
                    $edit->LicenseNumber = $request->input('LicenseNumber');
                    $edit->BirthDate = $request->input('BirthDate');
                    $edit->LicenseName = $LicenseName;
                    $edit->LicenseData = $foldername;
                    $edit->PassportNumber = $request->input('PassportNumber');
                    $edit->Address = $request->input('Address');
                    $edit->ValidUpto = $request->input('ValidUpto');
                    $edit->ImageName = $ImageName;
                    $edit->ImageData = $filename;
                    $edit->Status = $request->input('Status');
                    $edit->UpdatedBy = $request->input('UpdatedBy');
                    $edit->updated_at = now();
                    $edit->save();

                        return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
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



    public function destroy(Request $request)
    {
        $brands = DriverMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }


}
