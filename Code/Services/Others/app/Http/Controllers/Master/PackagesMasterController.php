<?php

namespace App\Http\Controllers\Master;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Models\Master\PackagesMaster;

class PackagesMasterController extends Controller
{
    public function index(Request $request){


        //$arrayDataRows = array();


        $valid_from = $request->input('ValidFrom');
        $valid_to = $request->input('ValidTo');
        $destination = $request->input('Destination');

        $RateCode = "V1^V31^M".date('n',strtotime($valid_from))."^D".$destination."^Y".date('Y',strtotime($valid_from));
// print_r($RateCode);
        $data = DB::select('
            SELECT json_build_array(elem) AS result
            FROM visa.package_master, JSON_ARRAY_ELEMENTS("Data") AS elem
            WHERE "RateCode" = \''.$RateCode.'\' and elem->>\'ValidFrom\' >= \''.$valid_from.'\' and elem->>\'ValidTo\' <= \''.$valid_to.'\' and elem->>\'Destination\' = \''.$destination.'\'');
            // print_r($data);exit;
        $total_data = array();
        foreach($data as $datas){

            $local_data = json_decode($datas->result);
            // print_r($local_data[0]);
            // exit;

            array_push($total_data,$local_data[0]);
        }



        return response()->json([
              'Status' => 200,
              'DataList' => $total_data,
          ]);


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
                        'id' => $data['id'],
                        'ClientId' => $data['ClientId'],
                        'HotelId' => $data['HotelId'],
                        'MarketType' => $data['MarketType'],
                        'SupplierId' => $data['MarketType'],
                        'PaxType' => $data['PaxType'],
                        'TariffType' => $data['TariffType'],
                        'SeasonType' => $data['SeasonType'],
                        'SeasonYear' => $data['SeasonYear'],
                        'Destination' => $data['Destination'],
                        'ValidFrom' => $data['ValidFrom'],
                        'ValidTo' => $data['ValidTo'],
                        'RoomType' => $data['RoomType'],
                        'MealType' => $data['MealType'],
                        'Currency' => $data['Currency'],
                        'SingleOccupancy' => $data['SingleOccupancy'],
                        'DoubleOccupancy' => $data['DoubleOccupancy'],
                        'ExtraBedAdult' => $data['ExtraBedAdult'],
                        'ExtraBedChild' => $data['ExtraBedChild'],
                        'ChildWithBed' => $data['ChildWithBed'],
                        'Breakfast' => $data['Breakfast'],
                        'TAC' => $data['TAC'],
                        'RoomTaxSlab' => $data['RoomTaxSlab'],
                        'MealTaxSlab' => $data['MealTaxSlab'],
                        'MarkUpType' => $data['MarkUpType'],
                        'MarkUpValue' => $data['MarkUpValue'],
                        'Remarks' => $data['Remarks'],
                        'Status' => $data['Status'],
                        'AddedBy' => $data['AddedBy'],
                        'UpdatedBy' => $data['UpdatedBy'],
                    );
                    array_push($final_data,$data_array);
                }


                    //print_r($request['Data']['Name']);
             //exit;

                 $savedata = PackagesMaster::create([
                    'Status' => $request->Status,
                    'RateCode' => $request->RateCode,
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
                $edit = PackagesMaster::find($id);

                if ($edit) {

                    PackagesMaster::where('id', $id)->update([
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
