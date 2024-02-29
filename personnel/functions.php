<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
        
    function localTyme($time){
        $localTime = date('h:i A', strtotime($time));
        if (empty($time)) {
            $localTime = "N/A";
            return $localTime;
        }else{
            return $localTime;
        }
        
    }

     function localDate($date){
        $localDate = date('d/m/Y', strtotime($date));
        if (empty($date)) {
            $localDate = "N/A";
            return $localDate;
        }else{
            return $localDate;
        }
    }

 function getCommand($commandId){
        $results = DB::queryFirstRow("SELECT * FROM command WHERE command_id=%i", $commandId);
        $array=[];
        if($results==true){
            $array['command_name'] = $results['command_name'];
            $array['command_code'] = $results['command_code'];
        }else{
            $array['command_name'] = 'N/A';
            $array['command_code'] = 'N/A';
        }
    return $array;
    }
  
    
    
function getRankDetail($rankId){
        $results = DB::queryFirstRow("SELECT * FROM ranks WHERE rank_id=%i", $rankId);
        $array=[];
        if($results==true){
            $array['rank_name'] = $results['rank_name'];
            $array['rank_code'] = $results['rank_code'];
        }
    return $array;
    }

function getEmolumentSchedule($scheduleId){
        $results = DB::queryFirstRow("SELECT * FROM emolument_schedule WHERE id=%i", $scheduleId);
        $array=[];
        if($results==true){
            $array['start_date'] = $results['start_date'];
            $array['end_date'] = $results['end_date'];
        }else{
            $array['start_date'] = 'N/A';
            $array['end_date'] = 'N/A';
        }
    return $array;
    }


function getBank($bankId){
        $results = DB::queryFirstRow("SELECT * FROM bank WHERE bank_id=%i", $bankId);
        $array=[];
        if($results==true){
            $array['bank_name'] = $results['bank_name'];
        }else{
             $array['bank_name'] = 'N/A';
        }
    return $array;
    }
 
 
 function getPFA($pfaId){
        $results = DB::queryFirstRow("SELECT * FROM pfa WHERE pfa_id=%i", $pfaId);
        $array=[];
        if($results==true){
            $array['pfa_name'] = $results['pfa_name'];
        }else{
             $array['pfa_name'] = 'N/A';
        }
    return $array;
    }  

function getPassport($svn){
        $results = DB::queryFirstRow("SELECT * FROM passports WHERE svn=%s", $svn);
        $array=[];
        if($results==true){
            $array['pass_name'] = $results['pass_name'];
        }else{
            $array['pass_name'] = '';
        }
    return $array;
    }

