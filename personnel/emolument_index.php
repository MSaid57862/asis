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
                                                <h3>RECORDS OF EMOLUMENT</h3>
                                            </div>
                                            <?php
                                                $year = date('Y', time()) + 1;
                                                $query = DB::queryFirstRow("SELECT * FROM emolument_schedule WHERE emolument_year=%s AND schedule_status=%s", $year, 'Active');
                                                if($query){
                                                       $endDate = $query['end_date'];
                                                       if($endDate!=''){
                                                        $today = date('Y-m-d'); // Use 'Y-m-d' format for date
                                                        
                                                        // Convert the date strings to timestamps
                                                        $endDateTimestamp = strtotime($endDate);
                                                        $todayTimestamp = strtotime($today);
                                                        
                                                        // Calculate the difference in seconds
                                                        $differenceInSeconds = $endDateTimestamp - $todayTimestamp;
                                                        
                                                        // Convert the difference to days
                                                        $differenceInDays = floor($differenceInSeconds / (60 * 60 * 24));
                                                        
                                                        if($differenceInDays < 0){
                                                            //Scheduled Emolument Date has Passed
                                                        }else{
                                                    
                                                ?>
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new-emolument-modal"><i class="mdi mdi-plus-circle me-1"></i> New Emolument</button>
                                                </div>
                                            </div><!-- end col-->
                                            <?php
                                                        }
                                                    }else{
                                                    //No End Date  
                                                    ?>
                                                   <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new-emolument-modal"><i class="mdi mdi-plus-circle me-1"></i> New Emolument</button>
                                                </div>
                                            </div><!-- end col--> 
                                            <?php   
                                                }
                                            }else{
                                                //No Active Schedule for Emolument
                                            }
                                            ?>
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Emolument</th>
                                                    <th>Date Submitted</th>
                                                    <th>Command</th>
                                                    <th>Unit</th>
                                                    <th>Status</th>
                                                    <th>Assessor</th>
                                                    <th>Validator</th>
                                                    <th>Auditor</th>
                                                    <th>Processor</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM emolument WHERE svn='$svn' ORDER BY  id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            
                                                            $getCommandDetail = getCommand($result['command']);
                                                            $commandName = $getCommandDetail['command_name'];
                                                            $unit = $result['unit'];
                                                            if($unit=='0'){
                                                                $unitName='Not Applicable';
                                                            }else{
                                                                $getUnitDetail = getUnit($result['unit']);
                                                                $unitName = $getUnitDetail['unit_name'];
                                                            }
                                                            // $getDesignationDetail = getDesignation($result['designation']);
                                                            // $designationName = $getDesignationDetail['designation_name'];
                                                            
                                                            $assessedBy = $result['assess_by'];
                                                            if($assessedBy==''){
                                                                $assessedBy = 'Pending';
                                                            }else{
                                                                $assessedBy = $result['assess_by']; 
                                                            }
                                                            
                                                             $validatedBy = $result['validate_by'];
                                                            if($validatedBy==''){
                                                                $validatedBy = 'Pending';
                                                            }else{
                                                                $validatedBy = $result['validate_by']; 
                                                            }
                                                            
                                                             $auditedBy = $result['audited_by'];
                                                            if($auditedBy==''){
                                                                $auditedBy = 'Pending';
                                                            }else{
                                                                $auditedBy = $result['audited_by']; 
                                                            }
                                                            
                                                             $processedBy = $result['processed_by'];
                                                            if($processedBy==''){
                                                                $processedBy = 'Pending';
                                                            }else{
                                                                $processedBy = $result['processed_by']; 
                                                            }
                                                ?>
                                                    
                                                            <tr class="">
                                                               <td><?php echo  'Emolument '.$result['emolument_year']; ?></td>
                                                                <td><?php echo date('d-M-Y', $result['date_created']); ?></td>
                                                                <td><?php echo $commandName; ?></td>
                                                                <td><?php echo $unitName; ?></td>
                                                                <td><?php echo $result['status']; ?></td>
                                                                <td><?php echo $assessedBy; ?></td>
                                                                <td><?php echo $validatedBy; ?></td>
                                                                <td><?php echo $auditedBy; ?></td>
                                                                <td><?php echo $processedBy; ?></td>
                                                                <td>
                                                                <?php
                                                                if($result['status']=='Submitted'){
                                                                ?>
                                                                     <button type="button" data-emolumentDelId="<?php echo $result['id']; ?>" class="btn btn-xs btn-outline-danger waves-effect waves-light emolumentId" data-bs-toggle="modal" data-bs-target="#emolument-delete-modal"><i class="fas fa-thumbs-down"></i></button>
                                                                   &nbsp; &nbsp;
                                                                   <button type="button" data-emolumentId="<?php echo $result['id']; ?>" class="btn btn-xs btn-outline-primary waves-effect waves-light emolumentId" data-bs-toggle="modal" data-bs-target="#emolument-detail-modal"><i class="fas fa-edit"></i></i></button>
                                                                <?php
                                                                }else{
                                                                    ?>
                                                                    <span class="bg-primary text-light p-1">LOCKED</span>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                    
                                                ?>
                                                
                                                
                                            </tbody>
                                        </table>
                                      <!--  <div class="form-group col-md-12 mt-4">-->
                                      <!--  <a href="nok.php" class="btn btn-secondary">Go Back  &laquo;</a>-->
                                      <!--  &nbsp; &nbsp; &nbsp;-->
                                      <!--  <a href="pic.php" class="btn btn-primary text-right">Proceed to Photo Upload  &raquo;</a>-->
                                        
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