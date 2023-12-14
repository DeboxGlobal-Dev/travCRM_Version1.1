<?php

namespace App\Http\Controllers\Hotel\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Hotel\Master\HotelRateMaster;

class HotelRateMasterController extends Controller
{
    public function index(Request $request){
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM HOTEL RATE LIST: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = HotelRateMaster::when($Search, function ($query) use ($Search) {
            return $query->where('SupplierId', $Search);
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "ClientId" => $post->ClientId,
                    "MarketType" => $post->MarketType,
                    "SupplierId" => $post->SupplierId,
                    "PaxType" => $post->PaxType,
                    "TariffType" => $post->TariffType,
                    "SeasonType" => $post->SeasonType,
                    "SeasonYear" => $post->SeasonYear,
                    "ValidFrom" => $post->ValidFrom,
                    "ValidTo" => $post->ValidTo,
                    "RoomType" => $post->RoomType,
                    "MealType" => $post->MealType,
                    "Currency" => $post->Currency,
                    "SingleOccupancy" => $post->SingleOccupancy,
                    "DoubleOccupancy" => $post->DoubleOccupancy,
                    "ExtraBedAdult" => $post->ExtraBedAdult,
                    "ExtraBedChild" => $post->ExtraBedChild,
                    "ChildWithBed" => $post->ChildWithBed,
                    "Breakfast" => $post->Breakfast,
                    "Lunch" => $post->Lunch,
                    "Dinner" => $post->Dinner,
                    "TAC" => $post->TAC,
                    "RoomTaxSlab" => $post->RoomTaxSlab,
                    "MealTaxSlab" => $post->MealTaxSlab,
                    "MarkUpType" => $post->MarkUpType,
                    "MarkUpValue" => $post->MarkUpValue,
                    "Remarks" => $post->Remarks,
                    "Status" => $post->Status,
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

    public function store(Request $request){

        call_logger('REQUEST COMES FROM ADD/UPDATE Hotel Rate: '.$request->getContent());

        try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'ClientId' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = HotelRateMaster::create([
                    'ClientId' => $request->ClientId,
                    'MarketType' => $request->MarketType,
                    'SupplierId' => $request->SupplierId,
                    'PaxType' => $request->PaxType,
                    'TariffType' => $request->TariffType,
                    'SeasonType' => $request->SeasonType,
                    'SeasonYear' => $request->SeasonYear,
                    'ValidFrom' => $request->ValidFrom,
                    'ValidTo' => $request->ValidTo,
                    'RoomType' => $request->RoomType,
                    'MealType' => $request->MealType,
                    'Currency' => $request->Currency,
                    'SingleOccupancy' => $request->SingleOccupancy,
                    'DoubleOccupancy' => $request->DoubleOccupancy,
                    'ExtraBedAdult' => $request->ExtraBedAdult,
                    'ExtraBedChild' => $request->ExtraBedChild,
                    'ChildWithBed' => $request->ChildWithBed,
                    'Breakfast' => $request->Breakfast,
                    'Lunch' => $request->Lunch,
                    'Dinner' => $request->Dinner,
                    'TAC' => $request->TAC,
                    'RoomTaxSlab' => $request->RoomTaxSlab,
                    'MealTaxSlab' => $request->MealTaxSlab,
                    'MarkUpType' => $request->MarkUpType,
                    'MarkUpValue' => $request->MarkUpValue,
                    'Remarks' => $request->Remarks,
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
                $edit = HotelRateMaster::find($id);

                $businessvalidation =array(
                    'ClientId' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->ClientId = $request->input('ClientId');
                        $edit->MarketType = $request->input('MarketType');
                        $edit->SupplierId = $request->input('SupplierId');
                        $edit->PaxType = $request->input('PaxType');
                        $edit->TariffType = $request->input('TariffType');
                        $edit->SeasonType = $request->input('SeasonType');
                        $edit->SeasonYear = $request->input('SeasonYear');
                        $edit->ValidFrom = $request->input('ValidFrom');
                        $edit->ValidTo = $request->input('ValidTo');
                        $edit->RoomType = $request->input('RoomType');
                        $edit->MealType = $request->input('MealType');
                        $edit->Currency = $request->input('Currency');
                        $edit->SingleOccupancy = $request->input('SingleOccupancy');
                        $edit->DoubleOccupancy = $request->input('DoubleOccupancy');
                        $edit->ExtraBedAdult = $request->input('ExtraBedAdult');
                        $edit->ExtraBedChild = $request->input('ExtraBedChild');
                        $edit->ChildWithBed = $request->input('ChildWithBed');
                        $edit->Breakfast = $request->input('Breakfast');
                        $edit->Lunch = $request->input('Lunch');
                        $edit->Dinner = $request->input('Dinner');
                        $edit->TAC = $request->input('TAC');
                        $edit->RoomTaxSlab = $request->input('RoomTaxSlab');
                        $edit->MealTaxSlab = $request->input('MealTaxSlab');
                        $edit->MarkUpType = $request->input('MarkUpType');
                        $edit->MarkUpValue = $request->input('MarkUpValue');
                        $edit->Remarks = $request->input('Remarks');
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
}
