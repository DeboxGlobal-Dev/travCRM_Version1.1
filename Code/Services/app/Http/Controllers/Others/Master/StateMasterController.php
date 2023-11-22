<?php

Namespace App\Http\Controllers\Others\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Others\Master\StateMaster;
use Illuminate\Support\Facades\Validator;

class StateMasterController extends Controller
{

    public function index(Request $request){
        call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());
        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = StateMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%')
                   ->orwhere('CountryId', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status', 'like', '%' . $Status . '%');
        })->select('*')->get('*');

        $countryName = getValue(_COUNTRY_MASTER_,3,"Name");
        
        call_logger('REQUEST2: '.$countryName);

        if ($posts->isNotEmpty()) {
            return response()->json([
                'Status' => 200,
                'TotalRecord' => $posts->count('id'),
                'DataList' => $posts
            ]);
        } else {
            return response()->json([
                "Status" => 0,
                "TotalRecord" => $posts->count('id'), 
                "Message" => "No Record Found."
            ]);
        }
        /*$dataList = StateMaster::orderBy('Name','ASC')->get();
        $totalRecord = count($statelist);
        if($totalRecord>0){
            return response()->json([
                "Status" => 0, 
                "TotalRecord" => $totalRecord, 
                "DataList" => $dataList
            ]);
        }else{
            return response()->json([
                "Status" => 0,
                "TotalRecord" => $totalRecord, 
                "Message" => "No Record Found."
            ]);
        }*/
    }

    public function store(Request $request)
    {
        call_logger('REQUEST COMES FROM ADD/UPDATE STATE: '.$request->getContent());
        
        try{
            $id = $request->input('id');
            if($id == '') {
                 
                $businessvalidation =array(
                    'Name' => 'required|unique:'._PGSQL_.'.'._STATE_MASTER_.',Name',
                    'CountryId' => 'required'
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation); 
                
                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = StateMaster::create([
                    'Name' => $request->Name,
                    'CountryId' => $request->CountryId,
                    'Status' => $request->Status,
                    'AddedBy' => $request->AddedBy, 
                    'DateAdded' => now(),
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
              }
     
            }else{
    
                $id = $request->input('id');
                $edit = StateMaster::find($id);
    
                $businessvalidation =array(
                    'Name' => 'required',
                    'CountryId' => 'required'
                );
                 
                $validatordata = validator::make($request->all(), $businessvalidation);
                
                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->Name = $request->input('Name');
                        $edit->CountryId = $request->input('CountryId');
                        $edit->Status = $request->input('Status');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->DateUpdated = now();
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
        $brands = StateMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }
    
    }
}