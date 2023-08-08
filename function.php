<?php  
function getTwoDecimalNumberFormat($value){
	$values = number_format((float)$value, 2, '.', ''); // cost should be in 2 decimal format
 	// $values = round($value); // all cost should be in round
	return $values;
}
function currency_converter($OldCurrVal,$NewCurrVal,$OldPrice){
	$OldPriceINR = $OldCurrVal * $OldPrice; //Price in INR
	$INR = 1/$NewCurrVal; //convert New old value in INR
	$NewValue = $OldPriceINR * $INR;
	return getTwoDecimalNumberFormat($NewValue);
}
function convert_to_base($OldCurrVal,$baseCurrencyVal,$OldPrice){

		// $rsaa="";
		// $rsaa=GetPageRecord('id,currencyValue',_QUERY_CURRENCY_RATE_MASTER_,'currencyId="'.$OldCurrId.'" and currencyValue!=0 and DATE(date)="'.date('Y-m-d',strtotime($roeDate)).'"  and deletestatus=0 order by date desc');
		// $userss=mysqli_fetch_array($rsaa); 
		// if($userss['id'] == '' || $userss['id'] == 0){
		// 	$rsaa2="";
		// 	$rsaa2=GetPageRecord('id,currencyValue',_QUERY_CURRENCY_RATE_MASTER_,'currencyId="'.$OldCurrId.'"  and currencyValue!=0 and DATE(date)<="'.date('Y-m-d').'" order by date desc');
		// 	$userss2=mysqli_fetch_array($rsaa2); 
		// 	if($userss2['id'] == '' || $userss2['id'] == 0){ 
		// 		$OldCurrVal = 1;
		// 	}else{ 
		// 		$OldCurrVal = $userss2['currencyValue'];
		// 	}
		// }else{ 
		// 	$OldCurrVal = $userss['currencyValue'];
		// }
 	 
	$OldPriceINR = $OldCurrVal * $OldPrice; //Price in INR
	$INR = 1/$baseCurrencyVal; //convert New old value in INR
	$NewValue = $OldPriceINR * $INR;
	return ($NewValue);
     
}

function getCurrencyVal($currencyId=null){
	if($currencyId!=''){

		$qcmQuery="";
	  	$qcmQuery=GetPageRecord('*',_QUERY_CURRENCY_MASTER_,' id="'.$currencyId.'"');
		$qcmData=mysqli_fetch_array($qcmQuery); 
		if($qcmData['isDefault'] == 1){
			return 1;
		}else{
			$qcrQuery="";
		  	$qcrQuery=GetPageRecord('id,currencyValue',_QUERY_CURRENCY_RATE_MASTER_,'currencyId="'.$currencyId.'" and currencyValue!=0 and DATE(date) = "'.date('Y-m-d',strtotime($roeDate)).'"  and deletestatus=0 order by date desc');
			$queryCurData=mysqli_fetch_array($qcrQuery);
			if($queryCurData['id'] == '' || $queryCurData['id'] == 0){
		 		$rsaa2="";
				$rsaa2=GetPageRecord('id,currencyValue',_QUERY_CURRENCY_RATE_MASTER_,'currencyId="'.$currencyId.'"  and currencyValue!=0 and DATE(date) <= "'.date('Y-m-d').'" order by date desc');
				$queryCurData2=mysqli_fetch_array($rsaa2); 
				if($queryCurData2['id'] == '' || $queryCurData2['id'] == 0){
					$curVal = 0;
				}else{
					$curVal = $queryCurData2['currencyValue'];
				}
		 	}else{
				$curVal = $queryCurData['currencyValue'];
		 	}
			return ($curVal>0)?$curVal:0;
		}
	}
}

function getChangeCurrencyValue_New($oldCurId,$quoteId,$OldPrice){
	if($quoteId!=''){
		$rsaa="";
		$rsaa=GetPageRecord('dayroe,currencyId',_QUOTATION_MASTER_,'id="'.$quoteId.'"');
		$quoteData=mysqli_fetch_array($rsaa);
		$NewCurrVal= $quoteData['dayroe'];

		if($NewCurrVal <= 0 || $NewCurrVal == NULL){
			$NewCurrVal= getCurrencyVal($quoteData['currencyId']);
		}
		$OldCurrVal = getCurrencyVal($oldCurId);
	}

	$OldPriceINR = $OldCurrVal * $OldPrice; //Price in INR
	$INR = 1/$NewCurrVal; //convert New old value in INR
	$NewValue =$OldPriceINR * $INR;
	return getTwoDecimalNumberFormat($NewValue); 
	// $NewValue = $OldPrice * $NewCurrVal;
	// return round($NewValue);
}


function getChangeCurrencyValue_New_old($oldCurId,$quoteId,$OldPrice){
	if($quoteId!=''){
		$rsaa="";
		$rsaa=GetPageRecord('dayroe,currencyId',_QUOTATION_MASTER_,'id="'.$quoteId.'"');
		$quoteData=mysqli_fetch_array($rsaa);
		$NewCurrVal= $quoteData['dayroe'];

		if($NewCurrVal <= 0 || $NewCurrVal == NULL){
			$NewCurrVal= getCurrencyVal($quoteData['currencyId']);
		}
		$OldCurrVal = getCurrencyVal($oldCurId);
	}

	$OldPriceINR = $OldCurrVal * $OldPrice; //Price in INR
	$INR = 1/$NewCurrVal; //convert New old value in INR
	$NewValue =$OldPriceINR * $INR;
	// return getTwoDecimalNumberFormat($NewValue);
	return round($NewValue);
}


function get_times( $default = '19:00', $interval = '+30 minutes' ) {

    $output = '';

    $current = strtotime( '00:00' );
    $end = strtotime( '23:59' );

    while( $current <= $end ) {
        $time = date( 'h:i A', $current );
        $sel = ( $time == $default ) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
        $current = strtotime( $interval, $current );
    }

    return $output;
}


function packageshowStarrating($id){
	if($id==4){
	return 'starh4.png';
	}
	if($id==2){
	return 'starh2.png';
	}
	if($id==5){
	return 'starh5.png';
	}

	if($id==3){
	return 'starh3.png';
	}

	if($id==1){
	return 'starh1.png';
	}
}

function stars($rating){
   $stars = '';
    for($i = 0; $i < 5; $i++){
        if($i < $rating){
            $stars .= "<img src='images/filled-star.png' />";
        } else {
            $stars .= "<img src='images/empty-star.png' />";
        }

    }
    return $stars;
}

function showClientType($type){ 
	$rs=GetPageRecord('*','businessTypeMaster',' id="'.$type.'"');
	$resListing1=mysqli_fetch_array($rs);
	return $resListing1['name'];
}


function showClientTypeUserName($type,$id){

	if($type!=2){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	} 
	// first name and
	if($type==2){
		$selectaa='firstName,lastName';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['firstName'].' '.$userss['lastName'];
		}
	} 
}


// webfrom query dashboard name
function showagentNamewf($type1,$id1){

	if($type1!=2){
		$selectaa='name';
		$whereaa='id="'.$id1.'"';
		$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	} 
	if($type1==2){
		$selectaa='firstName,lastName';
		$whereaa='id="'.$id1.'"';
		$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['firstName'].' '.$userss['lastName'];
		}
	}
	if($type1==1){
		$selectaa='firstName,lastName';
		$whereaa='id="'.$id1.'"';
		$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['firstName'].' '.$userss['lastName'];
		}
	}
	if($type1==22){
		$selectaa='firstName,lastName';
		$whereaa='id="'.$id1.'"';
		$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['firstName'].' '.$userss['lastName'];
		}
	}
	if($type1==21){
		$selectaa='firstName,lastName';
		$whereaa='id="'.$id1.'"';
		$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['firstName'].' '.$userss['lastName'];
		}
	}
	if($type1==82){
		$selectaa='firstName,lastName';
		$whereaa='id="'.$id1.'"';
		$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['firstName'].' '.$userss['lastName'];
		}
	}

}


// show department
function showClientTypeUserDepartment($type,$id){
	// Agent
	if($type!=2){
		$selectD='assignTo';
		$whereD='id="'.$id.'"';
		$rsD=GetPageRecord($selectD,_CORPORATE_MASTER_,$whereD);
		while($userD=mysqli_fetch_array($rsD)){
			
			$DPI=GetPageRecord('departmentId',_USER_MASTER_,'id="'.$userD['assignTo'].'"');
			$DId=mysqli_fetch_array($DPI);

			$rs=GetPageRecord('department','departmentMasters','id="'.$DId['departmentId'].'"'); 
			$DData=mysqli_fetch_array($rs);  
			return $DData['department'];
		}
	} 
	// for B2C
	if($type==2){
		$selectD='assignTo';
		$whereD='id="'.$id.'"';
		$rsD='';
		$rsD=GetPageRecord($selectD,_CONTACT_MASTER_,$whereD);
		while($userD=mysqli_fetch_array($rsD)){
			$DPI=GetPageRecord('departmentId',_USER_MASTER_,'id="'.$userD['assignTo'].'"');
			$DId=mysqli_fetch_array($DPI);

			$rs=GetPageRecord('department','departmentMasters','id="'.$DId['departmentId'].'"'); 
			$DData=mysqli_fetch_array($rs);  
			return $DData['department'];
		}
	}
}
 

function showClientTypeCountry($type,$id){

	if($type!=2){
		$selectaa='countryId';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
		while($clientData=mysqli_fetch_array($rsaa)){
			 $rsCC=GetPageRecord('name',_COUNTRY_MASTER_,'id="'.$clientData['countryId'].'"');
			 $clientCountry=mysqli_fetch_array($rsCC);
			return $clientCountry['name'];
		}
	} 
	// first name and
	if($type==2){
		$selectaa='countryId';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
		while($clientData=mysqli_fetch_array($rsaa)){
			$rsCB=GetPageRecord('name',_COUNTRY_MASTER_,'id="'.$clientData['countryId'].'"');
			$clientCountry=mysqli_fetch_array($rsCB);
		   return $clientCountry['name'];
		
		}
	}
}


function get_package_name($id){
	// user name from cms
	$selectaa='pacakageName';
	$whereaa='id="'.$id.'"';
	$rsaa=GetPageRecord($selectaa,_PACKAGE_DETAIL_MASTER_,$whereaa);
	while($userss=mysqli_fetch_array($rsaa)){
		return $userss['pacakageName'];
	}
}


 function makePackageId($id){
	 if($id!=''){
	 	return 'PCK'.str_pad($id, 6, '0', STR_PAD_LEFT);
	 }
 } 
 
function showClientTypeUserNameWithLink($type,$id){

if($type!=2){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return '<a href="showpage.crm?module=corporate&view=yes&id='.encode($id).'" target="_blank" class="maintablist">'.$userss['name'].'</a>';
}
}



if($type==2){
$selectaa='firstName,lastName';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return '<a href="showpage.crm?module=contacts&view=yes&id='.encode($id).'" target="_blank" class="maintablist">'.$userss['firstName'].' '.$userss['lastName'].'</a>';
}
}

}




function formatBytes($bytes, $precision = 2) {
	if($bytes!='0'){
	    if ($bytes > pow(1024,3)) return round($bytes / pow(1024,3), $precision)." GB";
	    else if ($bytes > pow(1024,2)) return round($bytes / pow(1024,2), $precision)." MB";
	    else if ($bytes > 1024) return round($bytes / 1024, $precision)." KB";
	    else return ($bytes)." B";
	} else {
		return '0';
	}
}

