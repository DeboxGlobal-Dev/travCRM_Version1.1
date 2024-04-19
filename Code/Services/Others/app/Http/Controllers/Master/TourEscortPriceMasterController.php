<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\TourEscortPriceMaster;

class TourEscortPriceMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM TOUR ESCORT PRICE SOURCE: '.$request->getContent());

        $id = $request->input('Id');
        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = TourEscortPriceMaster::when($Search, function ($query) use ($Search) {
            return $query->where('ServiceType', 'like', '%' . $Search . '%');
        })->when($id, function ($query) use ($id) {
            return $query->where('id',  $id );
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('ServiceType')->get('*');


        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "ServiceType" => $post->ServiceType,
                    "Destination" => $post->Destination,
                    "TourEscortService" => $post->TourEscortService,
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "Default" => ($post->Default == 1) ? 'Yes' : 'No',
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
        call_logger('REQUEST COMES FROM ADD/UPDATE TOUR ESCORT PRICE: '.$request->getContent());

        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'ServiceType' => 'required:'._DB_.'.'._TOUR_ESCORT_PRICE_MASTER_.',ServiceType',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = TourEscortPriceMaster::create([
                    'ServiceType' => $request->ServiceType,
                    'Destination' => $request->Destination,
                    'TourEscortService' => $request->TourEscortService,
                    'Status' => $request->Status,
                    'Default' => $request->Default,
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
                $edit = TourEscortPriceMaster::find($id);

                $businessvalidation =array(
                    'ServiceType' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->ServiceType = $request->input('ServiceType');
                        $edit->Destination = $request->input('Destination');
                        $edit->TourEscortService = $request->input('TourEscortService');
                        $edit->Status = $request->input('Status');
                        $edit->Default = $request->input('Default');
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
