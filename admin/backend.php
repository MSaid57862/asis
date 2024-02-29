<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once '../connections/meekro/db.class.php'; 
 require_once 'functions.php';
 
 ?>
<?php

//ADDING USER
	if(isset($_POST['add-user'])){
	    $svc = $_POST['serviceNo'];
	    $query = DB::query("SELECT svc FROM users WHERE svc='$svc'");
	    if($query){
            //RECORDS EXIST
	        $_SESSION['fail'] = ' Error. Service Number Exist ';
    			header('Location: ' . $_SERVER['HTTP_REFERER']);
	    }else{
	            $officerPassword = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9);
	            $token = bin2hex(random_bytes(32));
                $salt = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9).time().$token;
                $passwordHash = crypt($officerPassword, $salt);
                
    		DB::insertIgnore('users', [
    		  'username' => $_POST['email'],
    		  'fullname' => $_POST['fullname'],
    		  'access_level' => $_POST['access_level'],
    		  'department' => $_POST['departmentId'],
    		  'hash_key'=>$salt,
    		  'rank_id' => $_POST['rank'],
    		  'svc' => $_POST['serviceNo'],
    		  'password' => $passwordHash,
    		  'pass_change' => '0',
    		  'phone' => $_POST['phone'],
    		  'date_created' => time(),
    		]);
    
    		if(DB::affectedRows() == 1){
    		    // SEND MAIL

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
                        $email = $_POST['email'];
                        $mail->setFrom('846@tintech.com.ng', 'NIGERIA CUSTOMS SERVICE');
                        $mail->addAddress($email);
                        $link = urlencode('https://www.tintech.com.ng/asis');
                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'NCS Personnel Information System';
                        $mail->Body = '
                            <div style="font-family: Arial, sans-serif; width: 60%; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0,0,0,0.2); padding: 20px; line-height: 2.0;">
                                <p>Dear '.$_POST['fullname'].',</p>
                                <p>This is to notify you that your login credentials for the NCS Staff Information System have been created:</p>
                                <ul>
                                    <li><strong>Username:</strong> ' . $email . '</li>
                                    <li><strong>Password:</strong> ' . $officerPassword . '</li>
                                </ul>
                                <p>To access your account and proceed to your Bio-data Page, click the following link:</p>
                                <p><a href="' . urldecode($link) . '">HERE</a></p>
                                <p>If you have any questions or need further assistance, please do not hesitate to contact us.</p>
                                <p>Best regards,<br>ICT Technical Team</p>
                                <img src="../assets/images.logo.jpg" alt="Customs Logo" style="display: block; margin: 0 auto; max-width: 30%;">
                            </div>
                        ';
                    
                        $mail->send();
                        echo "<script>alert('Mail Sent to Declarant');</script>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
    			$_SESSION['success'] = " Successfully Added ";
    			header('Location: ' . $_SERVER['HTTP_REFERER']);
    		}else{
    			$_SESSION['fail'] = ' Error. Failed to Add records, please try again ';
    			header('Location: ' . $_SERVER['HTTP_REFERER']);
    		}
	    }
	
}

//FETCHING HEADQUARTER UNITS
	if (isset($_POST['commId'])) { 	
		// code...
		echo getHeadquarterUnits($_POST['commId']);
	}
	
