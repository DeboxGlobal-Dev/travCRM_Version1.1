<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CreateUpdateCompany;

class CreateUpdateCompanyController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('ID');
        $Search = $request->input('Search');

        $posts = CreateUpdateCompany::when($Search, function ($query) use ($Search) {
            return $query->where('COMPANYNAME', 'ilike', '%' . $Search . '%');
        })->when($id, function ($query) use ($id) {
            return $query->where('id',  $id );
        })->select('*')->orderBy('COMPANYNAME')->get('*');


        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post) {

                $arrayDataRows[] = [
                    "ID" => $post->id,
                    "COMPANYNAME" => $post->COMPANYNAME,
                    "REGISTEREDEMAIL" => $post->REGISTEREDEMAIL,
                    "LICENSEKEY" => $post->LICENSEKEY,
                    "ISACTIVE" => $post->ISACTIVE,
                    "ACTIONDATE" => $post->ACTIONDATE,
                    "LUT" => $post->LUT,
                    "ZIP" => $post->ZIP,
                    "PAN" => $post->PAN,
                    "TAN" => $post->TAN,
                    "CIN" => $post->CIN,
                    "ADDRESS1" => $post->ADDRESS1,
                    "ADDRESS2" => $post->ADDRESS2,
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                    "Created_at" => $post->created_at,
                    "Updated_at" => $post->updated_at
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
            $id = $request->input('id');
            $Status = 1;
            $ErrorMessage = "";

             if($request->COMPANYNAME == ""){
                   $Status *= 0;
                   $ErrorMessage .= "|Company Name is missing";

                }
                if(strlen($request->COMPANYNAME) > 250){
                   $Status *= 0;
                   $ErrorMessage .= "|Company Name should not contain more than 250 words"; 
                }

                if($request->REGISTEREDEMAIL == ""){
                    $Status *= 0;
                    $ErrorMessage .= "|Registered Email is missing";
 
                 }
                 if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $request->REGISTEREDEMAIL)){
                    $Status *= 0;
                    $ErrorMessage .= "|Email Format is not correct";
                   }
                 if(strlen($request->REGISTEREDEMAIL) > 100){
                    $Status *= 0;
                    $ErrorMessage .= "|Registered Email should not contain more than 100 words"; 

                 }
                if($request->LICENSEKEY == ""){
                   $Status *= 0;
                   $ErrorMessage .= "|License Key is missing";

                }
                if(strlen($request->LICENSEKEY) > 1000){
                   $Status *= 0;
                   $ErrorMessage .= "|License Key should not contain more than 1000 words"; 
                }
                if($request->ADDRESS1 == ""){
                   $Status *= 0;
                   $ErrorMessage .= "|Address 1 is missing";

                }
                if(strlen($request->ADDRESS1) > 500){
                   $Status *= 0;
                   $ErrorMessage .= "|Address 1 should not contain more than 500 words"; 
                }
                if($request->ACTIONDATE == ""){
                   $Status *= 0;
                   $ErrorMessage .= "|Action Date is missing";
                }
                if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$request->ACTIONDATE)){
                   $Status *= 0;
                   $ErrorMessage .= "|Action Date Incorrect Format";
                }
                if($request->ISACTIVE == ""){
                   $Status *= 0;
                   $ErrorMessage .= "|Incorrect Active/Inactive Flag";
                }
                if($id != ""){
                 if (CreateUpdateCompany::where('COMPANYNAME', $request->COMPANYNAME)->where('id', '!=', $id)->exists()) {
                   $Status *= 0;
                   $ErrorMessage .= "|Company already exists";
                 } 
                }else{
                  if (CreateUpdateCompany::where('COMPANYNAME', $request->COMPANYNAME)->exists()) {
                   $Status *= 0;
                   $ErrorMessage .= "|Company already exists";
                 }   
                }

            if ($id == '') {

                if($Status == 1){

                $savedata = CreateUpdateCompany::create([
                'COMPANYNAME' => $request->COMPANYNAME,
                'REGISTEREDEMAIL' => $request->REGISTEREDEMAIL,
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
                'COMPANYID' => "$savedata->id"
            ]);
            }
            else {
                return response()->json([
                'STATUSID' => "-1",
                'STATUSMESSAGE' => 'Failed to add data.',
                'COMPANYID' => ""
             ]);
          }
        }else{

            return response()->json([
                'STATUSID' => "-1",
                'STATUSMESSAGE' => "$ErrorMessage",
                'COMPANYID' => ""
             ]);

        } 
         } 
   if($id != '') {

                if($Status == 1){

                $updatedata = CreateUpdateCompany::where('id', $id)->update([
                    'COMPANYNAME'=>$request->input('COMPANYNAME'),
                    'REGISTEREDEMAIL' => $request->input('REGISTEREDEMAIL'),
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

                if($updatedata){

                return response()->json([
                    'STATUSID' => "0", 
                    'STATUSMESSAGE' => 'Data Updated successfully!',
                    'COMPANYID' => "$id"
                ]);
            } else {
                return response()->json([
                    'STATUSID' => "-1", 
                    'STATUSMESSAGE' => 'Failed To Update Data!',
                    'COMPANYID' => ""
                ]);
            }
        }else{

            return response()->json([
                'STATUSID' => "-1",
                'STATUSMESSAGE' => "$ErrorMessage",
                'COMPANYID' => ""
             ]);

        } 
    }
}
}
