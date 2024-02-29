<?php 
    include("header2.php");
    include("left-sidebar.php");
    
    $userId = $_SESSION['user_id'];
  
  $query = DB::queryFirstRow("SELECT * FROM users WHERE user_id=%i AND status=%s", $userId, 'Active');
 	if ($query) {
     	$userId = $query['user_id'];
 		$email = $query['username'];
 		$fullname = $query['fullname'];
 		$phone = $query['phone'];
 		$rank = $query['rank'];
 		$command = $query['command_id'];
 		$department = $query['department'];
 		$hashKey = $query['hash_key'];
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
                                        
                        <div class="col-md-12 shadow-lg p-3 mb-5 bg-body rounded" >
                            <h4 class="text-center">ACCOUNT UPDATE AND PASSWORD RESET</h4>
                        </div>
                         
                         <form action="backend.php" method="post" class="parsley-examples" novalidate="">
                          <div class="row col-md-12">   
                        <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="rank">Rank</label>
                                <select name="rank" class="form-control" id="rank" required="required">
                                  <?php 
                                    $record = DB::query("SELECT * FROM ranks ORDER BY rank_id ASC");
                                    if ($record) {
                                       echo '<option value=""> -- Select Rank -- </option>';
        
                                      foreach($record as $class) {
                                        ?>
                                        <option value="<?php echo $class['rank_id']; ?>" <?php if($rank==$class['rank_id']){ echo 'Selected';} ?>> <?php echo $class['rank_name']; ?></option>;
                                    <?php
                                      }
                                        
                                      }else{
                                        echo '<option value="">No Rank</option>';
                                      } 
                                  ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <input type="hidden" name="hashKey" value="<?php echo $hashKey;?>" >
                                <label for="fullname" class="form-label">Fullname<span class="text-danger">*</span></label>
                                <input type="text" name="fullname" parsley-trigger="change" value="<?php echo $fullname; ?>" required="required"  placeholder="Enter user name" class="form-control" id="fullname">
                            </div>
                        </div>
                        
                        <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="emailAddress" class="form-label">Email Address<span class="text-danger">*</span></label>
                                <input type="email" name="email" parsley-trigger="change" value="<?php echo $email; ?>" required="required" readonly placeholder="Enter email" class="form-control" id="emailAddress">
                            </div>
                        </div>
                                            
                       <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                <input type="text" name="phone" parsley-trigger="change" value="<?php echo $phone; ?>" required="required" class="form-control" id="phone" placeholder="Enter your current Phone Number">
                            </div>
                       </div>
                    
                    <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="command">Command</label>
                                <select name="command" class="form-control" id="command" required="required">
                                  <?php 
                                    $record = DB::query("SELECT * FROM command ORDER BY command_name ASC");
                                    if ($record) {
                                       echo '<option value=""> -- Select Command -- </option>';
        
                                      foreach($record as $class) {
                                        ?>
                                        <option value="<?php echo $class['command_id']; ?>" <?php if($command==$class['command_id']){ echo 'Selected';} ?>> <?php echo $class['command_name']; ?></option>;
                                    <?php
                                      }
                                        
                                      }else{
                                        echo '<option value="">No Command</option>';
                                      } 
                                  ?>
                                </select>
                            </div>
                        </div>
                        
                        
                         <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="department">Department</label>
                                <select name="department" class="form-control" id="department" required="required">
                                  <?php 
                                    $record = DB::query("SELECT * FROM department ORDER BY department_name ASC");
                                    if ($record) {
                                       echo '<option value=""> -- Select Department -- </option>';
        
                                      foreach($record as $class) {
                                        ?>
                                        <option value="<?php echo $class['department_id']; ?>" <?php if($department==$class['department_id']){ echo 'Selected';} ?>> <?php echo $class['department_name']; ?></option>;
                                    <?php
                                      }
                                        
                                      }else{
                                        echo '<option value="">No Department</option>';
                                      } 
                                  ?>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="oldpass" class="form-label">Old Password<span class="text-danger">*</span></label>
                                <input id="oldpass" name="oldpass" type="password" placeholder="Current Password" required="required" class="form-control">
                            </div>
                        </div>
                        
                         <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="newpass" class="form-label">New Password<span class="text-danger">*</span></label>
                                <input id="newpass" name="newpass" type="password" placeholder="Password" required="required" class="form-control">
                            </div>
                        </div>
                        
                         <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="passWord2" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input data-parsley-equalto="#newpass" type="password" required="required" placeholder="Password" class="form-control" id="passWord2">
                            </div>
                        </div>
                                            
                                        
                        <div class="text-end">
                            <button class="btn btn-primary waves-effect waves-light" id="submit" type="submit">UPDATE</button>
                            <button type="reset" class="btn btn-secondary waves-effect">RESET</button>
                        </div> 
                        </div>
                    </form>
               
                                    
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