<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CreateUpdateUser;

class CreateUpdateUserController extends Controller
{
    public function store(Request $request)
    {
       // try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'CompanyKey' => 'required|unique:'._DB_.'.'._USERS_MASTER_.',CompanyKey',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return  response()->json([
                        'STATUSID' => "-1", 
                        'STATUSMESSAGE' => 'Validation Error!',
                        'COMPANYID' => ""
                    ]);
                }else{
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

            }else{

                $id = $request->input('id');
                $edit = CreateUpdateUser::find($id);

                $businessvalidation =array(
                    'CompanyKey' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return  response()->json([
                    'STATUSID' => "-1", 
                    'STATUSMESSAGE' => 'Validation Error!',
                    'COMPANYID' => ""
                ]);
                }else{
                    if ($edit) {

                        $edit->CompanyKey = $request->input('CompanyKey');
                        $edit->UserCode = $request->input('UserCode');
                        $edit->FristName = $request->input('FristName');
                        $edit->LastName = $request->input('LastName');
                        $edit->Email = $request->input('Email');
                        $edit->Phone = $request->input('Phone');
                        $edit->Mobile = $request->input('Mobile');
                        $edit->Password = $request->input('Password');
                        $edit->PIN = $request->input('PIN');
                        $edit->Role = $request->input('Role');
                        $edit->Street = $request->input('Street');
                        $edit->LanguageKnown = $request->input('LanguageKnown');
                        $edit->TimeFormat = $request->input('TimeFormat');
                        $edit->Profile = $request->input('Profile');
                        $edit->Destination = $request->input('Destination');
                        $edit->UsersDepartment = $request->input('UsersDepartment');
                        $edit->ReportingManager = $request->input('ReportingManager');
                        $edit->UserType = $request->input('UserType');
                        $edit->UserLoginType = $request->input('UserLoginType');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->updated_at = now();
                        $edit->save();

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
                }
            }
        // }catch (\Exception $e){
        //     call_logger("Exception Error  ===>  ". $e->getMessage());
        //     return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }

}
