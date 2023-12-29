<?php

namespace App\Http\Controllers\Others\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Others\Master\QueryMaster;

class QueryMasterController extends Controller
{

public function index(Request $request){


    $arrayDataRows = array();

    call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());

    $Search = $request->input('Search');
    $Status = $request->input('Status');

    $posts = QueryMaster::when($Search, function ($query) use ($Search) {
        return $query->where('AgentId', 'like', '%' . $Search . '%');
    })->when($Status, function ($query) use ($Status) {
         return $query->where('Status',$Status);
    })->select('*')->orderBy('AgentId')->get('*');

    //$countryName = getName(_COUNTRY_MASTER_,3);
    //$countryName22 = getColumnValue(_COUNTRY_MASTER_,'ShortName','AU','Name');
    //call_logger('REQUEST2: '.$countryName22);

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
    call_logger('REQUEST COMES FROM ADD/UPDATE STATE: '.$request->getContent());

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
             $savedata = QueryMaster::create([
                "QueryId" => $request->QueryId,
                    "ClientType" => $request->ClientType,
                    "AgentId" => $request->AgentId,
                    "LeadPax" => $request->LeadPax,
                    "Subject" => $request->Subject,
                    "AddEmail" => $request->AddEmail,
                    "AdditionalInfo" => $request->AdditionalInfo,
                    "QueryType" => $request->QueryType,
                    "ValueAddedServices" => $request->ValueAddedServices,
                    "TravelInfo" => $request->TravelInfo,
                    "PaxType" => $request->PaxType,
                    "TravelDate" => $request->TravelDate,
                    "PaxInfo" => $request->PaxInfo,
                    "RoomInfo" => $request->RoomInfo,
                    "Priority" => $request->Priority,
                    "TAT" => $request->TAT,
                    "TourType" => $request->TourType,
                    "LeadSource" => $request->LeadSource,
                    "LeadRefrenceId" => $request->LeadRefrenceId,
                    "HotelPrefrence" => $request->HotelPrefrence,
                    "HotelType" => $request->HotelType,
                    "MealPlan" => $request->MealPlan,
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
                    $edit->ClientType = $request->input('ClientType');
                    $edit->AgentId = $request->input('AgentId');
                    $edit->LeadPax = $request->input('LeadPax');
                    $edit->Subject = $request->input('Subject');
                    $edit->AddEmail = $request->input('AddEmail');
                    $edit->AdditioalInfo = $request->input('AdditionalInfo');
                    $edit->QueryType = $request->input('QueryType');
                    $edit->ValueAdedServices = $request->input('ValueAddedServices');
                    $edit->TravelInfo = $request->input('TravelInfo');
                    $edit->PaxType = $request->input('PaxType');
                    $edit->TravelDate = $request->input('TravelDate');
                    $edit->PaxInfo = $request->input('PaxInfo');
                    $edit->RoomInfo = $request->input('RoomInfo');
                    $edit->Priority = $request->input('Priority');
                    $edit->TAT = $request->input('TAT');
                    $edit->TourType = $request->input('TourType');
                    $edit->LeadSource = $request->input('LeadSource');
                    $edit->LeadRefenceId = $request->input('LeadRefrenceId');
                    $edit->HotelPrfrence = $request->input('HotelPrefrence');
                    $edit->HotelType = $request->input('HotelType');
                    $edit->MealPlan = $request->input('MealPlan');
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
