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
                                                <h3>RECORDS OF EMOLUMENT SCHEDULES</h3>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#schedule-emolument-modal"><i class="mdi mdi-plus-circle me-1"></i> New Schedule</button>
                                                </div>
                                            </div><!-- end col-->
                                            
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Emolument</th>
                                                    <th>Date Started</th>
                                                    <th>Date Ended</th>
                                                    <th>Duration</th>
                                                    <th>Initiator</th>
                                                    <th>Terminator</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM emolument_schedule ORDER BY  id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){  
                                                            $id = $result['id'];
                                                            $startDate = $result['start_date'];
                                                            $endDate = $result['end_date'];
                                                            if($endDate==''){
                                                                $duration = 'Open';
                                                                $endDate = 'N/A';
                                                                $duration2 = 0;
                                                            }else{
                                                                $start = strtotime($result['start_date']);
                                                                $end = strtotime($result['end_date']);
                                                                $today = strtotime(date('Y-m-d'));
                                                                if ($start !== false && $end !== false) {
                                                                    $diffInSeconds = $end - $start;
                                                                    $diffInSeconds2 = $end - $today;
                                                                    $duration = floor($diffInSeconds / (60 * 60 * 24)). ' Days'; // 60 seconds * 60 minutes * 24 hours
                                                                    $duration2 = floor($diffInSeconds2 / (60 * 60 * 24));
                                                                }
                                                                
                                                            }
                                                            
                                                            $status = $result['schedule_status'];
                                                            if($status ='Inactive' && $duration2 > 0){
                                                                    $scheduleStatus = 'In Progress';
                                                                }else{
                                                                    $scheduleStatus = $result['schedule_status'];
                                                                }
                                                                
                                                     ?>
                                                            <tr class="">
                                                               <td><?php echo  'Emolument '.$result['emolument_year']; ?></td>
                                                                <td><?php echo $startDate; ?></td>
                                                                <td><?php echo $endDate; ?></td>
                                                                <td><?php echo $duration; ?></td>
                                                                <td><?php echo $result['initiated_by']; ?></td>
                                                                <td><?php echo $result['terminated_by']; ?></td>
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


                        
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
    <?php include("modals.php"); ?>

    <?php include("footer.php"); ?>