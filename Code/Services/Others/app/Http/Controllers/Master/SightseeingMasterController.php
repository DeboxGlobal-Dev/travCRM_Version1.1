<?php

namespace App\Http\Controllers\Sightseeing\Master;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sightseeing\Master\SightseeingMaster;
class SightseeingMasterController extends Controller
{
    public function index(Request $request){
       
         
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM LEAD SOURCE: '.$request->getContent());
        
        $Search = $request->input('Search');
        $Status = $request->input('Status');
        
        $posts = SightseeingMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%')
                         ->orwhere('DestinationId', 'like', '%' . $Search . '%')
                         ->orwhere('TransferType', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');
 
         
        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "Name" => $post->Name,
                    "DestinationId" => $post->DestinationId,
                    "TransferType" => $post->TransferType,
                    "DefaultQuotation" => $post->DefaultQuotation,
                    "DefaultProposal" => $post->DefaultProposal,
                    "CurrencyId" => $post->CurrencyId,
                    "AdultCost" => $post->AdultCost,
                    "ChildCost" => $post->ChildCost,
                    "Details" => $post->Details,
                    "InclusionsExclusionsTiming" => $post->InclusionsExclusionsTiming,
                    "ImportantNote" => $post->ImportantNote,
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
        call_logger('REQUEST COMES FROM ADD/UPDATE LEAD: '.$request->getContent());
        
        try{
            $id = $request->input('id');
            if($id == '') {
                 
                $businessvalidation =array(
                    'Name' => 'required|unique:'._DB_.'.'._SIGHTSEEING_MASTER_.',Name',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation); 
                
                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = SightseeingMaster::create([
                    'Name' => $request->Name,
                    'DestinationId' => $request->DestinationId,
                    'TransferType' => $request->TransferType,
                    'DefaultQuotation' => $request->DefaultQuotation,
                    'DefaultProposal' => $request->DefaultProposal,
                    'CurrencyId' => $request->CurrencyId,
                    'AdultCost' => $request->AdultCost,
                    'ChildCost' => $request->ChildCost,
                    'Details' => $request->Details,
                    'InclusionsExclusionsTiming' => $request->InclusionsExclusionsTiming,
                    'ImportantNote' => $request->ImportantNote,
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
                $edit = SightseeingMaster::find($id);
    
                $businessvalidation =array(
                    'Name' => 'required',
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation);
                
                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->Name = $request->input('Name');
                        $edit->DestinationId = $request->input('DestinationId');
                        $edit->TransferType = $request->input('TransferType');
                        $edit->DefaultQuotation = $request->input('DefaultQuotation');
                        $edit->DefaultProposal = $request->input('DefaultProposal');
                        $edit->CurrencyId = $request->input('CurrencyId');
                        $edit->AdultCost = $request->input('AdultCost');
                        $edit->ChildCost = $request->input('ChildCost');
                        $edit->Details = $request->input('Details');
                        $edit->InclusionsExclusionsTiming = $request->input('InclusionsExclusionsTiming');
                        $edit->ImportantNote = $request->input('ImportantNote');
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
 
  
     
    // public function destroy(Request $request)
    // {
    //     $brands = SightseeingMaster::find($request->id);
    //     $brands->delete();

    //     if ($brands) {
    //         return response()->json(['result' =>'Data deleted successfully!']);
    //     } else {
    //         return response()->json(['result' =>'Failed to delete data.'], 500);
    //     }
    
    // }
}
