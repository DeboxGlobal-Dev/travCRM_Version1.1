<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BusinessTypeMaster;

class BusinessTypeMasterController extends Controller
{

    public function index(){
        $brands = BusinessTypeMaster::all();
        if(count($brands)>0){
           return response()->json(['Status'=>200,'message'=>'','TotalRecord'=>$brands->count('id'),'DataList'=>$brands]);
        }else{
           return response()->json(['message'=>'brand not found'],404);
        }
   
       }

    public function save(Request $request)
    {
          $val = $request->input('id');
          if ($val === null) {
             $businessvalidation =array(
                'Name' => 'required',
                'SetDefault' => 'required',
                'AddedBy' => 'required',
                'UpdatedBy' => 'required',
                'Status' => 'required',
             );
             
             $validatordata = validator::make($request->all(), $businessvalidation); 
            if($validatordata->fails()){
             return $validatordata->errors();
       
            }else{
             $brand = BusinessTypeMaster::create([
                'Name' => $request->Name,
                'SetDefault' => $request->SetDefault,   
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
            
                $edit = BusinessTypeMaster::find($id);
            
                if ($edit) {
                    $edit->Name = $request->input('Name');
                    $edit->SetDefault = $request->input('SetDefault');
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
             $brands = BusinessTypeMaster::find($id);
             $brands->delete();
 
             if ($brands) {
                return response()->json(['result' =>'Data deleted successfully!']);
          } else {
                return response()->json(['result' =>'Failed to delete data.'], 500);
          }
          
          }
 
}
