<?php session_start(); ?>
<?php require_once '../connections/meekro/db.class.php'; ?>
<?php require_once 'functions.php';?>
<?php


      

      

//ADDING NEXT OF KIN INFORMATION
  if (isset($_POST['officer-kin'])) {
     $svn = $_SESSION['svc'];
       $record = DB::query("SELECT * FROM basic_information WHERE svn = '$svn' AND submission_status = 'Submitted'");
        if ($record) {
            //echo "<script>location.href='preview.php'</script>";
        }else{
        $res = DB::query("SELECT * FROM kin_information WHERE svn = '$svn'");
            if ($res) {
            $svn = $_SESSION['svc'];
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $relationship = $_POST['relationship'];
            $address = $_POST['address'];
            $date = time();
            
        $res = DB::query("UPDATE kin_information SET fullname=%s, phone=%s, email=%s, gender=%s,  relationship=%s, address=%s WHERE svn=%s", $fullname, $phone, $email, $gender, $relationship, $address, $svn);
            $_SESSION['success'] = " Records Successful Added";
            echo "<script>location.href='posting_index.php'</script>";
            }else{
        $res = DB::insert('kin_information', array(
            'svn' => $_SESSION['svc'],
            'fullname' => $_POST['fullname'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'relationship' => $_POST['relationship'],
            'address' => $_POST['address'],
            'date_created' => time()
        )
            
    );
        if($res){
             $_SESSION['success'] = " Records Successful Added";
            echo "<script>location.href='posting_index.php'</script>";
            
        }else{
             $_SESSION['fail'] = " Failed to Added Records ";
             header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
        }
    
        }
    }
    





//LOAD OFFICER POSTING LIST TABLE
if(isset($_POST['officerId'])){
$officerId = $_POST['officerId'];


        $query = DB::queryFirstRow("SELECT * FROM officers WHERE officer_id ='$officerId' AND status!='Deleted' LIMIT 1");
            if($query){
                    $officerName = $query['initials']. ' '.$query['surname'];
                    $rankId = $query['rank'];
                    $svc = $query['svc'];
                    $getRankDetail = getRankDetail($rankId);
                    $rankName = $getRankDetail['rank_name'];
                    $birthDate = $query['date_of_birth'];
                    $appointmentDate = $query['appointment_date'];
                    
                    $datetime1 = date_create($birthDate);
                    $datetime2 = date_create($appointmentDate);
                    $datetime3 = date_create($today);
                    $agediff = date_diff($datetime3, $datetime1)->format("%y Year(s) %m Month(s) %d Day(s)");
                    $agediff1 = date_diff($datetime3, $datetime1);
                    $yearsRemAge = 60 - $agediff;
                    $appointmentdiff = date_diff($datetime3, $datetime2)->format("%y Year(s) %m Month(s) %d Day(s)");
                    $appointmentdiff1 = date_diff($datetime3, $datetime2);
                    $yearsRemApp = 35 - $appointmentdiff;
                    $exactDateRemApp = date('Y', strtotime('+'.$yearsRemApp.'years')).'-'.date('M-d', strtotime($appointmentDate));
                    $exactDateRemAge = date('Y', strtotime('+'.$yearsRemAge.'years')).'-'.date('M-d', strtotime($birthDate));
                    if($yearsRemAge > $yearsRemApp ){
                        $retirementInfo = 'The Officer is '.$agediff . ' old. Proposed Retirement date is '.$exactDateRemAge.'  based on your Date of Birth '.$birthDate;
                        $officerData = 'Date of Birth: '.$birthDate;
                        $retirementDate = $exactDateRemAge;
                        $officerInfo =  'Appointment Date: '.$appointmentDate;
                    }else{
                        $retirementInfo ='The Officer has served for '.$appointmentdiff.' Proposed Retirement date is '.$exactDateRemApp.' based on your Date of Appointment in to the Service '.$appointmentDate; 
                        $officerData = 'Appointment Date: '.$appointmentDate;
                        $retirementDate = $exactDateRemApp;
                        $officerInfo = 'Date of Birth: '.$birthDate;
                    }
            }

$tbl = '<div class="retirementInfo text-danger text-center mb-2"><strong>'.$retirementInfo.'</strong></div>

<table id="datatable-buttons" width="100%" class="p-2">
    <tbody>
    
        <tr class="bg-light">
            <td>'.$officerInfo.'</td>
            <td>'.$officerData.'</td>
            <td>Proposed Retirement Date: <strong>'.$retirementDate.'</strong></td>
        </tr>
        
        <tr class="bg-light">
            <td>Service Number: <strong>'.$svc.'</strong></td>
            <td>Rank: <strong>'.$rankName.'</strong></td>
            <td>Name: <strong>'.$officerName.'</strong></strong></td>
        </tr>
        
    </tbody>
</table>

<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
    <thead>
        <tr class="text-bold">
            <th>Command</th>
            <th>Designation</th>
            <th>Unit</th>
            <th>Date Posted</th>
            <th>Effective Date</th>
            <th>Posting Duration</th>
            <th>Status</th>
            <th class="d-print-none">Action</th>
        </tr>
    </thead>
                                        

    <tbody>';
        
            
            $query = DB::query("SELECT * FROM postings WHERE officer_id ='$officerId' AND status!='Deleted' ORDER BY posting_id DESC");
            if($query){
                foreach($query as $result){
                    $getFormationDetails = getFormation($result['command']);
                    $commandName = $getFormationDetails['formation_name'];
                    $getUnitDetails = getUnit($result['unit']);
                    $unitName = $getUnitDetails['unit_name'];
                    $getDesignationtDetails = getDesignation($result['designation']);
                    $designationName = $getDesignationtDetails['designation_name'];
                    $status = $result['status'];
                    if($status=='Pending'){
                        $duration = 'N/A';
                        $action = "<a href='backend.php?postingDelId=$postingId' class='btn btn-xs btn-outline-danger' onclick='return confirm($confirmDelete);'><i class='fas fa fa-trash' data-toggle='tooltip' title='Delete'> </i></a>";
                    }else{
                        $postingDate = $result['effective_date'];
                        $today = date('Y-m-d', time());
                        $datePostedOut = $query['date_posted_out'];
                        
                        if($datePostedOut==''){
                        $today = date('Y-m-d', time());
                        }else{
                            $today = $datePostedOut;
                        }
                        
                        $datetime1 = date_create($postingDate);
                        $datetime2 = date_create($today);
                        $diff = date_diff($datetime1, $datetime2);
                        $duration = $diff->format("%y Year(s) %m Month(s) %d Day(s)");
                        
                        $action = "<a href='staff_order.php?postingId=".$postingId."' class='btn btn-xs btn-outline-info' target='_blank'><i class='fas fa fa-eye' data-toggle='tooltip' title='View'> </i></a>";
                }
            $postingId = $result['posting_id'];
            $confirmDelete = 'Are you sure to delete this posting record?';
            
                $tbl .="<tr>
                       
                        <td>".$commandName."</td>
                        <td>".$designationName."</td>
                        <td>".$unitName."</td>
                        <td>".date('d-M-y', $result['date_captured'])."</td>
                        <td>".$result['effective_date']."</td>
                        <td>".$duration."</td>
                        <td>".$result['status']."</td>
                        <td class='d-print-none'>".$action."</td>
                    </tr>";
        
                }
            }else{
                //Invalid Tracking ID
                
            }
    $tbl.="</tbody>
</table>";
    echo $tbl;
    
    
}
                                        
//FETCHING OFFICER DETAILS TO MODAL
	if(isset($_POST['svcModal'])){
        $officerId = $_POST['svcModal'];
        
        $getOfficerDetails = getOfficerDetail($officerId);
        $getRankDetail = getRankDetail($getOfficerDetails['rank']);
        
        $arr = array(
    	  'initials'=>$getOfficerDetails['initials'],
    	  'surname'=>$getOfficerDetails['surname'],
    	  'firstName'=>$getOfficerDetails['first_name'],
    	  'otherName'=>$getOfficerDetails['other_name'],
    	  'gender'=>$getOfficerDetails['gender'],
    	  'email'=>$getOfficerDetails['officer_email'],
    	  'phone'=>$getOfficerDetails['phone'],
    	  'rank'=>$getRankDetail['rank_name']
    	);
    	echo json_encode($arr);
	}
	

//FETCHING OFFICER EMOLUMENT TO MODAL
	if(isset($_POST['emolID'])){
        $emolID = $_POST['emolID'];
        $getOfficerEmolument = getOfficerEmolument($emolID);
        $svn= $getOfficerEmolument['svn'];
        $getOfficerDetails = getOfficerDetail($svn);
        $getRankDetail = getRankDetail($getOfficerEmolument['rank']);
        $getPassport = getPassport($svn);
        $getBank = getBank($getOfficerEmolument['bank']);
        $getPFA = getPFA($getOfficerEmolument['pfa']);
        $getCommand = getCommand($getOfficerEmolument['command']);
        $getUnit = getUnit($getOfficerEmolument['unit']);
        $arr = array(
    	  'initials'=>$getOfficerDetails['initials'],
    	  'surname'=>$getOfficerDetails['surname'],
    	  'email'=>$getOfficerDetails['officer_email'],
    	  'phone'=>$getOfficerDetails['phone'],
    	  'rank'=>$getRankDetail['rank_code'],
    	  'unit'=>$getUnit['unit_name'],
    	  'svn'=>$getOfficerEmolument['svn'],
    	  'command'=>$getCommand['command_name'],
    	  'bank'=>$getBank['bank_name'],
    	  'account_number'=>$getOfficerEmolument['account_number'],
    	  'emolument_status'=>$getOfficerEmolument['emolument_status'],
    	  'pfa'=>$getPFA['pfa_name'],
    	  'rsa_pin'=>$getOfficerEmolument['rsa_pin'],
    	  'reason'=>$getOfficerEmolument['reason'],
    	  'emolumentImage'=>$getPassport['pass_name']
    	);
    	echo json_encode($arr);
	}
	
//APPROVING POSTING REQUEST
	if(isset($_POST['approve-posting'])){
		if(!empty($_POST['postingId'])) {
		    
		        
			$checked_count = count($_POST['postingId']);
			foreach($_POST['postingId'] as $selected) {
				$postingId = $selected;
				$query1 = DB::queryFirstRow("SELECT * FROM postings WHERE posting_id='$postingId'  AND status='Pending' LIMIT 1");
		    if($query1){
		        $officerId = $query1['officer_id'];
				
				$query = DB::queryFirstRow("SELECT * FROM postings WHERE officer_id=%i AND status=%s", $officerId, 'Active');
         		if ($query) {
         		    $postingId2 = $query['posting_id'];
         			// UPDATE RECORD WITH  ACTIVE POSTING RECORD
                    $query2 = DB::query("UPDATE postings SET status=%s, date_posted_out=%i WHERE posting_id=%i AND status=%s", 'Post Out', time(), $postingId2, 'Active');
                    if($query2){
                           // UPDATE RECORD WITH  PENDING POSTING RECORD
                          $approvedBy = $_SESSION['user_id'];
                    	$query2 = DB::query("UPDATE postings SET status=%s, approved_by=%i, date_approved=%i, previous_posting_id=%i WHERE posting_id=%i AND status=%s", 'Active', $approvedBy, time(), $postingId2, $postingId, 'Pending');
                    	if(DB::affectedRows() == 1){
                    	    $_SESSION['success'] = " Successful ";
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
    			        }else{
    			            $_SESSION['fail'] = ' Somthing went wrong ';
    			            header('Location: ' . $_SERVER['HTTP_REFERER']);
    			        }
                    }else{
                        //Unable to Update Posting Table with ACTIVE Record Status
                        
                    }	
         		}else{
         		 //   No Previous Posting Record So UPDATE the Pending Record because it may be the first POSTING$approvedBy = $_SESSION['user_id'];
         		 $approvedBy = $_SESSION['user_id'];
         		 $query2 = DB::query("UPDATE postings SET status=%s, approved_by=%i, date_approved=%i, previous_posting_id=%i WHERE posting_id=%i AND status=%s", 'Active', $approvedBy, time(), '0', $postingId, 'Pending');
                    	if(DB::affectedRows() == 1){
                    	    $_SESSION['success'] = " Successful ";
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
    			        }else{
    			            $_SESSION['fail'] = ' Somthing went wrong ';
    			            header('Location: ' . $_SERVER['HTTP_REFERER']);
    			        }
         		 
         		}
        			}else{
        		    // No Active Records with Officer ID related to the Posting ID
        		    $_SESSION['fail'] = ' Error. No valid Officer ID ';
        			header('Location: ' . $_SERVER['HTTP_REFERER']);
        		}
			}
		
			
		}else{
			$_SESSION['fail'] = ' Select at least ONE Record of Posting for Approval, Please ';
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}



//GETING UNIT LIST BASED ON COMMAND SELECTION (DROPDOWN)
	if (isset($_POST['commandId'])) { 	
		// code...
		echo getUnitDropdown($_POST['commandId']);
	}


//GETING FORMATION FROM ZONE (DROPDOWN)
	if (isset($_POST['getFormationDropdown'])) { 	
		// code...
		echo getFormationDropdown($_POST['zoneId']);
	}
	


//GETING BARRACK UNITS FROM BARRACK NAME (DROPDOWN)
	if (isset($_POST['barrackAllocationId'])) { 	
		// code...
		echo getBarrackUnitDropdown($_POST['barrackAllocationId']);
	}


//LOAD BARRACK AND UNIT INFORMATION TO NEW ALLOCATION MODAL
	if (isset($_POST['barrackUnitSelectId'])) { 
		$getBarrackUnitDetails = getBarrackUnitDetails($_POST['barrackUnitSelectId']);
		$barrackId = $getBarrackUnitDetails['barrack_id'];
		$getBarrackDetails = getBarrackDetails($barrackId);
		$getState = getState($getBarrackDetails['barrack_state']);
		$getLGA = getLGA($getBarrackDetails['barrack_lga']);
		$arr = array(
    	  'name'=>$getBarrackDetails['name'],
    	  'barrack_code'=>$getBarrackDetails['barrack_code'],
    	  'barrack_state'=>$getState['state_name'],
    	  'barrack_lga'=>$getLGA['local_govt'],
    	  'address'=>$getBarrackDetails['address'],
    	  'category'=>$getBarrackDetails['category'],
    	  
    	  'unit_name'=>$getBarrackUnitDetails['unit_name'],
    	  'unit_code'=>$getBarrackUnitDetails['unit_code'],
    	  'unit_status'=>$getBarrackUnitDetails['unit_status'],
    	  'allocation_status'=>$getBarrackUnitDetails['allocation_status']
    	);
    	echo json_encode($arr);
		
	}
	
//DELETING Single POSTING RECORD
    if (isset($_GET['postingDelId'])) {
        $postingDelId = $_GET['postingDelId'];
        $deletedBy = $_SESSION['user_id'];
        DB::query("UPDATE postings SET status=%s, approved_by=%i, date_approved=%i WHERE posting_id=%i AND status=%s", 'Deleted', $deletedBy, time(), $postingDelId, 'Pending');
        if(DB::affectedRows() == 1){
            $_SESSION['del'] = " Deleted ";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['warning'] = ' Warning. You are not Permitted to Delete this Records ';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }


//DELETING PUMP
    if (isset($_GET['userDelId'])) {
        // code...
        $userId = $_GET['userDelId'];
        DB::query("UPDATE users SET status=%s WHERE user_id=%i", 'Deleted', $userId);
        if(DB::affectedRows() == 1){
            $_SESSION['del'] = " Deleted ";
            header('Location: ' . $_SERVER['HTTP_REFERER']."?");
        }else{
            $_SESSION['fail'] = ' Error. Try Again ';
            header('Location: ' . $_SERVER['HTTP_REFERER']."?");
        }
    }






//<!-- Updating Password -->
	if(isset($_POST['oldpass']) && isset($_POST['newpass'])){
      if (isset($_SESSION['username']) && !empty($_SESSION['user_id'])) {
      	$username = $_SESSION['username'];
      	$userId = $_SESSION['user_id'];
      	$newPass = $_POST['newpass'];
		$oldPass = $_POST['oldpass'];
		 $hashKey = $_POST['hashKey'];
		 $command = $_POST['command'];
		 $department = $_POST['department'];
		 $rank = $_POST['rank'];
		 $phone = $_POST['phone'];
		 $fullname = $_POST['fullname'];
      	$check = DB::queryFirstRow("SELECT password, hash_key FROM users WHERE  user_id=%s", $userId);
      	$array=[];
			  if ($check==true) {
			      
			        $dbPass = $check['password'];
                    $salt = $check['hash_key'];
                    $oldPassHash = crypt($oldPass, $salt);
                     
			      if($oldPassHash == $dbPass){
                    if ( strlen( $newPass ) < 8 ) {
                             
                        } else {
                           // Validate password strength
                            $uppercase = preg_match('@[A-Z]@', $newPass);
                            $lowercase = preg_match('@[a-z]@', $newPass);
                            $number    = preg_match('@[0-9]@', $newPass);
                            $specialChars = preg_match('@[^\w]@', $newPass);
                        
                        if(!$uppercase || !$lowercase || !$number || !$specialChars || mb_strlen($newPass) < 8) {
                            
                            echo "<script>
                  				alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
                  				location.href='changePassword.php';
                  			</script>";
                    }else{
                        $token = bin2hex(random_bytes(32));
                        $salt = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9).time().$token;
                        $newPassword = crypt($newPass, $salt);
			          	DB::query("UPDATE users SET fullname=%s,  phone=%i, rank_id=%i, command_id=%i, department=%i, password=%s, hash_key=%s, pass_change=%s, date_created=%s WHERE user_id=%s", 
			          	$fullname,  $phone, $rank, $command, $department, $newPassword, $salt, '1', time(), $userId) ;
                  		if(DB::affectedRows() == 1){
                  			// code...
                  			$_SESSION['pass_change'] = '1';
                  			echo "<script>alert('Records Updated Successful');
                  				location.href='index.php';
                  			</script>";
                  		}else{
                  			echo "<script>
                  				alert('An error occured. New Password should NOT be SAME as Current Password');
                  				location.href='changePassword.php';
                  				</script>";
                  		}
                     }
			      }
			          //End of New Password Match with Old Password
			      }else{
			          echo "<script>
                  				alert('Incorrect old password');
                  				location.href='changePassword.php';
                  			</script>";
			      }
			  }
      	
        }else{
        	echo "<script>
        		alert('Invalid Request. kindly loggin again');
        		location.href='logout.php';
        		</script>";
        }
      
  }


//NEW BARRACK
if(isset($_POST['new-barrack'])){
    $barrackCode = $_POST['barrackCode'];
    $query = DB::queryFirstRow("SELECT barrack_code FROM barrack_information WHERE barrack_code = '$barrackCode'");
    if($query){
        $_SESSION['fail'] = ' Error. Barrack Code Exist ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);	
            }else{
                
            $res = DB::insert('barrack_information', array(
            'name' => $_POST['barrackName'],
            'barrack_code' => $_POST['barrackCode'],
            'category' => $_POST['barrackCategory'],
            'description' => $_POST['barrackDescription'],
            'address' => $_POST['barrackAddress'],
            'barrack_state' => $_POST['barrackState'],
            'barrack_lga' => $_POST['barrackLGA'],
            'created_by' => $_SESSION['svc'],
            'barrack_status' => $_POST['barrackStatus'],
            'date_created' => time()
                )
                    
            );
                if($res){
                     $_SESSION['success'] = " Barrack Records Successful Added";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    
                }else{
                     $_SESSION['fail'] = " Failed to Added Barrack Records ";
                     header('Location: ' . $_SERVER['HTTP_REFERER']);
                }      
                        
    }
}


//NEW BARRACK UNIT
if(isset($_POST['new-barrack-unit'])){
    $barrackUnitCode = $_POST['barrackUnitCode'];
    $query = DB::queryFirstRow("SELECT unit_code FROM barrack_unit_information WHERE unit_code = '$barrackUnitCode'");
    if($query){
        $_SESSION['fail'] = ' Error. Barrack Unit Code Exist ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);	
            }else{
                
            $res = DB::insert('barrack_unit_information', array(
            'unit_name' => $_POST['barrackUnitName'],
            'unit_code' => $_POST['barrackUnitCode'],
            'unit_status' => $_POST['barrackUnitStatus'],
            'facilities' => $_POST['barrackFacilities'],
            'allocation_status' => $_POST['barrackUnitAllocationStatus'],
            'barrack_id' => $_POST['barrackId'],
            'created_by' => $_SESSION['svc'],
            'date_created' => time()
                )
                    
            );
                if($res){
                     $_SESSION['success'] = " Barrack Records Successful Added";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    
                }else{
                     $_SESSION['fail'] = " Failed to Added Barrack Records ";
                     header('Location: ' . $_SERVER['HTTP_REFERER']);
                }      
                        
    }
}


//NEW ALLOCATION APPLICATION
if(isset($_POST['new-allocation-application'])){
    $barrackUnitId = $_POST['barrackUnitSelect'];
    $svn = $_SESSION['svc'];
    $query = DB::queryFirstRow("SELECT * FROM barrack_unit_information WHERE barrack_unit_id = '$barrackUnitId' AND allocation_status='Available'");
    if($query){
           $query2 = DB::queryFirstRow("SELECT * FROM postings WHERE svn='$svn' AND status='Active'");
           if($query2){
                $res = DB::insert('allocations', array(
                'command' => $query2['command'],
                'unit' => $query2['unit'],
                'rank' => $query2['rank_id'],
                'barrack_id' => $query['barrack_id'],
                'barrack_unit_id' => $query['barrack_unit_id'],
                'unit_name' => $query['unit_name'],
                'unit_status' => $query['unit_status'],
                'facilities' => $query['facilities'],
                'decision' => 'Submitted',
                'svn' => $_SESSION['svc'],
                'application_date' => time()
                    )
                        
                );
                $insertedId = DB::insertId();
                if($res){
                    $flatCode = $query['unit_code'];
                    $date = date('m/y', time());
                    $trackingId = 'NCS/'.$flatCode.'/'.$date.'/'.$insertedId;
                    DB::query("UPDATE allocations SET tracking_id='$trackingId' WHERE allocation_id='$insertedId'");
                    DB::query("UPDATE barrack_unit_information SET allocation_status='Submitted' WHERE barrack_unit_id='$barrackUnitId'");
                    $_SESSION['success'] = " Barrack Application Successful";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    
                }else{
                     $_SESSION['fail'] = " Error. Failed to submit Barrack application ";
                     header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
           }else{
               $_SESSION['fail'] = ' Error. You dont have an Active Posting. Please update your Posting Records or Contact the System Administrator ';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
           }
        }else{
        $_SESSION['fail'] = ' Error. You are not allow to apply for this Unit because it is not currently available ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);	            
    }
}


//LOAD BARRACK  UNIT IMAGES TO MODAL
	if (isset($_POST['barrackImageId'])) { 
		$getBarrackUnitImages = getBarrackUnitImages($_POST['barrackImageId']);
		$arr = array(
    	  'image1'=>$getBarrackUnitImages['image1'],
    	  'imageTitle1'=>$getBarrackUnitImages['imageTitle1'],
    	  'image2'=>$getBarrackUnitImages['image2'],
    	  'imageTitle2'=>$getBarrackUnitImages['imageTitle2'],
    	  'image3'=>$getBarrackUnitImages['image3'],
    	  'imageTitle3'=>$getBarrackUnitImages['imageTitle3'],
    	  'image4'=>$getBarrackUnitImages['image4'],
    	  'imageTitle4'=>$getBarrackUnitImages['imageTitle4'],
    	  'image5'=>$getBarrackUnitImages['image5'],
    	  'imageTitle5'=>$getBarrackUnitImages['imageTitle5'],
    	  'image6'=>$getBarrackUnitImages['image6'],
    	  'imageTitle6'=>$getBarrackUnitImages['imageTitle6'],
    	  'image7'=>$getBarrackUnitImages['image7'],
    	  'imageTitle7'=>$getBarrackUnitImages['imageTitle7'],
    	  'image8'=>$getBarrackUnitImages['image8'],
    	  'imageTitle8'=>$getBarrackUnitImages['imageTitle8']
    	);
    	echo json_encode($arr);
		
	}

?>

