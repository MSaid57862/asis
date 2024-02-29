<?php 
    include("header.php");
    include("left-sidebar.php");
    $officerID = $_SESSION['user_id'];
    $departmentId = $_SESSION['department_id'];
?>
<?php
if(isset($_SESSION['username'])){
    $svn = $_SESSION['svc'];
     $query = DB::queryFirstRow("SELECT * FROM kin_information WHERE svn = '$svn'");
        if ($query) {
                $svn = $query['svn'];
                $fullname = $query['fullname'];
                $gender= $query['gender'];
                $email= $query['email'];
                $phone= $query['phone'];
                $relationship= $query['relationship'];
                $address = $query['address'];
        }else{
                $svn = '';
                $fullname = '';
                $gender= '';
                $email= '';
                $phone= '';
                $relationship= '';
                $address = '';  
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
                                    <h3>NEXT OF KIN INFORMATION</h3>
                                </div>
                                <!--<div class="col-md-4">-->
                                <!--    <div class="text-md-end mt-3 mt-md-0">-->
                                <!--        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#officer-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New Officer</button>-->
                                <!--    </div>-->
                                <!--</div><!-- end col-->-->
                            </div> <!-- end row -->
                    <form action="backend.php" method="post" class="parsley-examples">
                   
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                <label for="fullname">Fullname</label>
                                <input type="text" name="fullname" value="<?php echo $fullname; ?>" required="required" class="form-control" id="fullname">
                              </div>
                          </div>
                          <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email"  name="email" value="<?php echo $email; ?>" required="required" class="form-control" id="email">
                          </div>
                         </div>
                         
                         
                      
                      <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" minlength="11" maxlength="11" name="phone" value="<?php echo $phone; ?>" required="required" class="form-control" id="phone">
                          </div>
                     </div>
                     
                     
                      <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                            <label for="gender">Gender</label>
                              <select name="gender" class="form-control" id="gender">
                                  
                                <option value="">--Select Gender--</option>
                                <option value="MALE" <?php if($gender=='MALE'){ echo 'Selected';}?>>MALE</option>
                                <option value="FEMALE" <?php if($gender=='FEMALE'){ echo 'Selected';}?>>FEMALE</option>
                              </select>
                          </div>
                    </div>
                      
                    
                    <div class="col-md-6" style="text-transform: uppercase;">
                            <div class="mb-3">
                                <label for="relationship">Relationship with Next of Kin</label>
                                <select name="relationship" class="form-control" id="relationship" required="required">
                                  <?php 
                                    $record = DB::query("SELECT * FROM kin_relationship");
                                    if ($record) {
                                       echo '<option value=""> -- Select Relationship -- </option>';
        
                                      foreach($record as $class) {
                                        ?>
                                        <option value="<?php echo $class['id']; ?>" <?php if($relationship==$class['id']){ echo 'Selected';} ?>> <?php echo $class['name']; ?></option>;
                                    <?php
                                      }
                                        
                                      }else{
                                        echo '<option value="">No Relationship</option>';
                                      } 
                                  ?>
                                </select>
                            </div>
                    </div>
                    
                   
                    <div class="col-md-6" style="text-transform: uppercase;">
                        <div class="mb-3">
                            <label for="address">Residential Address</label>
                            <input type="text"  name="address" value="<?php echo $address; ?>" required="required" onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="address">
                      </div>
                    </div>
                        <div class="form-group col-md-12 mt-4">
                            
                        <button type="submit" name="officer-kin" id="officer-kin" value="Proceed" class="btn btn-success text-start" id="save"><i class="loader" role="status"></i>
                          Save & Proceed <i class="fa fa-arrow-right"></i>
                        </button>
                        
                         <a href="index.php" class="btn btn-secondary">Back  &laquo;</a>
                       
                        <?php
                        if($fullname!=''){
                        ?>
                        <!--<a href="posting_index.php" class="btn btn-primary">Proceed to Posting Information  &raquo;</a>-->
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
