<?php 
    include("header.php");
    include("left-sidebar.php");
    $officerID = $_SESSION['user_id'];
    $departmentId = $_SESSION['department_id'];
?>


<?php
function saveRecord(){
 json_decode("hello");
}
?>

<?php
   if (isset($_SESSION['svc'])) {
    $email = $_SESSION['username'];
	$result = DB::queryFirstRow("SELECT * FROM basic_information WHERE officer_email = '$email' LIMIT 1");
	if($result){
	            $svn = $result['svn'];
	            $title = $result['submission_status'];
	            if($title=='Active'){
	                $title = 'RETIREMENT VERIFICATION DATA PAGE';
	            }else{
	                $title = 'APPLICATION  DRAFT';
	            }
              $getOfficerDetail = getOfficerDetail($svn);
              $initials = $getOfficerDetail['initials'];
              $surname = $getOfficerDetail['surname'];
              $firstname = $getOfficerDetail['first_name'];
              $othername = $getOfficerDetail['other_name'];
              $middleName = $getOfficerDetail['middle_name'];
              $gender = $getOfficerDetail['gender'];
              $officerEmail = $getOfficerDetail['officer_email'];
              $phone = $getOfficerDetail['phone'];
              $dob = $getOfficerDetail['date_of_birth'];
              $appointmentDate = $getOfficerDetail['appointment_date'];
              $confirmationDate = $getOfficerDetail['confirmation_date'];
              $appointmentCategory = $getOfficerDetail['appointment_type'];
              $maritalStatus = $getOfficerDetail['marital_status'];
              $hqNo = $getOfficerDetail['hq_no'];
              $fileRef = $getOfficerDetail['file_ref'];
              $residenceAddress = $getOfficerDetail['residence_address'];
              
              $getKinDetail = getNextKin($svn);
              $kinFullname = $getKinDetail['fullname'];
              $relationship = $getKinDetail['relationship'];
              $kinPhone = $getKinDetail['phone'];
              $kinEmail = $getKinDetail['email'];
              $kinAddress = $getKinDetail['address'];
              
              $getUsers = getUserDetail($svn);
              $getRank = getRankDetail($getUsers['rank_id']);
              $rank = $getRank['rank_name']. '('.$getRank['rank_code'].')';
              
              $stateId = $result['state_id'];
              $stateResidenceId = $result['residence_state'];
              $getState = getState($stateId);
              $getResidenceState = getState($stateResidenceId);
              $state = $getState['state_name'];
              $state1 = $getResidenceState['state_name'];
              
              $lgaId = $result['lga_id'];
              $lgaResidenceId = $result['residence_lga'];
              $getLGA = getLGA($lgaId);
              $getResidenceLGA = getLGA($lgaResidenceId);
              $lga = $getLGA['local_govt'];
              $lga1 = $getResidenceLGA['local_govt'];
	}else{
	    //no records found
	     echo "<script>location.href='index.php'</script>";
	}

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
                        <div class="col-md-12 text-center bg-secondary">
                            <h3 class="text-light"><?php echo $title ;?></h3>
                        </div>
                                
                    </div> <!-- end row -->
                        
    <div class="form-group col-md-12 preview" id="preview-div">
        <form class="form row" id="officer-bank" method="POST" action="backend.php" enctype="multipart/form-data">
                <div class="row justify-content-between" style="background-color:#ecedeb; color:#226305;">
                    <div class="col-md-8">
                        <span><h4>Basic Information</h4></span>
                    </div>
                </div>
                  <div class="col-md-4 mb-3">
                        <span><img src="<?php echo 'passports/'.$passport; ?>" height="190px" width="180px" ></span>
                 </div>
                    
                <div class="col-md-8 my-auto">
                     <div class="mb-3">
                      <h3><strong><span><?php echo $surname. ' '.$firstname.' '.$middleName.' '.$othername; ?></span></strong></h3>
                  </div>
             </div>
             <div class="col-md-4">
            <div class="mb-3">
                <label style="font-size: 20px; color: black;" for="svn" class="">Service Number </label>
              <span style="font-size: 20px;"><strong><?php echo $svn ?></strong></span>
             </div> 
            </div>
                      
                    <div class="col-md-4">
                     <div class="mb-3">
                        
                        <label style="font-size: 20px;color: black;" for="hqNo">Headquarter Number</label>
                        <span style="font-size: 20px;"><strong><?php echo $hqNo; ?></strong></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="fileRef">File Reference</label>
                        <span style="font-size: 20px;"><strong><?php echo $fileRef; ?></strong></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="rank" class="">Rank</label>
                        <span style="font-size: 20px;"><strong><?php echo $rank ;?></strong></span>
                      </div>  
                    </div>
                      
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="initials">Initials</label>
                        <span style="font-size: 20px;"><strong><?php echo $initials; ?></strong></span>
                    </div>
                    </div>
                    
                     <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="gender">Gender</label>
                        <span style="font-size: 20px;"><strong><?php echo $gender; ?></strong></span>
                    </div>
                  </div>
                  
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="maritalStatus">Marital Status</label>
                        <span style="font-size: 20px;"><strong><?php echo $maritalStatus; ?></strong></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="dob">Date of Birth</label>
                        <span style="font-size: 20px;"><strong><?php echo $dob; ?></strong></span>
                    </div>
                  </div>
                  
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="phone">Phone</label>
                        <span style="font-size: 20px;"><strong><?php echo $phone; ?></strong></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="email">Email</label>
                        <span style="text-transform:lowercase; font-size: 20px;"><strong><?php echo $officerEmail; ?></strong></span>
                    </div>
                 </div>
                     
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="state">State of Origin</label>
                        <span style="font-size: 20px;"><strong><?php echo $state; ?></strong></span>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="lga">LGA of Origin</label>
                        <span style="font-size: 20px;"><strong><?php echo $lga; ?></strong></span>
                    </div>
                </div>
                
                 <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="state1">State of Residence</label>
                        <span style="font-size: 20px;"><strong><?php echo $state1; ?></strong></span>
                    </div>
                  </div>
                  
               <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="lga1">LGA of Residence</label>
                        <span style="font-size: 20px;"><strong><?php echo $lga1; ?></strong></span>
                    </div>
            </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="address">Residential Address</label>
                        <span style="font-size: 20px;"><strong><?php echo $residenceAddress; ?></strong></span>
                    </div>
                </div>
                
                
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="appointmentDate">Date of First Appointment</label>
                        <span style="font-size: 20px;"><strong><?php echo $appointmentDate; ?></strong></span>
                    </div>
                  </div>
                  
                   <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="confirmationDate">Date of Confirmation</label>
                        <span style="font-size: 20px;"><strong><?php echo $confirmationDate; ?></strong></span>
                    </div>
            </div>
            
               <div class="col-md-4">
                     <div class="mb-3">
                        <label style="font-size: 20px;color: black" for="appointmentCategory">Appointment Category</label>
                        <span style="font-size: 20px;"><strong><?php echo $appointmentCategory; ?></strong></span>
                    </div>
            </div>

            <div class="row justify-content-between" style="background-color:#ecedeb; color:#226305;">
                    <div class="col-md-8">
                        <span><h2>OTHER INFORMATION </h2></span>
                    </div>
            </div>
            </br>

            <div class="col-md-12 mb-3" style="background-color:#ecedeb; color:#226305;">
                    <span><h5>BANK DETAILS</h5></span>
                </div>

                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="accName">Account Name</label>
                        <input type="text" name="accName" required="required" value="" class="form-control" id="accName" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                  </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="bankName">Bank Name</label>
                        <input type="text" name="bankName" required="required" value="" class="form-control" id="bankName" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                  </div>

                  
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="accNumber">Account Number</label>
                        <input type="number" minlength="10" maxlength="10" name="accNumber" value="" required="required" class="form-control" id="accNumber">
                    </div>
                </div>
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="BVN">BVN</label>
                        <input type="number" minlength="10" maxlength="10" name="BVN" value="" required="required" class="form-control" id="BVN">
                    </div>
                </div>
              
                
            <div class="col-md-12 mb-3" style="background-color:#ecedeb; color:#226305;">
                    <span><h5>SPOUSE</h5></span>
                </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="spouseFullName">Full Name</label>
                        <input type="text" name="spouseFullName" required="required" value="" class="form-control" id="spouseFullName" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="spousePhone">Phone</label>
                        <input type="number" minlength="11" maxlength="11" name="spousePhone" value="" required="required" class="form-control" id="spousePhone">
                    </div>
                </div>
                <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="spouseEmail">EMAIL</label>
                            <input type="email"  name="spouseEmail" value="" class="form-control" id="spouseEmail">
                          </div>
                         </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="spouseAddress">Address</label>
                        <input type="text" name="spouseAddress" required="required" value="" class="form-control" id="spouseAddress" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                </div>                
                <div class="col-md-12 mb-3" style="background-color:#ecedeb; color:#226305;">
                    <span><h5>Next of Kin Information 1</h5></span>
                </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinFullname">Full Name</label>
                        <input type="text" name="kinFullname" required="required" value="<?php echo $kinFullname; ?>" class="form-control" id="kinFullname" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinPhone">Phone</label>
                        <input type="number" minlength="11" maxlength="11" name="phone" value="<?php echo $phone; ?>" required="required" class="form-control" id="phone">
                    </div>
                </div>
                <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="email">EMAIL</label>
                            <input type="email"  name="email" value="<?php echo $kinEmail; ?>"  class="form-control" id="email">
                          </div>
                </div>
                  
                 <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinRelationship">Relationship</label>
                        <input type="text" name="kinRelationship" required="required" value="<?php echo $relationship; ?>" class="form-control" id="kinRelationship" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                </div>

                <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="gender">Gender</label>
                              <select name="gender" class="form-control" id="gender">
                                  
                                <option value="">--Select Gender--</option>
                                <option value="MALE" <?php if($gender=='MALE'){ echo 'Selected';}?>>MALE</option>
                                <option value="FEMALE" <?php if($gender=='FEMALE'){ echo 'Selected';}?>>FEMALE</option>
                              </select>
                          </div>
                    </div>

                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinAddress">Address</label>
                        <input type="text" name="kinAddress" required="required" value="<?php echo $kinAddress; ?>" class="form-control" id="kinAddress" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                </div>

                <div class="col-md-12 mb-3" style="background-color:#ecedeb; color:#226305;">
                    <span><h5>Next of Kin Information 2</h5></span>
                </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinFullName">Full Name</label>
                        <input type="text" name="kinFullName" required="required" value="" class="form-control" id="kinFullName" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinPhone">Phone</label>
                        <input type="text" minlength="11" maxlength="11" name="kinPhone" value="" required="required" class="form-control" id="kinPhone">
                    </div>
                </div>
                <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="kinEmail2">EMAIL</label>
                            <input type="email"  name="kinEmail" value="" required="required" class="form-control" id="kinEmail">
                          </div>
                         </div>
                  
                 <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinRelationship">Relationship</label>
                        <input type="text" name="kinRelationship" required="required" value="" class="form-control" id="kinRelationship" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                </div>

                <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="gender">Gender</label>
                              <select name="kinGender" class="form-control" id="kinGender">
                                  
                                <option value="">--Select Gender--</option>
                                <option value="MALE" <?php if($gender=='MALE'){ echo 'Selected';}?>>MALE</option>
                                <option value="FEMALE" <?php if($gender=='FEMALE'){ echo 'Selected';}?>>FEMALE</option>
                              </select>
                          </div>
                    </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinAddress">Address</label>
                        <input type="text" name="kinAddress" required="required" value="" class="form-control" id="kinAddress" onkeyup="this.value = this.value.toUpperCase();" >
                    </div>
                </div>
            
            <br>
            
            <?php 
            $record = DB::query("SELECT id, svn, submission_status FROM basic_information WHERE svn = '$svn' AND submission_status <> 'Active'");
            if ($record) {
                ?>
                <div class="col-md-12 text-right mt-2 d-print-none">
                <button type="submit" name="update-officer" id="update-officer" value="Proceed" class="btn btn-success" id="save"><i class="loader" role="status"></i>
                  Next <i class="fa fa-arrow-right"></i>
                </button>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="pic.php" class="btn btn-secondary d-print-none">Go Back  &laquo;</a>
              </div>
                <?php
            }else{
                ?>
               <div class="col text-end d-print-none mr-2" >
                    <button onclick="printDiv('preview-div');" id="preview-div" type="button" class="btn btn-default"><i class="fas fa fa-print"></i></button>
                </div>
                
            <?php
            }
        ?>
        <div class="modal-footer">
            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-attachment"><i class="mdi mdi-plus-circle me-1"></i> Add Attachment </button>
            <button type="submit" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" name="officer-bank" id="officer-bank">Submit Form</button>
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
<script>
	function printDiv(divName){
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;

	}
</script>