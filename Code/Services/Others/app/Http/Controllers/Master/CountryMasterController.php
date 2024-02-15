<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CountryMaster;

class CountryMasterController extends Controller
{
    public function index(Request $request)
    {
        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = CountryMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'ilike', '%' . $Search . '%')
                ->orwhere('ShortName', 'ilike', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
            return $query->where('Status', $Status);
        })->select('*')->orderBy('Name')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post) {

                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "Name" => $post->Name,
                    "ShortName" => $post->ShortName,
                    "SetDefault" => ($post->SetDefault == 1) ? 'Yes' : 'No',
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                    "Created_at" => $post->created_at,
                    "Updated_at" => $post->updated_at
                ];
            }

            return response()->json([
                'Status' => 0,
                'TotalRecord' => $posts->count('id'),
                'DataList' => $arrayDataRows
            ]);
        } else {
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
            if ($id == '') {

                $businessvalidation = array(
                    'Name' => 'required|unique:' . _DB_ . '.' . _COUNTRY_MASTER_ . ',Name',
                    'ShortName' => 'required'
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if ($validatordata->fails()) {
                    return $validatordata->errors();
                } else {
                    $savedata = CountryMaster::create([
                        'Name' => $request->Name,
                        'ShortName' => $request->ShortName,
                        'SetDefault' => $request->SetDefault,
                        'Status' => $request->Status,
                        'AddedBy' => $request->AddedBy,
                        'created_at' => now(),
                    ]);

                    if ($savedata) {
                        return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                    } else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to add data.'], 500);
                    }
                }
            } else {

                $id = $request->input('id');
                $edit = CountryMaster::find($id);

                $businessvalidation = array(
                    'Name' => 'required|unique:' . _DB_ . '.' . _COUNTRY_MASTER_ . ',Name',
                    'ShortName' => 'required'
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if ($validatordata->fails()) {
                    return $validatordata->errors();
                } else {
                    if ($edit) {
                        $edit->Name = $request->input('Name');
                        $edit->ShortName = $request->input('ShortName');
                        $edit->SetDefault = $request->input('SetDefault');
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
        } catch (\Exception $e) {
            call_logger("Exception Error  ===>  " . $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }
}
