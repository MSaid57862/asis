<?php 
    session_start();
    require_once 'connections/meekro/db.class.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php
    if (!empty($_POST['emailAddress']) && !empty($_POST['svn'])) {
        $emailAddress =  $_POST['emailAddress'];
        $svn =  $_POST['svn'];
        $query = DB::queryFirstRow("SELECT * FROM users WHERE username=%s AND status=%s AND svc=%s", $emailAddress, 'Active', $svn);
        if ($query) {
            // Generate a unique token and store it in the database
            $token = bin2hex(random_bytes(32));
            
            $currentTimestamp = time(); // Get the current timestamp
            $minutesToAdd = 30; // Number of minutes to add
            $expiry_time = $currentTimestamp + ($minutesToAdd * 60); // Add 30 minutes in seconds (60 seconds per minute)
            $expiration = date('Y-M-d H:i:s', $expiry_time);
             DB::query("UPDATE users SET reset_token=%s, expiry_time=%s  WHERE svc=%s", $token, $expiry_time, $svn);
              if(DB::affectedRows() == 1){
                  $reset_link = "https://tintech.com.ng/asis/reset_password2.php?token=$token";
            
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
                        $mail->setFrom('pe@tintech.com.ng', 'NIGERIA CUSTOMS SERVICE');
                        $mail->addAddress($emailAddress);
                        $link = urlencode('https://tintech.com.ng/asis/reset_password2.php?token='.$token);
                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'NCS Staff Information System| Password Reset';
                       $mail->Body = '<html>
                            <head>
                                <style>
                                    /* Define your CSS styles here */
                                    .main-header {
                                        background-color: #09872f;
                                        color: white;
                                        padding: 20px;
                                        width: 60%; /* Set the width of the main div */
                                        margin: 0 auto; /* Center the div horizontally */
                                        border: 0px solid #ccc; /* Set border size, width, and color */
                                        box-shadow: 3px 3px 5px #888888; /* Add a shadow effect */
                                        font-size: 18px; /* Set text font size */
                                        line-height: 2.0; /* Set line spacing (line height) to 2.0 */
                                    }
                                    
                                    .main-name {
                                        background-color: #f2f5f3;
                                        padding: 20px;
                                        width: 60%; /* Set the width of the main div */
                                        margin: 0 auto; /* Center the div horizontally */
                                        border: 0px solid #ccc; /* Set border size, width, and color */
                                        box-shadow: 3px 3px 5px #888888; /* Add a shadow effect */
                                        font-size: 16px; /* Set text font size */
                                        line-height: 2.0; /* Set line spacing (line height) to 2.0 */
                                    }
                                    
                                    .main-content {
                                        background-color: #f3f3f3;
                                        padding: 20px;
                                        width: 60%; /* Set the width of the main div */
                                        margin: 0 auto; /* Center the div horizontally */
                                        border: 2px solid #ccc; /* Set border size, width, and color */
                                        box-shadow: 3px 3px 5px #888888; /* Add a shadow effect */
                                        font-size: 14px; /* Set text font size */
                                        line-height: 2.0; /* Set line spacing (line height) to 2.0 */
                                    }
                                    .reset-link {
                                        background-color: #007bff;
                                        color: #fff;
                                        text-decoration: none;
                                        padding: 10px 20px;
                                        border-radius: 5px;
                                        display: inline-block;
                                    }
                                </style>
                            </head>
                            <body>
                                <div class="main-header">
                                    <p> PASSWORD RESET REQUEST</p>
                                </div>
                                 <div class="main-name">
                                    <p>Dear '.$query['fullname'].'</p>
                                </div>
                                <div class="main-content">
                                    <p>You have submitted a request to reset your password on the Staff Information Portal.</p>
                                    <p>To proceed with the password reset, please click on the <a href="' . urldecode($link) . '" class="reset-link">Password Reset Link Here</a> to proceed or copy https://tintech.com.ng/asis/reset_password2.php?token='.$token.'</p>
                                    <p>If you did not request this password reset, you can ignore this email, and your password will remain unchanged.</p>
                                    <p>For security reasons, this link will expire on <strong class="reset-link">' . $expiration . '</strong> [30mins]. Please ensure you complete the password reset process promptly.</p>
                                    <p>Thank you</p>
                                </div>
                            </body>
                        </html>';
                    
                        $mail->send();
                        echo "<script>alert('Mail Sent to Officer');</script>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
            $error =  "Password Reset details sent to your email";
              }else{
                  //Fail to Send Reset Password Link
                  $error =  "Fail: An Error occured, please contact the System Administrator";
              }
            
        }else {
            
             $error =  "Incorrect Login Credentials";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Password Reset | NCS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo.ico">

		<!-- Bootstrap css -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- App css -->
		<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
		<!-- icons -->
		<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
		<!-- Head js -->
		<script src="assets/js/head.js"></script>

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/password-reset.jpg" alt="" height="110">
                                            </span>
                                        </a>
                    
                                        <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/password-reset.jpg" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                    <!-- <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p> -->
                                </div>

                                <form action="" method="post">
                                    <?php
                                        global $error;
                                        if (!empty($error)) {
                                            echo '<p class="text-center fw-bold text-danger">'. $error .'<p>';
                                        }
                                    ?>
                                    <div class="mb-3">
                                        <label for="emailAddress" class="form-label">Official Email</label>
                                        <input class="form-control" type="email" id="emailAddress" required="required" name="emailAddress" placeholder="officer.johnson@customs.gov.ng">
                                    </div>

                                    <div class="mb-3">
                                        <label for="svn" class="form-label">Service Number</label>
                                        <input class="form-control" type="text" id="svn" required="required" name="svn" placeholder="NCS1234">
                                    </div>
                                    
                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Submit </button>
                                    </div><br>
                                     <div class="text-center d-grid">
                                        <a href="index.php" class="btn btn-secondary text-light">Back to Login</a>
                                    </div>
                                </form>
                                <p>
                                    
                                </p>

                                

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="auth-recoverpw.html" class="text-white-50 ms-1">Forgot your password?</a></p>
                                <p class="text-white-50">Don't have an account? <a href="auth-register.html" class="text-white ms-1"><b>Sign Up</b></a></p>
                            </div> 
                        </div> -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


       <!--  <footer class="footer footer-alt">
            2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a> 
        </footer> -->

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>