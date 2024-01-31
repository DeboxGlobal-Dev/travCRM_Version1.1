<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CruiseRateMaster;

class CruiseRateMasterController extends Controller
{
    public function index(Request $request){
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM CRUISE RATE LIST: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = CruiseRateMaster::when($Search, function ($query) use ($Search) {
            return $query->where('ClientId', $Search);
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "ClientId" => $post->ClientId,
                    "CruiseId" => $post->CruiseId,
                    "MarketType" => $post->MarketType,
                    "SupplierName" => $post->SupplierName,
                    "TariffType" => $post->TariffType,
                    "ValidFrom" => $post->ValidFrom,
                    "ValidTo" => $post->ValidTo,
                    "TaxSlab" => $post->TaxSlab,
                    "CruiseName" => $post->CruiseName,
                    "CabinType" => $post->CabinType,
                    "Currency" => $post->Currency,
                    "AdultCost" => $post->AdultCost,
                    "ChildCost" => $post->ChildCost,
                    "InfantCost" => $post->InfantCost,
                    "Margin" => $post->Margin,
                    "Value" => $post->Value,
                    "Remarks" => $post->Remarks,
                    "Status" => $post->Status,
                    "JsonItem" => $post->JsonItem,
                    "Destination" => $post->Destination,
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

        call_logger('REQUEST COMES FROM ADD/UPDATE CRUISE RATE: '.$request->getContent());

        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'ClientId' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = CruiseRateMaster::create([
                    'ClientId' => $request->ClientId,
                    'CruiseId' => $request->CruiseId,
                    'MarketType' => $request->MarketType,
                    'SupplierName' => $request->SupplierName,
                    'TariffType' => $request->TariffType,
                    'ValidFrom' => $request->ValidFrom,
                    'ValidTo' => $request->ValidTo,
                    'TaxSlab' => $request->TaxSlab,
                    'CruiseName' => $request->CruiseName,
                    'CabinType' => $request->CabinType,
                    'Currency' => $request->Currency,
                    'AdultCost' => $request->AdultCost,
                    'ChildCost' => $request->ChildCost,
                    'InfantCost' => $request->InfantCost,
                    'Margin' => $request->Margin,
                    'Value' => $request->Value,
                    'Remarks' => $request->Remarks,
                    'Status' => $request->Status,
                    'JsonItem' => $request->getContent(),
                    'Destination' => $request->Destination,
                    'AddedBy' => $request->AddedBy,
                    'created_at' => now()
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
              }

            }else{

                $id = $request->input('id');
                $edit = CruiseRateMaster::find($id);

                $businessvalidation =array(
                    'ClientId' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->ClientId = $request->input('ClientId');
                        $edit->CruiseId = $request->input('CruiseId');
                        $edit->MarketType = $request->input('MarketType');
                        $edit->SupplierName = $request->input('SupplierName');
                        $edit->TariffType = $request->input('TariffType');
                        $edit->ValidFrom = $request->input('ValidFrom');
                        $edit->ValidTo = $request->input('ValidTo');
                        $edit->TaxSlab = $request->input('TaxSlab');
                        $edit->CruiseName = $request->input('CruiseName');
                        $edit->CabinType = $request->input('CabinType');
                        $edit->Currency = $request->input('Currency');
                        $edit->AdultCost = $request->input('AdultCost');
                        $edit->ChildCost = $request->input('ChildCost');
                        $edit->InfantCost = $request->input('InfantCost');
                        $edit->Margin = $request->input('Margin');
                        $edit->Value = $request->input('Value');
                        $edit->Remarks = $request->input('Remarks');
                        $edit->Status = $request->input('Status');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->JsonItem = $request->getContent();
                        $edit->Destination = $request->input('Destination');
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
