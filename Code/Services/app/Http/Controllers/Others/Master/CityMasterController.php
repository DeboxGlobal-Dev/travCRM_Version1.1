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
        return $query->where('Name', 'like', '%' . $Search . '%');
    })->when($Status, function ($query) use ($Status) {
         return $query->where('Status',$Status);
    })->select('*')->get('*');

    if ($posts->isNotEmpty()) {
        $arrayDataRows = [];
        foreach ($posts as $post){
            $arrayDataRows[] = [
                "Id" => $post->id,
                "Name" => $post->Name,
                "StateName" => getName(_STATE_MASTER_,$post->StateId),
                "CountryName" => getName(_COUNTRY_MASTER_,$post->CountryId),
                "Status" => $post->Status,
                "AddedBy" => $post->AddedBy,
                "UpdatedBy" => $post->UpdatedBy,
                "created_at" => $post->created_at,
                "updated_at" => $post->updated_at
            ];
        }

        return response()->json([
            'Status' => 0,
            'message' => '',
            'TotalRecord' => $posts->count('id'),
            'DataList' => $arrayDataRows
        ]);
    } else {
        return response()->json([
            "Status" => 0,
            "TotalRecord" => $posts->count('id'), 
            "Message" => "No Record Found."
        ]);
    }
}

    public function save(Request $request)
    {

          $val = $request->input('id');
          if ($val === null) {
             $businessvalidation =array(
                'Name' => 'required|unique:'._PGSQL_.'.'._CITY_MASTER_.',Name',
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
                'created_at' => now(),
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
                    $edit->updated_at = now();
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
