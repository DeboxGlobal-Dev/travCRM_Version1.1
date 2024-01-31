<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\FerryCompanyMaster;
use Illuminate\Support\Facades\Validator;

class FerryCompanyMasterController extends Controller
{
    public function index(Request $request){



        $arrayDataRows = array();
  
        call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());
  
        $Search = $request->input('Search');
        $Status = $request->input('Status');
  
        $posts = FerryCompanyMaster::when($Search, function ($query) use ($Search) {
            return $query->where('FerryCompanyName', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('FerryCompanyName')->get('*');
  
  
  
        //$countryName = getName(_COUNTRY_MASTER_,3);
        //$countryName22 = getColumnValue(_COUNTRY_MASTER_,'ShortName','AU','Name');
        //call_logger('REQUEST2: '.$countryName22);
  
        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "FerryCompanyName" => $post->FerryCompanyName,
                    "Destination" => $post->Destination,
                    "Website" => $post->Website,
                    "SelfSupplier" => $post->SelfSupplier,
                    "Type" => $post->Type,
                    "ContactPers" => $post->ContactPers,
                    "Designation" => $post->Designation,
                    "Phone" => $post->Phone,
                    "Email" => $post->Email,
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
                    'FerryCompanyName' => 'required|unique:'._DB_.'.'._FERRY_COMPANY_MASTER_.',FerryCompanyName',
                );
  
                $validatordata = validator::make($request->all(), $businessvalidation);
  
                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = FerryCompanyMaster::create([
                    'FerryCompanyName' => $request->FerryCompanyName,
                    'Destination' => $request->Destination,
                    'Website' => $request->Website,
                    'SelfSupplier' => $request->SelfSupplier,
                    'Type' => $request->Type,
                    'ContactPers' => $request->ContactPers,
                    'Designation' => $request->Designation,
                    'Phone' => $request->Phone,
                    'Email' => $request->Email,
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
                $edit = FerryCompanyMaster::find($id);
  
                $businessvalidation =array(
                    'FerryCompanyName' => 'required',
                );
  
                $validatordata = validator::make($request->all(), $businessvalidation);
  
                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->FerryCompanyName = $request->input('FerryCompanyName');
                        $edit->Destination = $request->input('Destination');
                        $edit->Website = $request->input('Website');
                        $edit->SelfSupplier = $request->input('SelfSupplier');
                        $edit->Type = $request->input('Type');
                        $edit->ContactPers = $request->input('ContactPers');
                        $edit->Designation = $request->input('Designation');
                        $edit->Phone = $request->input('Phone');
                        $edit->Email = $request->input('Email');
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
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }
  
}