function getOfficerDetail($svn){
        $results = DB::queryFirstRow("SELECT * FROM basic_information WHERE svn=%s", $svn);
        $array=[];
        if($results==true){
            $array['svn'] = $results['svn'];
            $array['rank'] = $results['rank'];
            $array['initials'] = $results['initials'];
            $array['date_of_birth'] = $results['date_of_birth'];
            $array['appointment_date'] = $results['appointment_date'];
            $array['confirmation_date'] = $results['confirmation_date'];
            $array['last_promotion_date'] = $results['last_promotion_date'];
            $array['gender'] = $results['gender'];
            $array['marital_status'] = $results['marital_status'];
            $array['phone'] = $results['phone'];
            $array['officer_email'] = $results['officer_email'];
            $array['surname'] = $results['surname'];
            $array['appointment_type'] = $results['appointment_type'];
            $array['first_name'] = $results['first_name'];
            $array['other_name'] = $results['other_name'];
            $array['middle_name'] = $results['middle_name'];
            $array['hrd_ref'] = $results['hrd_ref'];
            $array['residence_address'] = $results['residence_address'];
            $array['hq_no'] = $results['hq_no'];
            $array['file_ref'] = $results['file_ref'];
            $array['date_created'] = $results['date_created'];
        }else{
            $array['svn'] = 'N/A';
            $array['rank'] = 'N/A';
            $array['initials'] = 'N/A';
            $array['date_of_birth'] = 'N/A';
            $array['appointment_date'] = 'N/A';
            $array['confirmation_date'] = 'N/A';
            $array['last_promotion_date'] = 'N/A';
            $array['gender'] = 'N/A';
            $array['marital_status'] = 'N/A';
            $array['phone'] = 'N/A';
            $array['officer_email'] = 'N/A';
            $array['surname'] = 'N/A';
            $array['first_name'] = 'N/A';
            $array['other_name'] = '';
            $array['middle_name'] = '';
            $array['hrd_ref'] = 'N/A';
            $array['file_ref'] = 'N/A';
            $array['date_created'] = 'N/A';
        }
    return $array;
    }
  
  
  
  function getOfficerEmolument($emolumentId){
        $results = DB::queryFirstRow("SELECT * FROM emolument WHERE id=%s", $emolumentId);
        $array=[];
        if($results==true){
            $array['svn'] = $results['svn'];
            $array['rank'] = $results['rank'];
            $array['command'] = $results['command'];
            $array['unit'] = $results['unit'];
            $array['bank'] = $results['bank'];
            $array['account_number'] = $results['account_number'];
            $array['pfa'] = $results['pfa'];
            $array['rsa_pin'] = $results['rsa_pin'];
            $array['interdicted'] = $results['interdicted'];
            $array['date_interdicted'] = $results['date_interdicted'];
            $array['quartered'] = $results['quartered'];
            $array['date_quartered'] = $results['date_quartered'];
            $array['emolument_status'] = $results['status'];
            $array['reason'] = $results['reason'];
            $array['emolument_year'] = $results['emolument_year'];
            $array['date_created'] = $results['date_created'];
            
        }else{
             $array['svn'] = '';
            $array['rank'] = '';
            $array['command'] = '';
            $array['unit'] = '';
            $array['bank'] = '';
            $array['account_number'] = '';
            $array['pfa'] = '';
            $array['rsa_pin'] = '';
            $array['interdicted'] = '';
            $array['date_interdicted'] = '';
            $array['quartered'] = '';
            $array['date_quartered'] = '';
            $array['emolument_status'] = '';
            $array['reason'] = '';
            $array['emolument_year'] = '';
            $array['date_created'] = '';
        }
    return $array;
    }
    
function getPostingDetail($postingId){
        $results = DB::queryFirstRow("SELECT * FROM postings WHERE posting_id=%i", $postingId);
        $array=[];
        if($results==true){
            $array['officer_id'] = $results['officer_id'];
             $array['posting_ref'] = $results['posting_ref'];
            $array['officer_email'] = $results['officer_email'];
            $array['command'] = $results['command'];
            $array['unit'] = $results['unit'];
            $array['designation'] = $results['designation'];
            $array['status'] = $results['status'];
            $array['captured_by'] = $results['captured_by'];
            $array['date_captured'] = $results['date_captured'];
            $array['approved_by'] = $results['approved_by'];
            $array['date_approved'] = $results['date_approved'];
            $array['acknowledged_by'] = $results['acknowledged_by'];
            $array['date_acknowledged'] = $results['date_acknowledged'];
            $array['comment'] = $results['comment'];
            $array['approval_signature'] = $results['approval_signature'];
            $array['acknowledged_signature'] = $results['acknowledged_signature'];
            $array['effective_date'] = $results['effective_date'];
            $array['previous_posting_id'] = $results['previous_posting_id'];
        }
    return $array;
    }    
    
function getUnit($unitId){
        $results = DB::queryFirstRow("SELECT * FROM unit WHERE unit_id=%i", $unitId);
        $array=[];
        if($results==true){
            $array['unit_id'] = $results['unit_id'];
            $array['unit_name'] = $results['unit_name'];
             $array['unit_code'] = $results['unit_code'];
        }else{
            $array['unit_id'] = '';
            $array['unit_name'] = '';
             $array['unit_code'] = '';
        }
    return $array;
    }

