<?php

namespace App\Http\Controllers\Transport\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transport\Master\CabinTypeMaster;

class CabinTypeMasterController extends Controller
{
    public function index(Request $request){
       
         
        $arrayDataRows = array();
   
        $Search = $request->input('Search');
        $Status = $request->input('Status');
        
        $posts = CabinTypeMaster::when($Search, function ($query) use ($Search) {
            return $query->where('CruiseName', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('CruiseName')->get('*');
  
        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "CruiseName" => $post->CruiseName,
                    "CabinType" => $post->CabinType,
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
                    'CruiseName' => 'required|unique:'._DB_.'.'._CABIN_TYPE_MASTER_.',CruiseName',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation); 
                
                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = CabinTypeMaster::create([
                    
                    'CruiseName' => $request->CruiseName,
                    'CabinType' => $request->CabinType,
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
                $edit = CabinTypeMaster::find($id);
    
                $businessvalidation =array(
                    'CruiseName' => 'required',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation);
                
                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        
                        $edit->CruiseName = $request->input('CruiseName');
                        $edit->CabinType = $request->input('CabinType');
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
        $brands = CabinTypeMaster::find($request->id);
        $brands->delete();
  
        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }
    
    }
}
