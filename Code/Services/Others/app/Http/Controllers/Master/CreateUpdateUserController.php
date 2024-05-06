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

    public function index(Request $request)
        {

        $id = $request->input('Id');
        $companyId = $request->input('CompanyId');

        $posts = CreateUpdateUser::when($companyId, function ($query) use ($companyId) {
            return $query->where('CompanyKey', $companyId);
        })->when($id, function ($query) use ($id) {
            return $query->where('id',  $id );
        })->select('*')->orderBy('CompanyKey')->get('*');


        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post) {

                $arrayDataRows[] = [
                    "id" => $post->id,
                    "CompanyKey" => $post->CompanyKey,
                    "UserCode" => $post->UserCode,
                    "FirstName" => $post->FirstName,
                    "LastName" => $post->LastName,
                    "Email" => $post->Email,
                    "Phone" => $post->Phone,
                    "Mobile" => $post->Mobile,
                    "Password" => $post->Password,
                    "PIN" => $post->PIN,
                    "Role" => $post->Role,
                    "Street" => $post->Street,
                    "LanguageKnown" => $post->LanguageKnown,
                    "TimeFormat" => $post->TimeFormat,
                    "Profile" => $post->Profile,
                    "Destination" => $post->Destination,
                    "UsersDepartment" => $post->UsersDepartment,
                    "ReportingManager" => $post->ReportingManager,
                    "UserType" => $post->UserType,
                    "UserLoginType" => $post->UserLoginType,
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                    "Created_at" => $post->created_at,
                    "Updated_at" => $post->updated_at,
                    "Status" => $post->Status,
                ];
            }

            return response()->json([
                "Status" => 200,
                'TotalRecord' => $posts->count('id'),
                "DataList" => $arrayDataRows
            ]);
        } else {
            return response()->json([
                "Status" => 0,
                "TotalRecord" => $posts->count('id'),
                "DataList" => "No Record Found."
            ]);
        }
    }
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
               if($request->FirstName ==""){
                $Status *= 0;
                $ErrorMessage .= "|FirstName is Missing";
               }
               if(strlen($request->FirstName) > 50){
                $Status *= 0;
                $ErrorMessage .= "|FirstName should not contain more than 50 words"; 
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
                    'FirstName' => $request->FirstName,
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
                        

                if ($savedata) {
                    // return response()->json([
                    //     'STATUSID' => "0",
                    //     'STATUSMESSAGE' => 'Data Added successfully',
                    //     'USERKEY' => $savedata->id
                    // ]);
                    $response = Http::post('https://travcrm.in/Stratos/api/createUpdateUser.php', [
                    'COMPANYKEY' => $savedata->CompanyKey,
                    "USERID" => $savedata->id,
                    "USERKEY" => "",
                    "USEREMAIL" => $savedata->Email,
                    "ACTION" => "0"
                ]);
                 $data = $response->json(); 

                 if($data['STATUSID'] == 0){

                    $UserKey = $data['USERKEY'];
                    $UserId = $savedata->id;

                    $updateKey = CreateUpdateUser::where('id', $UserId)->update([
                            'UserKey'=>$UserKey,
                        ]);

                    if($updateKey){
                        return response()->json([
                        'Status' => "0",
                        'Message' => "User Created successfully"
                    ]);
                    } else {
                         return response()->json([
                        'Status' => "-1",
                        'Message' => "User Creation Failed"
                    ]);
                        
                    }

                 }else{
                    return response()->json([
                        'Status' => "-1",
                        'Message' => "User Creation Failed"
                    ]); 
                 }
 


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
                            'FirstName'=>$request->input('FirstName'),
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