function getState($stateId){
        $results = DB::queryFirstRow("SELECT * FROM state WHERE state_id=%i", $stateId);
        $array=[];
        if($results==true){
            $array['state_name'] = $results['state_name'];
        }else{
            $array['state_name'] = 'N/A';
        }
         return $array;
   
    }
    
//GET THE NUMBER OF FLATS (UNITS) IN EACH BARRACKS
function getNumberofUnits($barrackId){
    $results = DB::queryFirstRow("SELECT * FROM barrack_unit_information WHERE barrack_id='$barrackId'");
    if ($results) {
        $row_count = DB::count();
    }else{
        $row_count='0';
    }
    return $row_count;
}


//GET THE NUMBER OF FLATS IMAGES
function getNumberofUnitImages($unitId){
    $results = DB::queryFirstRow("SELECT * FROM barrack_unit_images WHERE unit='$unitId'");
    if ($results) {
        $row_count = DB::count();
    }else{
        $row_count='0';
    }
    return $row_count;
}

function getUnitImages($imageId){
        $results = DB::queryFirstRow("SELECT * FROM barrack_unit_images WHERE image_id=%i", $imageId);
        $array=[];
        if($results==true){
            $array['image_title'] = $results['image_title'];
            $array['description'] = $results['description'];
        }else{
            $array['image_title'] = 'N/A';
            $array['description'] = 'N/A';
        }
         return $array;
   
    }
    
function getLGA($lgaId){
        $results = DB::queryFirstRow("SELECT * FROM local_govt WHERE lga_id=%i", $lgaId);
        $array=[];
        if($results==true){
            $array['local_govt'] = $results['local_govt'];
        }else{
            $array['local_govt'] = 'N/A';
        }
    return $array;
    }
    
    
function getKinRelationship($Id){
        $results = DB::queryFirstRow("SELECT * FROM kin_relationship WHERE id=%i", $Id);
        $array=[];
        if($results==true){
            $array['name'] = $results['name'];
        }
    return $array;
    }
    
function getNextKin($svn){
        $results = DB::queryFirstRow("SELECT * FROM kin_information WHERE svn=%s", $svn);
        $array=[];
        if($results==true){
            $array['fullname'] = $results['fullname'];
            $rel = getKinRelationship($results['relationship']);
            $array['relationship'] = $rel['name'];
            $array['phone'] = $results['phone'];
            $array['address'] = $results['address'];
            $array['email'] = $results['email'];
            $array['gender'] = $results['gender'];
        }else{
            $array['fullname'] = 'N/A';
            $array['relationship'] = 'N/A';
            $array['phone'] = 'N/A';
            $array['address'] = 'N/A';
            $array['email'] = 'N/A';
            $array['gender'] = 'N/A';
        }
    return $array;
    }
    
    
    function getRank($rankId){
        $results = DB::queryFirstRow("SELECT * FROM ranks WHERE rank_id=%i", $rankId);
        $array=[];
        if($results==true){
            $array['rank_id'] = $results['rank_id'];
            $array['rank_name'] = $results['rank_name'];
             $array['rank_code'] = $results['rank_code'];
        }
    return $array;
    }
function getDepartment($departmentId){
        $results = DB::queryFirstRow("SELECT * FROM department WHERE department_id=%i", $departmentId);
        $array=[];
        if($results==true){
            $array['department_id'] = $results['department_id'];
            $array['department_name'] = $results['department_name'];
             $array['department_code'] = $results['department_code'];
             $array['department_head'] = $results['department_head'];
        }
    return $array;
    }
    
