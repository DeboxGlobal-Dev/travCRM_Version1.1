<?php

namespace App\Http\Controllers\Others\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Others\Master\DestinationMaster;
class DestinationMasterController extends Controller
{   
   public function index(Request $request){
       
         
      $arrayDataRows = array();

      call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());
      
      $Search = $request->input('Search');
      $Status = $request->input('Status');
      
      $posts = DestinationMaster::when($Search, function ($query) use ($Search) {
          return $query->where('CountryId', 'like', '%' . $Search . '%')
                     ->orwhere('State', 'like', '%' . $Search . '%')
                     ->orwhere('DestinationName', 'like', '%' . $Search . '%')
                     ->orwhere('Description', 'like', '%' . $Search . '%')
                     ->orwhere('SetDefault', 'like', '%' . $Search . '%')
                     ->orwhere('State', 'like', '%' . $Search . '%');
      })->when($Status, function ($query) use ($Status) {
           return $query->where('Status',$Status);
      })->select('*')->get('*');

      //$countryName = getName(_COUNTRY_MASTER_,3);
      //$countryName22 = getColumnValue(_COUNTRY_MASTER_,'ShortName','AU','Name');
      //call_logger('REQUEST2: '.$countryName22);

      if ($posts->isNotEmpty()) {
          $arrayDataRows = [];
          foreach ($posts as $post){
              $arrayDataRows[] = [
                  "Id" => $post->id,
                  "Name" => $post->Name,
                  "StateName" => getName(_STATE_MASTER_,$post->StateId),
                  "CountryName" => getName(_COUNTRY_MASTER_,$post->CountryId),
                  "CountryId" => $post->CountryId,
                  "StateId" => $post->StateId,
                  "Description" => $post->Description,
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
      call_logger('REQUEST COMES FROM ADD/UPDATE STATE: '.$request->getContent());
      
      try{
          $id = $request->input('id');
          if($id == '') {
               
              $businessvalidation =array(
                  'CountryId' => 'required',
                  'StateId' => 'required',
                  'Name' => 'required',
                  'Description' => 'required',
                  'SetDefault' => 'required',
                  'AddedBy' => 'required',
                  'Status' => 'required',

              );
               
              $validatordata = validator::make($request->all(), $businessvalidation); 
              
              if($validatordata->fails()){
                  return $validatordata->errors();
              }else{
               $savedata = DestinationMaster::create([
                  'CountryId' => $request->CountryId,
                  'StateId' => $request->StateId,   
                  'Name' => $request->Name,   
                  'Description' => $request->Description,   
                  'SetDefault' => $request->SetDefault,   
                  'AddedBy' => $request->AddedBy,   
                  'Status' => $request->Status,
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
              $edit = DestinationMaster::find($id);
  
              $businessvalidation =array(
                  'CountryId' => 'required',
                  'StateId' => 'required',
                  'Name' => 'required',
                  'Description' => 'required',
                  'UpdatedBy' => 'required',
                  'Status' => 'required',
              );
               
              $validatordata = validator::make($request->all(), $businessvalidation);
              
              if($validatordata->fails()){
               return $validatordata->errors();
              }else{
                  if ($edit) {
                      $edit->CountryId = $request->input('CountryId');
                      $edit->StateId = $request->input('StateId');
                      $edit->Name = $request->input('Name');
                      $edit->Description = $request->input('Description');
                      $edit->SetDefault = $request->input('SetDefault');
                      $edit->UpdatedBy = $request->input('UpdatedBy');
                      $edit->Status = $request->input('Status');
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

}
