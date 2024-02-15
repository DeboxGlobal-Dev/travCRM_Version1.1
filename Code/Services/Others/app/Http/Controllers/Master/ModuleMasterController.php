<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\ModuleMaster;
use Illuminate\Support\Facades\Validator;

class ModuleMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());

        $ModuleName = $request->input('ModuleName');
        $ModuleType = $request->input('ModuleType');
        $Status = $request->input('Status');

        $posts = ModuleMaster::when($ModuleName, function ($query) use ($ModuleName) {
            return $query->where('ModuleName', 'like', '%' . $ModuleName . '%');
        })->when($ModuleType, function ($query) use ($ModuleType) {
             return $query->where('ModuleType',$ModuleType);
        })->when($Status, function ($query) use ($Status) {
            return $query->where('Status',$Status);
       })->select('*')->orderBy('SerialNumber')->get('*');

        //$countryName = getName(_COUNTRY_MASTER_,3);
        //$countryName22 = getColumnValue(_COUNTRY_MASTER_,'ShortName','AU','Name');
        //call_logger('REQUEST2: '.$countryName22);

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                if($Status == 0){
                    $Status = 'Active';
                    
               }elseif ($Status == 1 ) {
                    $Status = 'InActive';
                    
               }
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "SerialNumber" => $post->SerialNumber,
                    "ModuleName" => $post->ModuleName,
                    "ModuleType" => $post->ModuleType,
                    "Url" => $post->Url,
                    "Icon" => $post->Icon,
                    "Status" => $Status,
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
                    'ModuleName' => 'required|unique:'._DB_.'.'._MODULE_MASTER_.',ModuleName',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = ModuleMaster::create([
                    'SerialNumber' => $request->SerialNumber,
                    'ModuleName' => $request->ModuleName,
                    'ModuleType' => $request->ModuleType,
                    'Url' => $request->Url,
                    'Icon' => $request->Icon,
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
                $edit = ModuleMaster::find($id);

                $businessvalidation =array(
                    'ModuleName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->SerialNumber = $request->input('SerialNumber');
                        $edit->ModuleName = $request->input('ModuleName');
                        $edit->ModuleType = $request->input('ModuleType');
                        $edit->Url = $request->input('Url');
                        $edit->Icon = $request->input('Icon');
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

}