function getFileIcon($filetype){

	$mainfile='images/filetype/fileunknown.png';
	if($filetype=='png'){
	$mainfile='images/filetype/filepng.png';
	}
	if($filetype=='docx'){
	$mainfile='images/filetype/filedoc.png';
	}

	if($filetype=='xls'){
	$mainfile='images/filetype/filexls.png';
	}

	if($filetype=='psd'){
	$mainfile='images/filetype/filepsd.png';
	}

	if($filetype=='ppt'){
	$mainfile='images/filetype/fileppt.png';
	}

	if($filetype=='pdf'){
	$mainfile='images/filetype/filepdf.png';
	}

	if($filetype=='mp4'){
	$mainfile='images/filetype/filemp4.png';
	}

	if($filetype=='jpg'){
	$mainfile='images/filetype/filejpeg.png';
	}
	if($filetype=='html'){
	$mainfile='images/filetype/filehtml.png';
	}

	if($filetype=='zip'){
	$mainfile='images/filetype/filezip.png';
	}

	return $mainfile;
}





function getRoomType($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_ROOM_TYPE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function countQueryunreadMails($id){
	if($id!=''){
		$result =mysqli_query (db(),"select id from "._QUERYMAILS_MASTER_." where queryid='".clean($id)."' and description!='' and status=1")  or die(mysqli_error(db()));
		$number =mysqli_num_rows($result);
		return $number;
	}
}

function makeQueryId($id){

	if($id!=''){
		$res=GetPageRecord('*',_QUERY_MASTER_,'id="'.$id.'" and deletestatus=0');
		$result=mysqli_fetch_array($res);

		$queryFinancialYear = $result['financeYear'];
		$diplayId = $result['displayId'];

		$rscms=GetPageRecord('*','companySettingsMaster','id=1');
		$editresultcsm=mysqli_fetch_array($rscms);

		$masterQueryIdSequence=clean($editresultcsm['queryIdSequence']);
		return $masterQueryIdSequence.$queryFinancialYear.'/'.str_pad($diplayId, 6, '0', STR_PAD_LEFT);
	}
}


function makeConfNumber($id){
	if($id!=''){

		$suppautoconfsq=GetPageRecord('*','companySettingsMaster','id=1');
		$supplierAutoConfsq=mysqli_fetch_array($suppautoconfsq);
		$masterSupplierPreSequence=clean($supplierAutoConfsq['supplierpreconfsqId']).date('Y');

		return $masterSupplierPreSequence.str_pad($id, 4, '0', STR_PAD_LEFT);
	}
}

function makeExtensionId($id){
	if($id!=''){
		return 'EXT'.str_pad($id, 6, '0', STR_PAD_LEFT);
	}
}


function makeQuotationId($id){

	if($id!=''){

		$rscms=GetPageRecord('*','companySettingsMaster','id=1');
		$editresultcsm=mysqli_fetch_array($rscms); 
		
		$rsp1=GetPageRecord('queryId,quotationNo,generateNo,status,isTourEx',_QUOTATION_MASTER_,' id="'.$id.'"');
		$quotationData=mysqli_fetch_array($rsp1);
		
		// $queryIdN = makeQueryId($quotationData['queryId']);

		if($quotationData['isTourEx'] == 1){
		$masterQueryIdSequence=clean($editresultcsm['extIdSequence']);
		}else{
		$masterQueryIdSequence=clean($editresultcsm['queryIdSequence']);
		}
		
		$rsp2=GetPageRecord('displayId,id,financeYear',_QUERY_MASTER_,' id="'.clean($quotationData['queryId']).'" order by id desc');
		$queryData=mysqli_fetch_array($rsp2);
		$queryFinancialYear = $queryData['financeYear'];
		if($quotationData['generateNo'] > 0){
 			return $masterQueryIdSequence.$queryFinancialYear.'/'.str_pad($queryData['displayId'], 6, '0', STR_PAD_LEFT)."-".$quotationData['quotationNo']."R".$quotationData['generateNo'];
		}else{
 			return $masterQueryIdSequence.$queryFinancialYear.'/'.str_pad($queryData['displayId'], 6, '0', STR_PAD_LEFT)."-".$quotationData['quotationNo'];
		}

	}
}


function generateVoucherNumber($voucherNo,$clientType,$date){
	if($voucherNo!=''){
		$rscms=GetPageRecord('*','companySettingsMaster',' 1 order by id asc limit 1');
		$editresultcsm=mysqli_fetch_array($rscms);  
		
		if($clientType == 'ClientVoucher'){
			$VoucherNoSequence=clean($editresultcsm['clientVoucherNoSequence']).date('Y',($date));			
			return $VoucherNoSequence.str_pad($voucherNo, 4, '0', STR_PAD_LEFT);
		}else{
			$VoucherNoSequence=clean($editresultcsm['supplierVoucherNoSequence']).date('Y',($date));
			return $VoucherNoSequence.str_pad($voucherNo, 4, '0', STR_PAD_LEFT);
		}
			 	 
	}
} 


function generateInvoiceId($invoiceDate,$invoiceTitle){
	// function generateInvoiceId($queryId,$invoiceTitle){
	// if($queryId!=''){
	if($invoiceDate!=''){
		// $queryQuery2=GetPageRecord('*',_QUERY_MASTER_,' 1 and id="'.$queryId.'"');
		// $queryData2=mysqli_fetch_array($queryQuery2);
		// $financeYear = $queryData2['financeYear'];

		$financeYear = getFinancialYear($invoiceDate);

		if($invoiceTitle==2){
			$invQuery2=GetPageRecord('*',_INVOICE_MASTER_,' 1 and invoiceTitle=2 and proformaInvSq>0 and financeYear="'.$financeYear.'" order by proformaInvSq desc');
			if(mysqli_num_rows($invQuery2)>0){
				$invData2=mysqli_fetch_array($invQuery2);
				$newDispalyId = $invData2['proformaInvSq']+1;
			}else{
				$newDispalyId = 1; 
				//this is the first proformaInvSq of this invoiceTitle
			}
	 	}else{
	 	    echo ' 1  and invoiceTitle=1 and taxInvSq>0 and financeYear="'.$financeYear.'" order by taxInvSq desc';
			$invQuery1=GetPageRecord('*',_INVOICE_MASTER_,' 1  and invoiceTitle=1 and taxInvSq>0 and financeYear="'.$financeYear.'" order by taxInvSq desc');
			if(mysqli_num_rows($invQuery1)>0){
				$invData1=mysqli_fetch_array($invQuery1);
				$newDispalyId = $invData1['taxInvSq']+1;
			}else{
				$newDispalyId = 1; 
				//this is the first taxInvSq of this invoiceTitle
			}
		}
		return $newDispalyId;
	}
}


function makeInvoiceId($invoiceId,$invoiceTitle=1){
 
		$csmQuery=GetPageRecord('*','companySettingsMaster','id=1');
		$csmData=mysqli_fetch_array($csmQuery);

		$rsinv = GetPageRecord('*',_INVOICE_MASTER_,'id="'.$invoiceId.'" and invoiceTitle="'.$invoiceTitle.'" ');
		$invData = mysqli_fetch_assoc($rsinv);
		$financeYear = $invData['financeYear'];

// 		$queryQuery=GetPageRecord('*',_QUERY_MASTER_,'id="'.$invData['queryId'].'"');
// 		$queryData=mysqli_fetch_array($queryQuery);
		
		if($invData['invoiceTitle']==2){
			$invSq = $invData['proformaInvSq'];
		}else{
			$invSq = $invData['taxInvSq'];
		}

		if($invData['invoiceTitle']==2){ 
 			$invSqPrefix = $csmData['proformaInvoiceNoSequence'].'/'.$financeYear; 
		}else{ 
			$invSqPrefix = $csmData['taxInvoiceNoSequence'].'/'.$financeYear;
		}

	if($invoiceId!=''){
		return $invSqPrefix.'/'.str_pad($invSq, 4, '0', STR_PAD_LEFT);
	}
}


function generateCnNo($queryId){
	if($queryId!=''){
		$queryQuery2=GetPageRecord('*',_QUERY_MASTER_,' 1 and id="'.$queryId.'"');
		$queryData2=mysqli_fetch_array($queryQuery2);
 
		$cnnQuery2=GetPageRecord('*','creditNoteMaster',' 1 and queryId in ( select id from queryMaster where 1 and financeYear="'.$queryData2['financeYear'].'" )  and cn_no>0 and deletestatus=0 order by cn_no desc');
		if(mysqli_num_rows($cnnQuery2)>0){
			$cnData2=mysqli_fetch_array($cnnQuery2);
			$newCnNo = $cnData2['cn_no']+1;
		}else{
			$newCnNo = 1; 
		}
 	 
		return $newCnNo;
	}
}

function makeCreditNoteNo($creditNoteId){

	// if(date('m')=="04"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="05"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="06"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="07"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="08"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="09"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="10"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="11"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="12"){
	// 	$financialYear = date('Y').'-'.(date('y')+1);
	// }elseif(date('m')=="01"){
	// 	$financialYear = (date('Y')-1).'-'.date('y');
	// }elseif(date('m')=="02"){
	// 	$financialYear = (date('Y')-1).'-'.date('y');
	// }elseif(date('m')=="03"){
	// 	$financialYear = (date('Y')-1).'-'.date('y');
	// }
 
	// // $rsfinnace=GetPageRecord('*','financeYearMaster',' financeYear="'.$financialYear.'" order by id asc limit 1');
	// // $editfinance=mysqli_fetch_array($rsfinnace); 
	// // $invoiceno = $editfinance['financeYear'];
	$rscr = '';
	$rscr = GetPageRecord('*','creditNoteMaster','id="'.$creditNoteId.'"');
	$crData = mysqli_fetch_assoc($rscr);
 	
 	$rsquery = '';
	$rsquery = GetPageRecord('*','queryMaster','id="'.$crData['queryId'].'"');
	$queryData = mysqli_fetch_assoc($rsquery);
		
	if($creditNoteId!=''){
		return 'CN/'.$queryData['financeYear'].'/'.str_pad($crData['cn_no'], 4, '0', STR_PAD_LEFT);
	}
}


function convertNumberToWordsForIndia($number){
	
  //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
  $words = array(
  '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
  '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
  '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
  '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
  '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
  '80' => 'eighty','90' => 'ninty');
  
  //First find the length of the number
  $number_length = strlen($number);
  //Initialize an empty array
  $number_array = array(0,0,0,0,0,0,0,0,0);        
  $received_number_array = array();
  
  //Store all received numbers into an array
  for($i=0;$i<$number_length;$i++){    
    $received_number_array[$i] = substr($number,$i,1);    
  }

  //Populate the empty array with the numbers received - most critical operation
  for($i=9-$number_length,$j=0;$i<9;$i++,$j++){ 
      $number_array[$i] = $received_number_array[$j]; 
  }

  $number_to_words_string = "";
  //Finding out whether it is teen ? and then multiply by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
  for($i=0,$j=1;$i<9;$i++,$j++){
      //"01,23,45,6,78"
      //"00,10,06,7,42"
      //"00,01,90,0,00"
      if($i==0 || $i==2 || $i==4 || $i==7){
          if($number_array[$j]==0 || $number_array[$i] == "1"){
              $number_array[$j] = intval($number_array[$i])*10+$number_array[$j];
              $number_array[$i] = 0;
          }
             
      }
  }

  $value = "";
  for($i=0;$i<9;$i++){
      if($i==0 || $i==2 || $i==4 || $i==7){    
          $value = $number_array[$i]*10; 
      }
      else{ 
          $value = $number_array[$i];    
      }            
      if($value!=0)         {    $number_to_words_string.= $words["$value"]." "; }
      if($i==1 && $value!=0){    $number_to_words_string.= "Crores "; }
      if($i==3 && $value!=0){    $number_to_words_string.= "Lakhs ";    }
      if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
      if($i==6 && $value!=0){    $number_to_words_string.= "Hundred "; }            

  }
  if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
	return strtoupper(strtolower($number_to_words_string)." Only.");
}
	
// make Receipt number here
function makeReceiptNo($scheduleId){
	if($scheduleId!=''){
		$receiptDate = date('Y').'-'.date('y', strtotime('+1year') );
		return $receiptDate.'/'.str_pad($scheduleId,4, '0', STR_PAD_LEFT);
	}
}
 
function makePaymentId($id){
	if($id!=''){
		return str_pad($id, 6, '0', STR_PAD_LEFT);
	}
}

function getCorporateCompany($id){
	if($id!=''){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
		return $userss['name'];
		}
	}
}


