<?php
include("inc.php");
include "logincheck.php";

include 'CommonFiles/Liberary/vendor7/autoload.php';

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
$ErrorMessage = "[Error] - File location ".$_SERVER['PHP_SELF']." Message:- " ;

//pdf parser library class object
$parser = new \Smalot\PdfParser\Parser();

logger($InfoMessage."*********FILE UPLOAD STARTS*********");
 
$filecount = count($_FILES['attachment']['name']);
logger($InfoMessage." Total File count :  ".$filecount);

logger($InfoMessage."DATA SENT VIA POST: ".json_encode($_POST).' & ITS PRODUCT TYPE: '.$_GET['ProductType']);

logger($InfoMessage."Session data: UserType--".strtoupper($_SESSION["Type"]).' & uploadType: '.$_SESSION["DIGIFlAG"].' & UserId: '. strtoupper($_SESSION["UID"]));


logger($InfoMessage."*******Loop Starts From Here****** ");   
for($i=0; $i<$filecount; $i++){
	
	
	$file = $_FILES["attachment"]['tmp_name'][$i];
	$mimeType = $_FILES["attachment"]['type'][$i];
	$basename = $_FILES["attachment"]['name'][$i];
	
	if($_REQUEST["ProductType"]=="PAN"){
		$url = $serverurlapi."BulkUpload/bulkaction.php";
		$target = $targetImagePath.'panpdf/'.$basename;
	}
	
	if($_REQUEST["ProductType"]=="TAN"){
		$url = $serverurlapi."BulkUpload/bulkactiontan.php";
		$target = $targetImagePath.'tanpdf/'.$basename;
	}
	
	//Copy pdf file to upolads
	if(copy($file, $target)){
		logger('Copy Success: '.$basename);
		chmod($target, 0777);
		$pdfPath = $target;
		logger('PDF Path: '.$pdfPath);
		$pdf    = $parser->parseFile($pdfPath);
		$images = $pdf->getObjectsByType('XObject', 'Image');	
		
		logger('*****outside image copy foreach****');
		$pageNo=0;
		$name = explode('.',$basename);
		//$newImageName = 'uploads/panimages/'.$name[0];
		$imageFileArr = '';
		foreach($images as $image){
		  $encodedImageFile2 = base64_encode($image->getContent());
		  //file_put_contents($newImageName.'_'.$pageNo.'.jpg', base64_decode($encodedImageFile2));
		  logger('THIS IS PAGE: '.$pageNo);
		 $imageFileArr.= '{
			"image":"'.$encodedImageFile2.'"
		},';
		  $pageNo++;
		
		}
		$imageFileJson = rtrim($imageFileArr,',');
		
		// Retrieve all pages from the pdf file.
     //$pages = $pdf->getPages();
	// logger('*****outside image copy foreach****'.print_r($pages));
		
		$TotalImagePage = $pageNo;
		logger('Total Image page count: '.$pageNo);
		
	}else{
		logger('Copy Failed: '.$basename);
	}

	$jsonDataToPost = '{
		"UserType":"'.strtoupper($_SESSION["Type"]).'",
		"UserId":"'.strtoupper($_SESSION["UID"]).'",
		"ip":"'.$_SERVER["REMOTE_ADDR"].'",
		"RegionId":"'.$_SESSION["REGIONID"].'",
		"BranchId":"'.$_SESSION["branchId"].'",
		"uploadType":"'.$uploadType.'",
		"TotalFileUpload":"'.$_POST["TotalFileUpload"].'",
		"CurrentFileUpload":"'.$_POST["CurrentFileUpload"].'",
		"TotalImagePage":"'.$TotalImagePage.'",
		"fileName":"'.$_FILES["attachment"]['name'][$i].'",
		"imageFile":['.$imageFileJson.']
	}';
	
	//logger('POST DATA IS: '.$jsonDataToPost);
	
	logger($InfoMessage." API URL :  ".$url);
	
	//Curl to send data
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,$url);
	curl_setopt($curl_handle, CURLOPT_POST, TRUE);
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $jsonDataToPost);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$returned_data = curl_exec($curl_handle);
	
	if(!curl_errno($curl_handle))
	{
		$info = curl_getinfo($curl_handle);
		if ($info['http_code'] == 200)
			$errmsg = 'File uploaded successfully';
			echo $returned_data;
			
	}
	else
	{
		$errmsg = curl_error($curl_handle);
		$namearr = explode('.',$basename);
		echo $returned_data = json_encode(['AckNumber'=>$namearr[0],'status'=>'Error in curl request','remark'=>'curl is not responding','SequenceNo'=>$_POST['CurrentFileUpload']], JSON_PRETTY_PRINT);
	}

	logger($InfoMessage." Return Value from API :  ".$returned_data);
	logger($InfoMessage." Response Curl message :  ".$errmsg.' and status code: '.$info['http_code']);
	logger($InfoMessage."*******Loop Ends Here****** ");   
	
}
	
	
	logger($InfoMessage."*********FILE UPLOAD ENDS*********");
	curl_close($curl_handle);
	
?>