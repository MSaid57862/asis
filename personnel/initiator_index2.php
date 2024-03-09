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

            <form class="form row" id="" method="POST" action="retirement_verification2.php" enctype="multipart/form-data">
                <div class="row justify-content-between" style="background-color:#ecedeb; color:#226305;">
                    <div class="col-md-8">
                        <span><h2>ANNUAL RETIREMENT RECORDS</h2></span>
                                </div>
                                            
                                    <div class="col-md-4">
                                      <div class="text-md-end mt-3 mt-md-0">
                                        <button type="submit" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" ><i class="mdi mdi-plus-circle me-1"></i>ADD FOR THIS YEAR</button>
                                    </div>
                                        </div><!-- end col-->
                                     </div> <!-- end row -->
                                    
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Year</th>
                                                    <th>Date Submitted</th>
                                                    <th>initiated_by</th>
                                                    <th>Status</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM verification_schedule ORDER BY  id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){  
                                                            $id = $result['id'];
                                                            $startDate = $result['date_submited'];

                                                                $start = strtotime($result['date_submited']);
                                                                $today = strtotime(date('Y-m-d'));
                                                            
                                                            
                                                            $status = $result['schedule_status'];
                                                            if($status ='Inactive' > 0){
                                                                    $scheduleStatus = 'In Progress';
                                                                }else{
                                                                    $scheduleStatus = $result['schedule_status'];
                                                                }
                                                                
                                                     ?>
                                                            <tr class="">
                                                               <td><?php echo  'Emolument '.$result['verification_year']; ?></td>
                                                                <td><?php echo $startDate; ?></td>
                                                                <td><?php echo $result['initiated_by']; ?></td>
                                                                <td><?php echo $scheduleStatus; ?></td>
                                                                <td>
                                                                    <button type="button" data-endEmolument="<?php echo $result['id']; ?>" id="viewScheduleEmolument" name="viewScheduleEmolument" class="btn btn-sm btn-outline-danger waves-effect waves-light viewScheduleEmolument" data-bs-toggle="modal" data-bs-target="#view-emolument-schedule-modal"><i class="fas fa-eye"></i></i></button>
                                                                    &nbsp; &nbsp;
                                                                    <button type="button" data-modifySchedule="<?php echo $id; ?>" id="editEmolumentDate" name="editEmolumentDate" class="btn btn-sm btn-outline-secondary waves-effect waves-light editEmolumentDate" data-bs-toggle="modal" data-bs-target="#edit-emolument-schedule-modal"><i class="fas fa-edit"></i></i></button>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                    
                                                ?>
                                                
                                                
                                            </tbody>
                                        </table>
                                      
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->
                        </form>


                        
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
    <?php include("modals.php"); ?>

    <?php include("footer.php"); ?>