<?php 
    include("header.php");
    include("left-sidebar.php");
    $officerID = $_SESSION['user_id'];
    $departmentId = $_SESSION['department_id'];
?>
<?php
if(isset($_SESSION['username'])){
    $officerEmail = $_SESSION['username'];
     $check = DB::queryFirstRow("SELECT * FROM basic_information WHERE officer_email = '$officerEmail' AND submission_status = 'Active'");
     if($check){
          echo "<script>location.href='preview.php'</script>";
     }else{
     $query = DB::queryFirstRow("SELECT * FROM basic_information WHERE officer_email = '$officerEmail' AND submission_status <> 'Active'");
        if ($query) {
                $svn = $query['svn'];
                $surname = $query['surname'];
                $firstname = $query['first_name'];
                $initials = $query['initials'];
                $othername = $query['other_name'];
                $middlename = $query['middle_name'];
                $phone = $query['phone'];
                $gender= $query['gender'];
                $email= $query['officer_email'];
                $hqNo= $query['hq_no'];
                $appointmentDate= $query['appointment_date'];
                $datePostedToStation= $query['date_posted_to_station'];
                $promotionDate= $query['last_promotion_date'];
                $fileRef= $query['file_ref'];
                $dob =  $query['date_of_birth'];
                $residenceState = $query['residence_state'];
                $residenceLga = $query['residence_lga'];
                $residenceAddress = $query['residence_address'];
                $maritalStatus= $query['marital_status'];
                $state = $query['state_id'];
                $lga= $query['lga_id'];
        }else{
                $svn = '';
                $surname = '';
                $firstname = '';
                $initial = '';
                $othername = '';
                $middlename = '';
                $appointmentDate= '';
                $promotionDate= '';
                $phone = '';
                $hqNo='';
                $email='';
                $dob = '';
                $residence = '';
                $maritalStatus= '';
                $state = '';
                $lga= '';         
        }
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
                                <div class="col-md-8">
                                    <h3>PERSONNEL BIO-DATA</h3>
                                </div>
                                <!--<div class="col-md-4">-->
                                <!--    <div class="text-md-end mt-3 mt-md-0">-->
                                <!--        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#officer-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New Officer</button>-->
                                <!--    </div>-->
                                <!--</div><!-- end col-->-->
                            </div> <!-- end row -->
                    <form action="backend.php" method="post" class="parsley-examples">
                   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                <label for="svn">SERVICE NUMBER</label>
                                <input type="text" name="svn" value="<?php echo $_SESSION['svc']; ?>" required="required" readonly class="form-control" id="svn">
                              </div>
                          </div>
                          <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="email">EMAIL</label>
                            <input type="email"  name="email" value="<?php echo $_SESSION['username']; ?>" required="required" readonly class="form-control" id="email">
                          </div>
                         </div>
                         
                         <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="fileRef">FILE REFERENCE</label>
                            <input type="text"  name="fileRef" value="<?php echo $fileRef; ?>"   class="form-control" id="fileRef">
                          </div>
                         </div>
                         
                          <div class="col-md-4">
                            <div class="mb-3">
                            <label for="hqNo">ID CARD NO (HQ No)</label>
                            <input type="text" name="hqNo" minlength="5" maxlength="5"  value="<?php echo $hqNo; ?>" class="form-control" id="hqNo" onkeyup="this.value = this.value.toUpperCase();" >
                          </div>
                         </div>
                         
                         <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="surname">Surname</label>
                                <input type="text" name="surname" required="required" value="<?php echo $surname; ?>" class="form-control" id="surname" onkeyup="this.value = this.value.toUpperCase();" >
                          </div>
                      </div>
                        <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="firstname" required="required" value="<?php echo $firstname; ?>" class="form-control" id="firstname" onkeyup="this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                     <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="middlename">Middle Name</label>
                                <input type="text" name="middlename" class="form-control" value="<?php echo $middlename; ?>" id="middlename" onkeyup="this.value = this.value.toUpperCase();">
                          </div>
                      </div>
                      
                     <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="othername">Othername</label>
                                <input type="text" name="othername" class="form-control" value="<?php echo $othername; ?>" id="othername" onkeyup="this.value = this.value.toUpperCase();">
                          </div>
                      </div>
                      
                      <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="initial">Initials</label>
                                <input type="text" name="initial" readonly required="required" value="<?php echo $initials; ?>"  class="form-control" id="initial" onkeyup="this.value = this.value.toUpperCase();">
                          </div>
                      </div>
                      
                      <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" minlength="11" maxlength="11" name="phone" value="<?php echo $phone; ?>" required="required" class="form-control" id="phone">
                          </div>
                     </div>
                     
                     <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="firstAppiontment">Date of First Appointment</label>
                                <input type="date" name="firstAppiontment"  required="required" value="<?php echo $appointmentDate; ?>"  class="form-control" id="firstAppiontment" onkeyup="this.value = this.value.toUpperCase();">
                          </div>
                      </div>
                      
                      <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="datePostedToStation">Date Posted to Station</label>
                                <input type="date" name="datePostedToStation"  required="required" value="<?php echo $datePostedToStation; ?>"  class="form-control" id="datePostedToStation" onkeyup="this.value = this.value.toUpperCase();">
                          </div>
                      </div>
                      
                      <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="promotionDate">Date of Last Promotion</label>
                                <input type="date" name="promotionDate" value="<?php echo $promotionDate; ?>" required="required" class="form-control" id="promotionDate">
                          </div>
                     </div>
                     
                      <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date"  name="dob" required="required" value="<?php echo $dob; ?>" class="form-control" id="dob">
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
                      
                    <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="maritalStatus">Marital Status</label>
                            <select name="maritalStatus" class="form-control" id="maritalStatus">
                                <option value="">--Select Marital Status--</option>
                                <option value="SINGLE" <?php if($maritalStatus=='SINGLE'){ echo 'Selected';}?>>SINGLE</option>
                                <option value="MARRIED" <?php if($maritalStatus=='MARRIED'){ echo 'Selected';}?>>MARRIED</option>
                                <option value="DIVORCED" <?php if($maritalStatus=='DIVORCED'){ echo 'Selected';}?>>DIVORCED</option>
                                <option value="WIDOW" <?php if($maritalStatus=='WIDOW'){ echo 'Selected';}?>>WIDOW</option>
                                
                              </select>
                          </div>
                    </div>
                    <div class="col-md-4" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="state">State of Origin</label>
                                <select name="state" class="form-control" id="state" required="required">
                                  <?php 
                                    $record = DB::query("SELECT * FROM state ORDER BY state_name ASC");
                                    if ($record) {
                                       echo '<option value=""> -- Select State -- </option>';
        
                                      foreach($record as $class) {
                                        ?>
                                        <option value="<?php echo $class['state_id']; ?>" <?php if($state==$class['state_id']){ echo 'Selected';} ?>> <?php echo $class['state_name']; ?></option>;
                                    <?php
                                      }
                                        
                                      }else{
                                        echo '<option value="">No State</option>';
                                      } 
                                  ?>
                                </select>
                            </div>
                    </div>
                    <div class="col-md-4" style="text-transform: uppercase;">
                        <div class="mb-3">
                            <label for="lga">LGA</label>
                            <select name="lga" class="form-control" id="lga" required="required">
                            </select>
                      </div>
                    </div>
                    <div class="col-md-4" style="text-transform: uppercase;">
                        <div class="mb-3">
                        <label for="state1">State of Residence</label>
                        <select name="state1" class="form-control" id="state1" required="required">
                          <?php 
                            $record = DB::query("SELECT * FROM state ORDER BY state_id ASC");
                            if ($record) {
                               echo '<option value=""> -- Select State -- </option>';

                              foreach($record as $class) {
                                        ?>
                                        <option value="<?php echo $class['state_id']; ?>" <?php if($residenceState==$class['state_id']){ echo 'Selected';} ?>> <?php echo $class['state_name']; ?></option>;
                                    <?php
                                      }
                                
                              }else{
                                echo '<option value="">No State</option>';
                              } 
                          ?>
                        </select>
                      </div>
                    </div>
                      
                    <div class="col-md-4" style="text-transform: uppercase;">
                        <div class="mb-3">
                            <label for="lga1">LGA of Residence</label>
                            <select name="lga1" class="form-control" id="lga1" required="required">
                            </select>
                      </div>
                    </div>
                    <div class="col-md-4" style="text-transform: uppercase;">
                        <div class="mb-3">
                            <label for="residenceAddress">Residence Address</label>
                            <input type="text"  name="residenceAddress" value="<?php echo $residenceAddress; ?>" required="required" onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="residenceAddress">
                      </div>
                    </div>
                        <div class="form-group col-md-12 mt-4 text-right">
                        
                        <button type="submit" name="add-officer" id="add-officer" value="Proceed" class="btn btn-success" id="save"><i class="loader" role="status"></i>
                          Save & Proceed <i class="fa fa-arrow-right"></i>
                        </button>
                        <?php
                        if($surname!=''){
                        ?>
                        <!--<a href="nok.php" class="btn btn-primary">Proceed to Next of Kin Information  &raquo;</a>-->
                        <?php
                        }
                        ?>
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
    <script type="text/javascript">
		$('#firstname').focusout(function(){
			var firstname = $('#firstname').val().trim();
			var	surname = $('#surname').val().trim();
			var	middlename = $('#middlename').val().trim();
			var	othername = $('#othername').val().trim();
				window.fi = firstname.slice(0,1);
				window.mi = middlename.slice(0,1);
				window.oi = othername.slice(0,1);
				var initials = window.fi+window.mi+window.oi;
			$('#initial').val(initials);

			//alert(fi);
			//$('#initials').val(fi);
		});

		$('#surname').focusout(function(){
			var firstname = $('#firstname').val().trim();
			var	surname = $('#surname').val().trim();
			var	middlename = $('#middlename').val().trim();
			var	othername = $('#othername').val().trim();
				window.fi = firstname.slice(0,1);
				window.mi = middlename.slice(0,1);
				window.oi = othername.slice(0,1);
				var initials = window.fi+window.mi+window.oi;
			$('#initial').val(initials);
		});
		$('#othername').focusout(function(){
			var firstname = $('#firstname').val().trim();
			var	surname = $('#surname').val().trim();
			var	middlename = $('#middlename').val().trim();
			var	othername = $('#othername').val().trim();
				window.fi = firstname.slice(0,1);
				window.mi = middlename.slice(0,1);
				window.oi = othername.slice(0,1);
				var initials = window.fi+window.mi+window.oi;
			$('#initial').val(initials);
		})


		$('#middlename').focusout(function(){
			var firstname = $('#firstname').val().trim();
			var	surname = $('#surname').val().trim();
			var	middlename = $('#middlename').val().trim();
			var	othername = $('#othername').val().trim();
				window.fi = firstname.slice(0,1);
				window.mi = middlename.slice(0,1);
				window.oi = othername.slice(0,1);
				var initials = window.fi+window.mi+window.oi;
			$('#initial').val(initials);
		})



		//$('#initials').val(fi+" "+surname);
	</script>