function getDesignation($designationId){
        $results = DB::queryFirstRow("SELECT * FROM designation WHERE designation_id=%i", $designationId);
        $array=[];
        if($results==true){
            $array['designation_id'] = $results['designation_id'];
            $array['designation_name'] = $results['designation_name'];
        }
    return $array;
    }
    
 function getHeadquarterUnits($commId){
        $query = DB::query("SELECT * FROM unit WHERE command_id=%i", $commId);
        
        if($query==true){
            $unit = ' <option value="">Select Unit</option>';
                foreach($query as $results){
                    $unit .="<option value='".$results['unit_id']."'>".$results['unit_name']."</option>";
                }
        }else{
            $unit = '<option>No Unit</option>';
        }
        return $unit;
    }


 function getDesignationDropDown($departmentId){
        $query = DB::query("SELECT * FROM designation WHERE department_id=%i", $departmentId);
        
        if($query==true){
            $designation = ' <option value="">Select Designation</option>';
                foreach($query as $results){
                    $designation .="<option value='".$results['designation_id']."'>".$results['designation_name']."</option>";
                }
        }else{
            $designation = '<option>No Designation</option>';
        }
        return $designation;
    }




function getBarrackUnitDropdown($barrackId){
        $query = DB::query("SELECT * FROM barrack_unit_information WHERE barrack_id=%i AND allocation_status=%s", $barrackId, 'Available');
        
        if($query==true){
            $barrackUnit = ' <option value="">Select Barrack Unit</option>';
                foreach($query as $results){
                    $barrackUnit .="<option value='".$results['barrack_unit_id']."'>".$results['unit_code']."</option>";
                }
        }else{
            $barrackUnit = '<option>No Barrack Unit</option>';
        }
        return $barrackUnit;
    }

function getLGADropdown($stateId){
        $record = DB::query("SELECT * FROM local_govt WHERE state_id =%i", $stateId);
        if ($record==true) {
           $lga = '<option value="" hidden> -- Select LGA -- </option>';

          foreach($record as $class) {
            $lga .= '<option value="' .$class['lga_id']. '">'.$class['local_govt'].'</option>';
          }
            
          }else{
            $lga = '<option value="">No LGA</option>';
          } 
        return $lga;               
}

