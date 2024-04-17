<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\FleetMaster;

class FleetMasterController extends Controller
{
    public function index(Request $request){


        $arrayDataRows = array();

        $Search = $request->input('Search');
        $Status = $request->input('Status');
    

        $posts = FleetMaster::when($Search, function ($query) use ($Search) {
            return $query->where('Name', 'like', '%' . $Search . '%');
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->orderBy('Name')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "Name" => $post->Name,
                    "VehicleType" => $post->VehicleType,
                    "Image" => $post->Image,
                    "Vehicle" => $post->Vehicle,
                    "RegistrationNumber" => $post->RegistrationNumber,
                    "Colour" => $post->Colour,
                    "FuelType" => $post->FuelType,
                    "AssignedDriver" => $post->AssignedDriver,
                    "Insurance" => $post->Insurance,
                    "IssueDate" => $post->IssueDate,
                    "Permits" => $post->Permits,
                    "PollutionPermitsExpiry" => $post->PollutionPermitsExpiry,
                    "Status" => $post->Status,
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
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

                $businessvalidation =array(
                    'Name' => 'required|unique:'._DB_.'.'._FLEET_MASTER_.',Name',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = FleetMaster::create([
                    'Name' => $request->Name,
                    'VehicleType' => $request->VehicleType,
                    'Parts' => $request->Parts,
                    'EngineNumber' => $request->EngineNumber,
                    'Vehicle' => $request->Vehicle,
                    'Insurance' => $request->Insurance,
                    'Colour' => $request->Colour,
                    'PolicyNumber' => $request->PolicyNumber,
                    'FuelType' => $request->FuelType,
                    'IssueDate' => $request->IssueDate,
                    'SeatingCapacity' => $request->SeatingCapacity,
                    'DueDate' => $request->DueDate,
                    'AssignedDriver' => $request->AssignedDriver,
                    'PremiumAmount' => $request->PremiumAmount,
                    'CategoryVehicleGroup' => $request->CategoryVehicleGroup,
                    'CoverAmount' => $request->CoverAmount,
                    'RegistrationNumber' => $request->RegistrationNumber,
                    'RTO' => $request->RTO,
                    'RegisteredOwnerName' => $request->RegisteredOwnerName,
                    'TaxEfficiency' => $request->TaxEfficiency,
                    'PollutionPermitsExpiry' => $request->PollutionPermitsExpiry,
                    'ExpiryDate' => $request->ExpiryDate,
                    'RegistrationDate' => $request->RegistrationDate,
                    'Permits' => $request->Permits,
                    'Image' => $request->Image,
                    'Status' => $request->Status,
                    'AddedBy' => $request->AddedBy,
                    'created_at' => now(),
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
              }

            }else{

                $id = $request->input('id');
                $edit = FleetMaster::find($id);

                $businessvalidation =array(
                    'Name' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->Name = $request->input('Name');
                        $edit->VehicleType = $request->input('VehicleType');
                        $edit->Parts = $request->input('Parts');
                        $edit->EngineNumber = $request->input('EngineNumber');
                        $edit->Vehicle = $request->input('Vehicle');
                        $edit->Insurance = $request->input('Insurance');
                        $edit->Colour = $request->input('Colour');
                        $edit->PolicyNumber = $request->input('PolicyNumber');
                        $edit->FuelType = $request->input('FuelType');
                        $edit->IssueDate = $request->input('IssueDate');
                        $edit->SeatingCapacity = $request->input('SeatingCapacity');
                        $edit->DueDate = $request->input('DueDate');
                        $edit->AssignedDriver = $request->input('AssignedDriver');
                        $edit->PremiumAmount = $request->input('PremiumAmount');
                        $edit->CategoryVehicleGroup = $request->input('CategoryVehicleGroup');
                        $edit->CoverAmount = $request->input('CoverAmount');
                        $edit->RegistrationNumber = $request->input('RegistrationNumber');
                        $edit->RTO = $request->input('RTO');
                        $edit->RegisteredOwnerName = $request->input('RegisteredOwnerName');
                        $edit->TaxEfficiency = $request->input('TaxEfficiency');
                        $edit->PollutionPermitsExpiry = $request->input('PollutionPermitsExpiry');
                        $edit->ExpiryDate = $request->input('ExpiryDate');
                        $edit->RegistrationDate = $request->input('RegistrationDate');
                        $edit->Permits = $request->input('Permits');
                        $edit->Image = $request->input('Image');
                        $edit->Status = $request->input('Status');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->updated_at = now();
                        $edit->save();

                        return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                }
            }
        }catch (\Exception $e){
            call_logger("Exception Error  ===>  ". $e->getMessage());
            return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        }
    }



    public function destroy(Request $request)
    {
        $brands = FleetMaster::find($request->id);
        $brands->delete();

        if ($brands) {
            return response()->json(['result' =>'Data deleted successfully!']);
        } else {
            return response()->json(['result' =>'Failed to delete data.'], 500);
        }

    }

}
