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

 function getFormation($formationId){
        $results = DB::queryFirstRow("SELECT * FROM formation WHERE formation_id=%i", $formationId);
        $array=[];
        if($results==true){
            $array['formation_name'] = $results['formation_name'];
            $array['zone_id'] = $results['zone_id'];
            $array['formation_code'] = $results['formation_code'];
        }
    return $array;
    }
    
function getRankDetail($rankId){
        $results = DB::queryFirstRow("SELECT * FROM rank WHERE rank_id=%i", $rankId);
        $array=[];
        if($results==true){
            $array['rank_name'] = $results['rank_name'];
            $array['rank_code'] = $results['rank_code'];
        }
    return $array;
    }

function getOfficerDetail($officerId){
        $results = DB::queryFirstRow("SELECT * FROM officers WHERE officer_id=%i", $officerId);
        $array=[];
        if($results==true){
            $array['svc'] = $results['svc'];
            $array['rank'] = $results['rank'];
            $array['initials'] = $results['initials'];
            $array['date_of_birth'] = $results['date_of_birth'];
            $array['appointment_date'] = $results['appointment_date'];
            $array['last_promotion_date'] = $results['last_promotion_date'];
            $array['gender'] = $results['gender'];
            $array['phone'] = $results['phone'];
            $array['officer_email'] = $results['officer_email'];
            $array['surname'] = $results['surname'];
            $array['first_name'] = $results['first_name'];
            $array['other_name'] = $results['other_name'];
            $array['hrd_ref'] = $results['hrd_ref'];
            $array['file_ref'] = $results['file_ref'];
            $array['date_created'] = $results['date_created'];
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
        $results = DB::queryFirstRow("SELECT * FROM units WHERE unit_id=%i", $unitId);
        $array=[];
        if($results==true){
            $array['unit_id'] = $results['unit_id'];
            $array['unit_name'] = $results['unit_name'];
             $array['unit_code'] = $results['unit_code'];
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
    
 function getUnitDropdown($commandId){
        $query = DB::query("SELECT * FROM units WHERE formation_id=%i", $commandId);
        
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

function getUserDetail($userId){
        $results = DB::queryFirstRow("SELECT * FROM users WHERE user_id=%i", $userId);
        $array=[];
        if($results==true){
            $array['username'] = $results['username'];
            $array['fullname'] = $results['fullname'];
            $array['svc'] = $results['svc'];
            $array['phone'] = $results['phone'];
            $array['rank'] = $results['rank'];
            $array['department_id'] = $results['department_id'];
            $array['command_id'] = $results['command_id'];
            $array['date_created'] = $results['date_created'];
        }
    return $array;
    }
    
function getProductPackageDetail($productPackageId){
        $results = DB::queryFirstRow("SELECT * FROM packages WHERE package_id=%i", $productPackageId);
        $array=[];
        if($results==true){
            $array['package_type'] = $results['package_type'];
        }
    return $array;
    }
    
function getStockDetails($stockId){
        $results = DB::queryFirstRow("SELECT * FROM stock WHERE stock_id=%i", $stockId);
        $array=[];
        if($results==true){
            $array['stock_ref'] = $results['stock_ref'];
            $array['stock_out'] = $results['stock_out'];
            $array['item_id'] = $results['item_id'];
            $array['entry_status'] = $results['entry_status'];
            $array['stock_in'] = $results['stock_in'];
            $array['balance'] = $results['balance'];
            $array['tracking_id'] = $results['tracking_id'];
            $array['officer_id'] = $results['officer_id'];
            $array['command_id'] = $results['command_id'];
            $array['factory_id'] = $results['factory_id'];
            $array['date_created'] = $results['date_created'];
        }
    return $array;
    }
    
    function getCommand($commandId){
		$results = DB::queryFirstRow("SELECT * FROM command WHERE command_id=%i", $commandId);
		$array=[];
		if ($results==true) {
				$array['command_name'] = $results['command_name'];
				$array['command_code'] = $results['command_code'];
		}
		return $array;
	}

	function getFactory($factoryId){
		$results = DB::queryFirstRow("SELECT * FROM factory WHERE factory_id=%i", $factoryId);
		$array=[];
		if ($results==true) {
			$array['factory_name'] = $results['factory_name'];
			$array['license'] = $results['license'];
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