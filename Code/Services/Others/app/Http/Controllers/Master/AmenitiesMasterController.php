<?php

namespace App\Http\Controllers\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Master\AmenitiesMaster;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AmenitiesMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();


        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = AmenitiesMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%')
                         ->orwhere('SetDefault', 'like', '%' . $Search . '%');
        })->when(isset($Status), function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "id" => $post->id,
                    "Name" => $post->Name,
                    "SetDefault" => $post->SetDefault,
                    "ImageName" => asset('storage/' . $post->ImageName),
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
        //call_logger('REQUEST COMES FROM ADD/UPDATE STATE: '.$request->getContent());

        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'Name' => 'required|unique:'._DB_.'.'._AMENITIES_MASTER_.',Name',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                    $Name = $request->input('Name');
                    $ImageName = $request->input('ImageName');
                    $base64Image = $request->input('ImageData');
                    $ImageData = base64_decode($base64Image);
                    $SetDefault = $request->input('SetDefault');
                    $Status = $request->input('Status');
                    $AddedBy = $request->input('AddedBy');
                    $UpdatedBy = $request->input('UpdatedBy');

                    $filename = time().'_'.$ImageName;

                    Storage::disk('public')->put($filename, $ImageData);

                 $savedata = AmenitiesMaster::create([
                    'Name' => $request->Name,
                    'SetDefault' => $request->SetDefault,
                    'ImageName' => $filename,
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
                $edit = AmenitiesMaster::find($id);

                $businessvalidation =array(
                    'Name' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $Name = $request->input('Name');
                        $ImageName = $request->input('ImageName');
                        $base64Image = $request->input('ImageData');
                        if($base64Image!=''){
                            $ImageData = base64_decode($base64Image);
                            $filename = time().'_'.$ImageName;
                            Storage::disk('public')->put($filename, $ImageData);
                        }
                        $SetDefault = $request->input('SetDefault');
                        $Status = $request->input('Status');
                        $AddedBy = $request->input('AddedBy');
                        $UpdatedBy = $request->input('UpdatedBy');




                        $edit->Name = $request->input('Name');
                        $edit->SetDefault = $request->input('SetDefault');
                        if($base64Image!=''){
                            $edit->ImageName = $filename;
                        }
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
        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {
        $brands = AmenitiesMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }
}
