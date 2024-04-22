<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\ItineraryRequirement;

class ItineraryRequirementController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');
        $id = $request->input('Id');

        $posts = ItineraryRequirement::when($Search, function ($query) use ($Search) {
            return $query->where('FromDestination', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status){
            return $query->where('Status', $Status);
        })->when($id, function ($query) use ($id) {
            return $query->where('id',  $id );
        })->select('*')->orderBy('FromDestination')->get('*');


        if($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post) {
                
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "FromDestination" => $post->FromDestination,
                    "ToDestination" => $post->ToDestination,
                    "TransferMode" => $post->TransferMode,
                    "Title" => $post->Title,
                    "Description" => $post->Description,
                    "DrivingDistance" => $post->DrivingDistance,
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

        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'FromDestination' => 'required:'._DB_.'.'._ITINERARY_REQUIREMENT_MASTER_.',FromDestination',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = ItineraryRequirement::create([
                    'FromDestination' => $request->FromDestination,
                    'ToDestination' => $request->ToDestination,
                    'TransferMode' => $request->TransferMode,
                    'Title' => $request->Title,
                    'Description' => $request->Description,
                    'DrivingDistance' => $request->DrivingDistance,
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
                $edit = ItineraryRequirement::find($id);

                $businessvalidation =array(
                    'FromDestination' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        ItineraryRequirement::where('id', $id)->update([
                        'FromDestination'=>$request->input('FromDestination'),
                        'ToDestination'=>$request->input('ToDestination'),
                        'TransferMode'=>$request->input('TransferMode'),
                        'Title'=>$request->input('Title'),
                        'Description'=>$request->input('Description'),
                        'DrivingDistance'=>$request->input('DrivingDistance'),
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

        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
           return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }

}
