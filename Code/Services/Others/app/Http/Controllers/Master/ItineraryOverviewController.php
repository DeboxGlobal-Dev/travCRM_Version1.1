<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\ItineraryOverview;

class ItineraryOverviewController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = ItineraryOverview::when($Search, function ($query) use ($Search) {
            return $query->where('OverviewName', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status){
            return $query->where('Status', $Status);
        })->select('*')->orderBy('OverviewName')->get('*');


        if($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post) {
                
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "OverviewName" => $post->OverviewName,
                    "OverviewInformation" => $post->OverviewInformation,
                    "HighlightInformation" => $post->HighlightInformation,
                    "ItineraryIntroduction" => $post->ItineraryIntroduction,
                    "ItinerarySummary" => $post->ItinerarySummary,
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                ];
            }

            return response()->json([
                'Status' => 200,
                'TotalRecord' => $posts->count('id'),
                'ItineraryInfoMaster' => $arrayDataRows
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

        //try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'OverviewName' => 'required|unique:'._DB_.'.'._ITINERARY_OVERVIEW_.',OverviewName',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = ItineraryOverview::create([
                    'OverviewName' => $request->OverviewName,
                    'OverviewInformation' => $request->OverviewInformation,
                    'HighlightInformation' => $request->HighlightInformation,
                    'ItineraryIntroduction' => $request->ItineraryIntroduction,
                    'ItinerarySummary' => $request->ItinerarySummary,
                    'Status' => $request->Status,
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
                $edit = ItineraryOverview::find($id);

                $businessvalidation =array(
                    'OverviewName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        ItineraryOverview::where('id', $id)->update([
                        'OverviewName'=>$request->input('OverviewName'),
                        'OverviewInformation'=>$request->input('OverviewInformation'),
                        'HighlightInformation'=>$request->input('HighlightInformation'),
                        'ItineraryIntroduction'=>$request->input('ItineraryIntroduction'),
                        'ItinerarySummary'=>$request->input('ItinerarySummary'),
                        'Status'=>$request->input('Status'),
                        'UpdatedBy'=>$request->input('UpdatedBy'),
                        //'updated_at'=>now(),


                    ]);
                     return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                    }
                    else {
                        return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                    
                }
            }

        // }catch (\Exception $e){
        //     call_logger("Exception Error  ===>  ". $e->getMessage());
        //    return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }

}
