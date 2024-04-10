<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\TaxMaster;

class TaxMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');
        $id = $request->input('Id');

        $posts = TaxMaster::when($Search, function ($query) use ($Search) {
            return $query->where('ServiceType', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->when($id, function ($query) use ($id) {
            return $query->where('id',  $id );
        })->select('*')->orderBy('ServiceType')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "ServiceType" => $post->ServiceType,
                    "TaxSlabName" => $post->TaxSlabName,
                    "TaxValue" => $post->TaxValue,
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "SetDefault" => ($post->SetDefault == 1) ? 'Active' : 'Inactive',
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
        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'ServiceType' => 'required|unique:'._DB_.'.'._TAX_MASTER_.',ServiceType',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = TaxMaster::create([
                    'ServiceType' => $request->ServiceType,
                    'TaxSlabName' => $request->TaxSlabName,
                    'TaxValue' => $request->TaxValue,
                    'Status' => $request->Status,
                    'SetDefault' => $request->SetDefault,
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
                $edit = TaxMaster::find($id);

                $businessvalidation =array(
                    'ServiceType' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->ServiceType = $request->input('ServiceType');
                        $edit->TaxSlabName = $request->input('TaxSlabName');
                        $edit->TaxValue = $request->input('TaxValue');
                        $edit->Status = $request->input('Status');
                        $edit->SetDefault = $request->input('SetDefault');
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
