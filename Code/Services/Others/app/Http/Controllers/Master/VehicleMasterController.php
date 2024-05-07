<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\VehicleMaster;

class VehicleMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = VehicleMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "id" => $post->id,
                    "VehicleTypeName" => getName(_VEHICLE_TYPE_MASTER_ ,$post->VehicleType),
                    "Capacity" => $post->Capacity,
                    "VehicleBrandName" => getName(_VEHICLE_BRAND_MASTER_ ,$post->VehicleBrand),
                    "Name" => $post->Name,
                    "ImageName" => asset('storage/' . $post->ImageName),
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
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
                    'Name' => 'required|unique:'._DB_.'.'._VEHICLE_MASTER_.',Name',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{

                    $VehicleType = $request->input('VehicleType');
                    $Capacity = $request->input('Capacity');
                    $VehicleBrand = $request->input('VehicleBrand');
                    $Name = $request->input('Name');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = time().'_'.$ImageName;

                    Storage::disk('public')->put($filename, $ImageData);
                 $savedata = VehicleMaster::create([
                    'VehicleType' => $request->VehicleType,
                    'Capacity' => $request->Capacity,
                    'VehicleBrand' => $request->VehicleBrand,
                    'Name' => $request->Name,
                    'ImageName' => $filename,
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
                $edit = VehicleMaster::find($id);

                $businessvalidation =array(
                    'Name' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        $VehicleType = $request->input('VehicleType');
                    $Capacity = $request->input('Capacity');
                    $VehicleBrand = $request->input('VehicleBrand');
                    $Name = $request->input('Name');
                    $ImageName = $request->input('ImageName');
                        $base64Image = $request->input('ImageData');
                        if($base64Image!=''){
                            $ImageData = base64_decode($base64Image);
                            $filename = time().'_'.$ImageName;
                            Storage::disk('public')->put($filename, $ImageData);
                        }
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    
                        $edit->VehicleType = $request->input('VehicleType');
                        $edit->Capacity = $request->input('Capacity');
                        $edit->VehicleBrand = $request->input('VehicleBrand');
                        $edit->Name = $request->input('Name');
                        if($base64Image!=''){
                            $edit->ImageName = $filename;
                        }
                        $edit->Status = $request->input('Status');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->updated_at = now();
                        $edit->save();

                        return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
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
        $brands = VehicleMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }

}