function getsupplierCompany($id){
	if($id!=''){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_SUPPLIERS_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	}
}

function getSelfSupplier(){
 	$selectaa='id';
	$whereaa='name!="" and self=1';
	$rsaa=GetPageRecord($selectaa,_SUPPLIERS_MASTER_,$whereaa);
	$userss=mysqli_fetch_array($rsaa);
	return $userss['id'];
}

function getDestination($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_DESTINATION_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getDepartureDestination($dayId,$quotationId,$queryId=''){
	$rDD = GetPageRecord('*','newQuotationDays','id>"'.$dayId.'" and quotationId="'.$quotationId.'" and queryId="'.$queryId.'" order by id asc');
	if(mysqli_num_rows($rDD)>0){
	$newQDD = mysqli_fetch_assoc($rDD);
	$cityName = getDestination($newQDD['cityId']);
	return $cityName;
	}else{
	$rDD = GetPageRecord('*','newQuotationDays','id="'.$dayId.'" and quotationId="'.$quotationId.'" and queryId="'.$queryId.'" order by id asc');
	if(mysqli_num_rows($rDD)>0){
	$newQDD = mysqli_fetch_assoc($rDD);
	$cityName = getDestination($newQDD['cityId']);
	return $cityName;
	}
}
}

function getDesignation($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_DESIGNATION_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}



function getNameTitle($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_NAME_TITLE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}


function getsuppliersType($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_SUPPLIERS_TYPE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}




function getsuppliersTypeNameList($id){
if($id!=''){
$type='';
$selectaa='*';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_SUPPLIERS_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){

$selectaa2='name';
$whereaa2='id="'.$userss['companyTypeId'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
	$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['airlinesType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['transferType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['entranceType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['activityType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['guideType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['trainType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';
$whereaa2='id="'.$userss['mealType'].'"';
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2);
while($userss2=mysqli_fetch_array($rsaa2)){
$type=$userss2['name'].', '.$type;
}


$selectaac='name';
$whereaac='id="'.$userss['cruiseType'].'"';
$rsaac=GetPageRecord($selectaac,_SUPPLIERS_TYPE_MASTER_,$whereaac);
while($userssc=mysqli_fetch_array($rsaac)){
$type=$userssc['name'].', '.$type;
}
}
 return ltrim(rtrim($type,', '),',');
}
}
 

function getUserName($id){
	if($id!=''){
		$selectaa='firstName,lastName';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_USER_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['firstName'].' '.$userss['lastName'];
		}
	}
}
function getUserType($id){
	if($id!=''){
		$selectaa='userType';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_USER_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['userType'];
		}
	}
}

function getUserEmailById($id){
	if($id!=''){
		$selectaa='email';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_USER_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['email'];
		}
	}
}

function getCountryName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_COUNTRY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getcountry($id){
if($id!=''){
$selectaa='countryId';
$whereaa='addressParent="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_ADDRESS_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
$c_country_id = $userss['countryId'];
}
return getCountryName($c_country_id);
}
}


function getStateName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_STATE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getstate($id){
if($id!=''){
$selectaa='stateId';
$whereaa='addressParent="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_ADDRESS_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
$c_state_id = $userss['stateId'];
}
return getStateName($c_state_id);
}
}


function getCityName($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_CITY_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}

function getcity($id){
	if($id!=''){
		$selectcaa='cityId';
		$wherecaa='addressParent="'.$id.'"';
		$rscaa=GetPageRecord($selectcaa,_ADDRESS_MASTER_,$wherecaa);
		while($usercss=mysqli_fetch_array($rscaa)){
			$c_id = $usercss['cityId'];
		}
	 	return getCityName($c_id);
	}
}



function getPhoneType($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,_PHONE_TYPE_MASTER_,$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}

}


function getEmailType($id){
	if($id!=''){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_EMAIL_TYPE_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	}
}
 
function getMultiPrimaryEmail($id,$sectionType){
	$mailsreturn='';
	if($id!='' && $sectionType=='contacts'){
		$selectaa='email';
		$whereaa='masterId="'.$id.'" and sectionType="'.$sectionType.'" limit 1';
		//and primaryvalue=1
		$rsaa=GetPageRecord($selectaa,_EMAIL_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
		 	$mailsreturn.=$userss['email'].',';
		}
		return rtrim($mailsreturn,',');
	}
	if($id!='' && $sectionType=='suppliers'){
		$selectaa='email';
		$whereaa='corporateId="'.$id.'"  and contactPerson!="" and deletestatus=0 limit 1';
		$rsaa=GetPageRecord($selectaa,'suppliercontactPersonMaster',$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
		 	$mailsreturn.=decode($userss['email']).',';
		}
		return rtrim($mailsreturn,',');
	}
	if($id!='' && $sectionType=='corporate'){
		$selectaa='email';
		$whereaa='corporateId="'.$id.'"  and contactPerson!="" and deletestatus=0';
		$rsaa=GetPageRecord($selectaa,'contactPersonMaster',$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
		 	$mailsreturn.=decode($userss['email']).',';
		}
		return rtrim($mailsreturn,',');
	}
	if($id!='' && $sectionType=='hotel'){
		$selectaa='email';
		$whereaa='corporateId="'.$id.'"  and contactPerson!="" and deletestatus=0';
		$rsaa=GetPageRecord($selectaa,'hotelContactPersonMaster',$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
		 	$mailsreturn.=$userss['email'].',';
		}
		return rtrim($mailsreturn,',');
	}

}

function GetHSNCode($id){
	$resHSN = GetPageRecord('*','sacCodeMaster','status=1 and deletestatus=0 and id="'.$id.'"');
	if(mysqli_num_rows($resHSN)>0){
	 $HSNData = mysqli_fetch_assoc($resHSN);
	 $hsnCode = $HSNData['serviceType'].' ('.$HSNData['sacCode'].')';
	 return $hsnCode;
	}
}

