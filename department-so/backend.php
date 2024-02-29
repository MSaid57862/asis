<?php session_start(); ?>
<?php require_once '../connections/meekro/db.class.php'; ?>
<?php require_once 'functions.php';?>
<?php

//ADDING OFFICER
	if(isset($_POST['add-officer'])){
	    $svc = $_POST['svc'];
	     $hrdRef = $_POST['hrdRef'];
	     $hrdDocument = $_POST['hrdDocument'];
	     if($hrdDocument==''){
	         $hrdDocument = 'N/A';
	     }else{
	         $hrdDocument = $_POST['hrdDocument'];
	     }
        $query = DB::queryFirstRow("SELECT * FROM officers WHERE svc='$svc' AND hrd_ref='$hrdRef' LIMIT 1");
			if($query){
			    //OFFICE RECORDS EXIST
			    $_SESSION['fail'] = ' Error. This Service Number with HRD Reference Number exist with Records ';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
			}else{
			     
            	DB::insertIgnore('officers', [
        		  'svc' => $_POST['svc'],
        		  'rank' => $_POST['rank'],
        		  'status' => 'Active',
        		  'initials' => $_POST['initials'],
        		  'surname' => $_POST['surname'],
        		  'first_name' => $_POST['firstName'],
        		  'other_name' => $_POST['otherName'],
        		  'gender' => $_POST['gender'],
        		  'phone' => $_POST['phone'],
        		  'officer_email' => $_POST['email'],
        		  'date_of_birth' => $_POST['dob'],
        		  'appointment_date' => $_POST['dfa'],
        		  'last_promotion_date' => $_POST['promotion'],
        		  'current_address' => $_POST['address'],
        		  'hrd_document' => $hrdDocument,
        		  'hrd_ref' => $_POST['hrdRef'],
        		  'file_ref' => $_POST['fileRef'],
        		  'user_id' => $_SESSION['user_id'],
        		  'department_id' => $_SESSION['department_id'],
        		  'date_created' => time(),
        		]);

            		if(DB::affectedRows() == 1){
            			$_SESSION['success'] = " Officer Records Successfully Added ";
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

//FETCHING STOCK REF FOR PRODUCTION MODAL
if(isset($_POST['productSelectID'])){
	    $productSelectID = $_POST['productSelectID'];
	    $getFactoryProductDetail = getFactoryProductDetail($productSelectID);
	    $productPackageID = $getFactoryProductDetail['package_type'];
	    $productCategoryID = $getFactoryProductDetail['product_category'];
	    $productID = $getFactoryProductDetail['product_type'];
	    $productMeasurementID = $getFactoryProductDetail['measurement_id'];
	    $getProductPackageDetail = getProductPackageDetail($productPackageID);
	    $getproductCategoryDetail = getCategoryDetails($productCategoryID);
	    $getProductDetail = getProductDetails($productID);
	    $getProductMeasurementDetail = getProductMeasurementDetail($productMeasurementID);
        
        $arr = array(
    	  'brand_name'=>$getFactoryProductDetail['brand_name'],
    	  'package_type'=>$getProductPackageDetail['package_type'],
    	  'product_category'=>$getproductCategoryDetail['category_type'],
    	  'product_type'=>$getProductDetail['product_type'],
    	  'measurement_id'=>$getProductMeasurementDetail['measurement_type'],
    	  'volume'=>$getFactoryProductDetail['volume'],
    	  'uca'=>$getFactoryProductDetail['uca'],
    	  'container_qty'=>$getFactoryProductDetail['container_qty'],
    	  'container'=>$getFactoryProductDetail['container']
    	);
    	echo json_encode($arr);
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
            <th>Action</th>
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
                        
                     $action = "<a href='staff_order.php?postingId=$postingId' class='btn btn-xs btn-outline-info' target='_blank'><i class='fas fa fa-eye' data-toggle='tooltip' title='View'> </i></a>";   
                         
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
                        <td>".$action."</td>
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
    	  'rank'=>$getOfficerDetails['rank']
    	);
    	echo json_encode($arr);
}




//Bulk Upload

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "../uploads/template/";
    $targetFile = $targetDir . basename($_FILES['addFile']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if it's a CSV file
    if ($fileType != "csv") {
       // echo "Only CSV files are allowed.";
        $uploadOk = 0;
    }

  if ($file_size > 12097152) {
   // echo 'file must not be more than 12 Mb';
    die("");
  }

    // Check if the file was uploaded successfully
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['addFile']['tmp_name'], $targetFile)) {
            // Read and insert data from the CSV file into the database
            $csvData = file_get_contents($targetFile);
            $lines = explode(PHP_EOL, $csvData);

            foreach ($lines as $line) {
                $data = str_getcsv($line);
                if (count($data) == 14) { // Assuming CSV columns: id, name, email, phone
                    $res2 = DB::insertIgnore('officers', array(
                    'file_ref' =>  $data[0],
                    'rank' => $data[3],
                    'svc' => $data[2],
                    'initials' => $data[5],
                    'surname' => $data[6],
                    'phone' => $data[13],
                    'officer_email' => $data[1],
                    'appointment_date' => $data[8],
                    'last_promotion_date' => $data[9],
                    'user_id' => $_SESSION['user_id'],
                    'department_id' => $_SESSION['department_id'],
                    'status' => 'Active',
                    'date_created' => time()
            
                  ));

                }
            }
             if(DB::affectedRows() == 1){
    			$_SESSION['success'] = "The file " . basename($_FILES["addFile"]["name"]) . " has been Uploaded and data inserted into the database. ";
    			header('Location: ' . $_SERVER['HTTP_REFERER']);
    		}else{
    			$_SESSION['fail'] = ' Error. Try Again ';
    			header('Location: ' . $_SERVER['HTTP_REFERER']);
    		} 
        } else {
          //  echo "Sorry, there was an error uploading your file.";
        }
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
                        $token = bin2hex(random_bytes(32));
                        $salt = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9).time().$token;
                        $newPass = crypt($newPass, $salt);
                    
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

