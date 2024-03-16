<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CreateUpdateUser;

class CreateUpdateUserController extends Controller
{
    public function store(Request $request)
    {
       // try{
            $id = $request->input('id');
            $Status = 1;
            $ErrorMessage = "";

            if($request->CompanyKey == ""){
                $Status *=0;
                $ErrorMessage .= "|CompanyKey is missing";
            }
            if($id != ""){
                if (CreateUpdateUser::where('CompanyKey', $request->CompanyKey)->where('id', '!=', $id)->exists()) {
                  $Status *= 0;
                  $ErrorMessage .= "|User CompanyKey already exists";
                } 
               }else{
                 if (CreateUpdateUser::where('CompanyKey', $request->CompanyKey)->exists()) {
                  $Status *= 0;
                  $ErrorMessage .= "|User CompanyKey already exists";
                }   
               }
               if($request->FristName ==""){
                $Status *= 0;
                $ErrorMessage .= "|FirstName already exists";
               }
               if(strlen($request->FristName) > 200){
                $Status *= 0;
                $ErrorMessage .= "|FristName should not contain more than 200 words"; 
             }
             if($id != ""){
                if (CreateUpdateUser::where('Email', $request->Email == "")->where('id', '!=', $id)->exists()) {
                  $Status *= 0;
                  $ErrorMessage .= "|User Email already exists";
                } 
               }else{
                 if (CreateUpdateUser::where('Email', $request->Email)->exists()) {
                  $Status *= 0;
                  $ErrorMessage .= "|User Email already exists";
                }   
               }
               if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $request->Email)){
                $Status *= 0;
                $ErrorMessage .= "|Email Format is not correct";
               }if($request->Email == ""){
                $Status *= 0;
                $ErrorMessage .= "|Email is missing";
               }
               
             if($request->Password ==""){
                $Status *= 0;
                $ErrorMessage .= "|Password is missing"; 
             }
            
            if($id == '') {

                
                if($Status == 1){
                   $savedata = CreateUpdateUser::create([

                    'CompanyKey' => $request->CompanyKey,
                    'UserCode' => $request->UserCode,
                    'FristName' => $request->FristName,
                    'LastName' => $request->LastName,
                    'Email' => $request->Email,
                    'Phone' => $request->Phone,
                    'Mobile' => $request->Mobile,
                    'Password' => $request->Password,
                    'PIN' => $request->PIN,
                    'Role' => $request->Role,
                    'Street' => $request->Street,
                    'LanguageKnown' => $request->LanguageKnown,
                    'TimeFormat' => $request->TimeFormat,
                    'Profile' => $request->Profile,
                    'Destination' => $request->Destination,
                    'UsersDepartment' => $request->UsersDepartment,
                    'ReportingManager' => $request->ReportingManager,
                    'UserType' => $request->UserType,
                    'UserLoginType' => $request->UserLoginType,
                    'AddedBy' => $request->AddedBy,
                    'created_at' => now(),
                ]);

                $response = Http::post('http://127.0.0.1:8000/api/testApi', [
                    'COMPANYKEY' => $savedata->CompanyKey,
                    "USERID" => $savedata->id,
                    "USERKEY" => "",
                    "USEREMAIL" => $savedata->Email,
                    "ACTION" => "0"
                ]);
                $data = $response->json(); // Get response body as JSON
                $status = $response->status(); // Get the status code of the response

                
                // $requestData = [
                //     "COMPANYKEY" => $savedata->CompanyKey,
                //     "USERID" => $savedata->id,
                //     "USERKEY" => "",
                //     "USEREMAIL" => $savedata->Email,
                //     "ACTION" => "0"
                // ];
    
                
                //call_logger("Hii-----".$requestData);
                

                if ($savedata) {
                    return response()->json([
                        'STATUSID' => "0",
                        'STATUSMESSAGE' => 'Data Added successfully',
                        'USERKEY' => $savedata->id
                    ]);
                } else {
                    return response()->json([
                        'STATUSID' => "-1",
                        'STATUSMESSAGE' => 'Failed to Add data.',
                        'USERKEY' => ""
                        ]);
                }
              }

              else{

                return response()->json([
                    'STATUSID' => "-1",
                    'STATUSMESSAGE' => "$ErrorMessage",
                    'USERKEY' => ""
                 ]);
    
            } 

            }else{

                $id = $request->input('id');
                $edit = CreateUpdateUser::find($id);
                if($Status == 1) {

                        $CompanyKey = $request->input('CompanyKey');
                        $Email = $request->input('Email');

                        $updatedata = CreateUpdateUser::where('id', $id)->update([
                            'CompanyKey'=>$request->input('CompanyKey'),
                            'UserCode'=>$request->input('UserCode'),
                            'FristName'=>$request->input('FristName'),
                            'LastName'=>$request->input('LastName'),
                            'Email'=>$request->input('Email'),
                            'Phone'=>$request->input('Phone'),
                            'Mobile'=>$request->input('Mobile'),
                            'Password'=>$request->input('Password'),
                            'PIN'=>$request->input('PIN'),
                            'Role'=>$request->input('Role'),
                            'Street'=>$request->input('Street'),
                            'LanguageKnown'=>$request->input('LanguageKnown'),
                            'TimeFormat'=>$request->input('TimeFormat'),
                            'Profile'=>$request->input('Profile'),
                            'Destination'=>$request->input('Destination'),
                            'UsersDepartment'=>$request->input('UsersDepartment'),
                            'ReportingManager'=>$request->input('ReportingManager'),
                            'UserType'=>$request->input('UserType'),
                            'UserLoginType'=>$request->input('UserLoginType'),
                            'UpdatedBy'=>$request->input('UpdatedBy'),
                            'updated_at'=>now(),
                        ]);

                        // $requestData = [
                        //     "COMPANYKEY" => $CompanyKey,
                        //     "USERID" => $id,
                        //     "USERKEY" => "",
                        //     "USEREMAIL" => $Email,
                        //     "ACTION" => "2"
                        // ];
                        //  print_r($requestData);
                        //  exit;

                        // $response = Http::post('http://127.0.0.1:8000/api/testApi', $requestData);
        
                        
                        // call_logger("test-".$requestData); 

                       if($updatedata){
                        return response()->json([
                            'STATUSID' => "0",
                            'STATUSMESSAGE' => 'Data Updated successfully',
                            'USERKEY' => $id
                        ]);
                    } else {
                        return response()->json([
                            'STATUSID' => "-1",
                            'STATUSMESSAGE' => 'Failed to update data. Record not found.',
                            'USERKEY' => ""
                            ]);
                    }
                       }else{

                        return response()->json([
                            'STATUSID' => "-1",
                            'STATUSMESSAGE' => "$ErrorMessage",
                            'USERKEY' => ""
                         ]);
            
                    } 
            }
    }

}
