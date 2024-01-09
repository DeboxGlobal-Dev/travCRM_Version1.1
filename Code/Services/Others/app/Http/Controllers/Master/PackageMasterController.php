<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Models\Master\PackageMaster;

class PackageMasterController extends Controller
{
    public function index(){


        $arrayDataRows = array();


        $posts = PackageMaster::whereJsonContains('Data',  ["FromDate" => "10-12-2023"])->get();
        //$posts = PackageMaster::select('*')->get('*');

        if ($posts->isNotEmpty()) {
          $arrayDataRows = [];
          foreach ($posts as $post){
              $arrayDataRows[] = [
                  "Id" => $post->id,
                  "Status" => $post->Status,
                  "Data" =>
                  // $post->Data,
                  array(
                      "FromDate" => $post->Data['FromDate'],
                      "ToDate" => $post->Data['ToDate'],
                      "PackageName" => $post->Data['PackageName'],
                      "PackageType" => $post->Data['PackageType'],
                      "Status" => $post->Data['Status']
                  ),

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
            //  print_r($request->all());
            //  exit;
            $id = $request->input('id');
            if($id == '') {



                $final_data = array();
                foreach($request['Data'] as $data){
                    $data_array = array(
                        'FromDate' => $data['FromDate'],
                        'ToDate' => $data['ToDate'],
                        'PackageName' => $data['PackageName'],
                        'PackageType' => $data['PackageType'],
                        'Status' => $data['Status']
                    );
                    array_push($final_data,$data_array);
                }


                    //print_r($request['Data']['Name']);
             //exit;

                 $savedata = PackageMaster::create([
                    'Status' => $request->Status,
                    'Data' => $final_data,
                 ]);
                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
            }
            else{
                $id = $request->input('id');
                $edit = PackageMaster::find($id);

                if ($edit) {

                    PackageMaster::where('id', $id)->update([
                        'Data'=>$request->input('Data'),
                    ]);

                    return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                    }
                    else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
            }
    }


}
