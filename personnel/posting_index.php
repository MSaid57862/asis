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
                                                <h3>RECORDS OF POSTING</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new-posting-modal"><i class="mdi mdi-plus-circle me-1"></i> New Posting</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Posting Ref</th>
                                                    <th>Rank</th>
                                                    <th>Command</th>
                                                    <th>Unit</th>
                                                    <th>Posting Date</th>
                                                    <th>Designation</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM postings WHERE svn='$svn' ORDER BY  posting_id DESC");
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
                                                             $getRank = getRankDetail($result['rank_id']);
                                                             $rankCode = $getRank['rank_code'];
                                                            $getDesignationDetail = getDesignation($result['designation']);
                                                            $designationName = $getDesignationDetail['designation_name'];
                                                ?>
                                                    
                                                            <tr class="">
                                                               <td><?php echo $result['posting_ref']; ?></td>
                                                                <td><?php echo $rankCode; ?></td>
                                                                <td><?php echo $commandName; ?></td>
                                                                <td><?php echo $unitName; ?></td>
                                                                <td><?php echo $result['effective_date']; ?></td>
                                                                <td><?php echo $designationName; ?></td>
                                                                <td><?php if($result['status']=='Active'){
                                                                    ?>
                                                                    <div class="text-md-start mt-3 mt-md-0">
                                                                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#postOut-modal"> Active</button>
                                                                    </div>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <div class="text-md-start mt-3 mt-md-0">
                                                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#postOut-modal" data-postID="<?php echo $result['posting_id'];?>"><?php echo $result['status']; ?> </button>
                                                                    </div>
                                                                <?php
                                                                    
                                                                };?></td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                    
                                                ?>
                                                
                                                
                                            </tbody>
                                        </table>
                                        <?php
                                            $query = DB::queryFirstRow("SELECT * FROM basic_information WHERE svn='$svn' AND submission_status='Active'");
                                                if($query){
                                                }else{
                                        ?>
                                        <div class="form-group col-md-12 mt-4">
                                        <a href="nok.php" class="btn btn-secondary">Go Back  &laquo;</a>
                                        &nbsp; &nbsp; &nbsp;
                                        <a href="pic.php" class="btn btn-primary text-right">Proceed to Photo Upload  &raquo;</a>
                                        
                                      </div>
                                      <?php
                                                }
                                                ?>
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