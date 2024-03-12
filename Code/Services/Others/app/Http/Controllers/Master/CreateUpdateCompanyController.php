<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CreateUpdateCompany;

class CreateUpdateCompanyController extends Controller
{
    public function store(Request $request)
    {
            $id = $request->input('id');
            if ($id == '') {
                $businessvalidation =array(
                    'COMPANYNAME' => 'required|:'._DB_.'.'._CREATE_UPDATE_COMPANY_.',COMPANYNAME',
                    'LICENSEKEY' => 'required',
                    'ISACTIVE' => 'required',
                    'ACTIONDATE' => 'required',
                    'ADDRESS1' => 'required',
                 );
                 $validatordata = validator::make($request->all(), $businessvalidation);
            if($validatordata->fails()){
             return $validatordata->errors();

    
            }else{ $savedata = CreateUpdateCompany::create([
                'COMPANYNAME' => $request->COMPANYNAME,
                'LICENSEKEY' => $request->LICENSEKEY,
                'ISACTIVE' => $request->ISACTIVE,
                'ACTIONDATE' => $request->ACTIONDATE,
                'LUT' => $request->LUT,
                'ZIP' => $request->ZIP,
                'PAN' => $request->PAN,
                'TAN' => $request->TAN,
                'CIN' => $request->CIN,
                'LUT' => $request->LUT,
                'ZIP' => $request->ZIP,
                'ADDRESS1' => $request->ADDRESS1,
                'ADDRESS2' => $request->ADDRESS2,
                'AddedBy' => $request->AddedBy,
                'created_at' => now(),
            ]);
            


            if ($savedata) {
                return response()->json([
                'STATUSID' => "0", 
                'STATUSMESSAGE' => 'Data added successfully!',
                'COMPANYID' => $savedata->id
            ]);
            } else {
                return response()->json([
                'STATUSID' => "-1",
                'STATUSMESSAGE' => 'Failed to add data.',
                'COMPANYID' => "$savedata->id"
             ]);
            }
          }
         } 
    }

    public function update(Request $request){
        $companyName = $request->input('COMPANYNAME');

        $businessvalidation = array(
            'COMPANYNAME' => 'required',
            'LICENSEKEY' => 'required',
            'ISACTIVE' => 'required',
            'ACTIONDATE' => 'required',
            'ADDRESS1' => 'required',
        );

        $validatordata = validator::make($request->all(), $businessvalidation);

        if ($validatordata->fails()) {
            return $validatordata->errors();
        } else {
            if (true) {
                CreateUpdateCompany::where('COMPANYNAME', $companyName)->update([
                    'COMPANYNAME'=>$request->input('COMPANYNAME'),
                    'LICENSEKEY'=>$request->input('LICENSEKEY'),
                    'ISACTIVE'=>$request->input('ISACTIVE'),
                    'ACTIONDATE'=>$request->input('ACTIONDATE'),
                    'LUT'=>$request->input('LUT'),
                    'ZIP'=>$request->input('ZIP'),
                    'PAN'=>$request->input('PAN'),
                    'TAN'=>$request->input('TAN'),
                    'CIN'=>$request->input('CIN'),
                    'ADDRESS1'=>$request->input('ADDRESS1'),
                    'ADDRESS2'=>$request->input('ADDRESS2'),
                    'UpdatedBy'=>$request->input('UpdatedBy'),
                    'updated_at'=>now(),
                ]);

                return response()->json([
                    'STATUSID' => "0", 
                    'STATUSMESSAGE' => 'Data Updated successfully!',
                    'COMPANYID' => $savedata->id
                ]);
            } else {
                return response()->json([
                    'STATUSID' => "-1", 
                    'STATUSMESSAGE' => 'Failed To Update Data!',
                    'COMPANYID' => $savedata->id
                ]);
            }
        }
    }
               
}
