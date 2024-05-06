<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\Git;


class GitController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = Git::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status){
            return $query->where('Status', $Status);
        })->select('*')->orderBy('Name')->get('*');


        if($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post) {
                
                $arrayDataRows[] = [
                    "id" => $post->id,
                    "Destination" => $post->Destination,
                    "Inclusion" => $post->Inclusion,
                    "Exclusion" => $post->Exclusion,
                    "TermsCondition" => $post->TermsCondition,
                    "Cancelation" => $post->Cancelation,
                    "ServiceUpgradation" => $post->ServiceUpgradation,
                    "OptionalTour" => $post->OptionalTour,
                    "PaymentPolicy" => $post->PaymentPolicy,
                    "Remarks" => $post->Remarks,
                    "SetDefault" => ($post->SetDefault == 1) ? 'Yes' : 'No',
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                ];
            }

            return response()->json([
                'Status' => 200,
                'TotalRecord' => $posts->count('id'),
                'ItineraryInfoMaster' => $arrayDataRows
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

        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'Name' => 'required|unique:'._DB_.'.'._GIT_MASTER_.',Name',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = Git::create([
                    'Name' => $request->Name,
                    'Destination' => $request->Destination,
                    'Inclusion' => $request->Inclusion,
                    'Exclusion' => $request->Exclusion,
                    'TermsCondition' => $request->TermsCondition,
                    'Cancelation' => $request->Cancelation,
                    'ServiceUpgradation' => $request->ServiceUpgradation,
                    'OptionalTour' => $request->OptionalTour,
                    'PaymentPolicy' => $request->PaymentPolicy,
                    'Remarks' => $request->Remarks,
                    'SetDefault' => $request->SetDefault,
                    'Status' => $request->Status,
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
                $edit = Git::find($id);

                $businessvalidation =array(
                    'Name' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {

                        Git::where('id', $id)->update([
                        'Name'=>$request->input('Name'),
                        'Destination'=>$request->input('Destination'),
                        'Inclusion'=>$request->input('Inclusion'),
                        'Exclusion'=>$request->input('Exclusion'),
                        'TermsCondition'=>$request->input('TermsCondition'),
                        'Cancelation'=>$request->input('Cancelation'),
                        'ServiceUpgradation'=>$request->input('ServiceUpgradation'),
                        'OptionalTour'=>$request->input('OptionalTour'),
                        'PaymentPolicy'=>$request->input('PaymentPolicy'),
                        'Remarks'=>$request->input('Remarks'),
                        'SetDefault'=>$request->input('SetDefault'),
                        'Status'=>$request->input('Status'),
                        'UpdatedBy'=>$request->input('UpdatedBy'),
                        //'updated_at'=>now(),


                    ]);
                     return response()->json(['Status' => 1, 'Message' => 'Data updated successfully']);
                    }
                    else {
                        return response()->json(['Status' => 0, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                    
                }
            }

        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
           return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }

}
