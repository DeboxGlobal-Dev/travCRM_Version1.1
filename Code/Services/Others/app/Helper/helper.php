
<?php

function call_logger($errorlog){
    $isActive = true;
    if($isActive){
        $newfile = 	'public/errorlog/Debuglog_'.date('dmy').'.txt';

        $exists = Storage::disk('local')->exists($newfile);
        if(!$exists)
        {
            Storage::put($newfile, '0777');
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

function ValidateTemplate($FieldName,$FieldValue,$IsMandate,$DataType,$Length, &$ErrorMessage){

$Status = 1;
$ErrorMessage = "";

if(trim($IsMandate) == 1 || strtoupper(trim($IsMandate)) == 'YES'){

    if(trim($FieldValue) == ""){
        $Status = 0;
        $ErrorMessage .= $FieldName." is Mandatory. ";
    }

}
if(strlen($FieldValue) > $Length && $Length != ""){
        $Status = 0;
        $ErrorMessage .= $FieldName." Length should not exceeds ".$Length.". ";
    }
if($DataType == "Email" && !filter_var($FieldValue, FILTER_VALIDATE_EMAIL)){
        $Status = 0;
        $ErrorMessage .= "Invalid ".$FieldName.". ";
    }
if($DataType == "Boolean" && trim($FieldValue) != 1 && trim($FieldValue) != 0 && trim(strtoupper($FieldValue)) != "YES" && trim(strtoupper($FieldValue)) != "NO"){
        $Status = 0;
        $ErrorMessage .= $FieldName." should be only Yes or No. ";
    }
if($DataType == "Decimal"){

        $pattern = "/^\d+(\.\d{1,2})?$/";

        if (!preg_match($pattern, $FieldValue)) {
            $Status = 0;
            $ErrorMessage .= $FieldName." should be a number with two maximum two decimal value. ";
        }

    }
if($DataType == "Date"){

        $format = 'd/m/Y';
        $dateTime = DateTime::createFromFormat($format, $FieldValue);

        if (!($dateTime && $dateTime->format($format) === $FieldValue)){
        $Status = 0;
        $ErrorMessage .= "Invalid ".$FieldName.". ";
        }

    }


return $Status;

}


?>
