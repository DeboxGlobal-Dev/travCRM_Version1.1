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
       try {
            $id = $request->input('id');
            if ($id == '') {

                    $savedata = CreateUpdateCompany::create([
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
                        'STATUSID' => 0, 
                        'STATUSMESSAGE' => 'Data added successfully!',
                        'COMPANYID' => $id
                    ]);
                    } else {
                        return response()->json(['Status' => 0, 'Message' => 'Failed to add data.'], 500);
                    }

            } 
        } catch (\Exception $e) {
            call_logger("Exception Error  ===>  " . $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }
}
