<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Master\ActivityRateMaster;

class ActivityRateMasterController extends Controller
{
    public function index(Request $request){
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM TRAIN RATE LIST: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = ActivityRateMaster::when($Search, function ($query) use ($Search) {
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
                    "ActivityId" => $post->ActivityId,
                    "SupplierName" => $post->SupplierName,
                    "ValidFrom" => $post->ValidFrom,
                    "ValidTo" => $post->ValidTo,
                    "Currency" => $post->Currency,
                    "Activity" => $post->Activity,
                    "PaxRange" => $post->PaxRange,
                    "TotalCost" => $post->TotalCost,
                    "PerPaxCost" => $post->PerPaxCost,
                    "TaxSlab" => $post->TaxSlab,
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



        call_logger('REQUEST COMES FROM ADD/UPDATE ACTIVITY RATE: '.$request->getContent());

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
                 $savedata = ActivityRateMaster::create([
                    'ClientId' => $request->ClientId,
                    'ActivityId' => $request->ActivityId,
                    'SupplierName' => $request->SupplierName,
                    'ValidFrom' => $request->ValidFrom,
                    'ValidTo' => $request->ValidTo,
                    'Currency' => $request->Currency,
                    'Activity' => $request->Activity,
                    'PaxRange' => $request->PaxRange,
                    'TotalCost' => $request->TotalCost,
                    'PerPaxCost' => $request->PerPaxCost,
                    'TaxSlab' => $request->TaxSlab,
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
                $edit = ActivityRateMaster::find($id);

                $businessvalidation =array(
                    'ClientId' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                    ActivityRateMaster::where('id', $id)->update([
                    'ClientId' => $request->input('ClientId'),
                    'ActivityId' => $request->input('ActivityId'),
                    'SupplierName' => $request->input('SupplierName'),
                    'ValidFrom' => $request->input('ValidFrom'),
                    'ValidTo' => $request->input('ValidTo'),
                    'Currency' => $request->input('Currency'),
                    'Activity' => $request->input('Activity'),
                    'PaxRange' => $request->input('PaxRange'),
                    'TotalCost' => $request->input('TotalCost'),
                    'PerPaxCost' => $request->input('PerPaxCost'),
                    'TaxSlab' => $request->input('TaxSlab'),
                    'Remarks' => $request->input('Remarks'),
                    'Status' => $request->input('Status'),
                    'JsonItem' => $request->getContent(),
                    'Destination' => $request->input('Destination'),
                    'UpdatedBy' => $request->input('UpdatedBy'),
                    //'created_at' => now()
                ]);




                        return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                }
            }
        }catch (\Exception $e){
            print_r($e->getMessage());
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }
}
