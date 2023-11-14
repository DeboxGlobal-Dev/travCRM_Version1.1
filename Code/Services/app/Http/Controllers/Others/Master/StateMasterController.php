<?php

Namespace App\Http\Controllers\Others\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Others\Master\StateMaster;

class StateMasterController extends Controller
{
    public function index(){
        $statelist = StateMaster::all();
        return $statelist;
    }

    public function store(Request $request)
    {
          $val = $request->input('id');
          if ($val == '') {
             
            $businessvalidation =array(
                'Name' => 'required',
                'CountryId' => 'required'
            );
             
            $validatordata = validator::make($request->all(), $businessvalidation); 
            
            if($validatordata->fails()){
             return $validatordata->errors();
            }else{
             $brand = StateMaster::create([
                'Name' => $request->Name,
                'CountryId' => $request->CountryId,
                'AddedBy' => $request->AddedBy,   
                'Status' => $request->Status,
                'DateAdded' => date('Y-m-d h:i:sa'),
             ]);
             if ($brand) {
                return response()->json(['result' =>'Data added successfully!']);
            } else {
                return response()->json(['result' =>'Failed to add data.'], 500);
            }
          }
 
          }else{


                $id = $request->input('id');
            
                $edit = StateMaster::find($id);
            
                if ($edit) {
                    $edit->Name = $request->input('Name');
                    $edit->CountryId = $request->input('CountryId');
                    $edit->UpdatedBy = $request->input('UpdatedBy');
                    $edit->Status = $request->input('Status');
                    $edit->DateUpdated = now();
                    $edit->save();
            
                    return response()->json(['result' => 'Data updated successfully']);
                } else {
                    return response()->json(['result' => 'Failed to update data. Record not found.'], 404);
                }
          }
 
    
    
    }
 
  
     
          public function destroy($id)
          {
             $brands = StateMaster::find($id);
             $brands->delete();
 
            if ($brands) {
                return response()->json(['result' =>'Data deleted successfully!']);
          } else {
                return response()->json(['result' =>'Failed to delete data.'], 500);
          }
          
          }
}