// new function for contact persons email and phone
function getContactPersonPhone($contactPId,$sectionType){
	if($contactPId!='' && $sectionType=='corporate'){
		$contSql='';
		$contSql='id="'.$contactPId.'"';
		$contQuery=GetPageRecord('phone','contactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return decode($contD['phone']);
	}
	if($contactPId!='' && $sectionType=='suppliers'){
		$contSql='';
		$contSql='corporateId="'.$contactPId.'"';
		$contQuery=GetPageRecord('phone','suppliercontactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return decode($contD['phone']);
	}
	if($contactPId!='' && $sectionType=='hotel'){
		$contSql='';
		$contSql='corporateId="'.$contactPId.'" and contactPerson!="" and deletestatus=0 order by primaryvalue,division desc';
		$contQuery=GetPageRecord('phone','hotelContactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return ($contD['phone']);
	}
	if($contactPId!='' && $sectionType=='contacts'){
		$selectaa='phoneNo';
		$whereaa='masterId="'.$contactPId.'" and sectionType="'.$sectionType.'" and primaryvalue=1 limit 1';
		$rsaa=GetPageRecord($selectaa,_PHONE_MASTER_,$whereaa);
		$userss=mysqli_fetch_array($rsaa);
		return $userss['phoneNo'];
	}
}

function getContactPersonEmail($contactPId,$sectionType){
	if($contactPId!='' && $sectionType=='corporate'){
		$contSql='';
		$contSql='id="'.$contactPId.'"';
		$contQuery=GetPageRecord('email','contactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return decode($contD['email']);
	}
	if($contactPId!='' && $sectionType=='suppliers'){ 
		$contSql='';
		$contSql='corporateId="'.$contactPId.'" order by division desc';
		$contQuery=GetPageRecord('email','suppliercontactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return decode($contD['email']);
	}
	if($contactPId!='' && $sectionType=='hotel'){
		$contSql='';
		$contSql='corporateId="'.$contactPId.'" and contactPerson!="" and deletestatus=0 order by primaryvalue,division desc';
		$contQuery=GetPageRecord('email','hotelContactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return ($contD['email']);
	}
	if($contactPId!='' && $sectionType=='contacts'){
		$selectaa='email';
		$whereaa='masterId="'.$contactPId.'" and sectionType="'.$sectionType.'" limit 1';
		$rsaa=GetPageRecord($selectaa,_EMAIL_MASTER_,$whereaa);
		$userss=mysqli_fetch_array($rsaa);
		return $userss['email'];
	}
} 

function getSuppEmailByContactPId($contactPId){
	
	if($contactPId>0){ 
		$contSql='';
		$contSql='id="'.$contactPId.'"';
		$contQuery=GetPageRecord('email','suppliercontactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		if(isValidEmail(decode($contD['email'])) == true){
			return decode($contD['email']);
		}
		return false;
	}
} 
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
}

function getContactPersonName($contactPId,$sectionType){
	if($contactPId!='' && $sectionType=='corporate'){
		$contSql='';
		$contSql='corporateId="'.$contactPId.'"';
		$contQuery=GetPageRecord('firstName,lastName','contactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return $contD['firstName'].' '.$contD['lastName'];
	}
	if($contactPId!='' && $sectionType=='suppliers'){
	
		$contSql='';
		$contSql='id="'.$contactPId.'"';
		$contQuery=GetPageRecord('firstName,lastName','suppliercontactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return $contD['firstName'].' '.$contD['lastName'];
	}
	if($contactPId!='' && $sectionType=='hotel'){
		$contSql='';
		$contSql='corporateId="'.$contactPId.'" and contactPerson!="" and deletestatus=0 order by primaryvalue,division desc';
		$contQuery=GetPageRecord('contactPerson','hotelContactPersonMaster',$contSql);
		$contD=mysqli_fetch_array($contQuery);
		return $contD['firstName'].' '.$contD['lastName'];
	}
	if($contactPId!='' && $sectionType=='contacts'){
		$selectaa='firstName,lastName';
		$whereaa='masterId="'.$contactPId.'" and sectionType="'.$sectionType.'" ';
		//and primaryvalue=1
		$rsaa=GetPageRecord($selectaa,_EMAIL_MASTER_,$whereaa);
		$userss=mysqli_fetch_array($rsaa);
		return strip($userss['firstName'].' '.$userss['lastName']);
	}
} 



//-----------------Paging Listing-----------------
function GetRecordList($select,$tablename,$where,$limit,$page,$targetpage){

	if(is_numeric($page) && $page!=''){
		$page=$page;
	} else {
		$page=1;
	}

	if(is_numeric($limit) && $limit!=''){
		$limit=$limit;
	} else {
		$limit=25;
	}
	$query = "SELECT COUNT(*) as num FROM ".$tablename."  ".$where."";
	$total_pages = mysqli_fetch_array(mysqli_query(db(),$query));
	$total_pages = $total_pages['num'];
	$stages = 3;
	if($page){
	$start = ($page - 1) * $limit;
	}else{
	$start = 0;
	}
	$query1 = "SELECT ".$select." FROM ".$tablename."  ".$where." LIMIT $start,  ".$limit."";
	$result=mysqli_query(db(),$query1) or die(mysqli_error(db()));
	//--------------paging--------------------
	if ($page == 0){$page = 1;}
	$prev = $page - 1;
	$next = $page + 1;

	$lastpage = ceil($total_pages/$limit);

	$LastPagem1 = $lastpage - 1;

	$paginate = '';

	if($lastpage > 1)

	{

		$paginate .= "<div class='paginate'>";

	if ($page > 1){

		$paginate.= "<a href='".$targetpage."page=$prev'>Previous</a>";

	}else{

		$paginate.= "<span class='disabled'>Previous</span>";	}



	if ($lastpage < 7 + ($stages * 2))

	{

	for ($counter = 1; $counter <= $lastpage; $counter++)

	{

	if ($counter == $page){

		$paginate.= "<span class='current'>$counter</span>";

	}else{

		$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

	}

}

elseif($lastpage > 5 + ($stages * 2))

{

if($page < 1 + ($stages * 2))

{

for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a href='".$targetpage."page=$LastPagem1'>$LastPagem1</a>";

$paginate.= "<a href='".$targetpage."page=$lastpage'>$lastpage</a>";

}

elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))

{

$paginate.= "<a href='".$targetpage."page=1'>1</a>";

$paginate.= "<a href='".$targetpage."page=2'>2</a>";

$paginate.= "...";

for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a href='".$targetpage."page=$LastPagem1'>$LastPagem1</a>";

$paginate.= "<a href='".$targetpage."page=$lastpage'>$lastpage</a>";

}

else

{

$paginate.= "<a href='".$targetpage."page=1'>1</a>";

$paginate.= "<a href='".$targetpage."page=2'>2</a>";

$paginate.= "...";

for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

}

} if ($page < $counter - 1){

$paginate.= "<a href='".$targetpage."page=$next'>Next</a>";

}else{

$paginate.= "<span class='disabled'>Next</span>";

}

$paginate.= "</div>";

}

return array($result,$total_pages,$paginate);

}

function senderror($data){
// mail("rohit.debox@gmail.com","Error Reporting From Debox CRM - ".date('d/m/Y h:i a')."",$data);
}
//----------------Get Record---------------------

function GetPageRecord($select,$tablename,$where){
	$sql="select ".$select." from ".$tablename." where ".$where."";
	$rs=mysqli_query(db(),$sql) or die(mysqli_error(db()));
	return $rs;
}

//----------------Delete Record---------------------
function deleteRecord($tablename,$where){
	$sql="delete  from ".$tablename." where ".$where."";
	mysqli_query(db(),$sql) or die(mysqli_error(db()));
}
//----------------Clear String---------------------

function clean($string){
	$string=trim($string);
	return addslashes($string);
}
//----------------Strip String---------------------

function strip($string){
	return stripslashes(trim($string));
}





function addslash($string){

return addslashes(trim($string));

}



//----------------Login---------------------

 

function login($username,$password){
$cip=$_SERVER['REMOTE_ADDR'];
$clogin=date('Y-m-d H:i:s');
$loginDate=date('Y-m-d');
$loginTime=date('H:i:s');
$conn = db();
$sql = "select * from "._USER_MASTER_." where email='".$username."' and  password='".md5($password)."' and status=1 ";
$rs=mysqli_query($conn,$sql);
$number =mysqli_num_rows($rs);
	if($number>0){

$select='';
$where='';
$rs='';
$select='profileId,cLogin,lLogin,id,currentIp,lastIp';
$where="email='".$username."' and  password='".md5($password)."'";
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$userinfo=mysqli_fetch_array($rs);
$cLogin=$userinfo['cLogin'];
$currentIp=$userinfo['currentIp'];
$id=$userinfo['id'];
$randnum = mt_rand(100000, 999999);
$uSession=$randnum;

$_SESSION['userid']=$id;
$_SESSION['username']=$username;
$_SESSION['sessionid']=session_id();
$_SESSION['uSession']=$uSession;

$namevalue ='userId="'.$_SESSION['userid'].'",ipAddress="'.$cip.'",dateAdded="'.$loginDate.'",loginTime="'.$loginTime.'"';

$add = addlisting('loginDetailMaster',$namevalue);

$profileeeeeeDataq=GetPageRecord('id','profileMaster',"1 and id='".$userinfo['profileId']."' and (adminDashboard=1 or salesDashboard=1 or operationsDashboard=1 or accountDashboard=1)");
$countprofileData=mysqli_num_rows($profileeeeeeDataq);

$profileeeDataq=GetPageRecord('adminDashboard,salesDashboard,operationsDashboard,accountDashboard','profileMaster',"1 and id='".$userinfo['profileId']."'");
$profileeeData=mysqli_fetch_array($profileeeDataq);


if($countprofileData>0){
if($profileeeData['operationsDashboard']==1){
  $_SESSION['dashboardid']=3;  
} 
if($profileeeData['salesDashboard']==1){
  $_SESSION['dashboardid']=2;  
}
if($profileeeData['accountDashboard']==1){
  $_SESSION['dashboardid']=4;  
}
if($profileeeData['adminDashboard']==1){
  $_SESSION['dashboardid']=1;  
}
} else{
$_SESSION['dashboardid']=1; 
}  
$sql_ins="update "._USER_MASTER_." set lLogin='$cLogin',lastIp='$currentIp',cLogin='$clogin',currentIp='$cip',uSession='".$uSession."' where id=".$_SESSION['userid']."";
mysqli_query(db(),$sql_ins);

 return 'yes';

 }
	else{
		return "no";
	}
}






function deletelist($tablename,$check_list,$userid){

if($check_list!=""){

for($i=0;$i<=count($check_list)-1;$i++)

{

$ansval=trim($check_list[$i]);

if(trim($ansval) != ''){



if($userid==''){

$sql_del="delete from ".$tablename."  where id='".$ansval."'";

mysqli_query(db(),$sql_del) or die(mysqli_error(db()));



} else {



$sql_del="delete from ".$tablename."  where id='".$ansval."' and userid ='".$userid."'";

mysqli_query(db(),$sql_del) or die(mysqli_error(db()));



}



} } }



return 'yes';

}









function encode($string)

{

$encoded = base64_encode(base64_encode(base64_encode($string)));

return  $encoded;
}



function decode($string){

$decoded = base64_decode(base64_decode(base64_decode($string)));

return  $decoded;
}



function addlistinggetlastid($tablename,$namevalue){

$sql_ins="insert into ".$tablename." set ".$namevalue."";
mysqli_query(db(),$sql_ins) or die(mysqli_error(db()));

return mysqli_insert_id(db());

}





function addlisting($tablename,$namevalue){

$sql_ins="insert into ".$tablename." set ".$namevalue."";
mysqli_query(db(),$sql_ins) or die(mysqli_error(db()));

return 'yes';

}





function updatelisting($tablename,$namevalue,$where){

$sql_ins="update ".$tablename." set ".$namevalue." where ".$where."";

mysqli_query(db(),$sql_ins) or die(mysqli_error(db()));

return 'yes';

}



function errorlogGenerateQuotation($msg,$newfilez){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName'];


 	$ip = get_client_ip();

	$log_filename = "log_generate";
	if (!file_exists($log_filename))
	{
	mkdir($log_filename, 0755, true);
	}
	$log  = $msg;
	file_put_contents($log_filename.'/'.$newfilez.'.html', $log, FILE_APPEND);

}



function countlisting($select,$tablename,$where){

$sql_ins="SELECT ".$select." FROM ".$tablename."  ".$where."";

$sql_ins1 = mysqli_query(db(),$sql_ins);

$totalcount=mysqli_num_rows($sql_ins1);

return $totalcount;

}







function checkduplicate($tablename,$where){
	$result =mysqli_query (db(),"select * from ".$tablename." where ".$where."")  or die(mysqli_error(db()));
	$number =mysqli_num_rows($result);
	if($number>0){
		return 'yes';
	} else {
		return 'no';
	}
}





function substrstring($string,$lenth){
return substr($string, 0, $lenth);
}











// get Menu Id



function getMenuId($isId)

{

   if($isId=="")

   {

        $url = 'http://'. $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];

		$path = parse_url($url, PHP_URL_PATH);

		$file_name = basename($path);

		$rs =mysqli_query (db(),"select id from "._menu_master_." where link ='".$file_name."'")  or die(mysqli_error(db()));

		$result=mysqli_fetch_array($rs);

		return $result['id'];



   } else {



     return $isId;

   }



}







function checkduplicateentry($tablename,$select,$where){



$result = mysqli_query (db(),"select ".$select." from ".$tablename."  ".$where."")  or die(mysqli_error(db()));

$number = mysqli_num_rows($result);

if($number>0)

{

return  'yes';

} else {

return  'no';

}





}
















function image_fix_orientation($filename) {
    $exif = exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        imagejpeg($image, $filename, 90);
    }
}









function imageResize($image, $thumb_width, $new_filename)
{
  $max_width = $thumb_width;
  //Check if GD extension is loaded
  if (!extension_loaded('gd') && !extension_loaded('gd2')) {
    trigger_error("GD is not loaded", E_USER_WARNING);
    return false;
  }
  //Get Image size info
  list($width_orig, $height_orig, $image_type) = getimagesize($image);
  switch ($image_type) {
    case 1:
      $im = imagecreatefromgif($image);
      break;
    case 2:
      $im = imagecreatefromjpeg($image);
      break;
    case 3:
      $im = imagecreatefrompng($image);
      break;
    default:
      trigger_error('Unsupported filetype!', E_USER_WARNING);
      break;
  }
  //calculate the aspect ratio
  $aspect_ratio = (float) $height_orig / $width_orig;
  //calulate the thumbnail width based on the height
  $thumb_height = round($thumb_width * $aspect_ratio);
  while ($thumb_height > $max_width) {
    $thumb_width -= 10;
    $thumb_height = round($thumb_width * $aspect_ratio);
  }
  $new_image = imagecreatetruecolor($thumb_width, $thumb_height);
  //Check if this image is PNG or GIF, then set if Transparent
  if (($image_type == 1) OR ($image_type == 3)) {
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
    $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
    imagefilledrectangle($new_image, 0, 0, $thumb_width, $thumb_height, $transparent);
  }
  imagecopyresampled($new_image, $im, 0, 0, 0, 0, $thumb_width, $thumb_height, $width_orig, $height_orig);
  //Generate the file, and rename it to $new_filename
  switch ($image_type) {
    case 1:
      imagegif($new_image, $new_filename);
      break;
    case 2:
      imagejpeg($new_image, $new_filename);
      break;
    case 3:
      imagepng($new_image, $new_filename);
      break;
    default:
      trigger_error('Failed resize image!', E_USER_WARNING);
      break;
  }
  return $new_filename;
}










function resize($img){
/*
only if you script on another folder get the file name*/
$r =explode("../",$img);
$name=end($r);


$vdir_upload = '../upload/thumb/';
list($width_orig, $height_orig) = getimagesize($img);
//ne size
$dst_width = 150;
$dst_height = ($dst_width/$width_orig)*$height_orig;
$im = imagecreatetruecolor($dst_width,$dst_height);
$image = imagecreatefromjpeg($img);
imagecopyresampled($im, $image, 0, 0, 0, 0, $dst_width, $dst_height, $width_orig, $height_orig);
//modive the name as u need
imagejpeg($im,$vdir_upload . "small" .$datef. $name);
//save memory
imagedestroy($im);
}





function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $thumbnail_image_width, $source_image_height)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = $thumbnail_image_width / $thumbnail_image_height;
    if ($source_image_width <= $thumbnail_image_width && $source_image_height <= $thumbnail_image_height) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) ($thumbnail_image_height * $source_aspect_ratio);
        $thumbnail_image_height = $thumbnail_image_height;
    } else {
        $thumbnail_image_width = $thumbnail_image_width;
        $thumbnail_image_height = (int) ($thumbnail_image_width / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

    $img_disp = imagecreatetruecolor($thumbnail_image_width,$thumbnail_image_width);
    $backcolor = imagecolorallocate($img_disp,0,0,0);
    imagefill($img_disp,0,0,$backcolor);

        imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));

    imagejpeg($img_disp, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    imagedestroy($img_disp);
    return true;
}

function generateLogs($sectionType,$sectionAction,$sectionId){


$select='superParentId';
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);
$loginusersuperParentId=$LoginUserDetails['superParentId'];



$dateAdded=time();
$namevalue ='userId="'.$loginusersuperParentId.'",modifyBy="'.$_SESSION['userid'].'",sectionType="'.$sectionType.'",sectionAction="'.$sectionAction.'",sectionId="'.$sectionId.'",modifyDate="'.$dateAdded.'"';
$sql_ins="insert into "._SYSTEM_LOGS_MASTER_." set ".$namevalue."";
mysqli_query(db(),$sql_ins) or die(mysqli_error(db()));
return 'yes';
}


