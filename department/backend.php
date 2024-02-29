<?php session_start(); ?>
<?php require_once '../connections/meekro/db.class.php'; ?>
<?php require_once 'functions.php';?>
<?php

//ADDING TERMINAL
	if(isset($_POST['add-terminal'])){
	    $terminal = $_POST['terminal'];
        $query = DB::queryFirstRow("SELECT * FROM terminal WHERE terminal_name='$terminal' LIMIT 1");
			if($query){
			    //OFFICE RECORDS EXIST
			    $_SESSION['fail'] = ' Error. Terminal Exist ';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
			}else{
			     
            	DB::insertIgnore('terminal', [
        		  'terminal_name' => $_POST['terminal'],
        		  'terminal_type' => $_POST['terminalType'],
        		  'status' => 'Active',
        		  'command' => $_POST['commandId'],
        		  'user_id' => $_SESSION['user_id'],
        		  'date_created' => time(),
        		]);

            		if(DB::affectedRows() == 1){
            			$_SESSION['success'] = " Terminal Records Successfully Added ";
            			header('Location: ' . $_SERVER['HTTP_REFERER']);
            		}else{
            			$_SESSION['fail'] = ' Error. Try Again ';
            			header('Location: ' . $_SERVER['HTTP_REFERER']);
            		}
			}
		
		
	}