//ADDING DEPARTMENT
	if(isset($_POST['add-department'])){ 	

		DB::insertIgnore('department', [
		  'department_name' => $_POST['departmentName'],
		  'department_code' => $_POST['deptCode'],
		  'department_head' => $_POST['hod'],
		]);

		if(DB::affectedRows() == 1){
			$_SESSION['success'] = " Department Added ";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}else{
			$_SESSION['fail'] = ' Error. Try Again ';
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}


//ADDING UNIT
	if(isset($_POST['add-unit'])){ 	

		DB::insertIgnore('units', [
		  'dept_id' => $_POST['dept'],
		  'unit_name' => $_POST['unit'],
		  'unit_code' => $_POST['unitCode'],
		]);

		if(DB::affectedRows() == 1){
			$_SESSION['success'] = " Unit Added ";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}else{
			$_SESSION['fail'] = ' Error. Try Again ';
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	
//ADDING DESIGNATION
	if(isset($_POST['add-designation'])){ 
		DB::insertIgnore('designation', [
		  'department_id' => $_POST['department'],
		  'designation_name' => $_POST['designation'],
		  'designation_code' => $_POST['designationCode'],
		]);

		if(DB::affectedRows() == 1){
			$_SESSION['success'] = " Designation Added ";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}else{
			$_SESSION['fail'] = ' Error. Try Again ';
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	

	
//ADDING FORMATION
	if(isset($_POST['add-formation'])){		

		DB::insertIgnore('formation', [
		  'formation_name' => $_POST['formation'],
		  'location' => $_POST['location'],
		  'zone_id' => $_POST['zoneId'],
		  'formation_code' => $_POST['formationCode'],
		  
		]);

		if(DB::affectedRows() == 1){
			$_SESSION['success'] = " Successfully Added ";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}else{
			$_SESSION['fail'] = ' Error. Try Again ';
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		
	}

//UPDATE USERS
	if (isset($_POST['update-user'])) {
	    $userId = $_POST['userId'];
	    $token = bin2hex(random_bytes(32));
        $salt = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9).time().$token;
        $password = $salt = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9);
        $password = crypt($password, $salt);
	    $phone = $_POST['phone'];
	    $email = $_POST['email'];
	    $accessLevel = $_POST['accessLevel'];
	    $command = $_POST['command'];
	    $fullname = $_POST['fullname'];
	    $svn = $_POST['svn'];
		$query = DB::queryFirstRow("SELECT * FROM users WHERE user_id='$userId'");
		if($query){
		 DB::query("UPDATE users SET password=%s, svc=%s, phone=%s, fullname=%s, hash_key=%s, username=%s, command_id=%s, access_level=%i, pass_change=%s  WHERE user_id=%s", $password, $svn, $phone, $fullname, $salt, $email, $command, $accessLevel, '0', $userId);
            if(DB::affectedRows() == 1){
                // SEND MAIL

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
                        $mail->setFrom('846@tintech.com.ng', 'NIGERIA CUSTOMS SERVICE');
                        $mail->addAddress($email);
                        $link = urlencode('https://www.tintech.com.ng/asis');
                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'NCS Personnel Information System | Record Update';
                        $mail->Body = '
                            <html>
                                <body>
                                    <div style="font-family: Arial, sans-serif; width: 60%; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0,0,0,0.2); padding: 20px; line-height: 2.0;">
                                        <img src="customs-logo.png" alt="Customs Logo" style="display: block; margin: 0 auto; max-width: 100%;">
                                        <h3>Hello ' . $fullname . '</h3>
                                        <p>This is to notify you that your login credentials for the NCS Staff Information System have been updated:</p>
                                        <ul>
                                            <li><strong>Username:</strong> ' . $email . '</li>
                                            <li><strong>Password:</strong> ' . $password . '</li>
                                        </ul>
                                        <p>To access your account and proceed to your Bio-data Page, click the following link:</p>
                                        <p><a href="' . urldecode($link) . '">HERE</a></p>
                                        <p>If you have any questions or need further assistance, please do not hesitate to contact us.</p>
                                        <p>Best regards,<br>Your Name</p>
                                    </div>
                                </body>
                            </html>
                        ';

                    
                        $mail->send();
                        echo "<script>alert('Mail Sent to Officer');</script>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                $_SESSION['success'] = " Record Updated ";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION['fail'] = ' Error. Failed to UPDATE ';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
		}else{
		    //Invalid UserId
		     $_SESSION['fail'] = ' Error. Try Again ';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}

//GETING TANKS BASE ON STATION ID (DROPDOWN)
	if (isset($_POST['getTanks'])) { 	
		// code...
		echo getTanks($_POST['stationId']);
	}



//UPDATING PUMP
	if (isset($_POST['edit-pump'])) {
		// code...
		 DB::query("UPDATE pumps SET pump_name=%s, station_id=%i WHERE tank_id=%i", 
		 	$_POST['pumpName'], $_POST['station'], $_POST['tankId']);
        if(DB::affectedRows() == 1){
            $_SESSION['success'] = " Updated ";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['fail'] = ' Error. Try Again ';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

	}

//Bulk Upload

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['addFile']) && $_FILES['addFile']['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file name
        $tempFileName = $_FILES['addFile']['tmp_name'];

        // Read the CSV file into an array
        $data = array_map('str_getcsv', file($tempFileName));

        // Loop through the data and insert into the database
        
        foreach ($data as $row) {
        $svn = $row[1];
        $email = $row[2];
        $fullname = $row[6].' '.$row[3];
        $token = bin2hex(random_bytes(32));
        $salt = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9).time().$token;
        $password = $salt = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9);
        $hashedPassword = crypt($password, $salt);
            $query = DB::queryFirstRow("SELECT * FROM users WHERE svc='$svn'");
            if($query){
                
            }else{
            $db = DB::insertIgnore('users', [
                'svc' =>  $row[1],
                'username' => $row[2],
                'fullname' => $fullname,
                'password' => $hashedPassword,
                'hash_key' => $salt,
                'access_level' => '3',
                'pass_change' => '0',
                'status' => 'Active',
                'date_created'=> time()
                
            ]);
        }
       if(DB::affectedRows() == 1){
           // SEND MAIL

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
                        $mail->setFrom('846@tintech.com.ng', 'NIGERIA CUSTOMS SERVICE');
                        $mail->addAddress($email);
                        $link = urlencode('https://www.tintech.com.ng/asis');
                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'NCS Personnel Information System | Profile Creation';
                        $mail->Body = '
                            <html>
                                <body>
                                    <div style="font-family: Arial, sans-serif; width: 60%; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0,0,0,0.2); padding: 20px; line-height: 2.0;">
                                        <h3>Hello ' . $fullname . '</h3>
                                        <p>This is to notify you that your login credentials for the NCS Staff Information System have been created:</p>
                                        <ul>
                                            <li><strong>Username:</strong> ' . $email . '</li>
                                            <li><strong>Password:</strong> ' . $password . '</li>
                                        </ul>
                                        <p>To access your account and proceed to your Bio-data Page, click the link below:</p>
                                        <p><a href="' . urldecode($link) . '">HERE</a></p>
                                        <p>If you have any questions or need further assistance, please do not hesitate to contact us.</p>
                                        <p>Best regards,<br>Your Name</p>
                                    </div>
                                </body>
                            </html>
                        ';

                    
                        $mail->send();
                        echo "<script>alert('Mail Sent to Officer');</script>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
            $_SESSION['success'] = " Uploaded ";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['fail'] = ' Error. Try Again ';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
        
    } else {
        echo "File upload error.";
    }
}


//DELETING TANK
    if (isset($_GET['tankDelId'])) {
        // code...
        $tankId = $_GET['tankDelId'];
        DB::query("UPDATE tanks SET status=%s WHERE tank_id=%i", 'Deleted', $tankId);
        if(DB::affectedRows() == 1){
            $_SESSION['del'] = " Deleted ";
            header('Location: ' . $_SERVER['HTTP_REFERER']."?&s");
        }else{
            $_SESSION['fail'] = ' Error. Try Again ';
            header('Location: ' . $_SERVER['HTTP_REFERER']."?&e");
        }
    }

//DELETING PUMP
    if (isset($_GET['pumpDelId'])) {
        // code...
        $pumpId = $_GET['pumpDelId'];
        DB::query("UPDATE pumps SET status=%s WHERE pump_id=%i", 'Deleted', $pumpId);
        if(DB::affectedRows() == 1){
            $_SESSION['del'] = " Deleted ";
            header('Location: ' . $_SERVER['HTTP_REFERER']."?&s");
        }else{
            $_SESSION['fail'] = ' Error. Try Again ';
            header('Location: ' . $_SERVER['HTTP_REFERER']."?&e");
        }
    }

//DELETING PUMP
    if (isset($_GET['userDelId'])) {
        // code...
        $userId = $_GET['userDelId'];
        DB::query("UPDATE users SET status=%s WHERE user_id=%i", 'Deleted', $userId);
        if(DB::affectedRows() == 1){
            $_SESSION['del'] = " Deleted ";
            header('Location: ' . $_SERVER['HTTP_REFERER']."?&s");
        }else{
            $_SESSION['fail'] = ' Error. Try Again ';
            header('Location: ' . $_SERVER['HTTP_REFERER']."?&e");
        }
    }

?>

