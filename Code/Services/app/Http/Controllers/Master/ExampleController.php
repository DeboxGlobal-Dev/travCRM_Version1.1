<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\main;

class ExampleController extends Controller
{
   public function apidata(Request $request)
   {
         $val = $request->input('id');
         if ($val === null) {
            $validationData =array(
               'name' => 'required',
               'description' => 'required',
               'addedby' => 'required',
               'updatedby' => 'required',
               'status' => 'required',
            );
            
            $validator = validator::make($request->all(), $validationData); 
           if($validator->fails()){
            return $validator->errors();
      
           }else{
            $brand = main::create([
               'name' => $request->name,
               'description' => $request->description,   
               'addedby' => $request->addedby,   
               'updatedby' => $request->updatedby,   
               'status' => $request->status,
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
                   $edit->name = $request->input('name');
                   $edit->description = $request->input('description');
                   $edit->addedby = $request->input('addedby');
                   $edit->updatedby = $request->input('updatedby');
                   $edit->status = $request->input('status');
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

