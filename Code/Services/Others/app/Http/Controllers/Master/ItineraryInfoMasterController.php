<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\ItineraryInfoMaster;

class ItineraryInfoMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = ItineraryInfoMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Title', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status){
            return $query->where('Status', $Status);
        })->select('*')->orderBy('Title')->get('*');


        if($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post) {
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "FromDestination" => $post->FromDestination,
                    "ToDestination" => $post->ToDestination,
                    "TransferMode" => $post->TransferMode,
                    "Title" => $post->Title,
                    "DrivingDistance" => $post->DrivingDistance,
                    "Details" => $post->Details,
                    "Status" => $post->Status,
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
                    'Title' => 'required|unique:'._DB_.'.'._ITINERARY_INFO_MASTER_.',Title',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = ItineraryInfoMaster::create([
                    'FromDestination' => $request->FromDestination,
                    'ToDestination' => $request->ToDestination,
                    'TransferMode' => $request->TransferMode,
                    'Title' => $request->Title,
                    'DrivingDistance' => $request->DrivingDistance,
                    'Details' => $request->Details,
                    'Status' => $request->Status,
                    'AddedBy' => $request->AddedBy,
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
                $edit = ItineraryInfoMaster::find($id);

                $businessvalidation =array(
                    'Title' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                    ItineraryInfoMaster::where('id', $id)->update([
                        'FromDestination'=>$request->input('FromDestination'),
                        'ToDestination'=>$request->input('ToDestination'),
                        'TransferMode'=>$request->input('TransferMode'),
                        'Title'=>$request->input('Title'),
                        'DrivingDistance'=>$request->input('DrivingDistance'),
                        'Details'=>$request->input('Details'),
                        'Status'=>$request->input('Status'),
                        'UpdatedBy'=>$request->input('UpdatedBy'),
                        //'updated_at'=>now(),


                    ]);
                     return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                    }
                    else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                    //if ($edit) {

                        //$edit->FromDestination = $request->input('FromDestination');
                        //$edit->ToDestination = $request->input('ToDestination');
                        //$edit->TransferMode = $request->input('TransferMode');
                        //$edit->Title = $request->input('Title');
                        //$edit->DrivingDistance = $request->input('DrivingDistance');
                        //$edit->Details = $request->input('Details');
                        //$edit->Status = $request->input('Status');
                        //$edit->UpdatedBy = $request->input('UpdatedBy');
                        //$edit->updated_at = now();
                        //$edit->save();

                        //return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                    //} else {
                        //return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
                    //}
                }
            }

        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
           return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }

    public function destroy(Request $request)
    {
        $brands = ItineraryInfoMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }


}
