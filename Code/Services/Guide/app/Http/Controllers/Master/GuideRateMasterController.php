<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\GuideRateMaster;

class GuideRateMasterController extends Controller
{
    public function index(Request $request){
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM GUIDE RATE LIST: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = GuideRateMaster::when($Search, function ($query) use ($Search) {
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
                    "GuideId" => $post->GuideId,
                    "SupplierName" => $post->SupplierName,
                    "ValidFrom" => $post->ValidFrom,
                    "ValidTo" => $post->ValidTo,
                    "PaxRange" => $post->PaxRange,
                    "DayType" => $post->DayType,
                    "UniversalCost" => $post->UniversalCost,
                    "Currency" => $post->Currency,
                    "ServiceCost" => $post->ServiceCost,
                    "LanguageAllowance" => $post->LanguageAllowance,
                    "OtherCost" => $post->OtherCost,
                    "GST" => $post->GST,
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

        call_logger('REQUEST COMES FROM ADD/UPDATE GUIDE RATE: '.$request->getContent());

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
                 $savedata = GuideRateMaster::create([
                    'ClientId' => $request->ClientId,
                    'GuideId' => $request->GuideId,
                    'SupplierName' => $request->SupplierName,
                    'ValidFrom' => $request->ValidFrom,
                    'ValidTo' => $request->ValidTo,
                    'PaxRange' => $request->PaxRange,
                    'DayType' => $request->DayType,
                    'UniversalCost' => $request->UniversalCost,
                    'Currency' => $request->Currency,
                    'ServiceCost' => $request->ServiceCost,
                    'LanguageAllowance' => $request->LanguageAllowance,
                    'OtherCost' => $request->OtherCost,
                    'GST' => $request->GST,
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
                $edit = GuideRateMaster::find($id);

                $businessvalidation =array(
                    'ClientId' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->ClientId = $request->input('ClientId');
                        $edit->GuideId = $request->input('GuideId');
                        $edit->SupplierName = $request->input('SupplierName');
                        $edit->ValidFrom = $request->input('ValidFrom');
                        $edit->ValidTo = $request->input('ValidTo');
                        $edit->PaxRange = $request->input('PaxRange');
                        $edit->DayType = $request->input('DayType');
                        $edit->UniversalCost = $request->input('UniversalCost');
                        $edit->Currency = $request->input('Currency');
                        $edit->ServiceCost = $request->input('ServiceCost');
                        $edit->LanguageAllowance = $request->input('LanguageAllowance');
                        $edit->OtherCost = $request->input('OtherCost');
                        $edit->GST = $request->input('GST');
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
