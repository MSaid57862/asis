<?php 
    include("header.php");
    include("left-sidebar.php");
    $officerID = $_SESSION['user_id'];
    $departmentId = $_SESSION['department_id'];
?>
<?php
if(isset($_SESSION['username'])){
    $svn = $_SESSION['svc'];
     $query = DB::queryFirstRow("SELECT * FROM passports WHERE svn = '$svn'");
        if ($query) {
                $passport = $query['pass_name'];
        }else{
                $passport = ''; 
    }
}

 if (isset($_POST['upload'])) {
  
    $tmp_file_errorImage = $_FILES['errorImage']['tmp_name'];
      $_SESSION['tmpFileErrorImage'] = $tmp_file_errorImage;
      $filename = $_FILES['errorImage']['name'];
      
      $fileType = $_FILES['errorImage']['type'];
      $fileSize = $_FILES['errorImage']['size'];
      //safe file name
      $name = preg_replace("/[^A-Z0-9._-]/i", "_", $filename);

    // don't overwrite an existing file
          $i = 0;
          $parts = pathinfo($name);
          while (file_exists('passports/' . $name)) {
            $i++;
            $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
          }
            move_uploaded_file($_SESSION['tmpFileErrorImage'], 'passports/' . $name);
            chmod('passports/' . $name, 0644); 
           //$_SESSION['errorImage'] = $name;
            $Id = $_SESSION['svc'];
           
        $check = DB::query("SELECT * FROM passports WHERE svn=%i", $_SESSION['svc'] );
          if ($check) {
            // UPDATE
           $res = DB::query("UPDATE passports SET pass_name=%s, date_created=%s WHERE svn=%i", $name, time(), $_SESSION['svc']);
            
          }else{
                   //INSERT
                 $res = DB::insert('passports', array(
                'svn' => $_SESSION['svc'],
                'pass_name' => $name,
                'date_created' => time()
                ));
           }
           if($res){
                    echo "<script>location.href='draft.php?id=$Id';</script>";
                }else{
                    
                }
            
        }else{
            //echo "ERRORRROROROROR";
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
                                    <h3>DRAFT APPLICATION VIEW</h3>
                                </div>
                                
                            </div> <!-- end row -->

                 <div class="form-group col-md-12 passport-div">
                  <form class="form row" id="addOthers" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group col-md-12" style="background-color:#ecedeb; color:#226305;">
                    <span>Basic Information</span>
                  </div>
                  <div class="form-group col-md-4">
                        <span><img src="<?php echo 'passports/'.$passport; ?>" height="140px" width="180px" ></span>
                    </div>
                  <div class="form-group col-md-8 my-auto">
                      <h3>    
                        <!--<label for="rank" class="">Fullname</label>-->
                        <span><?php echo $surname. ' '.$firstname.' '.$middlename.' '.$othername; ?></span>
                    </h3>
                  </div>
                  
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="svn" class="">Service Number</label>
                        <span><?php echo $svn ?></span>
                    </div> 
                  </div>
                      
                    <div class="col-md-4">
                     <div class="mb-3">
                        
                        <label for="hqNo">Headquarter Number</label>
                        <span><?php echo $hqNo; ?></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="rank" class="">Rank</label>
                        <span><?php echo $rank ?></span>
                      </div>  
                    </div>
                      
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="initials">Initials</label>
                        <span><?php echo $initials; ?></span>
                    </div>
                    </div>
                    
                     <div class="col-md-4">
                     <div class="mb-3">
                        <label for="gender">Gender</label>
                        <span><?php echo $gender; ?></span>
                    </div>
                  </div>
                  
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="maritalStatus">Marital Status</label>
                        <span><?php echo $maritalStatus; ?></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="dob">Date of Birth</label>
                        <span><?php echo $dob; ?></span>
                    </div>
                  </div>
                  
                    <div class="form-group col-md-4">
                        <label for="phone">Phone</label>
                        <span><?php echo $phone; ?></span>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <span style="text-transform:lowercase"><?php echo $email; ?></span>
                    </div>
                      
                    <div class="form-group col-md-4 unit-div">
                        <label for="state">State of Origin</label>
                        <span><?php echo $state; ?></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                        <label for="lga">LGA of Origin</label>
                        <span><?php echo $lga; ?></span>
                    </div>
                    <div class="form-group col-md-4 unit-div">
                        <label for="state1">State of Residence</label>
                        <span><?php echo $state1; ?></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                        <label for="lga1">LGA of Residence</label>
                        <span><?php echo $lga1; ?></span>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="address">Residential Address</label>
                        <span><?php echo $address; ?></span>
                    </div>
                <div class="form-group col-md-12" style="background-color:#ecedeb; color:#226305;">
                    <span>Next of Kin Information</span>
                </div>
                <div class="form-group col-md-4 unit-div">
                        <label for="fullname">Fullname</label>
                        <span><?php echo $fullname; ?></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                        <label for="kinPhone">Phone</label>
                        <span><?php echo $kinPhone; ?></span>
                    </div>
                    <div class="form-group col-md-4 unit-div">
                        <label for="kinEmail">Email</label>
                        <span style="text-transform:lowercase"><?php echo $kinEmail; ?></span>
                    </div>
                  
                  <div class="form-group col-md-4 unit-div">
                        <label for="kinRelationship">Relationship</label>
                        <span><?php echo $relationship; ?></span>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="kinAddress">Address</label>
                        <span><?php echo $kinAddress; ?></span>
                    </div>
                <div class="form-group col-md-12" style="background-color:#ecedeb; color:#226305;">
                    <span>Work Information</span>
                </div>
                <div class="form-group col-md-4 unit-div">
                        <label for="firstApp">Date of First Appointment</label>
                        <span><?php echo $firstApp; ?></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                        <label for="lastPromo">Date of Last Promotion</label>
                        <span><?php echo $lastPromo; ?></span>
                    </div>
                    <div class="form-group col-md-4 unit-div">
                        <label for="gradeLevel">Grade Level</label>
                        <span><?php echo $gradeLevel; ?></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                        <label for="command">Command</label>
                        <span><?php echo $command; ?></span>
                    </div>
                    
                    <div class="form-group col-md-4 unit-div">
                        <label for="unit">Unit</label>
                        <span><?php echo $unit; ?></span>
                    </div>
                  
                    <div class="form-group col-md-4">
                        <label for="posting">Date of Current Posting</label>
                        <span><?php echo $posting; ?></span>
                    </div>
                    <br>
                    
                    <?php 
                    $record = DB::query("SELECT id, svn, submission_status FROM basic_information WHERE svn = '$svn' AND submission_status <> 'Submitted'");
                    if ($record) {
                        ?>
                        <div class="col-md-12 text-right mt-2">
                        <button type="submit" name="save" value="Proceed" class="btn btn-success" id="save"><i class="loader" role="status"></i>
                          Final Submission <i class="fa fa-arrow-right"></i>
                        </button>
                      </div>
                        <?php
                    }else{
                        ?>
                        <div class="col-md-12 text-right mt-2 no-print">
                        <a class="btn btn-success btn-sm text-white " OnClick="print();"><i class="fa fa-print"></i> Print Biodata </a>
                        </div>
                    <?php
                    }
                    ?>
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
    