<?php

namespace App\Http\Controllers\Others\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Others\Master\HotelChainMaster;

class HotelChainMasterController extends Controller
{
    public function index(Request $request){
       
         
        $arrayDataRows = array();
   
        $Search = $request->input('Search');
        $Status = $request->input('Status');
        
        $posts = HotelChainMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');
   
        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "Name" => $post->Name,
                    "Location" => $post->Location,
                    "HotelWebsite" => $post->HotelWebsite,
                    "SelfSupplier" => $post->SelfSupplier,
                    "ContactType" => $post->ContactType,
                    "ContactName" => $post->ContactName,
                    "ContactDesignation" => $post->ContactDesignation,
                    "ContactCountryCode" => $post->ContactCountryCode,
                    "ContactMobile" => $post->ContactMobile,
                    "ContactEmail" => $post->ContactEmail,
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
                    'Name' => 'required|unique:'._DB_.'.'._HOTEL_CHAIN_MASTER_.',Name',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation); 
                
                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = HotelChainMaster::create([
                    'Name' => $request->Name,
                    'Location' => $request->Location,
                    'HotelWebsite' => $request->HotelWebsite,
                    'SelfSupplier' => $request->SelfSupplier,
                    'ContactType' => $request->ContactType,
                    'ContactName' => $request->ContactName,
                    'ContactDesignation' => $request->ContactDesignation,
                    'ContactCountryCode' => $request->ContactCountryCode,
                    'ContactMobile' => $request->ContactMobile,
                    'ContactEmail' => $request->ContactEmail,
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
                $edit = HotelChainMaster::find($id);
    
                $businessvalidation =array(
                    'Name' => 'required',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation);
                
                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->Name = $request->input('Name');
                        $edit->Location = $request->input('Location');
                        $edit->HotelWebsite = $request->input('HotelWebsite');
                        $edit->SelfSupplier = $request->input('SelfSupplier');
                        $edit->ContactType = $request->input('ContactType');
                        $edit->ContactName = $request->input('ContactName');
                        $edit->ContactDesignation = $request->input('ContactDesignation');
                        $edit->ContactCountryCode = $request->input('ContactCountryCode');
                        $edit->ContactMobile = $request->input('ContactMobile');
                        $edit->ContactEmail = $request->input('ContactEmail');
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
        $brands = HotelChainMaster::find($request->id);
        $brands->delete();
  
        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }
    
    }
}
