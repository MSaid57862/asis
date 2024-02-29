<?php 
    include("header.php");
    include("left-sidebar.php");
    $factoryID = $_SESSION['user_id'];
    $commandId = $_SESSION['command_id'];
    $department = $_SESSION['department_id'];
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
                                                <h3>OFFICERS' POSTING</h3>
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
                                                    <th>SVC</th>
                                                    <th>Rank</th>
                                                    <th>Name</th>
                                                    <th>Command</th>
                                                    <th>Unit</th>
                                                    <th>Posting Date</th>
                                                    <th>Designation</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM postings WHERE status ='Active' AND department='$department' ORDER BY  posting_id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            
                                                            $getFormationDetail = getFormation($result['command']);
                                                            $commandName = $getFormationDetail['formation_name'];
                                                            $getUnitDetail = getUnit($result['unit']);
                                                            $unitName = $getUnitDetail['unit_name'];
                                                            $getOfficerDetail = getOfficerDetail($result['officer_id']);
                                                            $officerSVC = $getOfficerDetail['svc'];
                                                            $officerInitials = $getOfficerDetail['initials'];
                                                            $officerSurname = $getOfficerDetail['surname'];
                                                            $officerRank = $getOfficerDetail['rank'];
                                                            $fullName = $officerInitials.' '.$officerSurname;
                                                            $getRankDetail = getRankDetail($officerRank);
                                                            $rankCode = $getRankDetail['rank_code'];
                                                            $getDesignationDetail = getDesignation($result['designation']);
                                                            $designationName = $getDesignationDetail['designation_name'];
                                                ?>
                                                    
                                                            <tr class="">
                                                               
                                                                <td><?php echo $officerSVC; ?></td>
                                                                <td><?php echo $rankCode; ?></td>
                                                                <td><?php echo $fullName; ?></td>
                                                                <td><?php echo $commandName; ?></td>
                                                                <td><?php echo $unitName; ?></td>
                                                                <td><?php echo date('d-M-y', $result['date_captured']); ?></td>
                                                                <td><?php echo $designationName; ?></td>
                                                                <td><?php echo $result['status']; ?></td>
                                                                <td>
                                                                   
                                                                        <button type="button" data-officerId="<?php echo $result['officer_id']; ?>" class="btn btn-xs btn-outline-success waves-effect waves-light officerId" data-bs-toggle="modal" data-bs-target="#posting-detail-modal"></i>Postings</button>
                                                                   
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