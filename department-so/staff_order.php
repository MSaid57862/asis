<?php session_start();
require_once '../connections/meekro/db.class.php';
require_once 'functions.php';
include "phpqrcode/qrlib.php";
$dt = date('Y-m-d H:i:s');
use Dompdf\Dompdf; 
if (isset($_GET['postingId'])) {
    
	$postingId = ($_GET['postingId']);
	// replacing slash with underscore
	//$refNo2 = str_replace('/', '_', $refNo);
	//qrcode
    $path = 'images/';
    //$qrcode = $path.$refNo2.'.png';
    $qrcode = $postingId.'.png';
    $link = "https://customs.gov.ng?postingId=".$postingId;
    
    QRcode::png($link, $qrcode);
    
	$query = DB::queryFirstRow("SELECT * FROM postings  WHERE posting_id = '$postingId' AND status!='Pending'  LIMIT 1");
		if ($query) {
              $email= $query['officer_email'];
              $status= $query['status'];
              $officerId= $query['officer_id'];
              $getOfficerDetails = getOfficerDetail($officerId);
              $surname = $getOfficerDetails['surname'];
              $fileRef = $getOfficerDetails['file_ref'];
              $svc = $getOfficerDetails['svc'];
              $initials = $getOfficerDetails['initials'];
              $officerName = $initials.' '.$surname;
              $rankId = $query['rank'];
              $getRankDetail = getRankDetail($rankId);
              $rankName = $getRankDetail['rank_name'];
              $getCurrentDesignation = getDesignation($query['designation']);
              $currentDesignation = $getCurrentDesignation['designation_name'];
              $currentEffectiveDate =  $query['effective_date'];
              $currentDatePosted = date('Y-M-d', $query['date_captured']);
              $currentPostingRef = $query['posting_ref'];
              $getCurrentCommand = getFormation($query['command']);
              $currentCommand = $getCurrentCommand['formation_name'];
              $getCurrentUnit = getUnit($query['unit']);
              $currentUnit = $getCurrentUnit['unit_name'];
              $currentDeptId = $query['department'];
              $getDeptDetail = getDepartment($query['department']);
              $deptName = $getDeptDetail['department_name'];
              $deptHead = $getDeptDetail['department_head'];
              
              $getUserDetail = getUserDetail($query['approved_by']);
              $approvedBy = $getUserDetail['fullname'];
              $datePrinted = date('Y-M-d H:i:s', time());
              
              $getPreviousPostingDetail = getPostingDetail($query['previous_posting_id']);
              $getPreviousCommand = getFormation($getPreviousPostingDetail['command']);
              $previousCommand = $getPreviousCommand['formation_name'];
              $getPreviousUnit = getUnit($getPreviousPostingDetail['unit']);
              $previousUnit = $getPreviousUnit['unit_name'];
              $getPreviousDesignation = getDesignation($getPreviousPostingDetail['designation']);
              $previousDesignation = $getPreviousDesignation['designation_name'];
              $previousPostingRef = $getPreviousPostingDetail['posting_ref'];
              $previousEffectiveDate = $getPreviousPostingDetail['effective_date'];
              $previousDatePosted = date('Y-M-d', $getPreviousPostingDetail['date_captured']);
        
        }else{
           $_SESSION['fail'] = ' Error. This Record has a PENDING or DELETE status and cannot be viewed';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

	// Include autoloader 
	require_once 'dompdf/autoload.inc.php'; 
	 
	
	 
	// Instantiate and use the dompdf class 
	$dompdf = new Dompdf();
	
	$html = <<<HTML
  <html style="">
      <head>
      <title>INTERNAL STAFF ORDER</title>
            <style type="text/css">
                /* Your document styling goes here */
				*{
					font-size:12px;
					padding: 5px;
				}
            </style>
      </head>
      <body style="margin-top:-15px; margin-bottom:-20px; margin-left:-50px;  margin-right: -20px;">
        <table border='0' width='560px' style="margin-left:20px;">
            <tr align='center'>
                <td align='center' width="80px">
                    <img src="$qrcode" height="80px" width="80px" >
                </td>
                <td width="500px" align='center'>
                    <span style='font-weight:bolder; font-size:19px; '>NIGERIA CUSTOMS SERVICE </span><br>
                    <span style="font-size:17px;">No 4 Abidjan Street, Zone 3, Abuja </span><br>
	
                </td>
                <td align='left' width="80px">
                    <img src="../img/logo.png" height="80px" width="80px"><br>
                   
                    
                </td>
            </tr>
            <tr align='center'>
                <td width="560px" align='center' colspan="3" style="margin-top:-10px;">
                    <span style="font-weight: bolder; font-size:16px; text-transform:uppercase;" >OFFICE OF THE $deptHead  $deptName</span>
                </td>
            </tr><br>
            <tr align='center'>
                <td width="560px" align='center' colspan="3" style="margin-top:-10px;">
                    <span style="font-weight: bolder; font-size:16px; text-transform:uppercase;" >HEADQUARTERS - ABUJA</span>
                </td>
            </tr>
        </table>
		
	  	<div style="margin-top: 15px; padding:0px;">
	  	<h1 style="margin-bottom:0px; margin-top:0px; text-align:center; font-size:20px; text-decoration: underline;">INTERNAL STAFF ORDER </h1>
		</div>
		
		<div>
		<center>
		<table border='0' width='100%' style="margin-left:20px;">
            <tr>
                <td width='100px'; style="text-align:left;  font-size:13px;">File Reference:</td>
                <td width="5px">  </td>
                <td style="text-align:left;  font-size:16px;">$fileRef</td>
                
            </tr>
            <tr>
                <td width='100px'; style="text-align:left;  font-size:13px;">Service Number:</td>
                <td width="5px">  </td>
                <td style="text-align:left;  font-size:16px;">$svc</td>
                
            </tr>
            <tr>
                <td width='100px'; style="text-align:left;  font-size:13px;">Rank:</td>
                <td width="5px">  </td>
                <td style="text-align:left;  font-size:16px;">$rankName</td>
                
            </tr>
            <tr>
                <td width='100px'; style="text-align:left;  font-size:13px;">Name:</td>
                <td width="5px">  </td>
                <td style="text-align:left;  font-size:16px;">$officerName</td>
                
            </tr>
            
            <tr>
                <td width='100px'; style="text-align:left;  font-size:13px;">Email:</td>
                <td width="5px">  </td>
                <td style="text-transform:lowercase; font-size: 16px;">$email</td>
                
            </tr>
        </table>
        </center>
        </div>
        
        <center>
		<table border='0' width='320px' style="margin-left:20px;">
            
            <tr>
                <td width='120px'; style="text-align:left;  font-size:20px;   border-bottom: 1px solid gray">Description</td>
                <td width='250px'; style="text-align:left;  font-size:20px;   border-bottom: 1px solid gray">New Posting</td>
                <td width='250px'; style="text-align:left;  font-size:20px;   border-bottom: 1px solid gray" >Previous Posting</td>
                
            </tr>
            <tr>
                <th width='100px'; style="text-align:left;  font-size:15px;">Staff Order No:</th>
                <td width="250px" style="text-align:left;  font-size:15px;">$currentPostingRef</td>
                <td width="250px" style="text-align:left;  font-size:15px;">$previousPostingRef</td>
                
            </tr>
            <tr>
                <th width='100px'; style="text-align:left;  font-size:15px;">Command:</th>
                <td width="250px" style="text-align:left;  font-size:15px;">$currentCommand</td>
                <td width="250px" style="text-align:left;  font-size:15px;">$previousCommand</td>
                
            </tr>
            
           <tr>
                <th width='100px'; style="text-align:left;  font-size:15px;">Unit:</th>
                <td width="250px" style="text-align:left;  font-size:15px;">$currentUnit</td>
                <td width="250px" style="text-align:left;  font-size:15px;">$previousUnit</td>
                
            </tr>
            <tr>
                <th width='100px'; style="text-align:left;  font-size:15px;">Designation:</th>
                <td width="250px" style="text-align:left;  font-size:15px;">$currentDesignation</td>
                <td width="250px" style="text-align:left;  font-size:15px;">$previousDesignation</td>
                
            </tr>
            <tr>
                <th width='100px'; style="text-align:left;  font-size:15px;">Date Posted:</th>
                <td width="250px" style="text-align:left;  font-size:15px;">$currentDatePosted</td>
                <td width="250px" style="text-align:left;  font-size:15px;">$previousDatePosted</td>
                
            </tr>
            <tr>
                <th width='100px'; style="text-align:left;  font-size:15px;">Effective Date:</th>
                <td width="250px" style="text-align:left;  font-size:15px;">$currentEffectiveDate</td>
                <td width="250px" style="text-align:left;  font-size:15px;">$previousEffectiveDate</td>
                
            </tr>
        </table>
        </center>
        </div>
        
       <div style="margin: 0px; text-align:justify; padding:0px; margin-left:20px;">
			<br>
			<span style="font-size:14px;">
				<strong>NOTE:</strong> 1) IT IS EXPECTED YOU WILL REMAIN IN THAT POST UNTIL FURTHER NOTICE. <br><br>
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     2) THIS CHANGE TAKES PLACE ON $currentEffectiveDate.
			</span>
		</div><br>
		<div style="margin: 0px; text-align:right; padding:0px; margin-right:10px;">
			<br>
			<span style="font-size:17px;">Date Printed: $datePrinted</span>
		</div>
		<br><br><br>
HTML;
if($status=='Pending'||$status=='Deleted'){
}else{
		
		$html.='<div style="margin: 0px; text-align:center; padding:0px;  ">
			<br>
			<span style="font-size:28px; font-family:Helvetica-Bold;">
			'.$approvedBy.' <br>
			</span>
			
			<span style="font-size:18px;">
			'.$deptHead.' <br>
			'.$deptName.'
			</span>
		</div>';
}
      
	

		
 
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("A4", "portrait");
		$dompdf->set_option('dpi', 100);
		$dompdf->render();
		$dompdf->stream($postingId.".pdf",array("Attachment"=>0));


// $dompdf->clear();
		
	}else{
		echo "<script>
				alert('Invalid link');
				location.href='postings.php';
			</script>
			";
	}


############################# / SUBMITING TRANSACTIONA##################


?>
        