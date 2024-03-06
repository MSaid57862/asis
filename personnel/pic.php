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
      
        $maxFileSize = 1024 * 1024; 
        
        if ($_FILES['errorImage']['error'] === UPLOAD_ERR_OK) {
                if ($_FILES['errorImage']['size'] <= $maxFileSize) {
                    
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
                       
                    $check = DB::query("SELECT * FROM passports WHERE svn=%s", $_SESSION['svc'] );
                      if ($check) {
                        // UPDATE
                       $res = DB::query("UPDATE passports SET pass_name=%s, date_created=%s WHERE svn=%s", $name, time(), $_SESSION['svc']);
                        
                      }else{
                               //INSERT
                             $res = DB::insert('passports', array(
                            'svn' => $_SESSION['svc'],
                            'pass_name' => $name,
                            'date_created' => time()
                            ));
                       }
                       if($res){
                                echo "<script>location.href='retirement_verification2.php?id=$Id';</script>";
                            }else{
                                
                            }

                    
                } else {
                    $_SESSION['fail'] = 'Error: The file size is too large. Please upload a file of up to 1MB';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                
                 $_SESSION['fail'] = 'Error: File upload failed. Please try again.';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            
        }else{
            //echo "ERRORRROROROROR";
        }
    
	
?>

<?php
if(isset($_SESSION['username'])){
    $svn = $_SESSION['svc'];
     $query = DB::queryFirstRow("SELECT * FROM passports WHERE svn = '$svn'");
        if ($query) {
                $passport = 'passports/'.$query['pass_name'];
        }else{
                $passport = ''; 
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
                                    <h3>UPLOAD YOUR PHOTOGRAPH FOR VERIFICATION</h3>
                                </div>
                                
                            </div> <!-- end row -->

                        <div class="form-group col-md-12 passport-div">
                             <form class="form row" id="addOthers" method="post" action="" enctype="multipart/form-data">
                                 <div class="col-md-12 text-right mt-2">
                                    <label for="passport">Upload Passport<small> [1MB jpeg/jpg]</small>&nbsp; &nbsp; &nbsp;<span class="text-danger"> PLEASE, NOTE THAT PASSPORT SIZE SHOULD NOT EXCEED 1MB AND MUST BE .JPG or .JPEG</span></label>
                                     <input type="file" id="errorImage" name="errorImage" accept=".jpg,.jpeg" class="form-control"
                                        data-show-preview="true" data-show-upload="false" required 
                                        data-allowed-file-extensions='["jpg", "jpeg"]' data-show-caption="true" aria-describedby="basic-addon1"
                                        data-parsley-max-file-size="1024" data-parsley-error-message="File size must be 1MB or less." >
                                
                                    <button type="submit" name="upload" value="Proceed" class="btn btn-success mt-2" id="upload"><i class="loader" role="status"></i>
                                       Upload & Proceed<i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="col-md-12 text-center m-2">
                                    <?php
                                        if($passport==''){
                                            
                                        }else{
                                    ?>
                                        <div class="text-center">
                                          <img src="<?php echo $passport; ?>" class="rounded img-thumbnail shadow-xs p-1 mb-5 bg-body" height="400px" width="350px" alt="...">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <!-- <div class="col-md-12 text-right mt-2"> -->
                                     <!-- <a href="posting_index.php" class="btn btn-secondary">Go Back  &laquo;</a> -->
                                     <div class="modal-footer">                                    &nbsp; &nbsp; &nbsp;
                                      <?php
                                        if($surname!=''){
                                        ?>
                                        <a href="retirement_verification2.php" style="margin-right: px;" class="btn btn-primary">Proceed to VERIFICATION &raquo;</a>
                                        <?php
                                        }
                                    ?>
                                </div>
                                <!-- </div> -->
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
    