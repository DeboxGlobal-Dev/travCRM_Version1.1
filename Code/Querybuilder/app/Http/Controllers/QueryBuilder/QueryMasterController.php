<?php

namespace App\Http\Controllers\QueryBuilder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\QueryBuilder\QueryMaster;

class QueryMasterController extends Controller
{

public function index(Request $request){


    $arrayDataRows = array();

    call_logger('REQUEST COMES FROM QUERY LIST: '.$request->getContent());

    $Search = $request->input('Search');
    $Status = $request->input('Status');

    $posts = QueryMaster::when($Search, function ($query) use ($Search) {
        return $query->where('AgentId', 'like', '%' . $Search . '%');
    })->when($Status, function ($query) use ($Status) {
         return $query->where('Status',$Status);
    })->select('*')->orderBy('AgentId')->get('*');

    if ($posts->isNotEmpty()) {
        $arrayDataRows = [];
        foreach ($posts as $post){
            $arrayDataRows[] = [
                "Id" => $post->id,
                "QueryId" => $post->QueryId,
                "ClientType" => $post->ClientType,
                "AgentId" => $post->AgentId,
                "LeadPax" => $post->LeadPax,
                "Subject" => $post->Subject,
                "AddEmail" => $post->AddEmail,
                "AdditionalInfo" => $post->AdditionalInfo,
                "QueryType" => $post->QueryType,
                "ValueAddedServices" => $post->ValueAddedServices,
                "TravelInfo" => $post->TravelInfo,
                "PaxType" => $post->PaxType,
                "TravelDate" => $post->TravelDate,
                "PaxInfo" => $post->PaxInfo,
                "RoomInfo" => $post->RoomInfo,
                "Priority" => $post->Priority,
                "TAT" => $post->TAT,
                "TourType" => $post->TourType,
                "LeadSource" => $post->LeadSource,
                "LeadRefrenceId" => $post->LeadRefrenceId,
                "HotelPrefrence" => $post->HotelPrefrence,
                "HotelType" => $post->HotelType,
                "MealPlan" => $post->MealPlan,
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
    call_logger('REQUEST COMES FROM ADD/UPDATE QUERY: '.$request->getContent());

    try{
        $id = $request->input('id');
        if($id == '') {

            $businessvalidation =array(
                // 'Name' => 'required|unique:'._DB_.'.'._TOUR_TYPE_MASTER_.',Name',
            );

            $validatordata = validator::make($request->all(), $businessvalidation);

            if($validatordata->fails()){
                return $validatordata->errors();
            }else{
                $otp = mt_rand(100000, 999999);
                $savedata = QueryMaster::create([
                    "QueryId" => $otp,
                    "QueryJson" => $request->QueryJson,
                    "AddedBy" => $request->AddedBy,
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
            $edit = QueryMaster::find($id);

            $businessvalidation =array(
                // 'Name' => 'required',
            );

            $validatordata = validator::make($request->all(), $businessvalidation);

            if($validatordata->fails()){
             return $validatordata->errors();
            }else{
                if ($edit) {
                    $edit->QueryId = $request->input('QueryId');
                    $edit->QueryJson = $request->input('QueryJson');
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



public function destroy(Request $request)
{
    $brands = QueryMaster::find($request->id);
    $brands->delete();

    if ($brands) {
        return response()->json(['result' =>'Data deleted successfully!']);
    } else {
        return response()->json(['result' =>'Failed to delete data.'], 500);
    }

}
}
