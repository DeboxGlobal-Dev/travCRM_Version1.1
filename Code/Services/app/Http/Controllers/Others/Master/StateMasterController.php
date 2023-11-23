<?php

Namespace App\Http\Controllers\Others\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Others\Master\StateMaster;
use Illuminate\Support\Facades\Validator;

class clsDataTable
{

  public $Id;
  public $Name;
  public $CountryId;
  public $CountryName; 
  public $Status;
  public $AddedBy;
  public $DateAdded;
}

class clsDBResponse 
{
    public $Status;
    public $TotalRecord;
    public $DataList=array();
}  

class StateMasterController extends Controller
{
   
    public function index(Request $request){
       
         
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());
        
        $Search = $request->input('Search');
        $Status = $request->input('Status');
        
        $posts = StateMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->get('*');

        // $dataArray = json_decode($posts, true);
        // $names = collect($dataArray)->pluck('Name');

        $countryName = getName(_COUNTRY_MASTER_,3);
        //$countryName22 = getColumnValue(_COUNTRY_MASTER_,'ShortName','AU','id');
        call_logger('REQUEST2: '.$posts);

        if ($posts->isNotEmpty()) {
            foreach ($posts as $post){

                $objDataTable = new clsDataTable(); 
                $objDataTable->Id = $post->id;
                $objDataTable->Name = $post->Name;
                $objDataTable->CountryId = $post->CountryId;
                $objDataTable->CountryName = getColumnValue(_COUNTRY_MASTER_,'id',$post->CountryId,'Name');;
                $objDataTable->Status = $post->Status;
                $objDataTable->AddedBy = $post->AddedBy;
                $objDataTable->DateAdded = $post->created_at;
      
                $a = array_push($arrayDataRows,$objDataTable);
            
        }
        }
    $objResponse = new clsDBResponse();
    $objResponse->Status = "0";
    $objResponse->TotalRecord = $posts->count('id');
    $objResponse->DataList = $arrayDataRows;
    
    return json_encode($objResponse,JSON_PRETTY_PRINT);
 
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
        $brands = StateMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }
    
    }
}