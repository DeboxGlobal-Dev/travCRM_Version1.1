<?php

namespace App\Http\Controllers\Others\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Others\Master\ContactDetailsMaster;

class ContactDetailsController extends Controller
{
    public function index(Request $request){

        
       
         
        $arrayDataRows = array();
   
        $Search = $request->input('Search');
        $Status = $request->input('Status');
        
        $posts = ContactDetailsMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');
  
        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "ParentId" => $post->ParentId,
                    "Title" => $post->Title,
                    "Name" => $post->Name,
                    "Designation" => $post->Designation,
                    "CountryCode" => $post->CountryCode,
                    "Phone1" => $post->Phone1,
                    "Phone2" => $post->Phone2,
                    "Phone3" => $post->Phone3,
                    "Email1" => $post->Email1,
                    "Email2" => $post->Email2,
                    "Type" => $post->Type,
                    "SetDefault" => $post->SetDefault,
                    "Status" => $post->Status,
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                    "Created_at" => $post->created_at,
                    "Updated_at" => $post->updated_at
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
                    'ParentId' => 'required|unique:'._DB_.'.'._CONTACT_PERSON_MASTER_.',ParentId',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation); 
                
                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = ContactDetailsMaster::create([
                    'ParentId' => $request->ParentId,
                    'Title' => $request->Title,
                    'Name' => $request->Name,
                    'Designation' => $request->Designation,
                    'CountryCode' => $request->CountryCode,
                    'Phone1' => $request->Phone1,
                    'Phone2' => $request->Phone2,
                    'Phone3' => $request->Phone3,
                    'Email1' => $request->Email1,
                    'Email2' => $request->Email2,
                    'Type' => $request->Type,
                    'SetDefault' => $request->SetDefault,
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
                $edit = ContactDetailsMaster::find($id);
    
                $businessvalidation =array(
                    'ParentId' => 'required',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation);
                
                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->ParentId = $request->input('ParentId');
                        $edit->Title = $request->input('Title');
                        $edit->Name = $request->input('Name');
                        $edit->Designation = $request->input('Designation');
                        $edit->CountryCode = $request->input('CountryCode');
                        $edit->Phone1 = $request->input('Phone1');
                        $edit->Phone2 = $request->input('Phone2');
                        $edit->Phone3 = $request->input('Phone3');
                        $edit->Email1 = $request->input('Email1');
                        $edit->Email2 = $request->input('Email2');
                        $edit->Type = $request->input('Type');
                        $edit->SetDefault = $request->input('SetDefault');
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
        $brands = ContactDetailsMaster::find($request->id);
        $brands->delete();
  
        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }
    
    }

}
