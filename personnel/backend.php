<?php 
 json_decode($_GET['officer-bank']);
session_start(); ?>
<?php require_once '../connections/meekro/db.class.php'; ?>
<?php require_once 'functions.php';?>
<?php

//FETCHING LGAs FROM SELECTION OF STATE OF ORIGIN
	if (isset($_POST['stateId'])) { 	
		// code...
		echo getLGADropdown($_POST['stateId']);
	}

//DRAFT SUBMISSION BY AN OFFICER
if(isset($_POST['update-officer'])){
    $svn = $_SESSION['svc'];
    $query = DB::queryFirstRow("SELECT svn FROM basic_information WHERE svn = '$svn'");
    if($query){
        $update = DB::query("UPDATE basic_information SET submission_status=%s, date_created=%s WHERE svn=%s", 'Active', time(), $svn);
    		if(DB::affectedRows() == 1){
    			$_SESSION['success'] = " Records Successfully Updated ";
    			 header('Location: ' . $_SERVER['HTTP_REFERER']);
    		}else{
    			$_SESSION['fail'] = ' Error. Records Failed to update. Please contact the System Administrator ';
    			header('Location: ' . $_SERVER['HTTP_REFERER']);
    		}
    }else{
    	$_SESSION['fail'] = ' Error. Invalid Service Number ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


//SCHEDUL EMOLUMENT
if (isset($_POST['schedule-emolument'])) {
    $year = date('Y', time()) + 1;
    $initiator = $_SESSION['svc'];
    $startDate = $_POST['dateStarted'];
    $endDate = $_POST['dateEnded'];
    $todayDate = strtotime(date('Y-m-d'));

    if ($endDate == '') {
        $terminator = 'N/A';
        $dateTerminated = 'N/A';
    } else{
            if(strtotime($startDate) >= strtotime($endDate)){
            $_SESSION['fail'] = 'Error. End Date cannot be before '.$startDate;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else {
                if($todayDate >= strtotime($endDate)){
            $_SESSION['fail'] = 'Error. End Date cannot be before TODAY';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                
           

    // Select all relevant emolument schedules for the year and inactive schedules whose end date has not passed
    $query = DB::query("SELECT * FROM emolument_schedule WHERE emolument_year=%s AND (schedule_status='Active' OR (schedule_status='Inactive' AND end_date >= NOW()))", $year);

    if (!empty($query)) {
        foreach ($query as $record) {
            $today = strtotime(date('Y-m-d'));
            $status = $record['schedule_status'];
            $end = strtotime($record['end_date']);

            if ($status == 'Active' && $end >= $today) {
                $_SESSION['fail'] = 'Error. Emolument for ' . $year . ' is still In-Progress';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit; // Terminate script execution after redirect
            } elseif ($status == 'Active') {
                $_SESSION['fail'] = 'Error. Emolument for ' . $year . ' has already been scheduled and is still Active';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit; // Terminate script execution after redirect
            }
        }
    }
     $today = strtotime(date('Y-m-d'));
    // Proceed to insert the new emolument schedule
    if ($endDate != '' && strtotime($endDate) < $today) {
        $_SESSION['fail'] = 'Error. End date has passed for ' . $year . ' Emolument';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        if($endDate != ''){
            $scheduleStat = 'Inactive';
        }else{
             $scheduleStat = 'Active';
        }
        $terminator = $_SESSION['svc'];
        $dateTerminated = time();
        // Insert the new emolument schedule
        DB::insert('emolument_schedule', [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'initiated_by' => $initiator,
            'date_initiated' => time(),
            'terminated_by' => $terminator,
            'date_terminated' => $dateTerminated,
            'schedule_status' => $scheduleStat,
            'emolument_year' => $year,
        ]);

        if (DB::affectedRows() == 1) {
            $_SESSION['success'] = "Emolument Period successfully Added";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['fail'] = 'Error. Try Again';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
     }
    
    }
   }
  }
}




//TERMINATE EMOLUMENT
    if (isset($_POST['end-emolument'])) {
        $emolumentTerminationId = $_POST['emolumentTerminationId'];
        $query = DB::queryFirstRow("SELECT * FROM emolument_schedule WHERE id=%i AND schedule_status=%s", $emolumentTerminationId, 'Active');
        if($query){
            $terminalBy = $_SESSION['svc'];
            $dateTerminated = time();
            $startDate = $query['start_date'];
            $endDate = $_POST['emolumentDate'];
            $emolumentTerminationDate = $_POST['emolumentDate'];
            
            $startDate = strtotime($query['start_date']);
            $emolumentTerminationDate = strtotime($_POST['emolumentDate']);
            if ($startDate === false || $emolumentTerminationDate === false) {
                // Handle invalid date strings here
                	$_SESSION['fail'] = ' Error. Invalid date format provided. ';
			        header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                // Calculate the difference in seconds
                $differenceInSeconds = $emolumentTerminationDate - $startDate;
            
                // Convert the difference to days
                $daysDifference = floor($differenceInSeconds / (60 * 60 * 24));
                if($daysDifference < 0){
                    $_SESSION['fail'] = ' Error. Emolument Termination Date CANNOT be before '.date('d-M-Y', $startDate);
			        header('Location: ' . $_SERVER['HTTP_REFERER']);
                }else{
                   $query2 = DB::query("UPDATE emolument_schedule SET schedule_status=%s, terminated_by=%s, end_date=%s, date_terminated=%s WHERE id=%i AND schedule_status=%s", 'Inactive', $terminalBy, $endDate, time(), $emolumentTerminationId, 'Active');
                	if(DB::affectedRows() == 1){
                	    $_SESSION['success'] = " Emolument Period Successfully Terminated ";
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
        	        }else{
        	            $_SESSION['fail'] = ' Failed: Somthing went WRONG. Please contact the System Administrator ';
        	            header('Location: ' . $_SERVER['HTTP_REFERER']);
        	        }  
                }
            }
        }else{
            $_SESSION['fail'] = ' Failed: You can only terminal an Active Emolument Schedule. ';
	        header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    
//NEW EMOLUMENT
if(isset($_POST['add-emolument'])){
    $svn = $_SESSION['svc'];
    $query = DB::queryFirstRow("SELECT svn FROM basic_information WHERE svn = '$svn' AND submission_status='Active'");
    if($query){
        $y = date('Y', time());
        $year = $y + 1;
        $query = DB::queryFirstRow("SELECT * FROM emolument WHERE svn = '$svn' AND  (status<>'Cancelled' || status<>'Rejected' || status<>'Deleted') AND emolument_year='$year'");
            if($query){
                	$_SESSION['fail'] = ' Warning. You are not allowed to submit this Emolument. Please contact the system Administrator ';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                
                  $res = DB::insert('emolument', array(
                    'svn' => $_SESSION['svc'],
                    'rank' => $_POST['rank'],
                    'command' => $_POST['commandPostEmolument'],
                    'unit' => $_POST['unitEmolument'],
                    'bank' => $_POST['bank'],
                    'account_number' => $_POST['accountNumber'],
                    'rsa_pin' => $_POST['pfaNumber'],
                    'pfa' => $_POST['pfa'],
                    'emolument_year' => $year,
                    'interdicted' => $_POST['interdicted'],
                    'date_interdicted' => $_POST['dateInterdicted'],
                    'quartered' => $_POST['barracks'],
                    'date_quartered' => $_POST['dateQuartered'],
                    'status' => 'Submitted',
                    'date_created' => time()
                        )
                            
                    );
                        if($res){
                             $_SESSION['success'] = " Emolument Records Successful Added";
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                            
                        }else{
                             $_SESSION['fail'] = " Failed to Added Records ";
                             header('Location: ' . $_SERVER['HTTP_REFERER']);
                                }
                        }
    }else{
    	$_SESSION['fail'] = ' Error. Invalid Records. Please UPDATE your Information to Proceed ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


//APPROVE EMOLUMENT BY AN ASSESSOR
if(isset($_POST['approve-emolument'])){
		if(!empty($_POST['emolumentId'])) {
		    
			$checked_count = count($_POST['emolumentId']);
			foreach($_POST['emolumentId'] as $selected) {
				$emolumentId = $selected;
				$query1 = DB::queryFirstRow("SELECT * FROM emolument WHERE id='$emolumentId'  AND status='Submitted' LIMIT 1");
		    if($query1){
		        $assessedBy = $_SESSION['svc'];
         		 $query2 = DB::query("UPDATE emolument SET status=%s, assess_status=%s, assess_by=%s, date_assessed=%s WHERE id=%i AND status=%s", 'ASSESSED', 'APPROVED', $assessedBy, time(), $emolumentId, 'Submitted');
                    	if(DB::affectedRows() == 1){
                    	    $_SESSION['success'] = " Emolument Successfully APPROVED ";
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
    			        }else{
    			            $_SESSION['fail'] = ' Failed: Somthing went WRONG. Please contact the System Administrator ';
    			            header('Location: ' . $_SERVER['HTTP_REFERER']);
    			        }
    			}else{
    		    // No Active Records EMOLUMENT DATA
    		    $_SESSION['fail'] = ' Error. No valid EMOLUMENT RECORD Found ';
    			header('Location: ' . $_SERVER['HTTP_REFERER']);
    		}
		}
		
			
		}else{
			$_SESSION['fail'] = ' Select at least ONE Record of EMOLUMENT for Approval, Please ';
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}

// Reject Emolument
if(isset($_POST['reject-emolument'])){
		if(!empty($_POST['emolumentId'])) {
		    
			$checked_count = count($_POST['emolumentId']);
			foreach($_POST['emolumentId'] as $selected) {
				$emolumentId = $selected;
				$query1 = DB::queryFirstRow("SELECT * FROM emolument WHERE id='$emolumentId'  AND status='Submitted' LIMIT 1");
		    if($query1){
		        $assessedBy = $_SESSION['svc'];
         		 $query2 = DB::query("UPDATE emolument SET status=%s, assess_status=%s, assess_by=%s, date_assessed=%s WHERE id=%i AND status=%s", 'ASSESSED', 'APPROVED', $assessedBy, time(), $emolumentId, 'Submitted');
                    	if(DB::affectedRows() == 1){
                    	    $_SESSION['success'] = " Emolument Successfully APPROVED ";
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
    			        }else{
    			            $_SESSION['fail'] = ' Failed: Somthing went WRONG. Please contact the System Administrator ';
    			            header('Location: ' . $_SERVER['HTTP_REFERER']);
    			        }
    			}else{
    		    // No Active Records EMOLUMENT DATA
    		    $_SESSION['fail'] = ' Error. No valid EMOLUMENT RECORD Found ';
    			header('Location: ' . $_SERVER['HTTP_REFERER']);
    		}
		}
		
			
		}else{
			$_SESSION['fail'] = ' Select at least ONE Record of EMOLUMENT for Approval, Please ';
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
//FETCHING HEADQUARTER UNITS
	if (isset($_POST['commId'])) { 	
		// code...
		echo getHeadquarterUnits($_POST['commId']);
	}
//FETCHING DESIGNATION
if (isset($_POST['departmentId'])) { 	
	// code...
	echo getDesignationDropDown($_POST['departmentId']);
}

	
//ADDING NEW POSTING RECORDS OF OFFICER
	if(isset($_POST['add-posting'])){
	    $svn = $_SESSION['svc'];
        $query = DB::queryFirstRow("SELECT * FROM basic_information WHERE svn='$svn' AND submission_status<>'Retired' LIMIT 1");
			if($query){
			    $check = DB::queryFirstRow("SELECT * FROM postings WHERE svn='$svn' AND status='Pending'");
			    if($check){
			        //There is a Record with Pending Status
			        $_SESSION['fail'] = ' Error. The Officer has a Pending Posting Record already ';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
			    }else{
			       //There is NO record with Pending Status
			       $unit = $_POST['unit'];
			       if($unit==''){
			           $unit = 'N/A';
			       }else{
			           $unit = $_POST['unit'];
			       }
			       
			       $datePostedOut = $_POST['datePostedOut'];
			    	    if($datePostedOut!=''){
			    	        $status = 'Posted Out';
			    	        $datePostedOut = $_POST['datePostedOut'];
			    	    }else{
			    	        $status = 'Active';
			    	        $datePostedOut = 'N/A';
			    	    }
			    	$query2 = DB::queryFirstRow("SELECT * FROM postings WHERE svn='$svn' AND status='Active'");
			    	if($query2){
			    	    $previousPostingId = $query2['posting_id'];
			    	    if($previousPostingId==''){
			    	        $previousPostingId = 'N/A';
			    	    }else{
			    	        $previousPostingId = $query2['posting_id'];
			    	    }
			    	    
			    	    
			    	            //INSERT NEW POSTING RECORDS
			    	            DB::insertIgnore('postings', [
                        		  'svn' => $svn,
                        		  'command' => $_POST['commandPost'],
                        		  'rank_id' => $_POST['rank'],
                        		  'unit' => $unit,
                        		  'officer_email' => $_POST['emailModal'],
                        		  'designation' => $_POST['designation'],
                        		  'date_posted_out' => $datePostedOut,
                        		  'department' => $_SESSION['department_id'],
                        		  'previous_posting_id' => $previousPostingId,
                        		  'effective_date' => $_POST['effectiveDate'],
                        		  'status' => $status,
                        		  'captured_by' => $_SESSION['svc'],
                        		  'date_captured' => time(),
                        		]);
                        		
                        		    $id = DB::insertId();
                        		    
                                    $capturer = $_SESSION['svc'];
                                    $getUserDetail = getUserDetail($capturer);
                                    $deptId = $_POST['department'];
                                    $getDeptDetail = getDepartment($deptId);
                                    $deptCode = $getDeptDetail['department_code'];
                                    $getCommandDetail = getCommand($_POST['commandPost']);
                                    $commCode = $getCommandDetail['command_code'];
                                    $getUnitDetail = getUnit($_POST['unit']);
                                    $unitCode = $getUnitDetail['unit_code'];
                                    $month = date('m/y', time());
                                    $postingRef = 'NCS/'.$deptCode.'/'.$commCode.'/'.$unitCode.'/'.$month.'/'.$id;
                                    
                            		$query8 = DB::query("UPDATE postings SET posting_ref=%s WHERE posting_id=%i", $postingRef, $id);
                            		if(DB::affectedRows() == 1){
                            			$_SESSION['success'] = " Posting Records Successfully Added ";
                            			header('Location: ' . $_SERVER['HTTP_REFERER']);
                            		}else{
                            			$_SESSION['fail'] = ' Error. Try Again ';
                            			header('Location: ' . $_SERVER['HTTP_REFERER']);
                            		}
			    	    
			    	}else{
        			    DB::insertIgnore('postings', [
                		  'svn' => $_SESSION['svc'],
                		  'command' => $_POST['commandPost'],
                		  'unit' => $unit,
                		  'rank_id' => $_POST['rank'],
                		  'officer_email' => $_SESSION['username'],
                		  'designation' => $_POST['designation'],
                		  'effective_date' => $_POST['effectiveDate'],
                		  'status' => $status,
                		  'captured_by' => $_SESSION['svc'],
                		  'department' => $_POST['department'],
                		  'previous_posting_id' => '0',
                		  'date_captured' => time(),
                		]);
                            
                             $id = DB::insertId();
                        		    
                                    $capturer = $_SESSION['svc'];
                                    $getUserDetail = getUserDetail($capturer);
                                    $deptId = $_POST['department'];
                                    $getDeptDetail = getDepartment($deptId);
                                    $deptCode = $getDeptDetail['department_code'];
                                    $commandId = $_POST['commandPost'];
                                    $getCommandDetail = getCommand($commandId);
                                    $commCode = $getCommandDetail['command_code'];
                                    $getUnitDetail = getUnit($_POST['unit']);
                                    $unitCode = $getUnitDetail['unit_code'];
                                    $month = date('m/y', time());
                                    $unit = $_POST['unit'];
                                    if($unit==''){
                                        $unitCode='';
                                    }else{
                                        $unitCode = '/'.$unitCode;
                                    }
                                    $postingRef = 'NCS/'.$deptCode.'/'.$commCode.$unitCode.'/'.$month.'/'.$id;
                                    
                            		$query9 = DB::query("UPDATE postings SET posting_ref=%s WHERE posting_id=%i", $postingRef, $id);
                            		
                    		if(DB::affectedRows() == 1){
                    			$_SESSION['success'] = " Posting Records Successfully Added ";
                    			header('Location: ' . $_SERVER['HTTP_REFERER']);
                    		}else{
                    			$_SESSION['fail'] = ' Error. Try Again ';
                    			header('Location: ' . $_SERVER['HTTP_REFERER']);
                    		}
    			    	}
			    }
			}else{
			     //OFFICE RECORDS EXIST
			    $_SESSION['fail'] = ' Error. This Service Number does not exist with Records ';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		
		
	}



//ADDING OFFICER BIODATA INFORMATION
  if (isset($_POST['add-officer'])) {
      $birth = substr($_POST['dob'], 0, 4);
      $thisYear = date("Y");
      $age = $thisYear - $birth;
      $fappt = substr($_POST['firstAppiontment'], 0, 4);
      $years = $thisYear - $fappt;
      if($years > 35){
         $_SESSION['fail'] = ' Error. You are 35 and above years in Service ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }elseif($age < 18 || $age > 60){
          $_SESSION['fail'] = ' Error. You are either below 18 years or above 60 years ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
          //echo "<script>location.href='index.php?v'</script>";
      }else{
        $svn = $_POST['svn'];
       $record = DB::query("SELECT * FROM basic_information WHERE svn = '$svn' AND submission_status = 'Active'");
        if ($record) {
            $_SESSION['success'] = ' You have submitted your records already ';
           // header('Location: ' . $_SERVER['HTTP_REFERER']);
            echo "<script>location.href='preview.php'</script>";
        }else{
        $res = DB::query("SELECT * FROM basic_information WHERE svn = '$svn' AND submission_status = 'Pending'");
            if ($res) {
                foreach($res as $application){
                    $Id = $application['id'];
                }
            $svn = $_POST['svn'];
            $surname = $_POST['surname'];
            $firstname = $_POST['firstname'];
            $othername = $_POST['othername'];
            $middlename = $_POST['middlename'];
            $appointmentDate = $_POST['firstAppiontment'];
            $promotionDate = $_POST['promotionDate'];
            $datePostToStation = $_POST['datePostedToStation'];
            $initials = $_POST['initial'];
            $dob = $_POST['dob'];
            $status = 'Draft';
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $fileRef = $_POST['fileRef'];
            $hqNo = $_POST['hqNo'];
            $maritalStatus = $_POST['maritalStatus'];
            $state = $_POST['state'];
            $lga = $_POST['lga'];
            $state1 = $_POST['state1'];
            $lga1 = $_POST['lga1'];
            $residence = $_POST['residenceAddress'];
            $date = time();
            
        $res = DB::query("UPDATE basic_information SET appointment_date=%s, last_promotion_date=%s, date_posted_to_station=%s, surname=%s, first_name=%s, initials=%s,  other_name=%s, middle_name=%s, phone=%s, officer_email=%s, 
        date_of_birth=%s, gender=%s, hq_no=%s, file_ref=%s, marital_status=%s, state_id=%s, lga_id=%s, residence_address=%s, residence_state=%s, residence_lga=%s WHERE svn=%s",
        $appointmentDate, $promotionDate, $datePostToStation, $surname, $firstname,
        $initials, $othername, $middlename, $phone, $email, $dob, $gender, $hqNo, $fileRef, $maritalStatus, $state, $lga, $residence, $state1, $lga1, $svn);
        
            //$_SESSION['Id'] = $Id;
            $_SESSION['success'] = " Records Updated Successful ";
        echo "<script>location.href='nok.php'</script>";
        }else{
        $res = DB::insert('basic_information', array(
            'svn' => $_POST['svn'],
            'surname' => $_POST['surname'],
            'first_name' => $_POST['firstname'],
            'initials' => $_POST['initial'],
            'other_name' => $_POST['othername'],
            'file_ref' => $_POST['fileRef'],
            'middle_name' => $_POST['middlename'],
            'submission_status' => 'Pending',
            'phone' => $_POST['phone'],
            'hq_no' => $_POST['hqNo'],
            'appointment_date' => $_POST['appointmentDate'],
            'last_promotion_date' => $_POST['promotionDate'],
            'date_posted_to_station' => $_POST['datePostedToStation'],
            'officer_email' => $_POST['email'],
            'date_of_birth' => $_POST['dob'],
            'gender' => $_POST['gender'],
            'marital_status' => $_POST['maritalStatus'],
            'state_id' => $_POST['state'],
            'lga_id' => $_POST['lga'],
            'residence_address' => $_POST['residenceAddress'],
            'residence_state' => $_POST['state1'],
            'residence_lga' => $_POST['lga1'],
            'date_created' => time()
        )
        
    ); 
    $_SESSION['Id'] = DB::insertId();
     if($res){
        $_SESSION['success'] = " Successful ";
        echo "<script>location.href='nok.php'</script>";
            }else{
                 $_SESSION['fail'] = ' Somthing went wrong ';
                  header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
  }
      
}
      

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


    //ADDING BANK INFORMATION
  if (isset($_POST['officer-bank'])) {
    $svn = $_SESSION['svc'];
      $record = DB::query("SELECT * FROM basic_information WHERE svn = '$svn' AND submission_status = 'Submitted'");
       if ($record) {
           //echo "<script>location.href='preview.php'</script>";
       }else{
       $res = DB::query("SELECT * FROM bank_info WHERE svn = '$svn'");
           if ($res) {
           $svn = $_SESSION['svc'];
           $bankName = $_POST['bankName'];
           $accName = $_POST['accName'];
           $BVN = $_POST['BVN'];
           $accNumber = $_POST['accNumber'];
           
       $res = DB::query("UPDATE bank_info SET bankName=%s, accName=%s, BVN=%s, accNumber=%s WHERE svn=%s", $bankName, $accName, $BVN, $accNumber, $svn);
           $_SESSION['success'] = " Records Successful Added";
           echo "<script>location.href='retirement_verification2.php'</script>";
           }else{
       $res = DB::insert('bank_info', array(
           'svn' => $_SESSION['svc'],
           'bankName' => $_POST['bankName'],
           'accName' => $_POST['accName'],
           'BVN' => $_POST['BVN'],
           'accNumber' => $_POST['accNumber'],
       )
           
   );
       if($res){
            $_SESSION['success'] = " Records Successful Added";
           echo "<script>location.href='retirement_verification2.php'</script>";
           
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


//EDIT EMOLUMENT SCHEDULE PERIOD MODAL
	if(isset($_POST['editEmolId'])){
        $editEmolumentId = $_POST['editEmolId'];
        $getEmolumentSchedule = getEmolumentSchedule($editEmolumentId);
        $arr = array(
    	  'start_date'=>$getEmolumentSchedule['start_date'],
    	  'end_date'=>$getEmolumentSchedule['end_date']
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

