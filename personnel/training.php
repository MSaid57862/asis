<?php 
    include("header.php");
    include("left-sidebar.php");
    $svn = $_SESSION['svc'];
    $commandId = $_SESSION['command_id'];
    $departmentId = $_SESSION['department_id'];
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
                                                <h3>RECORDS OF TRAININGS/COURSES ATTENDED</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new-training-modal"><i class="mdi mdi-plus-circle me-1"></i> New Training/Course</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Date Attended</th>
                                                    <th>Date Concluded</th>
                                                    <th>Duration</th>
                                                    <th>Location</th>
                                                    <!--<th>Action</th>-->
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM training WHERE svn='$svn' ORDER BY  training_id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            
                                                            
                                                ?>
                                                    
                                                            <tr class="">
                                                               <td><?php echo $result['training_title']; ?></td>
                                                                <td><?php echo $result['start_date']; ?></td>
                                                                <td><?php echo $result['end_date']; ?></td>
                                                                <td><?php //echo $unitName; ?></td>
                                                                <td><?php echo $result['training_location']; ?></td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                    
                                                ?>
                                                
                                                
                                            </tbody>
                                        </table>
                                      
                                        
                                      <!--</div>-->
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