<?php 
    session_start();
    require_once 'connections/meekro/db.class.php';
?>
<?php
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username =  $_POST['username'];
        
        
        $query = DB::queryFirstRow("SELECT * FROM users WHERE username=%s AND status=%s", $username, 'Active');
        if($query){
            $salt = $query['hash_key'];
            $password =  $_POST['password'];
            $passwordHash = crypt($password, $salt);
            $userId = $query['user_id'];
            $results = DB::queryFirstRow("SELECT * FROM users WHERE password=%s AND status=%s AND user_id=%i", $passwordHash, 'Active', $userId);
        if ($results) {
            
                //echo $error = "Welcome " ;
                $_SESSION['access_level'] = $results['access_level'];
                $_SESSION['user_id'] = $results['user_id'];
                $_SESSION['username'] = $results['username'];
                $_SESSION['svc'] = $results['svc'];
                 $_SESSION['rank'] = $results['rank'];
                $_SESSION['command_id'] = $results['command_id'];
                $_SESSION['department_id'] = $results['department'];
                $_SESSION['fullname'] = $results['fullname'];
                $_SESSION['status'] = $results['status'];
                
                $_SESSION['unit_assessed'] = $results['unit_assessed'];
                $_SESSION['unit_validated'] = $results['unit_validated'];
                $_SESSION['unit_audited'] = $results['unit_audited'];
                $_SESSION['unit_processed'] = $results['unit_processed'];
                $_SESSION['initiator'] = $results['initiator'];
                
                $_SESSION['barrack_manager'] = $results['barrack_manager'];
                $_SESSION['staff_officer'] = $results['staff_officer'];
                $_SESSION['command_staff_officer'] = $results['command_staff_officer'];
                 $_SESSION['department_head'] = $results['department_head'];
                
                $_SESSION['pass_change'] = $results['pass_change'];
                if ($_SESSION['access_level'] == '1') {
                    // Super Admin
                    header("Location: admin/");
                }elseif ($_SESSION['access_level'] == '5') {
                    // STAFF Officer
                    header("Location: department-so/");
                }elseif ($_SESSION['access_level'] == '2') {
                    // HEAD OF DEPARTMENT
                    header("Location: department/index.php");
                }elseif ($_SESSION['access_level'] == '3') {
                    // Personnel
                    header("Location: personnel/");
                }else{
                    // We dont know who you are
                }
                
                die();
            
        }else {
            $error =  "Invalid Login Credentials";
        }
        }else{
            //Incorrect Username
            $error =  "Incorrect Login Credentials";
        }
    }else{
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Log In | NCS</title>
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
                                                <img src="assets/images/logo.jpg" alt="" height="110">
                                            </span>
                                        </a>
                    
                                        <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-light.png" alt="" height="22">
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
                                        <label for="emailaddress" class="form-label">Username</label>
                                        <input class="form-control" type="text" id="username" required="required" name="username" placeholder="Enter Username">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div><br>
                                     <div class="text-center d-grid">
                                        <a href="reset_password.php" class="btn btn-outline-secondary text-danger">Forgot Password?</a>
                                    </div>
                                </form>
                                <p>
                                    
                                </p>

                                <!-- <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign in with</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                        </li>
                                    </ul>
                                </div> -->

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