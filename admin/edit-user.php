<?php 
    include("header.php");
    include("left-sidebar.php");
?>
<?php
    if(isset($_GET['userId'])){
        $userId = $_GET['userId'];
        $query = DB::queryFirstRow("SELECT * FROM users WHERE user_id='$userId' LIMIT 1");
        if($query){
            $svn = $query['svc'];
            $fullname = $query['fullname'];
            $username = $query['username'];
            $phone = $query['phone'];
            $rank = $query['rank'];
            $accessLevel = $query['access_level'];
            $command = $query['command_id'];
        }else{
             echo "<div class='alert alert-warning'>Invalid Officer Records</div>";
        }
    }else{
        echo "<script>location.href='index.php'</script>";
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
                                            <div class="col-md-8">
                                                <h3>RECORDS UPDATE</h3>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#user-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        <form action="backend.php" method="post" class="parsley-example">
                                            
                                            <div class="modal-body p-4">
                                                
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <input type="hidden" value="<?php echo $_GET['userId']; ?>" name="userId" >
                                                                <label for="rank" class="form-label">Rank</label>
                                                                <select class="form-select" name="rank" required id="rank">
                                                                    <option value="">Select Rank</option>
                                                                    <?php
                                                                        $query = DB::query("SELECT * FROM ranks ORDER BY rank_id");
                                                                            foreach($query as $result){
                                                                    ?>
                                                                    <option value="<?php $result['rank_id'];?>"<?php if($rank == $result['rank_id']){ echo "selected"; } ?>>
                                                                                    <?php echo $result['rank_name'] ?></option>;
                                                                    <?php                
                                                                            }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="fullname" class="form-label">Fullname</label>
                                                                <input type="text" name="fullname" value="<?php echo $fullname; ?>" required class="form-control" id="fullname">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="svn"  class="form-label">SVN</label>
                                                                <input type="text" data-parsley-type="digits" value="<?php echo $svn; ?>" class="form-control" required name="svn" id="svn">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control" name="email" value="<?php echo $username; ?>" required id="email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="phone"  class="form-label">Phone</label>
                                                                <input type="text"  value="<?php echo $phone; ?>" data-parsley-maxlength="11" data-parsley-minlength="11" class="form-control" required name="phone" id="phone">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6" style="text-transform: uppercase;">
                                                        <div class="mb-3">
                                                            <label for="accessLevel">Access Level</label>
                                                            <select name="accessLevel" class="form-control" id="accessLevel" required="required">
                                                              <?php 
                                                                $record = DB::query("SELECT * FROM access_level ORDER BY access_name ASC");
                                                                if ($record) {
                                                                   echo '<option value=""> -- Select Access Level -- </option>';
                                    
                                                                  foreach($record as $class) {
                                                                    ?>
                                                                    <option value="<?php echo $class['access_id']; ?>" <?php if($accessLevel==$class['access_id']){ echo 'Selected';} ?>> <?php echo $class['access_name']; ?></option>;
                                                                <?php
                                                                  }
                                                                    
                                                                  }else{
                                                                    echo '<option value="">No Access Level</option>';
                                                                  } 
                                                              ?>
                                                            </select>
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
                                                                                    
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="userRole" class="form-label">User Role</label>
                                                                <select class="form-select" name="userRole" required id="userRole">
                                                                    <option value="">Select User Role</option>
                                                                    <option value="Officer">Officer</option>
                                                                    <option value="Assessor">Assessor</option>
                                                                    <option value="Validator">Validator</option>
                                                                    <option value="Auditor">Auditor</option>
                                                                    <option value="Processor">Processor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6 role-div">
                                                               <div class="mb-3">
                                                                <label for="roleCommand">Zone/Command/Unit</label>
                                                                <select name="roleCommand" class="form-control" id="roleCommand">
                                                                  <?php 
                                                                    $record = DB::query("SELECT * FROM command  ORDER BY command_name ASC");
                                                                    if ($record) {
                                                                      echo '<option value=""> -- Select Command -- </option>';
                                        
                                                                      foreach($record as $class) {
                                                                        echo '<option value="'.$class['command_id'].'">'
                                                                             .$class['command_name'].
                                                                          '</option>';
                                                                      }
                                                                        
                                                                      }else{
                                                                        echo '<option value="">No Command</option>';
                                                                      } 
                                                                  ?>
                                                                </select>
                                                              </div>
                                                          </div>
                                                          
                                                           <div class="col-md-6 unitUser-div">
                                                               
                                                            <div class="mb-3">
                                                                <label for="unitUser">Unit</label>
                                                                <select name="unitUser" class="form-control" id="unitUser">
                                                                </select>
                                                          </div>
                                                      </div>  
                                                    </div>
                                                
                                            </div>
                                            
                                                <div class="row justify-content-between">
                                                    
                                                    <div class="col-md-12 text-end">
                                                        <button type="submit" name="update-user" class="btn btn-info waves-effect waves-light">Save Changes</button>
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