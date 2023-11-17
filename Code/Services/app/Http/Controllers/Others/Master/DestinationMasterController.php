<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DestinationMaster;
class DestinationMasterController extends Controller
{   
    public function index(){
        $brands = DestinationMaster::all();
        if(count($brands)>0){
           return response()->json(['Status'=>200,'message'=>'','TotalRecord'=>$brands->count('id'),'DataList'=>$brands]);
        }else{
           return response()->json(['message'=>'data not found'],404);
        }
   
       }

    public function save(Request $request)
    {
          $val = $request->input('id');
          if ($val === null) {
             $businessvalidation =array(
                'CountryId' => 'required',
                'State' => 'required',
                'DestinationName' => 'required',
                'Description' => 'required',
                'SetDefault' => 'required',
                'AddedBy' => 'required',
                'UpdatedBy' => 'required',
                'Status' => 'required',
             );
             
             $validatordata = validator::make($request->all(), $businessvalidation); 
            if($validatordata->fails()){
             return $validatordata->errors();
       
            }else{
             $brand = DestinationMaster::create([
                'CountryId' => $request->CountryId,
                'State' => $request->State,   
                'DestinationName' => $request->DestinationName,   
                'Description' => $request->Description,   
                'SetDefault' => $request->SetDefault,   
                'AddedBy' => $request->AddedBy,   
                'UpdatedBy' => $request->UpdatedBy,   
                'Status' => $request->Status,
                'date_added' => now(),
             ]);
             if ($brand) {
                return response()->json(['result' =>'Data added successfully!']);
            } else {
                return response()->json(['result' =>'Failed to add data.'], 500);
            }
          }
 
          }else{
                $id = $request->input('id');
            
                $edit = DestinationMaster::find($id);
            
                if ($edit) {
                    $edit->CountryId = $request->input('CountryId');
                    $edit->State = $request->input('State');
                    $edit->DestinationName = $request->input('DestinationName');
                    $edit->Description = $request->input('Description');
                    $edit->SetDefault = $request->input('SetDefault');
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
             $brands = DestinationMaster::find($id);
             $brands->delete();
 
             if ($brands) {
                return response()->json(['result' =>'Data deleted successfully!']);
          } else {
                return response()->json(['result' =>'Failed to delete data.'], 500);
          }
          
          }
}