function datetimemix($date){
return date('j F Y, g:i A', $date);
}

function dateDMY($date){
return date('d-m-Y', $date);
}


function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}


function makedatetime($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . '';
        }
    }
}


function getCurrencyName($id){
	if($id!=''){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_QUERY_CURRENCY_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	}
}
 

function getChangeCurrencyValue($id,$changeid,$valuefield){

	if($id!='' && $changeid!=''){
		$selectaa='currencyValue';
		$whereaa='currencyFrom="'.$id.'" and currencyTo="'.$changeid.'" ';
		$rsaa=GetPageRecord($selectaa,_CURRENCY_CONVERSION_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			$cr1= $userss['currencyValue'];
		}
		if($id!='' && $changeid!=''){
			$selectaa='currencyValue';
			$whereaa='currencyTo="'.$id.'" and currencyFrom="'.$changeid.'" ';
			$rsaa=GetPageRecord($selectaa,_CURRENCY_CONVERSION_MASTER_,$whereaa);
			while($userss=mysqli_fetch_array($rsaa)){
				$cr2= $userss['currencyValue'];
			}
			if($cr1!='' && $cr2!=''){
				if($cr1<$cr2){
					$finalvalue=$valuefield*$cr2;
				} else {
					$finalvalue=$valuefield/$cr1;
				}
			} else {
				$finalvalue=$valuefield;
			}
		}
	}

	return $finalvalue;

}

function getNight($fromDate,$toDate){
	$date1 = new DateTime($fromDate);
	$date2 = new DateTime($toDate);
	$numberOfNights= $date2->diff($date1)->format("%a");
	return $numberOfNights;
}


function nv_get_plaintext( $string, $keep_image = true, $keep_link = true ){
    // Get image tags
    if( $keep_image )
    {
        if( preg_match_all( "/\<img[^\>]*src=\"([^\"]*)\"[^\>]*\>/is", $string, $match ) )
        {
            foreach( $match[0] as $key => $_m )
            {
                $textimg = '';
                if( strpos( $match[1][$key], 'data:image/png;base64' ) === false )
                {
                    $textimg = " " . $match[1][$key];
                }
                if( preg_match_all( "/\<img[^\>]*alt=\"([^\"]+)\"[^\>]*\>/is", $_m, $m_alt ) )
                {
                    $textimg .= " " . $m_alt[1][0];
                }
                $string = str_replace( $_m, $textimg, $string );
            }
        }
    }

    // Get link tags
    if( $keep_link )
    {
        if( preg_match_all( "/\<a[^\>]*href=\"([^\"]+)\"[^\>]*\>(.*)\<\/a\>/isU", $string, $match ) )
        {
            foreach( $match[0] as $key => $_m )
            {
                $string = str_replace( $_m, $match[1][$key] . " " . $match[2][$key], $string );
            }
        }
    }

    $string = str_replace( ' ', ' ', strip_tags( $string ) );
    return preg_replace( '/[ ]+/', ' ', $string );
}







function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


function errorlog($msg,$newfilez){ 
	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName']; 
 	$ip = get_client_ip(); 
	$log_filename = "log_hotel";
	if (!file_exists($log_filename))
	{
	mkdir($log_filename, 0755, true);
	}
	$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	file_put_contents($log_filename.'/'.$newfilez.'.log', $log, FILE_APPEND);
}


function errorlogc($msg,$newfilez){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName'];


 	$ip = get_client_ip();

	$log_filename = "currency_log";
	if (!file_exists($log_filename))
	{
	mkdir($log_filename, 0755, true);
	}
	$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	file_put_contents($log_filename.'/'.$log_filename.'_'.date("Y_m_d").'_'.$newfilez.'.log', $log, FILE_APPEND);

	}
function transporterrorlog($msg,$newfilez){

$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
$userdetails=mysqli_fetch_array($rsasd);
$username=$userdetails['firstName'].' '.$userdetails['lastName'];

$ip = get_client_ip();

$log_filename = "log_transport";
if (!file_exists($log_filename))
{
mkdir($log_filename, 0755, true);
}
$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
file_put_contents($log_filename.'/'.$log_filename.'_'.date("Y_m_d").'_'.$newfilez.'.log', $log, FILE_APPEND);

}

function transfer_errorlog($msg,$newfilez){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName']; 
	$ip = get_client_ip(); 
	$log_filename = "log_transfer";
	if (!file_exists($log_filename))
	{
		mkdir($log_filename, 0755, true);
	}
	$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	file_put_contents($log_filename.'/'.$log_filename.'_'.date("Y_m_d").'_'.$newfilez.'.log', $log, FILE_APPEND);

}


function errorlogssx($msg,$newfilez){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName'];


 	$ip = get_client_ip();

	$log_filename = "itineraryTitle_log";
	if (!file_exists($log_filename))
	{
	mkdir($log_filename, 0755, true);
	}
	$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	file_put_contents($log_filename.'/'.$log_filename.'_'.date("Y_m_d").'_'.$newfilez.'.log', $log, FILE_APPEND);

}
function errorlogg($msg,$newfilez){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName'];


 	$ip = get_client_ip();

	$log_filename = "guide_log";
	if (!file_exists($log_filename))
	{
	mkdir($log_filename, 0755, true);
	}
	$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	file_put_contents($log_filename.'/'.$log_filename.'_'.date("Y_m_d").'_'.$newfilez.'.log', $log, FILE_APPEND);

}
function errorlogdr($msg,$newfilez){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName'];


 	$ip = get_client_ip();

	$log_filename = "driver_log";
	if (!file_exists($log_filename))
	{
	mkdir($log_filename, 0755, true);
	}
	$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	file_put_contents($log_filename.'/'.$log_filename.'_'.date("Y_m_d").'_'.$newfilez.'.log', $log, FILE_APPEND);

}
function errorloggsub($msg,$newfilez){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName'];


 	$ip = get_client_ip();

	$log_filename = "guidesub_log";
	if (!file_exists($log_filename))
	{
	mkdir($log_filename, 0755, true);
	}
	$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	file_put_contents($log_filename.'/'.$log_filename.'_'.date("Y_m_d").'_'.$newfilez.'.log', $log, FILE_APPEND);

}
function errorlogd($msg,$newfilez){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName'];


 	$ip = get_client_ip();

	$log_filename = "description_log";
	if (!file_exists($log_filename))
	{
	mkdir($log_filename, 0755, true);
	}
	$log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	file_put_contents($log_filename.'/'.$log_filename.'_'.date("Y_m_d").'_'.$newfilez.'.log', $log, FILE_APPEND);

}
function makeTourId($id){
	if($id!=''){
		return 'TI'.str_pad($id, 6, '0', STR_PAD_LEFT);
	}
}

function getVehicleTypeName($id){
	if($id!=''){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,'vehicleTypeMaster',$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	}
}
function getTransferType($id){
	if($id!=''){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,'transferTypeMaster',$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	}
}


function importErrorlog($msg,$errTime,$folderName){

	$rsasd=GetPageRecord('firstName,lastName',_USER_MASTER_,'id="'.$_SESSION['userid'].'"');
	$userdetails=mysqli_fetch_array($rsasd);
	$username=$userdetails['firstName'].' '.$userdetails['lastName'];
	$ip = get_client_ip();
	$log_folderName = $folderName;
	if (!file_exists($log_folderName)){
		mkdir($log_folderName, 0755, true);
	}
	 $log  = $msg.', Added by- '.trim($username).', IP Address- '.$ip.PHP_EOL;
	// $log_folderName.'/'.$log_folderName.'_'.date("Y_m_d").'_'.$errTime.'.log', $log, FILE_APPEND;
	file_put_contents($log_folderName.'/'.$log_folderName.'_'.date("Y_m_d").'_'.$errTime.'.log', $log, FILE_APPEND);

}

// function makeQueryTourId($id){
// 	if($id!=''){
// 		$rs=GetPageRecord('fromDate,monthTourId,queryConfirmedBy,financeYear',_QUERY_MASTER_,' id="'.$id.'" and monthTourId>0');
// 		$queryData=mysqli_fetch_array($rs);
// 		$myArray = explode('-',$queryData['financeYear']);
// 		$currentFinanceYear = $myArray['0'];
// 		$rsasd=GetPageRecord('usercode',_USER_MASTER_,'id="'.$queryData['queryConfirmedBy'].'"');
// 		$userdetails=mysqli_fetch_array($rsasd);
// 		//queryConfirmingDate old column
// 		return date('y/m/',strtotime($queryData['fromDate'])).str_pad($queryData['monthTourId'], 4, '0', STR_PAD_LEFT).'/'.$userdetails['usercode'];
// 	}
// }

// ALTER TABLE `queryMaster` CHANGE `queryConfirmingTourId` `monthTourId` INT(11) NOT NULL DEFAULT '0';

function generateQueryTourId($quotationId){
	
	if($quotationId!=''){

		$csmQuery=GetPageRecord('*','companySettingsMaster','id=1');
		$csmData=mysqli_fetch_array($csmQuery);
		$tourIdSequence = $csmData['tourIdSequence'];

		$quotationQuery=GetPageRecord('*',_QUOTATION_MASTER_,'id="'.$quotationId.'"');
		$quotationData=mysqli_fetch_array($quotationQuery);  


		// getting the next tourNo 
		// we will store both type tourd Id 

		// month wise cycle
		$querySql1=' deletestatus=0 and MONTH(fromDate)="'.date('m',strtotime($quotationData['fromDate'])).'" and YEAR(fromDate)="'.date('Y',strtotime($quotationData['fromDate'])).'" and queryConfirmingDate!="NULL" order by monthTourId desc';
		$queryQuery1=GetPageRecord('id,monthTourId',_QUERY_MASTER_,$querySql1); 
		
		if(mysqli_num_rows($queryQuery1)>0){
			$queryData1=mysqli_fetch_array($queryQuery1);
			$monthTourId = $queryData1['monthTourId']+1;
		}else{
			$monthTourId = 1;
		}
		

		$financeYear = getFinancialYear($quotationData['fromDate']);

		$querySql2=' deletestatus=0 and financeYear="'.$financeYear.'" and queryConfirmingDate!="NULL" order by yearTourId desc';
		$queryQuery2=GetPageRecord('id,yearTourId',_QUERY_MASTER_,$querySql2); 
		if(mysqli_num_rows($queryQuery2)>0){
			$queryData2=mysqli_fetch_array($queryQuery2);
			$yearTourId = $queryData2['yearTourId']+1;
		}else{
			$yearTourId = 1;
		}
		// got the next tourNo

		//update tour Ids and closing and tour confirming date 
		return updatelisting(_QUERY_MASTER_,'queryCloseDate="'.date('Y-m-d').'",queryConfirmingDate="'.date('Y-m-d').'",monthTourId="'.$monthTourId.'",yearTourId="'.$yearTourId.'",queryConfirmedBy="'.$_SESSION['userid'].'"','id="'.$quotationData['queryId'].'"');

	}

}