//ADDING NEW POSTING RECORDS OF OFFICER
	if(isset($_POST['add-posting'])){
	    $officerId = $_POST['svcModal'];
        $query = DB::queryFirstRow("SELECT * FROM officers WHERE officer_id='$officerId' AND status='Active' LIMIT 1");
			if($query){
			    $rank = $query['rank'];
			    $check = DB::queryFirstRow("SELECT * FROM postings WHERE officer_id='$officerId' AND status='Pending'");
			    if($check){
			        //There is a Record with Pending Status
			        $_SESSION['fail'] = ' Error. The Officer has a Pending Posting Record already ';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
			    }else{
			       //There is NO record with Pending Status
			       
			    	$query2 = DB::queryFirstRow("SELECT * FROM postings where officer_id='$officerId' AND status='Active'");
			    	if($query2){
			    	    $previousPostingId = $query2['posting_id'];
			    	    // Current Active Posting FOUND AND UPDATED
			    	    // $query3 = DB::query("UPDATE postings SET status=%s, date_posted_out=%i WHERE officer_id=%i AND status=%s", 'Active', time(), $officerId, 'Active');
			    	    // if($query3){
			    	            //INSERT NEW POSTING RECORDS
			    	            DB::insertIgnore('postings', [
                        		  'officer_id' => $_POST['svcModal'],
                        		  'command' => $_POST['command'],
                        		  'rank' => $rank,
                        		  'unit' => $_POST['unit'],
                        		  'officer_email' => $_POST['emailModal'],
                        		  'designation' => $_POST['designation'],
                        		  'department' => $_SESSION['department_id'],
                        		  'previous_posting_id' => $previousPostingId,
                        		  'effective_date' => $_POST['effectiveDate'],
                        		  'status' => 'Pending',
                        		  'captured_by' => $_SESSION['user_id'],
                        		  'date_captured' => time(),
                        		]);
                        		
                        		    $id = DB::insertId();
                        		    
                                    $capturer = $_SESSION['user_id'];
                                    $getUserDetail = getUserDetail($capturer);
                                    $deptId = $_SESSION['department_id'];
                                    $getDeptDetail = getDepartment($deptId);
                                    $deptCode = $getDeptDetail['department_code'];
                                    $getCommandDetail = getFormation($_POST['command']);
                                    $commCode = $getCommandDetail['formation_code'];
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
			    	    // }else{
			    	    //         //UNABLE TO UPDATE PREVIOUS ACTIVE POSTING RECORDS
			    	    //             $_SESSION['fail'] = ' Error. Failed to Update. The officer has NO Active Posting Records ';
            //                 			header('Location: ' . $_SERVER['HTTP_REFERER']); 
			    	    // }
			    	}else{
        			    DB::insertIgnore('postings', [
                		  'officer_id' => $_POST['svcModal'],
                		  'command' => $_POST['command'],
                		  'unit' => $_POST['unit'],
                		  'rank' => $rank,
                		  'officer_email' => $_POST['emailModal'],
                		  'designation' => $_POST['designation'],
                		  'effective_date' => $_POST['effectiveDate'],
                		  'status' => 'Pending',
                		  'captured_by' => $_SESSION['user_id'],
                		  'department' => $_SESSION['department_id'],
                		  'previous_posting_id' => '0',
                		  'date_captured' => time(),
                		]);
                            
                             $id = DB::insertId();
                        		    
                                    $capturer = $_SESSION['user_id'];
                                    $getUserDetail = getUserDetail($capturer);
                                    $deptId = $_SESSION['department_id'];
                                    $getDeptDetail = getDepartment($deptId);
                                    $deptCode = $getDeptDetail['department_code'];
                                    $getCommandDetail = getFormation($_POST['command']);
                                    $commCode = $getCommandDetail['formation_code'];
                                    $getUnitDetail = getUnit($_POST['unit']);
                                    $unitCode = $getUnitDetail['unit_code'];
                                    $month = date('m/y', time());
                                    $postingRef = 'NCS/'.$deptCode.'/'.$commCode.'/'.$unitCode.'/'.$month.'/'.$id;
                                    
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



//FETCHING STOCK OUT RECORDS
if(isset($_POST['productionID'])){
	$productionID = $_POST['productionID'];
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

//ADDING ARM ALLOCATION
	if(isset($_POST['allocate-arm'])){
		if(!empty($_POST['userId'])) {
			$formationId = $_POST['formation'];
// 			$shiftId = $_POST['userShiftId'];
		// Counting number of checked checkboxes.
			$checked_count = count($_POST['userId']);
			//echo "You have selected following ".$checked_count." option(s): <br/>";
			// Loop to store and display values of individual checked checkbox.
			$query = DB::queryFirstRow("SELECT * FROM arm_allocation ORDER BY allocation_id DESC LIMIT 1");
			if($query){
			    $batch = $query['allocation_id'] + 173;
			}else{
			     $batch = 136;
			}
			foreach($_POST['userId'] as $selected) {
				//echo "<p>".$selected ."</p>";
				// $position = 1;

				$allocationId = $selected;
				$query = DB::queryFirstRow("SELECT * FROM arm_allocation WHERE allocation_id=%i", $allocationId);
         		if ($query) {
         			// DO NOTHING
         			$armId = $query['arm_id'];
         			$fromCommandId = $query['to_command_id'];
         			$toCommandId = $formationId;
         			$fromComm = getFromCommand($fromCommandId);
                    $fromCommandCode = $fromComm['formation_code'];
                    $toComm = getToCommand($toCommandId);
                    $armStatus = $query['arm_status'];
                    $toCommandCode = $toComm['formation_code'];
                    $getArmDetails = getArmsDetails($armId);
                    $serialNo = $getArmDetails['serial_no'];
                    $typeId = $getArmDetails['type_id'];
                    $armType = getArmType($typeId);
                    $categoryId = $armType['category_id'];
                    $allocatiedBy = $_SESSION['user_id'];
                    $year =  date("Y/m");
                    
                    //INSERTING INTO THE ALLOCATION TABLE
                	DB::insertIgnore('arm_allocation', [
            		  'arm_id' => $armId,
            		  'from_command_id' => $fromCommandId,
            		  'to_command_id' => $toCommandId,
            		  'allocated_by' => $allocatiedBy,
            		  'category_id' => $categoryId,
            		  'arm_status' => $armStatus,
            		  'status' => 'Sent',
            		  'date_allocated' => time(),
                		]);
                	if(DB::affectedRows() == 1){
			            $Id = DB::insertId();
			            $trackingRef = 'NCS/'.$fromCommandCode.'/'.$toCommandCode.'/'.$serialNo.'/'.$Id;
			            $batchNo = 'AM/'.$toCommandCode.'/'.$year.'/'.$batch;
			             DB::query("UPDATE arm_allocation SET tracking_ref=%s, batch_no=%s WHERE allocation_id=%i", $trackingRef, $batchNo, $Id);
			             DB::query("UPDATE arm_allocation SET status=%s WHERE allocation_id=%i", 'Moved', $allocationId);
                        if(DB::affectedRows() == 1){
                            $_SESSION['success'] = " Successful ";
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                        }
			        }else{
			            $_SESSION['fail'] = ' Somthing went wrong ';
			            header('Location: ' . $_SERVER['HTTP_REFERER']);
			        }	
                
         			
         			
         			
         			
         		}else{
         		 //   we dont know yet
         		}
         		//$position = $position + 1;
			}
			
		}
		else{
			$_SESSION['fail'] = ' Select at least ONE Arm for Movement from Formation to another Formation ';
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

//DELETING Single RECORD OF PRODUCTION IN THE PRODUCTION Batch
    if (isset($_GET['DelProductionId'])) {
        $DelProductionId = $_GET['DelProductionId'];
        DB::query("UPDATE production SET entry_status=%s WHERE production_id=%i AND entry_status=%s", 'Deleted', $DelProductionId, 'Active');
        if(DB::affectedRows() == 1){
            $_SESSION['del'] = " Deleted ";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['fail'] = ' Error. You are not Permitted to Delete this PRODUCTION RECORD ';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

//CLOSING Single RECORD OF PRODUCTION IN THE PRODUCTION Batch
    if (isset($_GET['CloseProductionId'])) {
        $CloseProductionId = $_GET['CloseProductionId'];
        DB::query("UPDATE production SET entry_status=%s WHERE production_id=%i AND entry_status=%s", 'Closed', $CloseProductionId, 'Active');
        if(DB::affectedRows() == 1){
            $_SESSION['success'] = " Product Successfully Closed ";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['fail'] = ' Error. You are not Permitted to Close this PRODUCTION RECORD ';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } 
//DELETING Raw Material Batch
    if (isset($_GET['DelTrackingId'])) {
        $DelTrackingId = $_GET['DelTrackingId'];
        DB::query("UPDATE raw_material SET status=%s WHERE tracking_id=%i AND status=%s", 'Deleted', $DelTrackingId, 'New');
        if(DB::affectedRows() == 1){
            DB::query("UPDATE items SET status=%s WHERE tracking_id=%i AND status=%s", 'Deleted', $DelTrackingId, 'New');
            if(DB::affectedRows() >= 1){
                $_SESSION['del'] = " Deleted ";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                }else{
                    $_SESSION['fail'] = ' Error. You are not Permitted to Delete these items';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        
        }else{
            $_SESSION['fail'] = ' Error. You are not Permitted to Delete the Raw Material Batch ';
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
        	// code...
      	$username = $_SESSION['username'];
      	$userId = $_SESSION['user_id'];
      	$newPass = $_POST['newpass'];
		$oldPass = $_POST['oldpass'];
      	$check = DB::queryFirstRow("Select password FROM users WHERE  user_id=%s", $userId);
      	$array=[];
			  if ($check==true) {
			      
			          $dbPass = $check['password'];
			      
			      if($oldPass == $dbPass){
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
                        
			          	DB::query("UPDATE users SET password=%s, pass_change=%s WHERE user_id=%s", $newPass, '1', $userId) ;
                  		if(DB::affectedRows() == 1){
                  			// code...
                  			$_SESSION['pass_change'] = '1';
                  			echo "<script>
                  				alert('Password Updated Successful');
                  				location.href='arms_register.php';
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


?>

