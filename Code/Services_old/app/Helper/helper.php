
<?php

use Carbon\Carbon;

function call_logger($errorlog){
    $isActive = true;
    if($isActive){
        $newfile = 	'public/errorlog/Debuglog_'.date('dmy').'.txt';

        $exists = Storage::disk('local')->exists($newfile);
        if(!$exists)
        {
            Storage::put($newfile, '');
        }

        $logfile=fopen(Storage::path($newfile),'a');

        $ip = \Request::ip();
        date_default_timezone_set('Asia/Kolkata');
        $time = date('d-m-Y h:i:s A',time());
        $contents = "$ip\t$time\t$errorlog\r";
        fwrite($logfile,$contents);

    }
}

function getName($tableName,$id){
    $name = DB::table($tableName)->where('id',$id)->get('Name');
    if($name->isNotEmpty()){
        return $name[0]->Name;
    }
}

function getColumnValue($tableName,$where,$val,$columnName){
    $value = DB::table($tableName)->where($where,$val)->get($columnName);
    if($value->isNotEmpty()){
        return $value[0]->$columnName;
    }
}


function getCodes($from,$to,$destination){

    $firstmonth = Carbon::parse($from)->format('n');
    $lastmonth = Carbon::parse($to)->format('n');
    $firstyear = Carbon::parse($from)->year;
    $lastyear = Carbon::parse($to)->year;
    $arr = array();

    if($firstyear == $lastyear){

        for($i = $firstmonth;$i <= $lastmonth;$i++){
            array_push($arr,"V1^V31^M".$i."^D".$destination."^Y".$firstyear);
        }

    }else{

        for($j = $firstyear;$j <= $lastyear;$j++){

            if($j == $firstyear){

                for($z = $firstmonth;$z <= 12;$z++){
                    array_push($arr,"V1^V31^M".$z."^D".$destination."^Y".$j);
                }

            }
            if($j == $lastyear){

                for($z = 1;$z <= $lastmonth;$z++){
                    array_push($arr,"V1^V31^M".$z."^D".$destination."^Y".$j);
                }

            }
            if($j != $firstyear && $j != $lastyear){

                for($z = 1;$z <= 12;$z++){
                    array_push($arr,"V1^V31^M".$z."^D".$destination."^Y".$j);
                }

            }


        }

    }

return $arr;


}


?>
