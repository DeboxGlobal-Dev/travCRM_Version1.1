<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CruiseMaster;

class CruiseMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = CruiseMaster::when($Search, function ($query) use ($Search) {
            return $query->where('CruisePackageName', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('CruisePackageName')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "CruisePackageName" => $post->CruisePackageName,
                    "Destination" => $post->Destination,
                    "RunningDays" => $post->RunningDays,
                    "ArrivalTime" => $post->ArrivalTime,
                    "DepartureTime" => $post->DepartureTime,
                    "Status" => $post->Status,
                    "Details" => $post->Details,
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
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
        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'CruisePackageName' => 'required|unique:'._DB_.'.'._CRUISE_MASTER_.',CruisePackageName',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = CruiseMaster::create([

                    'CruisePackageName' => $request->CruisePackageName,
                    'Destination' => $request->Destination,
                    'RunningDays' => $request->RunningDays,
                    'ArrivalTime' => $request->ArrivalTime,
                    'DepartureTime' => $request->DepartureTime,
                    'Status' => $request->Status,
                    'Details' => $request->Details,
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
                $edit = CruiseMaster::find($id);

                $businessvalidation =array(
                    'CruisePackageName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        $edit->CruisePackageName = $request->input('CruisePackageName');
                        $edit->Destination = $request->input('Destination');
                        $edit->RunningDays = $request->input('RunningDays');
                        $edit->ArrivalTime = $request->input('ArrivalTime');
                        $edit->DepartureTime = $request->input('DepartureTime');
                        $edit->Status = $request->input('Status');
                        $edit->Details = $request->input('Details');
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
        $brands = CruiseMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }
}
