<?php 
    include("header.php");
    include("left-sidebar.php");
    $officerID = $_SESSION['user_id'];
    $departmentId = $_SESSION['department_id'];
?>
<?php
   if (isset($_SESSION['svc'])) {
    $email = $_SESSION['username'];
	$result = DB::queryFirstRow("SELECT * FROM basic_information WHERE officer_email = '$email' LIMIT 1");
	if($result){
	            $svn = $result['svn'];
	            $title = $result['submission_status'];
	            if($title=='Active'){
	                $title = 'PERSONNEL DATA PAGE';
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
        <form class="form row" id="" method="POST" action="retirement_verification2.php" enctype="multipart/form-data">
                <div class="row justify-content-between" style="background-color:#ecedeb; color:#226305;">
                    <div class="col-md-8">
                        <span><h4>Basic Information</h4></span>
                                </div>
                                            
                                    <div class="col-md-4">
                                      <div class="text-md-end mt-3 mt-md-0">
                                        <button type="submit" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" ><i class="mdi mdi-plus-circle me-1"></i>verification form</button>
                                    </div>
                                        </div><!-- end col-->
                                     </div> <!-- end row -->
                 
                                    
                 </div>
                    
                <div class="col-md-8 my-auto">
                     <div class="mb-3">
                      <h3><strong><span><?php echo $surname. ' '.$firstname.' '.$middleName.' '.$othername; ?></span></strong></h3>
                  </div>
             </div>
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="svn" class="">Service Number</label>
                        <span><strong><?php echo $svn ?></strong></span>
                    </div> 
                  </div>
                      
                    <div class="col-md-4">
                     <div class="mb-3">
                        
                        <label for="hqNo">Headquarter Number</label>
                        <span><strong><?php echo $hqNo; ?></strong></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="fileRef">File Reference</label>
                        <span><strong><?php echo $fileRef; ?></strong></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="rank" class="">Rank</label>
                        <span><strong><?php echo $rank ;?></strong></span>
                      </div>  
                    </div>
                      
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="initials">Initials</label>
                        <span><strong><?php echo $initials; ?></strong></span>
                    </div>
                    </div>
                    
                     <div class="col-md-4">
                     <div class="mb-3">         
                        <label for="gender">Gender</label>
                        <span><strong><?php echo $gender; ?></strong></span>
                    </div>
                  </div>
                  
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="maritalStatus">Marital Status</label>
                        <span><strong><?php echo $maritalStatus; ?></strong></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="dob">Date of Birth</label>
                        <span><strong><?php echo $dob; ?></strong></span>
                    </div>
                  </div>
                  
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="phone">Phone</label>
                        <span><strong><?php echo $phone; ?></strong></span>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                     <div class="mb-3">
                        <label for="email">Email</label>
                        <span style="text-transform:lowercase"><strong><?php echo $officerEmail; ?></strong></span>
                    </div>
                 </div>
                     
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="state">State of Origin</label>
                        <span><strong><?php echo $state; ?></strong></span>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="lga">LGA of Origin</label>
                        <span><strong><?php echo $lga; ?></strong></span>
                    </div>
                </div>
                
                 <div class="col-md-4">
                     <div class="mb-3">
                        <label for="state1">State of Residence</label>
                        <span><strong><?php echo $state1; ?></strong></span>
                    </div>
                  </div>
                  
               <div class="col-md-4">
                     <div class="mb-3">
                        <label for="lga1">LGA of Residence</label>
                        <span><strong><?php echo $lga1; ?></strong></span>
                    </div>
            </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="address">Residential Address</label>
                        <span><strong><?php echo $residenceAddress; ?></strong></span>
                    </div>
                </div>
                
                
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="appointmentDate">Date of First Appointment</label>
                        <span><strong><?php echo $appointmentDate; ?></strong></span>
                    </div>
                  </div>
                  
                   <div class="col-md-4">
                     <div class="mb-3">
                        <label for="confirmationDate">Date of Confirmation</label>
                        <span><strong><?php echo $confirmationDate; ?></strong></span>
                    </div>
            </div>
            
               <div class="col-md-4">
                     <div class="mb-3">
                        <label for="appointmentCategory">Appointment Category</label>
                        <span><strong><?php echo $appointmentCategory; ?></strong></span>
                    </div>
            </div>
                
                <div class="col-md-12 mb-3" style="background-color:#ecedeb; color:#226305;">
                    <span><h5>Next of Kin Information</h5></span>
                </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="fullname">Fullname</label>
                        <span><strong><?php echo $kinFullname; ?></strong></span>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinPhone">Phone</label>
                        <span><strong><?php echo $kinPhone; ?></strong></span>
                    </div>
                </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinEmail">Email</label>
                        <span style="text-transform:lowercase"><strong><?php echo $kinEmail; ?></strong></span>
                    </div>
                </div>
                  
                 <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinRelationship">Relationship</label>
                        <span><strong><?php echo $relationship; ?></strong></span>
                    </div>
                </div>
                
                <div class="col-md-4">
                     <div class="mb-3">
                        <label for="kinAddress">Address</label>
                        <span><strong><?php echo $kinAddress; ?></strong></span>
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






<!DOCTYPE html>
<html>
<head><title>Change Picture</title>
<link rel="SHORTCUT ICON" href="Images/dc1.png" />
<link  rel="stylesheet" type="text/css" href="home.css" title="default styles" media="screen"/>
<!-- Le styles -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">










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