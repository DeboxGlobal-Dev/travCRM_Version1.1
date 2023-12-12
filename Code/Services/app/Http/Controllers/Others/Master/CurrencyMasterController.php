<?php

namespace App\Http\Controllers\Others\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Others\Master\CurrencyMaster;

class CurrencyMasterController extends Controller
{  
   public function index(Request $request){
    
       
         
      $arrayDataRows = array();

      call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());
      
      $Search = $request->input('Search');
      $Status = $request->input('Status');
      
      $posts = CurrencyMaster::when($Search, function ($query) use ($Search) {
          return $query->where('CountryCode', 'like', '%' . $Search . '%');
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
                  "CountryId" => $post->CountryId,
                  "CountryCode" => $post->CountryCode,
                  "Currencyname" => $post->CurrencyName,
                  "Status" => $post->Status,
                  "SetDefaut" => $post->SetDefaut,
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
                  'CountryId' => 'required|unique:'._DB_.'.'._CURRENCY_MASTER_.',CountryId',
              );
               
              $validatordata = validator::make($request->all(), $businessvalidation); 
              
              if($validatordata->fails()){
                  return $validatordata->errors();
              }else{
               $savedata = CurrencyMaster::create([
                'CountryId' => $request->CountryId,
                  'CountryCode' => $request->CountryCode,
                  'CurrencyName' => $request->CurrencyName,
                  'Status' => $request->Status,
                  'SetDefaut' => $request->SetDefaut,
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
              $edit = CurrencyMaster::find($id);
  
              $businessvalidation =array(
                  'CountryCode' => 'required',
              );
               
              $validatordata = validator::make($request->all(), $businessvalidation);
              
              if($validatordata->fails()){
               return $validatordata->errors();
              }else{
                  if ($edit) {
                      $edit->CountryId = $request->input('CountryId');
                      $edit->CountryCode = $request->input('CountryCode');
                      $edit->CurrencyName = $request->input('CurrencyName');
                      $edit->Status = $request->input('Status');
                      $edit->SetDefaut = $request->input('SetDefaut');
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

}
