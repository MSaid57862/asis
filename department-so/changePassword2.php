<?php 
  $thisPage = "Manage Users";
  
  include("header2.php");
  $userId = $_SESSION['user_id'];
  
  $query = DB::queryFirstRow("SELECT * FROM users WHERE user_id=%i", $userId);
 	if ($query) {
     	$userId = $query['user_id'];
 		$email = $query['username'];
 		$fullname = $query['fullname'];
 	}else{
 	    
 	}
  
?>
<?php //include("modals.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

        <?php
           
            if(isset($_GET['e'])){
                ?>
              <script type="text/javascript">
                window.onload = function(){
                document.getElementById('swalDefaultError').click();
                }
            </script>

            <button type="button" class="btn btn-success swalDefaultError" id="swalDefaultError" style="display: none;">
            </button> 
       <?php
            }
        ?>

        <?php
            if(isset($_GET['s'])){
                ?>
              <script type="text/javascript">
                window.onload = function(){
                document.getElementById('swalDefaultSuccess').click();
                }
            </script>

            <button type="button" class="btn btn-success swalDefaultSuccess" id="swalDefaultSuccess" style="display: none;">
            </button> 
       <?php
            }
        ?>

    <!-- Content Header (Page header) -->
    
 
         <div class="card">
            <div class="card-header bg-dark rounded-0">
              <h3 class="card-title text-bold">Password Change</h3>
            </div>
            <!-- /.card-header -->

            <div class="container-fluid">

                <div class="row p-3">
                    
                    <div class="col-md-6 offset-md-3">
                
                         <form action="#" class="parsley-examples" novalidate="">
                                            <div class="mb-3">
                                                <label for="userName" class="form-label">User Name<span class="text-danger">*</span></label>
                                                <input type="text" name="userName" parsley-trigger="change" value="<?php echo $fullname; ?>" required="required" readonly  placeholder="Enter user name" class="form-control" id="userName">
                                            </div>
                                            <div class="mb-3">
                                                <label for="emailAddress" class="form-label">Email address<span class="text-danger">*</span></label>
                                                <input type="email" name="email" parsley-trigger="change" value="<?php echo $email; ?>" required="required" readonly placeholder="Enter email" class="form-control" id="emailAddress">
                                            </div>
                                            <div class="mb-3">
                                                <label for="oldPass" class="form-label">Old Password<span class="text-danger">*</span></label>
                                                <input id="oldPass" type="password" placeholder="Current Password" required="required" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="pass1" class="form-label">Password<span class="text-danger">*</span></label>
                                                <input id="pass1" type="password" placeholder="Password" required="required" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="passWord2" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <input data-parsley-equalto="#pass1" type="password" required="required" placeholder="Password" class="form-control" id="passWord2">
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
                                                <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                                                <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                            </div>
                                        </form>
                    </div>
              </div>
              
              
                  
            </div>           

            <!-- /.card-body -->
          </div>

  </div>
  <!-- /.content-wrapper -->
<?php
  include("footer.php");
?>