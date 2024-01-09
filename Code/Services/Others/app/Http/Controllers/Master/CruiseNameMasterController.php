<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CruiseNameMaster;

class CruiseNameMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = CruiseNameMaster::when($Search, function ($query) use ($Search) {
            return $query->where('CruiseName', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('CruiseName')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "CruiseCompany" => $post->CruiseCompany,
                    "CruiseName" => $post->CruiseName,
                    "Status" => $post->Status,
                    "ImageName" => $post->ImageName,
                    "ImageData" => $post->ImageData,
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
        //try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'CruiseName' => 'required|unique:'._DB_.'.'._CRUISE_NAME_MASTER_.',CruiseName',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{

                    $CruiseCompany = $request->input('CruiseCompany');
                    $CruiseName = $request->input('CruiseName');
                    $Status = $request->input('Status');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = uniqid() . '.png';

                    // print_r($filename);die();
                    Storage::disk('public')->put($filename, $ImageData);


                 $savedata = CruiseNameMaster::create([
                    'CruiseCompany' => $request->CruiseCompany,
                    'CruiseName' => $request->CruiseName,
                    'Status' => $request->Status,
                    'ImageName' => $ImageName,
                    'ImageData' => $filename,
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
                $edit = CruiseNameMaster::find($id);

                $businessvalidation =array(
                    'CruiseName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{

                    $id = $request->input('id');
                    $edit = CruiseNameMaster::find($id);

                    $businessvalidation =array(
                        'CruiseName' => 'required',
                    );

                    $validatordata = validator::make($request->all(), $businessvalidation);

                    if($validatordata->fails()){
                     return $validatordata->errors();
                    }else{
                        if ($edit) {
                            $edit->CruiseCompany = $request->input('CruiseCompany');
                            $edit->CruiseName = $request->input('CruiseName');
                            $edit->Status = $request->input('Status');
                            $edit->ImageName = $request->input('ImageName');
                            $base64Image = $request->input('ImageData');
                            $edit->ImageData = base64_decode($base64Image);
                            $edit->UpdatedBy = $request->input('UpdatedBy');
                            $edit->updated_at = now();
                            $edit->save();

                            return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                        } else {
                            return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
                        }
                    }
                }
            }
        // }catch (\Exception $e){
        //     call_logger("Exception Error  ===>  ". $e->getMessage());
        //     return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }



    public function destroy(Request $request)
    {
        $brands = CruiseNameMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }
}
