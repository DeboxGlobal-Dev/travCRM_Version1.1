<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\main;

class ExampleController extends Controller
{   
   public function index(){
      $brands = main::all();
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
            $validationData =array(
               'Name' => 'required',
               'Description' => 'required',
               'Addedby' => 'required',
               'Updatedby' => 'required',
               'Status' => 'required',
            );
            
            $validator = validator::make($request->all(), $validationData); 
           if($validator->fails()){
            return $validator->errors();
      
           }else{
            $brand = main::create([
               'Name' => $request->Name,
               'Description' => $request->Description,   
               'Addedby' => $request->Addedby,   
               'Updatedby' => $request->Updatedby,   
               'Status' => $request->Status,
            ]);
            if ($brand) {
               return response()->json(['result' =>'Data added successfully!']);
           } else {
               return response()->json(['result' =>'Failed to add data.'], 500);
           }
         }

         }else{
               $id = $request->input('id');
           
               $edit = main::find($id);
           
               if ($edit) {
                   $edit->Name = $request->input('Name');
                   $edit->Description = $request->input('Description');
                   $edit->Addedby = $request->input('Addedby');
                   $edit->Updatedby = $request->input('Updatedby');
                   $edit->Status = $request->input('status');
                   $edit->save();
           
                   return response()->json(['result' => 'Data updated successfully']);
               } else {
                   return response()->json(['result' => 'Failed to update data. Record not found.'], 404);
               }
         }

   
   
   }

 
    
         public function destroy($id)
         {
            $brands = main::find($id);
            $brands->delete();

            if ($brands) {
               return response()->json(['result' =>'Data deleted successfully!']);
         } else {
               return response()->json(['result' =>'Failed to delete data.'], 500);
         }
         
         }


        
    }

