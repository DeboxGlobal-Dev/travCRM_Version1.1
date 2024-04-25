<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\BankMaster;

class BankMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');
        $id = $request->input('Id');

        $posts = BankMaster::when($Search, function ($query) use ($Search) {
            return $query->where('BankName', 'like', '%' . $Search . '%');
        })->when($id, function ($query) use ($id) {
            return $query->where('id',  $id );
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('BankName')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "BankName" => $post->BankName,
                    "AccountNumber" => $post->AccountNumber,
                    "BranchAddress" => $post->BranchAddress,
                    "UpiId" => $post->UpiId,
                    "AccountType" => $post->AccountType,
                    "BeneficiaryName" => $post->BeneficiaryName,
                    "BranchIfsc" => $post->BranchIfsc,
                    "BranchSwiftCode" => $post->BranchSwiftCode,
                    "ImageName" => $post->ImageName,
                    "ImageData" => asset('storage/' . $post->ImageData),
                    "ShowHide" => $post->ShowHide,
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "SetDefault" => ($post->SetDefault == 1) ? 'Yes' : 'No',
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
                    'BankName' => 'required|unique:'._DB_.'.'._BANK_MASTER_.',BankName',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{

                    $BankName = $request->input('BankName');
                    $AccountNumber = $request->input('AccountNumber');
                    $BranchAddress = $request->input('BranchAddress');
                    $UpiId = $request->input('UpiId');
                    $AccountType = $request->input('AccountType');
                    $BeneficiaryName = $request->input('BeneficiaryName');
                    $BranchIfsc = $request->input('BranchIfsc');
                    $BranchSwiftCode = $request->input('BranchSwiftCode');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $ShowHide = $request->input('ShowHide');
                    $SetDefault = $request->input('SetDefault');
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = uniqid() . '.png';

                    // print_r($filename);die();
                    Storage::disk('public')->put($filename, $ImageData);


                 $savedata = BankMaster::create([
                    'BankName' => $request->BankName,
                    'AccountNumber' => $request->AccountNumber,
                    'BranchAddress' => $request->BranchAddress,
                    'UpiId' => $request->UpiId,
                    'AccountType' => $request->AccountType,
                    'BeneficiaryName' => $request->BeneficiaryName,
                    'BranchIfsc' => $request->BranchIfsc,
                    'BranchSwiftCode' => $request->BranchSwiftCode,
                    'ImageName' => $ImageName,
                    'ImageData' => $filename,
                    'ShowHide' => $request->ShowHide,
                    'SetDefault' => $request->SetDefault,
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
                $edit = BankMaster::find($id);

                $businessvalidation =array(
                    'BankName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        $BankName = $request->input('BankName');
                        $AccountNumber = $request->input('AccountNumber');
                        $BranchAddress = $request->input('BranchAddress');
                        $UpiId = $request->input('UpiId');
                        $AccountType = $request->input('AccountType');
                        $BeneficiaryName = $request->input('BeneficiaryName');
                        $BranchIfsc = $request->input('BranchIfsc');
                        $BranchSwiftCode = $request->input('BranchSwiftCode');
                        $ImageName = $request->input('ImageName');
                        $base64Image = $request->input('ImageData');
                        $ImageData = base64_decode($base64Image);
                        $ShowHide = $request->input('ShowHide');
                        $SetDefault = $request->input('SetDefault');
                        $Status = $request->input('Status');
                        $AddedBy = $request->input('AddedBy');
                        $UpdatedBy = $request->input('UpdatedBy');
    
                        $filename = uniqid() . '.png';
    
                        // print_r($filename);die();
                        Storage::disk('public')->put($filename, $ImageData);
                        
                        $edit->BankName = $request->input('BankName');
                        $edit->AccountNumber = $request->input('AccountNumber');
                        $edit->BranchAddress = $request->input('BranchAddress');
                        $edit->UpiId = $request->input('UpiId');
                        $edit->AccountType = $request->input('AccountType');
                        $edit->BeneficiaryName = $request->input('BeneficiaryName');
                        $edit->BranchIfsc = $request->input('BranchIfsc');
                        $edit->BranchSwiftCode = $request->input('BranchSwiftCode');
                        $edit->ImageName = $ImageName;
                        $edit->ImageData = $filename;
                        $edit->ShowHide = $request->input('ShowHide');
                        $edit->SetDefault = $request->input('SetDefault');
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
