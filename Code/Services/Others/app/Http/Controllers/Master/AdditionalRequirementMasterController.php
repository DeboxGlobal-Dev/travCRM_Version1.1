<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\AdditionalRequirementMaster;

class AdditionalRequirementMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = AdditionalRequirementMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "Name" => $post->Name,
                    "DestinationId" => $post->DestinationId,
                    "CurrencyId" => $post->CurrencyId,
                    "CostType" => $post->CostType,
                    "AdultCost" => $post->AdultCost,
                    "ChildCost" => $post->ChildCost,
                    "InfantCost" => $post->InfantCost,
                    "ImageName" => $post->ImageName,
                    "ImageData" => $post->ImageData,
                    "Details" => $post->Details,
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
                    'Name' => 'required|unique:'._DB_.'.'._ADDITIONAL_REQUIREMENT_MASTER_.',Name',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{

                    $Name = $request->input('Name');
                    $DestinationId = $request->input('DestinationId');
                    $CurrencyId = $request->input('CurrencyId');
                    $CostType = $request->input('CostType');
                    $AdultCost = $request->input('AdultCost');
                    $ChildCost = $request->input('ChildCost');
                    $InfantCost = $request->input('InfantCost');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $Details = $request->input('Details');
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = uniqid() . '.png';

                    // print_r($filename);die();
                    Storage::disk('public')->put($filename, $ImageData);


                 $savedata = AdditionalRequirementMaster::create([
                    'Name' => $request->Name,
                    'DestinationId' => $request->DestinationId,
                    'CurrencyId' => $request->CurrencyId,
                    'CostType' => $request->CostType,
                    'AdultCost' => $request->AdultCost,
                    'ChildCost' => $request->ChildCost,
                    'InfantCost' => $request->InfantCost,
                    'ImageName' => $ImageName,
                    'ImageData' => $filename,
                    'Details' => $request->Details,
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
                $edit = AdditionalRequirementMaster::find($id);

                $businessvalidation =array(
                    'Name' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->Name = $request->input('Name');
                        $edit->DestinationId = $request->input('DestinationId');
                        $edit->CurrencyId = $request->input('CurrencyId');
                        $edit->CostType = $request->input('CostType');
                        $edit->AdultCost = $request->input('AdultCost');
                        $edit->ChildCost = $request->input('ChildCost');
                        $edit->InfantCost = $request->input('InfantCost');
                        $edit->ImageName = $request->input('ImageName');
                        $base64Image = $request->input('ImageData');
                        $edit->ImageData = base64_decode($base64Image);
                        $edit->Details = $request->input('Details');
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



    /*public function destroy(Request $request)
    {
        $brands = AdditionalRequirementMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }*/

}