function generateQueryId($tourDate){
	
	if($tourDate!=''){

		$csmQuery=GetPageRecord('*','companySettingsMaster','id=1');
		$csmData=mysqli_fetch_array($csmQuery);
		$tourIdSequence = $csmData['tourIdSequence'];
 
		$financeYear = getFinancialYear($tourDate);
 		// echo ' 1 and financeYear="'.$financeYear.'" and displayId>0 and deletestatus=0 order by id desc';
		$qQuery2=GetPageRecord('*',_QUERY_MASTER_,' 1 and financeYear="'.$financeYear.'" and displayId>0 and deletestatus=0 order by id desc');
		if(mysqli_num_rows($qQuery2)>0){
			$queryData2=mysqli_fetch_array($qQuery2);
			$newDispalyId = $queryData2['displayId']+1;
		}else{
			$newDispalyId = 1; //this is the first displayId of this financeyear
		}
		return $newDispalyId;
	}
}

function getFinancialYear($tourDate){
	$fyQuery='';
	$fyQuery=GetPageRecord('*','financeYearMaster',' 1 and "'.date('Y-m-d',strtotime($tourDate)).'" BETWEEN fromDate and toDate and status=1 and deletestatus=0');
	if(mysqli_num_rows($fyQuery)>0){
        $fyData = mysqli_fetch_array($fyQuery);
		$financeYear = $fyData['financeYear'];
	}else{
		// if financeYearMaster does not have entry
		if(date('m')=="04"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="05"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="06"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="07"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="08"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="09"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="10"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="11"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="12"){
			$financeYear = date('y').'-'.(date('y')+1);
		}elseif(date('m')=="01"){
			$financeYear = (date('y')-1).'-'.date('y');
		}elseif(date('m')=="02"){
			$financeYear = (date('y')-1).'-'.date('y');
		}elseif(date('m')=="03"){
			$financeYear = (date('y')-1).'-'.date('y');
		} 
	}
	return $financeYear;
}

function getfinancialYearMaster($date){
	$fyQuery='';
	$fyQuery=GetPageRecord('*','financeYearMaster',' 1 and "'.date('Y-m-d',strtotime($date)).'" BETWEEN fromDate and toDate and status=1 and deletestatus=0');
	if(mysqli_num_rows($fyQuery)>0){
        $fyData = mysqli_fetch_array($fyQuery);
	} 
	return $fyData;
}

function makeQueryTourId($queryId){
	if($queryId!=''){

		$csmQuery=GetPageRecord('*','companySettingsMaster','id=1');
		$csmData=mysqli_fetch_array($csmQuery);
		$tourIdSequence = $csmData['tourIdSequence'];

		$querySql2=GetPageRecord('fromDate,queryConfirmedBy,monthTourId,yearTourId,financeYear',_QUERY_MASTER_,' id="'.$queryId.'" ');
		$queryData2=mysqli_fetch_array($querySql2);
		// $myArray = explode('-',$queryData2['financeYear']);
		// $currentFinanceYear = $myArray['0'];
		$userQuery=GetPageRecord('usercode',_USER_MASTER_,'id="'.$queryData2['queryConfirmedBy'].'"');
		$userData=mysqli_fetch_array($userQuery);

		if($tourIdSequence == 2 && $queryData2['yearTourId']>0 ){
			return date('y/m/',strtotime($queryData2['fromDate'])).str_pad($queryData2['yearTourId'], 4, '0', STR_PAD_LEFT).'/'.$userData['usercode'];
		}else{
			return date('y/m/',strtotime($queryData2['fromDate'])).str_pad($queryData2['monthTourId'], 4, '0', STR_PAD_LEFT).'/'.$userData['usercode'];
		}

	
		// fy month wise cycle
		// 23/09/0001/ad
		// 23/09/0002/ad
		// 23/10/0001/ad
		// 23/10/0002/ad
		// 23/10/0003/ad

		// fy year wise cycle
		// 22/09/0001/ad
		// 22/09/0002/ad
		// 22/10/0003/ad
		// 22/10/0004/ad
		// 22/10/0005/ad
	}
 	
}

function getMealPlanName($id){
	
	$rs=GetPageRecord('*',_MEAL_PLAN_MASTER_,'name!="" and deletestatus=0 and status=1 and id="'.$id.'"'); 
	$resListing=mysqli_fetch_array($rs);
	return $resListing['name'];
}

function getSupplierName($id){
	$rs=GetPageRecord('*',_SUPPLIERS_MASTER_,' id="'.$id.'" and status=1 and deletestatus=0 and name!="" '); 
		$supplierData=mysqli_fetch_array($rs); 
		return addslashes($supplierData['name']);	
}

function makeSeriesTourId($id){
	if($id!=''){
		$rs=GetPageRecord('fromDate,ConfirmedTourId,ConfirmedBy',_QUOTATION_MASTER_,' id="'.$id.'" and ConfirmedTourId>0');
		$quotationData=mysqli_fetch_array($rs);
		
		$rsasd=GetPageRecord('usercode',_USER_MASTER_,'id="'.$quotationData['ConfirmedBy'].'"');
		$userdetails=mysqli_fetch_array($rsasd);
		//queryConfirmingDate old column
		return date('y/m/',strtotime($quotationData['fromDate'])).str_pad($quotationData['ConfirmedTourId'], 4, '0', STR_PAD_LEFT).'/'.$userdetails['usercode'];
	
		
	}
}



function getMarketType($id){
	if($id!=''){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,'marketMaster',$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	}
}





function getQueryMaketType($id){
	if($id!=''){

		$rs=GetPageRecord('clientType,id,companyId',_QUERY_MASTER_,' id="'.$id.'"');
		$queryData=mysqli_fetch_array($rs);
		if($queryData['clientType']!=2){

			$selectaa='marketType';
			$whereaa='id="'.$queryData['companyId'].'"';
			$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
			while($userss=mysqli_fetch_array($rsaa)){
			return $userss['marketType'];
			}

		}
		if($queryData['clientType']==2){

			$selectaa='marketType';
			$whereaa='id="'.$queryData['companyId'].'"';
			$rsaa=GetPageRecord($selectaa,'contactsMaster',$whereaa);
			while($userss=mysqli_fetch_array($rsaa)){
			return $userss['marketType'];
			}

		}
	}
}


function getMaketTypeName($id){
	if($id!=''){

		$rs=GetPageRecord('clientType,id,companyId',_QUERY_MASTER_,' id="'.$id.'"');
		$queryData=mysqli_fetch_array($rs);

		if($queryData['clientType']==2){
			$companytable = 'contactsMaster';
		}else{
			$companytable = _CORPORATE_MASTER_;
		}

		$selectaa='marketType';
		$whereaa='id="'.$queryData['companyId'].'"';
		$rsaa=GetPageRecord($selectaa,$companytable,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			$rs=GetPageRecord('name','marketMaster',' id="'.$userss['marketType'].'" order by id asc');
			$editresult=mysqli_fetch_array($rs);
			if($userss['marketType']==0){
				return 'General';
			}else{
				return $editresult['name'];
			}
		}
		//return $queryData['clientType'];


	}
}

function getMaketTypeColor($id){
	if($id!=''){

		$rs=GetPageRecord('clientType,id,companyId',_QUERY_MASTER_,' id="'.$id.'"');
		$queryData=mysqli_fetch_array($rs);

		if($queryData['clientType']==2){
			$companytable = 'contactsMaster';
		}else{
			$companytable = _CORPORATE_MASTER_;
		}

		$selectaa='marketType';
		$whereaa='id="'.$queryData['companyId'].'"';
		$rsaa=GetPageRecord($selectaa,$companytable,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){

		$rs=GetPageRecord('marketColor','marketMaster',' id="'.$userss['marketType'].'" order by id asc');
		$editresult=mysqli_fetch_array($rs);
		if($userss['marketType']==0){
		return '#6ea3c3';
		}else{
		return $editresult['marketColor'];
		}
		}


	}
}

function getCostWithGSTOLD($cost,$roomGST,$roomTAC=0,$markup=0,$markupType=0){

	$roomGST = ($cost*$roomGST/100);

	$roomTAC = ($cost*$roomTAC/100);

	$markupCost = getMarkupCost($cost,$markup,$markupType);

	return  getTwoDecimalNumberFormat($cost+$markupCost+$roomGST-$roomTAC);
}

function getCostWithGST($cost,$gstRangeType,$roomTAC=0,$markup=0,$markupType=1){

	if($gstRangeType == 1){
		$roomGST = getGstValueByGstRangeId($cost,$gstRangeType);
	}elseif($roomTAC == 0 && $markup == 0 && $markupType == 1){ 
		// this meal gst value 
		$roomGST = $gstRangeType;
	}else{
		$roomGST = 0;
	}
    
	$cost = $cost+($cost*$roomGST/100);
	$cost = $cost-($cost*$roomTAC/100);

    if($markup > 0){
    	$cost = $cost+getMarkupCost($cost,$markup,$markupType);
    }
	
	return  getTwoDecimalNumberFormat($cost);
}

function getGstValueByGstRangeId($cost,$gstRangeType){
	if($gstRangeType==1){
		$gstQuery=""; 
		$gstQuery=GetPageRecord('*','gstMaster','  1 and "'.$cost.'" BETWEEN priceRangeFrom and priceRangeTo and serviceType="hotel" and status=1 and deleteStatus=0 and gstValue>0 limit 1'); 
		$gstSlabData=mysqli_fetch_array($gstQuery);
		return clean($gstSlabData['gstValue']);
	}else{
		return 0;
		// if tax inclusive then gstTax return 0
	}
}

function getGstValueById($gstId){
	if($gstId!='' && $gstId!=0){
		$gstQuery="";
		$gstQuery=GetPageRecord('*','gstMaster',' id="'.clean($gstId).'"'); 
		$gstSlabData=mysqli_fetch_array($gstQuery);
		return clean($gstSlabData['gstValue']);
	}else{
		return 0;
	}	
}
function getGstSlabById($gstId){
	if($gstId!='' && $gstId!=0){
		$gstQuery="";
		$gstQuery=GetPageRecord('*','gstMaster',' id="'.clean($gstId).'"'); 
		$gstSlabData=mysqli_fetch_array($gstQuery);
		return clean($gstSlabData['gstSlabName']);
	}else{
		return 0;
	}	
}
function getGstIdBySlab($slabName,$serviceType){
	if($slabName!=''){
		$gstQuery="";
		$gstQuery=GetPageRecord('*','gstMaster',' gstSlabName="'.clean($slabName).'" and serviceType="'.$serviceType.'"'); 
		$gstSlabData=mysqli_fetch_array($gstQuery);
		return clean($gstSlabData['id']);
	}else{
		return 0;
	}	
}



function getTariffType($id){
if($id!=''){
$selectaa='name';
$whereaa='id="'.$id.'"';
$rsaa=GetPageRecord($selectaa,'tariffTypeMaster',$whereaa);
while($userss=mysqli_fetch_array($rsaa)){
return $userss['name'];
}
}
}


// new showing staring images dynamic
function showStarrating($id){

	$rs1=GetPageRecord('hotelCategory,name','hotelCategoryMaster',' id ="'.$id.'"');
	$hotelCatData = mysqli_fetch_array($rs1);
	$hid = $hotelCatData['name'];

	return ($hid);
}

//********************************************************************
// for special character removal
function hyphenize($string) {
    $dict = array(
        "I'm"      => "I am",
        "thier"    => "their",
        // Add your own replacements here
    );
    return strtolower(
        preg_replace(
          array( '#[\\s-]+#', '#[^A-Za-z0-9. -]+#' ),
          array( '-', '' ),
          // the full cleanString() can be downloaded from http://www.unexpectedit.com/php/php-clean-string-of-utf8-chars-convert-to-similar-ascii-char
          cleanString(
              str_replace( // preg_replace can be used to support more complicated replacements
                  array_keys($dict),
                  array_values($dict),
                  urldecode($string)
              )
          )
        )
    );
}

