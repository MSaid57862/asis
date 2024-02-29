<?php 
    session_start();
    require_once 'connections/meekro/db.class.php';
if(isset($_GET['token'])){
    $token = $_GET['token'];
     $query = DB::queryFirstRow("SELECT * FROM users WHERE reset_token=%s", $token);
        if ($query) {
            $expiryTime = $query['expiry_time'];
            $expirationDate = date('Y-M-d H:i:s', $expiryTime);
            $svn = $query['svc'];
            $tokenKey = $query['reset_token'];
           
            $today = time();
            $diff = $expiryTime - $today; // Calculate the difference
            $minutes = floor(($diff % 3600) / 60);
            if ($diff < 0) {
                // Token has expired
                $error = "Requested Password Reset Token has expired since ".$expirationDate;
            } else {
                // Token is still valid, and you can also display the expiration time
                $expirationDate = date('Y-M-d H:i:s', $expiryTime);
                $error = "Requested Password Reset Token will expire on " . $expirationDate." Remaining ".$minutes." mins";
            }

        }else {
            
             $error =  "Invalid Token";
        }
}else{
    
}
?>
<?php
  if (isset($_POST['submit'])) {
      	$password = $_POST['password'];
      	$password2 = $_POST['password2'];
      	$token = $_POST['token'];
      	if($password == $password2){
      	$query = DB::queryFirstRow("SELECT * FROM users WHERE  reset_token=%s", $token);
		if ($query) {
           // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
                        
            if(!$uppercase || !$lowercase || !$number || !$specialChars || mb_strlen($password) < 8) {
                
                echo "<script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');</script>";
        }else{
                $expiryTime = $query['expiry_time'];
                $userId = $query['user_id'];
                $today = time();
                $diff = $expiryTime - $today; // Calculate the difference
                $minutes = floor(($diff % 3600) / 60);
                if ($diff < 0) {
                    // Token has expired
                    $error = "Requested Password Reset Token has Expired";
                } else {
                    $token = bin2hex(random_bytes(32));
                    $salt = substr(str_shuffle("123j!m45&67HAGGSabcetyi@l907PF65X0OoVBNMZ"), 0, 9).time().$token;
                    $hashedPassword = crypt($password, $salt);
                  	DB::query("UPDATE users SET password=%s, hash_key=%s, date_created=%s, pass_change=%i  WHERE user_id=%s", $hashedPassword, $salt, time(), '1', $userId) ;
      		        if(DB::affectedRows() == 1){
      		            	$_SESSION['pass_change'] = '1';
                  			echo "<script>
                      			alert('Password Updated Successful');
                      			location.href='index.php';
                  			</script>";
      		        }else{
      		            //Fail to Reset Password
      		            echo "<script>
                      			alert('Failed to  Reset Password');
                  			</script>";
      		        }
                }

         }
			
	      }else{
	          echo "<script>alert('Invalid Token');</script>";
	      }
      	}else{
      	  echo "<script>alert('Password Mismatch');</script>";  
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

                                <form action="" method="POST">
                                    <?php
                                        global $error;
                                        if (!empty($error)) {
                                            echo '<p class="text-center fw-bold text-danger">'. $error .'<p>';
                                        }
                                    ?>
                                    <div class="col-md-12" style="text-transform: uppercase;">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">New Password<span class="text-danger">*</span></label>
                                            <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
                                            <input id="password" name="password" type="password" placeholder="Password" required="required" class="form-control">
                                        </div>
                                    </div>
                                    
                                     <div class="col-md-12" style="text-transform: uppercase;">
                                        <div class="mb-3">
                                            <label for="password2" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input data-parsley-equalto="#password" type="password" required="required" placeholder="Confirm Password" class="form-control" name="password2" id="password2">
                                        </div>
                                    </div>
                                    <?php
                                     if ($diff < 0) {
                                     }else{
                                         
                                     ?>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit" name="submit"> SUBMIT </button>
                                    </div><br>
                                    <?php
                                     }
                                     ?>
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