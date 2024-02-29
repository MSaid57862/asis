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


 
function getUserDetail($svn){
        $results = DB::queryFirstRow("SELECT * FROM users WHERE svc=%i", $svn);
        $array=[];
        if($results==true){
            $array['username'] = $results['username'];
            $array['fullname'] = $results['fullname'];
            $array['svc'] = $results['svc'];
            $array['phone'] = $results['phone'];
            $array['rank'] = $results['rank'];
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
			$array['category'] = $results['category'];
			$array['address'] = $results['address'];
			$array['barrack_state'] = $results['barrack_state'];
		}else{
		    $array['name'] = 'N/A';
			$array['category'] = 'N/A';
			$array['address'] = 'N/A';
			$array['state'] = 'N/A';
		}
		return $array;
	}

	function getBarrackUnitDetails($barrackUnitId){
		$results = DB::queryFirstRow("SELECT * FROM barrack_unit_information WHERE barrack_unit_id=%i", $barrackUnitId);
		$array=[];
		if ($results==true) {
			$array['unit_name'] = $results['unit_name'];
			$array['unit_status'] = $results['unit_status'];
			$array['facilities'] = $results['facilities'];
			$array['allocation_status'] = $results['allocation_status'];
		}else{
		    $array['unit_name'] = 'N/A';
			$array['unit_status'] = 'N/A';
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

// Function to resize the image while maintaining its aspect ratio
function resizeImageTo1MB($sourcePath, $destinationPath, $targetFileSize) {
    list($width, $height) = getimagesize($sourcePath);
    $aspectRatio = $width / $height;
    $newWidth = sqrt($targetFileSize * $aspectRatio);
    $newHeight = $newWidth / $aspectRatio;

    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
    $imageType = exif_imagetype($sourcePath);
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($sourcePath);
            imagecopyresampled($resizedImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagejpeg($resizedImage, $destinationPath);
            break;
        case IMAGETYPE_PNG:
            $source = imagecreatefrompng($sourcePath);
            imagecopyresampled($resizedImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagepng($resizedImage, $destinationPath);
            break;
        default:
            // Unsupported image type
            break;
    }

    imagedestroy($source);
    imagedestroy($resizedImage);
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