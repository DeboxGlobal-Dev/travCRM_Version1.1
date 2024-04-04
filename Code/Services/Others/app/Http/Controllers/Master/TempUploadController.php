<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\TempUpload;

class TempUploadController extends Controller
{
public function store(Request $request)
{
    $jsonData = $request->getContent();

    if (!empty($jsonData)) {
        $jsonRecords = json_decode($jsonData, true);
        if ($jsonRecords) {
            foreach ($jsonRecords as $jsonRecord) {
                $tempUploadData = new TempUpload();
                $tempUploadData->ServiceType = 'hotel'; 
                $tempUploadData->UploadJson = json_encode($jsonRecord, JSON_PRETTY_PRINT);
                $tempUploadData->save();
            }

            return response()->json(['message' => 'Records saved successfully']);
        } else {
            return response()->json(['message' => 'Failed to decode JSON data'], 400);
        }
    } else {
        return response()->json(['message' => 'No JSON data found'], 400);
    }
}
}


