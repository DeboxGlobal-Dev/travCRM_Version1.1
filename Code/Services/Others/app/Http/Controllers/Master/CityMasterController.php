<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\CityMaster;
class CityMasterController extends Controller
{

public function index(Request $request) {
   
    $id = $request->input('Id');
    $search = $request->input('Search');
    $status = $request->input('Status');

    
    $postsQuery = CityMaster::when($search, function ($query) use ($search) {
        return $query->where('Name', 'like', '%' . $search . '%');
    })->when(isset($status), function ($query) use ($status) {
        return $query->where('Status', $status);
    })->when($id, function ($query) use ($id) {
        return $query->where('id', $id);
    });

    
    $posts = $postsQuery->select('*')->orderBy('Name')->get();
    $totalRecord = $posts->count();
    $arrayDataRows = [];
    $includeStateAndCountryNames = $request->has('Search') || $request->has('Status');

    foreach ($posts as $post) {
        $dataRow = [
            "id" => $post->id,
            "Name" => $post->Name,
            "CountryId" => $post->CountryId,
            "StateId" => $post->StateId,
            "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
            "AddedBy" => $post->AddedBy,
            "UpdatedBy" => $post->UpdatedBy,
            "Created_at" => $post->created_at,
            "Updated_at" => $post->updated_at
        ];

        if ($includeStateAndCountryNames) {
            $dataRow["StateName"] = getName(_STATE_MASTER_, $post->StateId) ?? null;
            $dataRow["CountryName"] = getName(_COUNTRY_MASTER_, $post->CountryId) ?? null;
        }

        $arrayDataRows[] = $dataRow;
    }
    if ($id && !$search && !isset($status)) {
        return response()->json([
            'Status' => 0,
            'message' => '',
            'TotalRecord' => $totalRecord,
            'DataList' => $arrayDataRows
        ]);
    }
    if ($posts->isNotEmpty()) {
        return response()->json([
            'Status' => 0,
            'message' => '',
            'TotalRecord' => $totalRecord,
            'DataList' => $arrayDataRows
        ]);
    } else {
        return response()->json([
            "Status" => 0,
            "TotalRecord" => 0,
            "Message" => "No Record Found."
        ]);
    }
}



    public function store(Request $request)
    {

          $val = $request->input('id');
          if ($val === null) {
             $businessvalidation =array(
                'Name' => 'required|unique:'._DB_.'.'._CITY_MASTER_.',Name',
                'CountryId' => 'required',
                'StateId' => 'required',
                'AddedBy' => 'required',
                'UpdatedBy' => 'required',
                'Status' => 'required',
             );

             $validatordata = validator::make($request->all(), $businessvalidation);
            if($validatordata->fails()){
             return $validatordata->errors();

            }else{
             $brand = CityMaster::create([
                'Name' => $request->Name,
                'CountryId' => $request->CountryId,
                'StateId' => $request->StateId,
                'AddedBy' => $request->AddedBy,
                'UpdatedBy' => $request->UpdatedBy,
                'Status' => $request->Status,
                'created_at' => now(),
             ]);
             if ($brand) {
                return response()->json(['Status' => 1, 'Message' =>'Data added successfully!']);
            } else {
                return response()->json(['Status' => 0, 'Message' =>'Failed to add data.'], 500);
            }
          }

          }else{
                $id = $request->input('id');

                $edit = CityMaster::find($id);

                $businessvalidation =array(
                    'Name' => 'required',
                    'CountryId' => 'required'
                );
                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                   }
                   else{
                    if ($edit) {
                        $edit->Name = $request->input('Name');
                        $edit->CountryId = $request->input('CountryId');
                        $edit->StateId = $request->input('StateId');
                        $edit->AddedBy = $request->input('AddedBy');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->Status = $request->input('Status');
                        $edit->updated_at = now();
                        $edit->save();
    
                        return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                   }
          }



    }



          public function destroy($id)
          {
             $brands = CityMaster::find($id);
             $brands->delete();

             if ($brands) {
                return response()->json(['result' =>'Data deleted successfully!']);
          } else {
                return response()->json(['result' =>'Failed to delete data.'], 500);
          }

          }
}
