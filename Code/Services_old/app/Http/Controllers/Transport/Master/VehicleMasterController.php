<?php

namespace App\Http\Controllers\Transport\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transport\Master\VehicleMaster;

class VehicleMasterController extends Controller
{
    public function index(Request $request){
       
         
        $arrayDataRows = array();
   
        $Search = $request->input('Search');
        $Status = $request->input('Status');
        
        $posts = VehicleMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');
  
        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "VehicleType" => $post->VehicleType,
                    "Capacity" => $post->Capacity,
                    "VehicleBrand" => $post->VehicleBrand,
                    "Name" => $post->Name,
                    "ImageName" => $post->ImageName,
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
                    'Name' => 'required|unique:'._DB_.'.'._VEHICLE_MASTER_.',Name',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation); 
                
                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = VehicleMaster::create([
                    'VehicleType' => $request->VehicleType,
                    'Capacity' => $request->Capacity,
                    'VehicleBrand' => $request->VehicleBrand,
                    'Name' => $request->Name,
                    'ImageName' => $request->ImageName,
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
                $edit = VehicleMaster::find($id);
    
                $businessvalidation =array(
                    'Name' => 'required',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation);
                
                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->VehicleType = $request->input('VehicleType');
                        $edit->Capacity = $request->input('Capacity');
                        $edit->VehicleBrand = $request->input('VehicleBrand');
                        $edit->Name = $request->input('Name');
                        $edit->ImageName = $request->input('ImageName');
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
