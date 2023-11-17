<?php
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

?>