// with above function
function cleanString($text) {
    $utf8 = array(
        '/[������]/u'   =>   'a',
        '/[�����]/u'    =>   'A',
        '/[����]/u'     =>   'I',
        '/[����]/u'     =>   'i',
        '/[����]/u'     =>   'e',
        '/[����]/u'     =>   'E',
        '/[������]/u'   =>   'o',
        '/[�����]/u'    =>   'O',
        '/[����]/u'     =>   'u',
        '/[����]/u'     =>   'U',
        '/�/'           =>   'c',
        '/�/'           =>   'C',
        '/�/'           =>   'n',
        '/�/'           =>   'N',
        '/�/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[�����]/u'    =>   ' ', // Literally a single quote
        '/[�����]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
//*****************************************
 

function cleanNonAsciiCharactersInString($orig_text) {

    $text = $orig_text;

    // Single letters
    $text = preg_replace("/[∂άαáàâãªä]/u",      "a", $text);
    $text = preg_replace("/[∆лДΛдАÁÀÂÃÄ]/u",     "A", $text);
    $text = preg_replace("/[ЂЪЬБъь]/u",           "b", $text);
    $text = preg_replace("/[βвВ]/u",            "B", $text);
    $text = preg_replace("/[çς©с]/u",            "c", $text);
    $text = preg_replace("/[ÇС]/u",              "C", $text);        
    $text = preg_replace("/[δ]/u",             "d", $text);
    $text = preg_replace("/[éèêëέëèεе℮ёєэЭ]/u", "e", $text);
    $text = preg_replace("/[ÉÈÊË€ξЄ€Е∑]/u",     "E", $text);
    $text = preg_replace("/[₣]/u",               "F", $text);
    $text = preg_replace("/[НнЊњ]/u",           "H", $text);
    $text = preg_replace("/[ђћЋ]/u",            "h", $text);
    $text = preg_replace("/[ÍÌÎÏ]/u",           "I", $text);
    $text = preg_replace("/[íìîïιίϊі]/u",       "i", $text);
    $text = preg_replace("/[Јј]/u",             "j", $text);
    $text = preg_replace("/[ΚЌК]/u",            'K', $text);
    $text = preg_replace("/[ќк]/u",             'k', $text);
    $text = preg_replace("/[ℓ∟]/u",             'l', $text);
    $text = preg_replace("/[Мм]/u",             "M", $text);
    $text = preg_replace("/[ñηήηπⁿ]/u",            "n", $text);
    $text = preg_replace("/[Ñ∏пПИЙийΝЛ]/u",       "N", $text);
    $text = preg_replace("/[óòôõºöοФσόо]/u", "o", $text);
    $text = preg_replace("/[ÓÒÔÕÖθΩθОΩ]/u",     "O", $text);
    $text = preg_replace("/[ρφрРф]/u",          "p", $text);
    $text = preg_replace("/[®яЯ]/u",              "R", $text); 
    $text = preg_replace("/[ГЃгѓ]/u",              "r", $text); 
    $text = preg_replace("/[Ѕ]/u",              "S", $text);
    $text = preg_replace("/[ѕ]/u",              "s", $text);
    $text = preg_replace("/[Тт]/u",              "T", $text);
    $text = preg_replace("/[τ†‡]/u",              "t", $text);
    $text = preg_replace("/[úùûüџμΰµυϋύ]/u",     "u", $text);
    $text = preg_replace("/[√]/u",               "v", $text);
    $text = preg_replace("/[ÚÙÛÜЏЦц]/u",         "U", $text);
    $text = preg_replace("/[Ψψωώẅẃẁщш]/u",      "w", $text);
    $text = preg_replace("/[ẀẄẂШЩ]/u",          "W", $text);
    $text = preg_replace("/[ΧχЖХж]/u",          "x", $text);
    $text = preg_replace("/[ỲΫ¥]/u",           "Y", $text);
    $text = preg_replace("/[ỳγўЎУуч]/u",       "y", $text);
    $text = preg_replace("/[ζ]/u",              "Z", $text);

    // Punctuations

    $text = preg_replace("/[�]/u", "", $text); 
    $text = preg_replace("/[,,]/u", ",", $text); 
    $text = preg_replace("/[‚‚]/u", ",", $text);        
    $text = preg_replace("/[`‛′’‘]/u", "'", $text);
    $text = preg_replace("/[″“”«»„]/u", '"', $text);
    $text = preg_replace("/[—–―−–‾⌐─↔→←]/u", '-', $text);
    $text = preg_replace("/[  ]/u", ' ', $text);

    $text = str_replace("…", "...", $text);
    $text = str_replace("≠", "!=", $text);
    $text = str_replace("≤", "<=", $text);
    $text = str_replace("≥", ">=", $text);
    $text = preg_replace("/[‗≈≡]/u", "=", $text);


    // Exciting combinations    
    $text = str_replace("ыЫ", "bl", $text);
    $text = str_replace("℅", "c/o", $text);
    $text = str_replace("₧", "Pts", $text);
    $text = str_replace("™", "tm", $text);
    $text = str_replace("№", "No", $text);        
    $text = str_replace("Ч", "4", $text);                
    $text = str_replace("‰", "%", $text);
    $text = preg_replace("/[∙•]/u", "*", $text);
    $text = str_replace("‹", "<", $text);
	$text = str_replace("\"", "", $text);
	$text = str_replace("•", "", $text);
    $text = str_replace("›", ">", $text);
    $text = str_replace("‼", "!!", $text);
    $text = str_replace("⁄", "/", $text);
    $text = str_replace("∕", "/", $text);

    $text = str_replace("⅞", "7/8", $text);
    $text = str_replace("⅝", "5/8", $text);
    $text = str_replace("⅜", "3/8", $text);
    $text = str_replace("⅛", "1/8", $text);        
    $text = preg_replace("/[‰]/u", "%", $text);
    $text = preg_replace("/[Љљ]/u", "Ab", $text);
    $text = preg_replace("/[Юю]/u", "IO", $text);
    $text = preg_replace("/[ﬁﬂ]/u", "fi", $text);
    $text = preg_replace("/[зЗ]/u", "3", $text); 
    $text = str_replace("£", "(pounds)", $text);
    $text = str_replace("₤", "(lira)", $text);
    $text = preg_replace("/[‰]/u", "%", $text);
    $text = preg_replace("/[↨↕↓↑│]/u", "|", $text);
    $text = preg_replace("/[∞∩∫⌂⌠⌡]/u", "", $text);


    //2) Translation CP1252.
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans['f'] = '&fnof;';    // Latin Small Letter F With Hook
    $trans['-'] = array(
        '&hellip;',     // Horizontal Ellipsis
        '&tilde;',      // Small Tilde
        '&ndash;'       // Dash
        );
    $trans["+"] = '&dagger;';    // Dagger
    $trans['#'] = '&Dagger;';    // Double Dagger         
    $trans['M'] = '&permil;';    // Per Mille Sign
    $trans['S'] = '&Scaron;';    // Latin Capital Letter S With Caron        
    $trans['OE'] = '&OElig;';    // Latin Capital Ligature OE
    $trans["'"] = array(
        '&lsquo;',  // Left Single Quotation Mark
        '&rsquo;',  // Right Single Quotation Mark
        '&rsaquo;', // Single Right-Pointing Angle Quotation Mark
        '&sbquo;',  // Single Low-9 Quotation Mark
        '&circ;',   // Modifier Letter Circumflex Accent
        '&lsaquo;'  // Single Left-Pointing Angle Quotation Mark
        );

    $trans['"'] = array(
        '&ldquo;',  // Left Double Quotation Mark
        '&rdquo;',  // Right Double Quotation Mark
        '&bdquo;',  // Double Low-9 Quotation Mark
        );

    $trans['*'] = '&bull;';    // Bullet
    $trans['n'] = '&ndash;';    // En Dash
    $trans['m'] = '&mdash;';    // Em Dash        
    $trans['tm'] = '&trade;';    // Trade Mark Sign
    $trans['s'] = '&scaron;';    // Latin Small Letter S With Caron
    $trans['oe'] = '&oelig;';    // Latin Small Ligature OE
    $trans['Y'] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
    $trans['euro'] = '&euro;';    // euro currency symbol
    ksort($trans);

    foreach ($trans as $k => $v) {
        $text = str_replace($v, $k, $text);
    }

    // 3) remove <p>, <br/> ...
    $text = strip_tags($text);

    // 4) &amp; => & &quot; => '
    $text = html_entity_decode($text);


    // transliterate
    // if (function_exists('iconv')) {
    // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // }

    // remove non ascii characters
    // $text =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $text);      

    $text=trim($text); 
    return $text;
    
}

// clean excel special characters
function cleanExcelSP($Str) {  
  $StrArr = str_split($Str); $NewStr = '';
  foreach ($StrArr as $Char) {    
    $CharNo = ord($Char);
    if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
    if ($CharNo > 31 && $CharNo < 127) {
      $NewStr .= $Char;    
    }
  }  
  return $NewStr;
}
  
function countSupplierunreadMails($id){
	if($id!=''){
		$result =mysqli_query (db(),"select id from "._SUPPLIER_COMMUNICATION_MAIL_." where queryId='".clean($id)."' and replyStatus=1")  or die(mysqli_error(db()));
		$number =mysqli_num_rows($result);
		return $number;
	}
}



function getHotelDateSets($quotationId,$suppId){
	$suppIdQuery="";
	if($suppId > 0){
		$suppIdQuery = ' and supplierId="'.$suppId.'"';
	}
	$result="";
	$tmpHotelID = 0;
	$tmpCheckIn="";
	$checkInDate = "";
	$checkOutDate =""; 
	$FID =""; 
	
	$getNSQuery = '';
	$getNSQuery = ' and dayId in ( select id from newQuotationDays where packageId=0 )';


	$hotelQuery2=""; 
	$hotelQuery2=GetPageRecord('id,hotelId,fromDate,DATE_ADD(toDate , INTERVAL 1 DAY) as toDate','finalQuote',' quotationId="'.$quotationId.'" '.$suppIdQuery.' '.$getNSQuery.' group by hotelId,dayId order by fromDate,hotelId asc');
	while($finalQuotHotel=mysqli_fetch_array($hotelQuery2)){
		
		$DB_HotelID = $finalQuotHotel["hotelId"];
		$tmpCheckIn = $finalQuotHotel["fromDate"];
		 
		if ($tmpHotelID <> $DB_HotelID)
		{
			if ($tmpHotelID<>0 )
			{
				if($result <> "")
				{
					$result = $result."~";
				}
				$result=$result.$tmpHotelID."^".$checkInDate."^".$checkOutDate."^".$FID;
			}
			$checkInDate = $finalQuotHotel["fromDate"];	
		}

		if ( $tmpHotelID == $DB_HotelID && $tmpCheckIn <> $checkOutDate  )
		{
			if($result <> "")
			{
				$result = $result."~";
			}
			$result=$result.$tmpHotelID."^".$checkInDate."^".$checkOutDate."^".$FID;
			$checkInDate = $finalQuotHotel["fromDate"];
		}
		$FID = $finalQuotHotel['id'];
		//$FID = $tmpFID;
		$tmpHotelID = $DB_HotelID;
		$checkOutDate = date('Y-m-d',strtotime($finalQuotHotel["toDate"]));

	}
	if ($tmpHotelID<>0)
	{
		if($result<>"" )
		{
			$result = $result."~";
		}
		$result=$result.$tmpHotelID."^".$checkInDate."^".$checkOutDate."^".$FID;
	}
	return $result;
}


//new function for special character
function IsNonAsciExists($ValueofField) {
	$ValueofField = str_replace( array( '\'', '\"', '"',',' , ';', '<', '>' ), '', $ValueofField);
    $tmp = "";
    $tmp = preg_replace('/[[:^print:]]/','',$ValueofField); 
    // should be aA
   
    $Exists = FALSE;
    if (strlen($ValueofField) > strlen($tmp))
    {
        $Exists = TRUE;
    } 
    return $Exists;
}

function decode22($fun) 
{

	$decoded22 = base64_decode(base64_decode(base64_decode($fun)));

	return  $decoded22;



}


function maskEmail($email){
	if($email!=''){
	    $em   = explode("@",$email);
	    $name = implode('@', array_slice($em, 0, count($em)-1));
	    $len  = floor(strlen($name)/2);
	    return str_repeat('x', $len) . "@" . end($em);   
	}
}
function maskPhone($phone){ 
	if($phone!=''){
		$result = substr($phone, 0, 4);
		$result .= "****";
		$result .= substr($phone, 7, 4);
		echo $result;   
	}
}

function geDocFileSrc($fileId){ 
	if($fileId!=''){
		$docSelect='uploadFile';
		$docWhere='id="'.$fileId.'"';
		$docrs1=GetPageRecord($docSelect,_DOCUMENT_FILES_MASTER_,$docWhere);
		while($docfileData=mysqli_fetch_array($docrs1)){
			return 	$docfileData['uploadFile'];
		}
	}
}
function geDocFileName($fileId){ 
	if($fileId!=''){
		$docSelect='name';
		$docWhere='id="'.$fileId.'"';
		$docrs1=GetPageRecord($docSelect,_DOCUMENT_FILES_MASTER_,$docWhere);
		while($docfileData=mysqli_fetch_array($docrs1)){
			return $docfileData['name'];
		}
	}
} 

// This function will allow you to delete any folder .
function DeleteFolderAndFiles($path){
	if (is_dir($path) === true){
		$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
		foreach ($files as $file){
			if (in_array($file->getBasename(), array('.', '..')) !== true){
				if ($file->isDir() === true){
					rmdir($file->getPathName());
				}
				else if (($file->isFile() === true) || ($file->isLink() === true)){
					unlink($file->getPathname());
				}
			}
		}
		return rmdir($path);
	}
	else if ((is_file($path) === true) || (is_link($path) === true)){
		return unlink($path);
	}
	return false;
}

function createPath($path) {
	// $path = 'dirfiles'.$path;
	// !file_exists($path) && 
	if (!is_dir($path)) {
	    mkdir($path, 0777, true);
		return true;
	}else{
		return false;
	}
}

function getFolderSize($directory) {
    $size = 0;
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
        $size+=$file->getSize();
    }
    return formatBytes($size, $precision = 2);
} 

function countFolderFiles($folderId) {
	$folderQuery2=''; 
	$folderQuery2=GetPageRecord('*',_DOCUMENT_FOLDER_MASTER_,' deletestatus=0 and id='.$folderId.' order by id desc');
	$folderData2=mysqli_fetch_array($folderQuery2);
	if($folderData2['id']>0){
		$directory = ($folderData2['fpath']);
	}else{
		$directory = ('docFiles');
	} 

	if(is_dir($directory)){
		$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
		foreach($files as $file) {
			if(is_dir($file)){
		    	$result[] = $file;
			}
		}
	  	return count($result);
	}else{
	  	return 0;
	}
} 

function scan_dir($folderId){
	$folderQuery2=''; 
	$folderQuery2=GetPageRecord('*',_DOCUMENT_FOLDER_MASTER_,' deletestatus=0 and id='.$folderId.' order by id desc');
	$folderData2=mysqli_fetch_array($folderQuery2);
	if($folderData2['id']>0){
		$path = ($folderData2['fpath']);
	}else{
		$path = ('docFiles');
	} 

	if(is_dir($path)){
	    $bytestotal=0;
	    $nbfiles=0;
	    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $filename=>$cur) {
	        $filesize=$cur->getSize();
	        $bytestotal+=$filesize;
	        $nbfiles++;
	        $files[] = $filename;
	    } 
	    return array('total_files'=>$nbfiles,'total_size'=>formatBytes($bytestotal, $precision = 2),'files'=>$files);
	}else{
	  	return 0;
	}
}

