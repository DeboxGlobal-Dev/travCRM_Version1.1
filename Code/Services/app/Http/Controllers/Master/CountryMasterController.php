<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\CountryMaster;

use Illuminate\Http\Request;

class CountryMasterController extends Controller
{
    public function save(Request $request)
    {
          $val = $request->input('id');
          if ($val === null) {
             $businessvalidation =array(
                'name' => 'required',
                'ShortName' => 'required',
                'SetDefault' => 'required',
                'AddedBy' => 'required',
                'UpdatedBy' => 'required',
             );
             
             $validatordata = validator::make($request->all(), $businessvalidation); 
            if($validatordata->fails()){
             return $validatordata->errors();
       
            }else{
             $brand = CountryMaster::create([
                'name' => $request->name,
                'ShortName' => $request->ShortName,
                'SetDefault' => $request->SetDefault,   
                'AddedBy' => $request->AddedBy,   
                'UpdatedBy' => $request->UpdatedBy,   
                'status' => $request->status,
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
            
                $edit = CountryMaster::find($id);
            
                if ($edit) {
                    $edit->name = $request->input('name');
                    $edit->ShortName = $request->input('ShortName');
                    $edit->SetDefault = $request->input('SetDefault');
                    $edit->AddedBy = $request->input('AddedBy');
                    $edit->UpdatedBy = $request->input('UpdatedBy');
                    $edit->status = $request->input('status');
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
             $brands = CountryMaster::find($id);
             $brands->delete();
 
             if ($brands) {
                return response()->json(['result' =>'Data deleted successfully!']);
          } else {
                return response()->json(['result' =>'Failed to delete data.'], 500);
          }
          
          }
}
