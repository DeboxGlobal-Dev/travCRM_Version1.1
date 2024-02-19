<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\ImageGalleryMaster;

class ImageGalleryMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM STATE LIST: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = ImageGalleryMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Type', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Type')->get('*');



        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "ImageName" => asset('storage/' . $post->ImageName),
                    //'http://localhost:8000/storage/public/posts/' .$post->ImageName,
                    //asset('storage/public/posts/' . $this->ImageName),
                    //'http://localhost:8000/api/storage/public/posts/' .$post->ImageName,
                    //"ImageData" => $post->ImageData,
                    "Type" => $post->Type,
                    "ParentId" => $post->ParentId,
                    "Status" => ($post->Status == 1) ? 'Active' : 'Inactive',
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                    "Created_at" => $post->created_at,
                    "Updated_at" => $post->updated_at,
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

       try{
           $id = $request->input('id');
            if($id == '') {
                
                $images = new ImageGalleryMaster();

                $filename = "";
                if($request->hasFile('ImageName')){
                    $filename=$request->file('ImageName')->store('posts', 'public');
                }else{
                    $filename = Null;
                }
                $images->ImageName=$filename;
                $images->Type=$request->Type;
                $images->ParentId=$request->ParentId;
                $images->Status=$request->Status;
                $images->AddedBy=$request->AddedBy;

                $result = $images->save();

                
                if ($result) {
                    return response()->json(['Status' => 0,
                     'Message' => 'Data added successfully!',
                     //'result' => $filename
                    ]);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
              

            }else{

        //         $id = $request->input('id');
        //         $edit = ImageGalleryMaster::find($id);

        //         $businessvalidation =array(
        //             'Type' => 'required',
        //         );

        //         $validatordata = validator::make($request->all(), $businessvalidation);

        //         if($validatordata->fails()){
        //          return $validatordata->errors();
        //         }else{
        //             if ($edit) {

        //                 $ImageName = $request->input('ImageName');
        //                 $base64Image = $request->input('ImageData');
        //                 $ImageData = base64_decode($base64Image);
        //                 $Type = $request->input('Type');
        //                 $ParentId = $request->input('ParentId');
        //                 $Status = $request->input('Status');
        //                 $AddedBy = $request->input('AddedBy');
        //                 $UpdatedBy = $request->input('UpdatedBy');
    
        //                 $filename = uniqid() . '.png';
    
        //                 // print_r($filename);die();
        //                 Storage::disk('public')->put($filename, $ImageData);

        //                 $edit->ImageName = $request->input('ImageName');
        //                 $edit->ImageData = $request->input('ImageData');
        //                 $edit->Type = $request->input('Type');
        //                 $edit->ParentId = $request->input('ParentId');
        //                 $edit->Status = $request->input('Status');
        //                 $edit->UpdatedBy = $request->input('UpdatedBy');
        //                 $edit->updated_at = now();
        //                 $edit->save();

        //                 return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
        //             } else {
        //                 return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
        //             }
        //         }
             }
        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
         }
    }
}
