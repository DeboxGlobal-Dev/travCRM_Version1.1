<?php

namespace App\Http\Controllers\Master;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\MonumentMaster;

class MonumentMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM LEAD SOURCE: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = MonumentMaster::when($Search, function ($query) use ($Search) {
            return $query->where('MonumentName', 'like', '%' . $Search . '%')
                         ->orwhere('Destination', 'like', '%' . $Search . '%')
                         ->orwhere('DefaultQuotation', 'like', '%' . $Search . '%')
                         ->orwhere('WeekendDays', 'like', '%' . $Search . '%')
                         ->orwhere('TransferType', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('MonumentName')->get('*');


        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "id" => $post->id,
                    "MonumentName" => $post->MonumentName,
                    "Destination" => $post->Destination,
                    "TransferType" => $post->TransferType,
                    "ClosedOnDays" => $post->ClosedOnDays,
                    "DefaultQuotation" => $post->DefaultQuotation,
                    "DefaultProposal" => $post->DefaultProposal,
                    "WeekendDays" => $post->WeekendDays,
                    "Description" => $post->Description,
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
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
        call_logger('REQUEST COMES FROM ADD/UPDATE LEAD: '.$request->getContent());

        //try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'MonumentName' => 'required|unique:'._DB_.'.'._MONUMENT_MASTER_.',MonumentName',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = MonumentMaster::create([
                    'MonumentName' => $request->MonumentName,
                    'Destination' => $request->Destination,
                    'TransferType' => $request->TransferType,
                    'ClosedOnDays' => $request->ClosedOnDays,
                    'DefaultQuotation' => $request->DefaultQuotation,
                    'DefaultProposal' => $request->DefaultProposal,
                    'WeekendDays' => $request->WeekendDays,
                    'Status' => $request->Status,
                    'Description' => $request->Description,
                    'AddedBy' => $request->AddedBy,
                    'created_at' => now(),
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 1, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 0, 'Message' =>'Failed to add data.'], 500);
                }
              }

            }else{

                $id = $request->input('id');
                $edit = MonumentMaster::find($id);

                $businessvalidation =array(
                    'MonumentName' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->MonumentName = $request->input('MonumentName');
                        $edit->Destination = $request->input('Destination');
                        $edit->TransferType = $request->input('TransferType');
                        $edit->ClosedOnDays = $request->input('ClosedOnDays');
                        $edit->DefaultQuotation = $request->input('DefaultQuotation');
                        $edit->DefaultProposal = $request->input('DefaultProposal');
                        $edit->WeekendDays = $request->input('WeekendDays');
                        $edit->Description = $request->input('Description');
                        $edit->Status = $request->input('Status');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->updated_at = now();
                        $edit->save();

                        return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                }
            }
        // }catch (\Exception $e){
        //     call_logger("Exception Error  ===>  ". $e->getMessage());
        //     return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }



    // public function destroy(Request $request)
    // {
    //     $brands = MonumentMaster::find($request->id);
    //     $brands->delete();

    //     if ($brands) {
    //         return response()->json(['result' =>'Data deleted successfully!']);
    //     } else {
    //         return response()->json(['result' =>'Failed to delete data.'], 500);
    //     }

    // }
}
