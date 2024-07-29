<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\NationalityMaster;

class NationalityMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = NationalityMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "id" => $post->id,
                    "Name" => $post->Name,
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
    try {
        $id = $request->input('id');

        if (empty($id)) {
            $businessvalidation = [
                'Name' => 'required|unique:' . _DB_ . '.' . _NATIONALITY_MASTER_ . ',Name',
            ];

            $validatordata = Validator::make($request->all(), $businessvalidation);

            if ($validatordata->fails()) {
                return response()->json(['Status' => 0, 'Errors' => $validatordata->errors()], 400);
            } else {
                $savedata = NationalityMaster::create([
                    'Name' => $request->input('Name'),
                    'Status' => $request->input('Status'),
                    'AddedBy' => $request->input('AddedBy'),
                    'UpdatedBy' => $request->input('UpdatedBy'),
                    'created_at' => now(),
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 1, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 0, 'Message' => 'Failed to add data.'], 500);
                }
            }
        } else {
            $edit = NationalityMaster::find($id);

            $businessvalidation = [
                'Name' => 'required',
            ];

            $validatordata = Validator::make($request->all(), $businessvalidation);

            if ($validatordata->fails()) {
                return response()->json(['Status' => 0, 'Errors' => $validatordata->errors()], 400);
            } else {
                if ($edit) {
                    $edit->Name = $request->input('Name');
                    $edit->Status = $request->input('Status');
                    $edit->AddedBy = $request->input('AddedBy');
                    $edit->UpdatedBy = $request->input('UpdatedBy');
                    $edit->updated_at = now();
                    $edit->save();

                    return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                } else {
                    return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
                }
            }
        }
    } catch (\Exception $e) {
        call_logger("Exception Error  ===>  " . $e->getMessage());
        return response()->json(['Status' => -1, 'Message' => 'Exception Error Found'], 500);
    }
}

public function destroy(Request $request)
{
    $brands = NationalityMaster::find($request->id);
    $brands->delete();

    if ($brands) {
        return response()->json(['result' =>'Data deleted successfully!']);
    } else {
        return response()->json(['result' =>'Failed to delete data.'], 500);
    }

}
}