function getUserDetail($svn){
        $results = DB::queryFirstRow("SELECT * FROM users WHERE svc=%i", $svn);
        $array=[];
        if($results==true){
            $array['username'] = $results['username'];
            $array['fullname'] = $results['fullname'];
            $array['svc'] = $results['svc'];
            $array['phone'] = $results['phone'];
            $array['rank_id'] = $results['rank_id'];
            $array['department_id'] = $results['department'];
            $array['command_id'] = $results['command_id'];
            $array['date_created'] = $results['date_created'];
        }
    return $array;
    }
    

 

	function getBarrackDetails($barrackId){
		$results = DB::queryFirstRow("SELECT * FROM barrack_information WHERE barrack_id=%i", $barrackId);
		$array=[];
		if ($results==true) {
			$array['name'] = $results['name'];
			$array['barrack_code'] = $results['barrack_code'];
			$array['category'] = $results['category'];
			$array['address'] = $results['address'];
			$array['barrack_state'] = $results['barrack_state'];
			$array['barrack_lga'] = $results['barrack_lga'];
		}else{
		    $array['name'] = 'N/A';
		    $array['barrack_code'] = 'N/A';
			$array['category'] = 'N/A';
			$array['address'] = 'N/A';
			$array['barrack_state'] = 'N/A';
			$array['barrack_lga'] = 'N/A';
		}
		return $array;
	}

	function getBarrackUnitDetails($barrackUnitId){
		$results = DB::queryFirstRow("SELECT * FROM barrack_unit_information WHERE barrack_unit_id=%i", $barrackUnitId);
		$array=[];
		if ($results==true) {
			$array['unit_name'] = $results['unit_name'];
			$array['unit_code'] = $results['unit_code'];
			$array['unit_status'] = $results['unit_status'];
			$array['barrack_id'] = $results['barrack_id'];
			$array['facilities'] = $results['facilities'];
			$array['allocation_status'] = $results['allocation_status'];
		}else{
		    $array['unit_name'] = 'N/A';
			$array['unit_status'] = 'N/A';
			$array['unit_code'] = 'N/A';
			$array['barrack_id'] = 'N/A';
			$array['facilities'] = 'N/A';
			$array['allocation_status'] = 'N/A';
		}
		return $array;
	}
	
	function getAllocationDetails($allocationId){
		$results = DB::queryFirstRow("SELECT * FROM allocation WHERE allocation_id=%i", $allocationId);
		$array=[];
		if ($results==true) {
			$array['tracking_id'] = $results['tracking_id'];
			$array['svn'] = $results['svn'];
			$array['rank'] = $results['rank'];
			$array['command'] = $results['command'];
			$array['unit'] = $results['unit'];
			$array['description'] = $results['description'];
			$array['status'] = $results['status'];
			$array['decision'] = $results['decision'];
			$array['decision_date'] = $results['decision_date'];
			$array['application_date'] = $results['application_date'];
			$array['decision_reason'] = $results['decision_reason'];
			$array['move_out_date'] = $results['move_out_date'];
			$array['move_out_reason'] = $results['move_out_reason'];
			$array['decision_by'] = $results['decision_by'];
			$array['moved_out_by'] = $results['moved_out_by'];
		}else{
		    $array['tracking_id'] = 'N/A';
			$array['svn'] = 'N/A';
			$array['rank'] = 'N/A';
			$array['command'] = 'N/A';
			$array['unit'] = 'N/A';
			$array['description'] = 'N/A';
			$array['status'] = 'N/A';
			$array['decision'] = 'N/A';
			$array['decision_date'] = 'N/A';
			$array['application_date'] = 'N/A';
			$array['decision_reason'] = 'N/A';
			$array['move_out_date'] = 'N/A';
			$array['move_out_reason'] = 'N/A';
			$array['decision_by'] = 'N/A';
			$array['moved_out_by'] = 'N/A';
		
		}
			return $array;
	}	
function getCountry($countryId){
        $results = DB::queryFirstRow("SELECT * FROM country WHERE country_id=%i", $countryId);
        $countryDetails=[];
        if($results==true){
            $countryDetails['country_name'] = $results['country_name'];
            $countryDetails['country_id'] = $results['country_id'];
            //$countryDetails['date_created'] = $results['date_created'];
        }
        return $countryDetails;
    }
    

function getBarrackUnitImages($barrackUnitId) {
    // Perform the database query to fetch up to 8 rows
    $results = DB::query("SELECT image_url, image_title FROM barrack_unit_images WHERE unit = %i ORDER BY image_id LIMIT 8", $barrackUnitId);

    $array = [];

    for ($i = 1; $i <= 8; $i++) {
        if (isset($results[$i - 1])) {
            $array['image' . $i] = $results[$i - 1]['image_url'];
            $array['imageTitle' . $i] = $results[$i - 1]['image_title'];
        } else {
            $array['image' . $i] = '';
            $array['imageTitle' . $i] = 'No Image';
        }
    }

    return $array;
}


	
function getEmailNotification($emailId, $emailSubject, $emailMessage, $emailLink){
        
        
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'tintech.com.ng';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '846@tintech.com.ng';                     // SMTP username
    $mail->Password   = 'exprocode2022';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('$emailSubject', 'NIGERIA CUSTOMS SERVICE');
    $mail->addAddress($emailId);     // Add a recipient
    $link = urlencode($emailLink);
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $emailSubject;
    $mail->Body    = $emailMessage.' Click the link below to download <br> 
        <a href='.urldecode($link).'>Download Document</a>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo "<script>alert('Mail Sent to '.$emailId);</script>";
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
##########end of email##########3333
    }
    return null;
?>