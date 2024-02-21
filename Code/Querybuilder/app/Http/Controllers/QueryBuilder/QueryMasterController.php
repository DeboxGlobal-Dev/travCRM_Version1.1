<?php

namespace App\Http\Controllers\QueryBuilder;

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
        call_logger('REQUEST COMES search query: '.$Search);
        $posts = QueryMaster::when($Search, function ($query) use ($Search) {
            return $query->where('QueryId', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
            return $query->where('Status',$Status);
        })->select('*')->orderBy('QueryId')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "QueryId" => $post->QueryId,
                    "FDCode" => $post->FDCode,
                    "PackageCode" => $post->PackageCode,
                    "PackageName" => $post->PackageName,
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
       // try{
            call_logger('REQUEST COMES FROM QUERY ADD/UPDATE: '.$request->getContent());

            $id = $request->input('id');
            call_logger('new id:'.$id.'++');
            if($id==''){

                $valuedata = array();
                $valuedata = array(
                    'Flight' => $request['ValueAddedServices']['Flight'],
                    'Visa' => $request['ValueAddedServices']['Visa'],
                    'Insurance' => $request['ValueAddedServices']['Insurance'],
                    'Train' => $request['ValueAddedServices']['Train'],
                    'Transfer' => $request['ValueAddedServices']['Transfer'],
                );

                $traveldata = array();
                $traveldata = array(
                    'Type' => $request['TravelDate']['Type'],
                    'FromDate' => $request['TravelDate']['FromDate'],
                    'ToDate' => $request['TravelDate']['ToDate'],
                    'TotalDays' => $request['TravelDate']['TotalDays'],
                    'SeasonType' => $request['TravelDate']['SeasonType'],
                    'SeasonYear' => $request['TravelDate']['SeasonYear'],
                );

                $paxdata = array();
                $paxdata = array(
                    'Adult' => $request['PaxInfo']['Adult'],
                    'Child' => $request['PaxInfo']['Child'],
                    'Infant' => $request['PaxInfo']['Infant'],
                );

                $roomdata = array();
                $roomdata = array(
                    'Single' => $request['RoomInfo']['Single'],
                    'Double' => $request['RoomInfo']['Double'],
                    'Twin' => $request['RoomInfo']['Twin'],
                    'Triple' => $request['RoomInfo']['Triple'],
                    'ExtraBed' => $request['RoomInfo']['ExtraBed'],
                );
                $otp = mt_rand(100000, 999999);

                call_logger('REQUEST COMES FROM : '.$request->Subject.'+++++++++++'.$request->ClientType);

                

                


                $savedata = QueryMaster::create([
                    "QueryId" => $otp,
                    "FDCode" => $request->FDCode,
                    "PackageCode" => $request->PackageCode,
                    "PackageName" => $request->PackageName,
                    "ClientType" => $request->ClientType,
                    "AgentId" => $request->AgentId,
                    "LeadPax" => $request->LeadPax,
                    "Subject" => $request->Subject,
                    "AddEmail" => $request->AddEmail,
                    "AdditionalInfo" => $request->AdditionalInfo,
                    "QueryType" => $request->QueryType,
                    "ValueAddedServices" => $valuedata,
                    "TravelInfo" => $request->TravelInfo,
                    "PaxType" => $request->PaxType,
                    "TravelDate" => $traveldata,
                    "PaxInfo" => $paxdata,
                    "RoomInfo" => $roomdata,
                    "Priority" => $request->Priority,
                    "TAT" => $request->TAT,
                    "TourType" => $request->TourType,
                    "LeadSource" => $request->LeadSource,
                    "LeadRefrenceId" => $request->LeadRefrenceId,
                    "HotelPrefrence" => $request->HotelPrefrence,
                    "HotelType" => $request->HotelType,
                    "MealPlan" => $request->MealPlan,
                    "AddedBy" => $request->AddedBy,
                    "UpdatedBy" => $request->UpdatedBy,
                    'created_at' => now()
                ]);
                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
            }else{
                $edit = QueryMaster::find($id);
                if ($edit) {
                    $edit->QueryId = $request->input('QueryId');
                    $edit->ClientType = $request->input('ClientType');
                    $edit->LeadPax = $request->input('LeadPax');
                    $edit->Subject = $request->input('Subject');
                    $edit->QueryType = $request->input('QueryType');
                    $edit->Priority = $request->input('Priority');
                    $edit->TAT = $request->input('TAT');
                    $edit->LeadSource = $request->input('LeadSource');
                    $edit->FromDate = $request->input('FromDate');
                    $edit->ToDate = $request->input('ToDate');
                    $edit->QueryJson = $request->input('QueryJson');
                    $edit->UpdatedBy = $request->input('UpdatedBy');
                    $edit->updated_at = now();
                    $edit->save();

                    return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                }else{
                    return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
                }
            }
        // }catch (\Exception $e){
        //     call_logger("Exception Error  ===>  ". $e->getMessage());
        //     return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }
}
