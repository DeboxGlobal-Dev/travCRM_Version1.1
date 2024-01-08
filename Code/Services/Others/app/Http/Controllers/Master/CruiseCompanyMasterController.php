<?php

namespace App\Http\Controllers\Transport\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transport\Master\CruiseCompanyMaster;

class CruiseCompanyMasterController extends Controller
{
    public function index(Request $request){
       
         
        $arrayDataRows = array();
   
        $Search = $request->input('Search');
        $Status = $request->input('Status');
        
        $posts = CruiseCompanyMaster::when($Search, function ($query) use ($Search) {
            return $query->where('CruiseCompanyName', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('CruiseCompanyName')->get('*');
  
        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "CruiseCompanyName" => $post->CruiseCompanyName,
                    "Destination" => $post->Destination,
                    "Country" => $post->Country,
                    "State" => $post->State,
                    "City" => $post->City,
                    "PinCode" => $post->PinCode,
                    "Address" => $post->Address,
                    "Website" => $post->Website,
                    "GST" => $post->GST,
                    "SelfSupplier" => $post->SelfSupplier,
                    "Type" => $post->Type,
                    "Phone" => $post->Phone,
                    "Email" => $post->Email,
                    "Status" => $post->Status,
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
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
                    'CruiseCompanyName' => 'required|unique:'._DB_.'.'._CRUISE_COMPANY_MASTER_.',CruiseCompanyName',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation); 
                
                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = CruiseCompanyMaster::create([
                    
                    'CruiseCompanyName' => $request->CruiseCompanyName,
                    'Destination' => $request->Destination,
                    'Country' => $request->Country,
                    'State' => $request->State,
                    'City' => $request->City,
                    'PinCode' => $request->PinCode,
                    'Address' => $request->Address,
                    'Website' => $request->Website,
                    'GST' => $request->GST,
                    'SelfSupplier' => $request->SelfSupplier,
                    'Type' => $request->Type,
                    'Phone' => $request->Phone,
                    'Email' => $request->Email,
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
                $edit = CruiseCompanyMaster::find($id);
    
                $businessvalidation =array(
                    'CruiseCompanyName' => 'required',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation);
                
                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        
                        $edit->CruiseCompanyName = $request->input('CruiseCompanyName');
                        $edit->Destination = $request->input('Destination');
                        $edit->Country = $request->input('Country');
                        $edit->State = $request->input('State');
                        $edit->City = $request->input('City');
                        $edit->PinCode = $request->input('PinCode');
                        $edit->Address = $request->input('Address');
                        $edit->Website = $request->input('Website');
                        $edit->GST = $request->input('GST');
                        $edit->Type = $request->input('Type');
                        $edit->Phone = $request->input('Phone');
                        $edit->Email = $request->input('Email');
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
        $brands = CruiseCompanyMaster::find($request->id);
        $brands->delete();
  
        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }
    
    }

}
