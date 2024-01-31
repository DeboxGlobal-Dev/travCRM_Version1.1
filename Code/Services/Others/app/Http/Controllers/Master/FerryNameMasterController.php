<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\FerryNameMaster;

class FerryNameMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = FerryNameMaster::when($Search, function ($query) use ($Search) {
            return $query->where('FerryName', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('FerryName')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "FerryCompany" => $post->FerryCompany,
                    "FerryName" => $post->FerryName,
                    "Capacity" => $post->Capacity,
                    "ImageName" => $post->ImageName,
                    "ImageData" => $post->ImageData,
                    "Status" => $post->Status,
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
                    'FerryName' => 'required|unique:'._DB_.'.'._FERRY_NAME_MASTER_.',FerryName',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{

                    $FerryCompany = $request->input('FerryCompany');
                    $FerryName = $request->input('FerryName');
                    $Capacity = $request->input('Capacity');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = uniqid() . '.png';

                    // print_r($filename);die();
                    Storage::disk('public')->put($filename, $ImageData);


                 $savedata = FerryNameMaster::create([
                    'FerryCompany' => $request->FerryCompany,
                    'FerryName' => $request->FerryName,
                    'Capacity' => $request->Capacity,
                    'ImageName' => $ImageName,
                    'ImageData' => $filename,
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
                $edit = FerryNameMaster::find($id);

                $businessvalidation =array(
                    'FerryName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        $FerryCompany = $request->input('FerryCompany');
                        $FerryName = $request->input('FerryName');
                        $Capacity = $request->input('Capacity');
                        $ImageName = $request->input('ImageName');
                        $base64Image = $request->input('ImageData');
                        $ImageData = base64_decode($base64Image);
                        $Status = $request->input('Status');
                        $AddedBy = $request->input('AddedBy');
                        $UpdatedBy = $request->input('UpdatedBy');
    
                        $filename = uniqid() . '.png';
    
                        // print_r($filename);die();
                        Storage::disk('public')->put($filename, $ImageData);
                        
                        $edit->FerryCompany = $request->input('FerryCompany');
                        $edit->FerryName = $request->input('FerryName');
                        $edit->Capacity = $request->input('Capacity');
                        $edit->ImageName = $request->input('ImageName');
                        $edit->ImageData = $request->input('ImageData');
                        $edit->Status = $request->input('Status');
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
            print_r( $e->getMessage());
            exit;
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }



    public function destroy(Request $request)
    {
        $brands = FerryNameMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }


}