function getMarkupCost($actualCost, $markup, $markupType) {
    $newCost = 0;    
    if ($markupType == 1) {
        $newCost = ($actualCost * $markup / 100);
    }
    if ($markupType == 2 && $actualCost>0) {
        $newCost = $markup;
    }
    return ($newCost);
}
 
function url_get_contents($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}


function getmailclearcontent($body){ 
	if (preg_match('/^([a-zA-Z0-9]{76} )+[a-zA-Z0-9]{76}$/', $body)) {
	    $body = base64_decode($body);
	}
	$body = str_replace('Content-Type: text/plain; charset="UTF-8"',' ',$body);
	$body = utf8_encode(str_replace('Content-Type: text/html; charset="UTF-8"',' ',$body));
	$body = str_replace('"3D','',$body);
	$body = str_replace('""','"',$body);
	$body = preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','',$body); 
	return imap_qprint($body);
}
 
 
function getNationality($id){
	if($id!=''){
		$selectaa='name';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,'nationalityMaster',$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
			return $userss['name'];
		}
	}
}
 
function makeServiceCode($servicePrefix,$serviceId){
	if($serviceId!=''){
		return $servicePrefix.str_pad($serviceId,6, '0', STR_PAD_LEFT);
	}
}

function removeTagByClass(string $html, string $className) {
    $dom = new \DOMDocument();
    $dom->loadHTML($html);
    $finder = new \DOMXPath($dom);

    $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' {$className} ')]");

    foreach ($nodes as $node) {
        $node->parentNode->removeChild($node);
    }

    return $dom->saveHTML();

}
 
function html_tidy($src){
    libxml_use_internal_errors(true);
    $x = new DOMDocument;
    $x->loadHTML('<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />'.$src);
    $x->formatOutput = true;
    $ret = preg_replace('~<(?:!DOCTYPE|/?(?:html|body|head))[^>]*>\s*~i', '', $x->saveHTML());
    return trim(str_replace('<meta http-equiv="Content-Type" content="text/html;charset=utf-8">','',$ret));
}


function getISOConComm($id){
	if($id!=''){
		$selectaa='commission';
		$whereaa='id="'.$id.'"';
		$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa);
		while($userss=mysqli_fetch_array($rsaa)){
		return $userss['commission'];
		}
	}
}


function formatUrl($str, $sep = '-'){
    $res = ($str);
    $res = preg_replace('/[^[:alnum:]]/', ' ', $res);
    $res = preg_replace('/[[:space:]]+/', $sep, $res);
    $res = preg_replace('/-+/', '-', $res);
    $res = trim($res, $sep);
    return date('Y-m-d-H-i-s') . "_" . $res;
}


function getFOCCost($focCost,$slabId,$focType,$serviceType,$quotationId){
    $esQLE = "";
    $esQLE=GetPageRecord('*','quotationFOCRates','1 and slabId="'.$slabId.'" and focType="'.$focType.'" and quotationId="'.$quotationId.'"');
    if (mysqli_num_rows($esQLE)>0 ) {
        $escortData = mysqli_fetch_array($esQLE);
        $Cost=$CalType='';
        if($serviceType=='hotel'){
            $Cost=$escortData['hotelCost'];
            $CalType=$escortData['hotelCalType'];
        } 
        if($serviceType=='guide'){
            $Cost=$escortData['guideCost'];
            $CalType=$escortData['guideCalType'];
        } 
        if($serviceType=='activity'){
            $Cost=$escortData['activityCost'];
            $CalType=$escortData['activityCalType'];
        } 
        if($serviceType=='entrance'){
            $Cost=$escortData['entranceCost'];
            $CalType=$escortData['entranceCalType'];
        } 
        if($serviceType=='transfer'){
            $Cost=$escortData['transferCost'];
            $CalType=$escortData['transferCalType'];
        }  
        if($serviceType=='train'){
            $Cost=$escortData['trainCost'];
            $CalType=$escortData['trainCalType'];
        } 
        if($serviceType=='flight'){
            $Cost=$escortData['flightCost'];
            $CalType=$escortData['flightCalType'];
        } 
        if($serviceType=='restaurant'){
            $Cost=$escortData['restaurantCost'];
            $CalType=$escortData['restaurantCalType'];
        } 
        if($serviceType=='other'){
            $Cost=$escortData['otherCost'];
            $CalType=$escortData['otherCalType'];
        }

        if ($CalType == 1) {
            $newfocCost = ($focCost * $Cost / 100);
        }
        if ($CalType == 2) {
            $newfocCost = $Cost;
        }
        return getTwoDecimalNumberFormat($newfocCost);
    }
}

function getPerPersonBasisCost($ppCostONXYZBasis,$serviceMarkup,$markupType,$discount,$discountType,$serviceTax,$isUni_Mark,$commissionType,$ISOCommission,$ConsortiaCommission,$ClientCommission,$tcs){
    if($serviceMarkup!= 0 && $isUni_Mark==1) {
      $ppCostONXYZBasisMarkup = getMarkupCost($ppCostONXYZBasis, $serviceMarkup, $markupType);  // single markup
      $ppCostONXYZBasis = $ppCostONXYZBasis + $ppCostONXYZBasisMarkup; //single with markup
    }
    if($ISOCommission!= 0) {
      $ppCostONXYZBasisISOCommission = getMarkupCost($ppCostONXYZBasis, $ISOCommission, $markupType);  // single markup
      $ppCostONXYZBasis = $ppCostONXYZBasis + $ppCostONXYZBasisISOCommission; //single with markup
    }
    if($ConsortiaCommission!= 0) {
      $ppCostONXYZBasisConsortiaCommission = getMarkupCost($ppCostONXYZBasis, $ConsortiaCommission, $markupType);  // single markup
      $ppCostONXYZBasis = $ppCostONXYZBasis + $ppCostONXYZBasisConsortiaCommission; //single with markup
    }
    if($ClientCommission!= 0) {
      $ppCostONXYZBasisClientCommission = getMarkupCost($ppCostONXYZBasis, $ClientCommission, $markupType);  // single markup
      $ppCostONXYZBasis = $ppCostONXYZBasis + $ppCostONXYZBasisClientCommission; //single with markup
    }
    if ($discount>0) {
      $ppCostONXYZBasisDiscount = getMarkupCost($ppCostONXYZBasis, $discount, $discountType);  // single Discount
      $ppCostONXYZBasis = $ppCostONXYZBasis - $ppCostONXYZBasisDiscount; //single with Discount
    }
    if ($serviceTax>0) {
      $ppCostONXYZBasisTax = getMarkupCost($ppCostONXYZBasis, $serviceTax, 1);  // single Discount
    }
    if ($tcs>0) {
      $ppCostONXYZBasistcs = getMarkupCost($ppCostONXYZBasis, $tcs, 1);  // single Discount
    }
    $ppCostONXYZBasis = $ppCostONXYZBasis + $ppCostONXYZBasisTax + $ppCostONXYZBasistcs; //single with Discount
    return getTwoDecimalNumberFormat($ppCostONXYZBasis); 
} 
function sanitizeString($string) {
    try {
        // Remove leading/trailing whitespaces
        $string = trim($string);

        // Remove special characters using regex
        $string = preg_replace('/[^A-Za-z0-9@\/:._\- ]/', '', $string);
  		// $string = preg_replace('/[^A-Za-z0-9@._\- ]/', '', $string);
        return $string;

    } catch (Exception $e) {
        // Log the error or display an error message
        error_log('Error in sanitizeString function: ' . $e->getMessage());
        // Handle the error gracefully, e.g., return a default value or show an error page
        return '';
    }
} 

// Escape function to prevent SQL injection
function escapeString($conn, $str) {
    return mysqli_real_escape_string($conn, $str);
}

function getGstRangeType($gstRangeType){
    return ($gstRangeType > 0)?'Slab Wise Tax':'Tax Inclusive';;
}
?>
