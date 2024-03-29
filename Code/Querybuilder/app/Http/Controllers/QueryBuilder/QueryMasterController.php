<?php

namespace App\Http\Controllers\QueryBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\QueryBuilder\QueryMaster;

class QueryMasterController extends Controller //
{
    public function index(Request $request)
    {

        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM QUERY LIST: ' . $request->getContent());
        $QueryId = $request->input('QueryId');
        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = QueryMaster::when($QueryId, function ($query) use ($QueryId) {
            return $query->where('QueryId', 'like', $QueryId);
        })->when($Status, function ($query) use ($Status) {
            return $query->where('Status', $Status);
        })
        ->select('*')->orderBy('QueryId')->get();

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post) {

                $dataFromJson = json_decode($post->QueryJson);
                // print_r($dataFromJson);
                // exit;
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "QueryId" => $post->QueryId,
                    "FDCode" => $dataFromJson->FDCode,
                    "PackageCode" => $post->QueryId,
                    "PackageName" => $post->QueryId,
                    "ClientType" => $post->ClientType,
                    "AgentId" => $post->AgentId,
                    "LeadPax" => $post->LeadPax,
                    "Subject" => $post->Subject,
                    "AddEmail" => $dataFromJson->AddEmail,
                    "AdditionalInfo" => $dataFromJson->AdditionalInfo,
                    "QueryType" => $post->QueryType,
                    "TravelInfo" => $dataFromJson->TravelInfo,
                    "PaxType" => $dataFromJson->PaxType,
                    "Priority" => $post->Priority,
                    "TAT" => $post->TAT,
                    "TourType" => $post->TourType,
                    "LeadSource" => $post->LeadSource,
                    "HotelPrefrence" => $dataFromJson->HotelPrefrence,
                    "HotelType" => $dataFromJson->HotelType,
                    "MealPlan" => $dataFromJson->MealPlan,
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                ];
            }

            return response()->json([
                'Status' => 1,
                'TotalRecord' => $posts->count('id'),
                'DataList' => $arrayDataRows
            ]);
        } else {
            return response()->json([
                "Status" => 0,
                "TotalRecord" => $posts->count('id'),
                "Message" => "No Record Found."
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            call_logger('REQUEST COMES FROM QUERY ADD/UPDATE: ' . $request->getContent());

            $id = $request->input('id');
            call_logger('new id:' . $id . '++');
            if ($id == '') {
                $otp = mt_rand(100000, 999999);

                call_logger('REQUEST COMES FROM : ' . $request->Subject . '+++++++++++' . $request->ClientType);

                $savedata = QueryMaster::create([
                    "QueryId" => $otp,
                    "ClientType" => $request->ClientType,
                    "LeadPax" => $request->LeadPax,
                    "Subject" => $request->Subject,
                    "QueryType" => $request->QueryType,
                    "Priority" => $request->Priority,
                    "TAT" => $request->TAT,
                    "LeadSource" => $request->LeadSource,
                    "FromDate" => $request->TravelDate['FromDate'],
                    "ToDate" => $request->TravelDate['ToDate'],
                    "QueryJson" => $request->getContent(),
                    "AddedBy" => $request->AddedBy,
                    'created_at' => now()
                ]);
                if ($savedata) {
                    return response()->json(['Status' => 1, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 0, 'Message' => 'Failed to add data.'], 500);
                }
            } else {
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

                    return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                } else {
                    return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }
}
