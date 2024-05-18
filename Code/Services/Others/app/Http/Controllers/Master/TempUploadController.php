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

    $templateJson = '{
    "Status" : 0,
    "Template" : [
        {
            "ColumnName" : "HOTEL_NAME",
            "ColumnKey" : "HOTEL_NAME",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : "100"
        },
        {
            "ColumnName" : "DESTINATION",
            "ColumnKey" : "DESTINATION",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "SELF_SUPPLIER",
            "ColumnKey" : "SELF_SUPPLIER",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "SUPPLIER_NAME",
            "ColumnKey" : "SUPPLIER_NAME",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "HOTEL_COUNTRY",
            "ColumnKey" : "HOTEL_COUNTRY",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "STATE",
            "ColumnKey" : "STATE",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "CITY",
            "ColumnKey" : "CITY",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "HOTEL_ADDRESS",
            "ColumnKey" : "HOTEL_ADDRESS",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "DIVISION",
            "ColumnKey" : "DIVISION",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "CONTACT_PERSON",
            "ColumnKey" : "CONTACT_PERSON",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "DESIGNATION",
            "ColumnKey" : "DESIGNATION",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "MOBILE_NO",
            "ColumnKey" : "MOBILE_NO",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "CONTACT_PERSON_EMAIL",
            "ColumnKey" : "CONTACT_PERSON_EMAIL",
            "IsMandtory" : "Yes",
            "DataType" : "Email",
            "Length" : ""
        },
        {
            "ColumnName" : "MARKET_TYPE",
            "ColumnKey" : "MARKET_TYPE",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "SEASON_TYPE",
            "ColumnKey" : "SEASON_TYPE",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "ROOM_TYPE",
            "ColumnKey" : "ROOM_TYPE",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "MEAL_PLAN",
            "ColumnKey" : "MEAL_PLAN",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "FROM_VALIDITY",
            "ColumnKey" : "FROM_VALIDITY",
            "IsMandtory" : "Yes",
            "DataType" : "Date",
            "Length" : ""
        },
        {
            "ColumnName" : "TO_VALIDITY",
            "ColumnKey" : "TO_VALIDITY",
            "IsMandtory" : "Yes",
            "DataType" : "Date",
            "Length" : ""
        },
        {
            "ColumnName" : "CURRENCY",
            "ColumnKey" : "CURRENCY",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "SINGLE",
            "ColumnKey" : "SINGLE",
            "IsMandtory" : "Yes",
            "DataType" : "Decimal",
            "Length" : ""
        },
        {
            "ColumnName" : "DOUBLE",
            "ColumnKey" : "DOUBLE",
            "IsMandtory" : "Yes",
            "DataType" : "Decimal",
            "Length" : ""
        },
        {
            "ColumnName" : "CHILD_WITH_BED",
            "ColumnKey" : "CHILD_WITH_BED",
            "IsMandtory" : "Yes",
            "DataType" : "Decimal",
            "Length" : ""
        },
        {
            "ColumnName" : "EXTRA_BED_ADULT",
            "ColumnKey" : "EXTRA_BED_ADULT",
            "IsMandtory" : "Yes",
            "DataType" : "Decimal",
            "Length" : ""
        },
        {
            "ColumnName" : "EXTRA_BED",
            "ColumnKey" : "EXTRA_BED",
            "IsMandtory" : "Yes",
            "DataType" : "Decimal",
            "Length" : ""
        },
        {
            "ColumnName" : "BREAKFAST",
            "ColumnKey" : "BREAKFAST",
            "IsMandtory" : "Yes",
            "DataType" : "Decimal",
            "Length" : ""
        },
        {
            "ColumnName" : "LUNCH",
            "ColumnKey" : "LUNCH",
            "IsMandtory" : "Yes",
            "DataType" : "Decimal",
            "Length" : ""
        },
        {
            "ColumnName" : "DINNER",
            "ColumnKey" : "DINNER",
            "IsMandtory" : "Yes",
            "DataType" : "Decimal",
            "Length" : ""
        },
        {
            "ColumnName" : "TARRIF_TYPE",
            "ColumnKey" : "TARRIF_TYPE",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "ROOM_GST_SLAB",
            "ColumnKey" : "ROOM_GST_SLAB",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "MEAL_GST_SLAB",
            "ColumnKey" : "MEAL_GST_SLAB",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "STAR",
            "ColumnKey" : "STAR",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "HOTEL_WEB_LINK",
            "ColumnKey" : "HOTEL_WEB_LINK",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "HOTEL_CHAIN",
            "ColumnKey" : "HOTEL_CHAIN",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "WEEKEND_NAME",
            "ColumnKey" : "WEEKEND_NAME",
            "IsMandtory" : "Yes",
            "DataType" : "Char",
            "Length" : ""
        },
        {
            "ColumnName" : "HOTEL_TYPE",
            "ColumnKey" : "HOTEL_TYPE",
            "IsMandtory" : "No",
            "DataType" : "Char",
            "Length" : ""
        }
    ]
}';
///////test
$template = json_decode($templateJson, true);
//call_logger($templateJson);
// Check if the template is properly loaded and has the "Template" key
if (isset($template['Template'])) {
$i = 1;

    // Iterate through each column in the template
    foreach ($template['Template'] as $column) {
        $CN[$i] = $column['ColumnName'];
        $IM[$i] = $column['IsMandtory'];
        $DT[$i] = $column['DataType'];
        $LN[$i] = $column['Length'];
        $i++;
    }
}

$hotels = json_decode($jsonData, true);
//var_dump($hotels);
// Iterate through each hotel data and access its values
if (isset($hotels)) {
    $Success = 0;
    $Failed = 0;
    $ValidationJsonString="";
    $x=1;

    foreach ($hotels as $data) {

        $a=1;
        $validate = 1;
        foreach($data as $datas){
        $validate *= ValidateTemplate($CN[$a],$datas,$IM[$a],$DT[$a],$LN[$a],$ValidationJsonString);
        call_logger("Validation----Rec No ".$x."---".$CN[$a]."-> ".$datas."--".$ValidationJsonString);
        $a++;
        }
        if($validate){
            $tempUploadData = new TempUpload();
            $tempUploadData->ServiceType = 'hotel';
            $tempUploadData->AddedBy = 1;
            $tempUploadData->created_at = now();
            $tempUploadData->UploadJson = json_encode($data, JSON_PRETTY_PRINT);
            $tempUploadData->save();
        call_logger("Rec No ".$x."---Success");
        $Success++;
        }
        else{
            call_logger("Rec No ".$x."--Failed");
            $Failed++;
        }
$x++;
}
return ['Message' => "Data Saved",'Success' => $Success,'Failed' => $Failed];
}
}
}


