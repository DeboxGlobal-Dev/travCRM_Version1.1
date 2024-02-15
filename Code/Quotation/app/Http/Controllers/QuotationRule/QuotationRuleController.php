<?php

namespace App\Http\Controllers\QuotationRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\QuotationRule\QuotationInfo;

class QuotationRuleController extends Controller
{
    public function index(Request $request){
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM QuotationInfo LIST: '.$request->getContent());

        $QueryId = $request->input('QueryId');
        $Subject = $request->input('Subject');
        $Status = $request->input('Status');

        $posts = QuotationInfo::when($QueryId, function ($query) use ($QueryId) {
            return $query->where('QueryId',$QueryId);
        })->when($Subject, function ($query) use ($Subject) {
            return $query->where('Subject','like', '%' . $Subject . '%');
       })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('QueryId')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "QueryId" => $post->QueryId,
                    "Subject" => $post->Subject,
                    "FromDate" => $post->FromDate,
                    "ToDate" => $post->ToDate,
                    "Adult" => $post->Adult,
                    "Child" => $post->Child,
                    "TotalPax" => $post->TotalPax,
                    "LeadPaxName" => $post->LeadPaxName,
                    "Version" => $post->Version,
                    "IsSave" => $post->IsSave,
                    "Status" => $post->Status,
                    "AddedBy" => $post->AddedBy,
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

    public function store(Request $request){

        call_logger('REQUEST COMES FROM ADD QuotationInfo: '.$request->getContent());

        try{
            $queryId=$request->input('QueryId');
            $Id= QuotationInfo::where('QueryId','=' ,$queryId)->first();
            if($Id == '') {
                 $savedata = QuotationInfo::create([
                    'QueryId' => $request->QueryId,
                    'Subject' => $request->Subject,
                    'FromDate' => $request->FromDate,
                    'ToDate' => $request->ToDate,
                    'Adult' => $request->Adult,
                    'Child' => $request->Child,
                    'TotalPax' => $request->TotalPax,
                    'LeadPaxName' => $request->LeadPaxName,
                    'JsonData' => $request->getContent(),
                    'Version' => '1',
                    'IsSave' => '1',
                    'Status' => $request->Status,
                    'AddedBy' => $request->AddedBy,
                    'created_at' => now()
                ]);
                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }

                

            }
            else{
                // $edit= QuotationInfo::where('id','=' ,$Id->id)->orderBy('id', 'desc')->get();
                $edit = QuotationInfo::where('QueryId', $request->QueryId)->orderBy('id', 'desc')->take(1)->get();
                //print_r($edit[0]->Version);
                    if ($edit) {    
                        $savedata = QuotationInfo::create([
                            'QueryId' => $request->QueryId,
                            'Subject' => $request->Subject,
                            'FromDate' => $request->FromDate,
                            'ToDate' => $request->ToDate,
                            'Adult' => $request->Adult,
                            'Child' => $request->Child,
                            'TotalPax' => $request->TotalPax,
                            'LeadPaxName' => $request->LeadPaxName,
                            'JsonData' => $request->getContent(),
                            'Version' => $edit[0]->Version+1,
                            'IsSave' => '0',
                            'Status' => $request->Status,
                            'AddedBy' => $request->AddedBy,
                            'created_at' => now()
                        ]);
                        return response()->json(['Status' => 0, 'Message' => 'Data saved successfully']);
                    } else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to saved data.'], 401);
                    }
                
            }
        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }


    Public function updatedata(Request $request){
        $id=$request->input('id');
        $edit = QuotationInfo::find($id);

        if($edit){
                        $edit->QueryId = $request->input('QueryId');
                        $edit->Subject = $request->input('Subject');
                        $edit->FromDate = $request->input('FromDate');
                        $edit->ToDate = $request->input('ToDate');
                        $edit->Adult = $request->input('Adult');
                        $edit->Child = $request->input('Child');
                        $edit->TotalPax = $request->input('TotalPax');
                        $edit->LeadPaxName = $request->input('LeadPaxName');
                        $edit->JsonData = $request->getContent();
                        $edit->Version = $request->input('Version');
                        $edit->IsSave = '1';
                        $edit->Status = $request->input('Status');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->updated_at = now();
                        $edit->save();
                        return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to update data.'], 401);
                    }
        }
    }
    // public function increamentdata(Request $request){

    //     $id = $request->input('id');
    //     $data = QuotationInfo::find($id);

    //     if($data->exists){
    //         $data->Version++;
    //         $data->Is_flag = 0;
    //     }else{
    //         $data->Version = 1;
    //         $data->Is_flag = 1;
    //     }

    //     $data->save();

    // }

