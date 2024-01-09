<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Models\Master\UserMaster;

class UserMasterController extends Controller
{
     public function index(){


          $arrayDataRows = array();

          $posts = UserMaster::whereJsonContains('Data',  ["Name" => "Token"])->get();

          if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "Title" => $post->Title,
                    "Data" => array(
                        "Name" => $post->Data['Name'],
                        "Gender" => $post->Data['Gender']
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
             //print_r($request['Data']['Name']);
             //exit;
            $id = $request->input('id');
            if($id == '') {

                    $data = array(
                        'Name' => $request['Data']['Name'],
                        'Gender' => $request['Data']['Gender'],
                        'Code' => $request['Data']['Code'],
                        'Status' => $request['Data']['Status'],
                    );


                 $savedata = UserMaster::create([
                    'Title' => $request->Title,
                    'Data' => $data,
                 ]);
                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
            }
    }

}
