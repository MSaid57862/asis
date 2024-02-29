<?php 
    include("header2.php");
    include("left-sidebar.php");
    
    $userId = $_SESSION['user_id'];
  
  $query = DB::queryFirstRow("SELECT * FROM users WHERE user_id=%i", $userId);
 	if ($query) {
     	$userId = $query['user_id'];
 		$email = $query['username'];
 		$fullname = $query['fullname'];
 	}else{
 	    
 	}
?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                       
                                    </div>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                           
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row justify-content-between">
                                            <div class="col-md-12">
                                                <h3>Welcome <?php echo $fullname; ?></h3>
                                            </div>
                                        </div> <!-- end row -->
                                        
                        <div class="col-md-6 offset-md-3 shadow-lg p-3 mb-5 bg-body rounded" >
                            <h4 class="text-center">Password Reset</h4>
                         <form action="backend.php" method="post" class="parsley-examples" novalidate="">
                             
                                            <div class="mb-3">
                                                <label for="userName" class="form-label">User Name<span class="text-danger">*</span></label>
                                                <input type="text" name="userName" parsley-trigger="change" value="<?php echo $fullname; ?>" required="required" readonly  placeholder="Enter user name" class="form-control" id="userName">
                                            </div>
                                            <div class="mb-3">
                                                <label for="emailAddress" class="form-label">Email address<span class="text-danger">*</span></label>
                                                <input type="email" name="email" parsley-trigger="change" value="<?php echo $email; ?>" required="required" readonly placeholder="Enter email" class="form-control" id="emailAddress">
                                            </div>
                                            <div class="mb-3">
                                                <label for="oldpass" class="form-label">Old Password<span class="text-danger">*</span></label>
                                                <input id="oldpass" name="oldpass" type="password" placeholder="Current Password" required="required" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="newpass" class="form-label">Password<span class="text-danger">*</span></label>
                                                <input id="newpass" name="newpass" type="password" placeholder="Password" required="required" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="passWord2" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <input data-parsley-equalto="#newpass" type="password" required="required" placeholder="Password" class="form-control" id="passWord2">
                                            </div>
                                            <!--<div class="mb-3">-->
                                            <!--    <div class="form-check form-check-purple">-->
                                            <!--        <input id="checkbox6a" type="checkbox" class="form-check-input" data-parsley-multiple="checkbox6a">-->
                                            <!--        <label for="checkbox6a">-->
                                            <!--            Remember me-->
                                            <!--        </label>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                        
                                            <div class="text-end">
                                                <button class="btn btn-primary waves-effect waves-light" id="submit" type="submit">Submit</button>
                                                <button type="reset" class="btn btn-secondary waves-effect">Reset</button>
                                            </div>
                                        </form>
                    </div>
                                        
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->


                        
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
    <?php include("modals.php"); ?>

    <?php include("footer.php"); ?>