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

        $Search = $request->input('QueryId');
        // $Status = $request->input('Status');

        $posts = QuotationInfo::when($Search, function ($query) use ($Search) {
            return $query->where('QueryId', $Search);
        })->select('*')->get('*');

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
                    "JsonData" => $post->JsonData,
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
            $id = $request->input('id');
            if($id == '') {

                 $savedata = QuotationInfo::create([
                    'QueryId' => $request->QueryId,
                    'Subject' => $request->Subject,
                    'FromDate' => $request->FromDate,
                    'ToDate' => $request->ToDate,
                    'Adult' => $request->Adult,
                    'Child' => $request->Child,
                    'LeadPaxName' => $request->LeadPaxName,
                    'TotalPax' => $request->TotalPax,
                    'JsonData' => $request->JsonData,
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
        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }
}
