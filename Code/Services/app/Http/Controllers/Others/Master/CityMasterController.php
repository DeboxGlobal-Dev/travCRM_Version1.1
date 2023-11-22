<?php

namespace App\Http\Controllers\Others\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Others\Master\CityMaster;
class CityMasterController extends Controller
{   

   public function index(Request $request){
      $Search = $request->input('Search');
      $Status = $request->input('Status');

    $posts = CityMaster::when($Search, function ($query) use ($Search) {
        return $query->where('Name', 'like', '%' . $Search . '%')
                     ->orwhere('CountryId', 'like', '%' . $Search . '%')
                     ->orwhere('StateId', 'like', '%' . $Search . '%');
    })->when($Status, function ($query) use ($Status) {
         return $query->where('Status', 'like', '%' . $Status . '%');
    })->select('*')->get('*');

    if ($posts->isNotEmpty()) {
        return response()->json([
            'Status' => 200,
            'message' => '',
            'TotalRecord' => $posts->count('id'),
            'DataList' => $posts
        ]);
    } else {
        return response()->json(['message' => 'Data not found'], 404);
    }
}

    public function save(Request $request)
    {

          $val = $request->input('id');
          if ($val === null) {
             $businessvalidation =array(
                'Name' => 'required',
                'CountryId' => 'required',
                'StateId' => 'required',
                'AddedBy' => 'required',
                'UpdatedBy' => 'required',
                'Status' => 'required',
             );
             
             $validatordata = validator::make($request->all(), $businessvalidation); 
            if($validatordata->fails()){
             return $validatordata->errors();
       
            }else{
             $brand = CityMaster::create([
                'Name' => $request->Name,
                'CountryId' => $request->CountryId,   
                'StateId' => $request->StateId,   
                'AddedBy' => $request->AddedBy,   
                'UpdatedBy' => $request->UpdatedBy,   
                'Status' => $request->Status,
                'Date_added' => now(),
             ]);
             if ($brand) {
                return response()->json(['result' =>'Data added successfully!']);
            } else {
                return response()->json(['result' =>'Failed to add data.'], 500);
            }
          }
 
          }else{
                $id = $request->input('id');
            
                $edit = CityMaster::find($id);
            
                if ($edit) {
                    $edit->Name = $request->input('Name');
                    $edit->CountryId = $request->input('CountryId');
                    $edit->StateId = $request->input('StateId');
                    $edit->AddedBy = $request->input('AddedBy');
                    $edit->UpdatedBy = $request->input('UpdatedBy');
                    $edit->Status = $request->input('Status');
                    $edit->Updated_at = now();
                    $edit->save();
            
                    return response()->json(['result' => 'Data updated successfully']);
                } else {
                    return response()->json(['result' => 'Failed to update data. Record not found.'], 404);
                }
          }
 
    
    
    }
 
  
     
          public function destroy($id)
          {
             $brands = CityMaster::find($id);
             $brands->delete();
 
             if ($brands) {
                return response()->json(['result' =>'Data deleted successfully!']);
          } else {
                return response()->json(['result' =>'Failed to delete data.'], 500);
          }
          
          }
}
