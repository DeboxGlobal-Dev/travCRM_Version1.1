<?php
function call_logger($errorlog){
    $newfile = 	'errorlog/Debuglog_'.date('dmy').'.txt';

    $exists = Storage::disk('local')->exists($newfile);
    if(!$exists)
	{
        Storage::put($newfile, '');
	}

	$logfile=fopen(Storage::path($newfile),'a');
	
	$ip = $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set('Asia/Kolkata');
	$time = date('d-m-Y h:i:s A',time());
	$contents = "$ip\t$time\t$errorlog\r";
	fwrite($logfile,$contents);
	
}
?>