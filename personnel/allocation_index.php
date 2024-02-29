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
                                                <h3>RECORDS OF QUARTERS ALLOCATIONS</h3>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <a href="barrack_index.php" class="btn btn-success text-white "><i class="fas fa-search"></i></i> SEARCH ALLOCATION</a>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new-allocation-modal"><i class="fas fa-plus-circle"></i> APPLY</button>
                                                </div>
                                            </div><!-- end col--> 
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Tracking ID</th>
                                                    <th>Posting</th>
                                                    <th>Barrack/Quarters Name</th>
                                                    <th>Category</th>
                                                    <th>Flat/Unit</th>
                                                    <th>Status</th>
                                                    <th>Submission</th> 
                                                    <th>Decision</th>
                                                    <th>Date</th>
                                                    <th>Exited</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM allocations WHERE svn='$svn' ORDER BY  allocation_id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            
                                                            $getCommandDetail = getCommand($result['command']);
                                                            $commandName = $getCommandDetail['command_name'];
                                                            $unit = $result['unit'];
                                                            if($unit=='0'||$unit==''){
                                                                $unitName='N/A';
                                                            }else{
                                                                $getUnitDetail = getUnit($result['unit']);
                                                                $unitName = $getUnitDetail['unit_name'];
                                                            }
                                                          $getBarrackDetails = getBarrackDetails($result['barrack_id']);
                                                          $barrackName = $getBarrackDetails['name'];
                                                          $category = $getBarrackDetails['category'];
                                                          
                                                          $getBarrackUnitDetails = getBarrackUnitDetails($result['barrack_unit_id']);
                                                          $barrackUnitName = $getBarrackUnitDetails['unit_name'];
                                                ?>
                                                    
                                                            <tr class="">
                                                               <td><?php echo  $result['tracking_id']; ?></td>
                                                                <td><?php echo $commandName; ?></td>
                                                                <td><?php echo $barrackName; ?></td>
                                                                <td><?php echo $category; ?></td>
                                                                <td><?php echo $barrackUnitName; ?></td>
                                                                <td><?php echo $result['unit_status']; ?></td>
                                                                <td><?php echo date('d-M-Y', $result['application_date']); ?></td>
                                                                <td><?php echo $result['decision']; ?></td>
                                                                <td><?php echo $result['decision_date']; ?></td>
                                                                <td><?php echo $result['move_out_date']; ?></td>
                                                                <td>
                                                                <?php
                                                                if($result['decision']=='Submitted'){
                                                                ?>
                                                                     <a type="button" href="backend.php?applicatinId=<?php echo $result['allocation_id']; ?>" class="btn btn-xs btn-outline-danger waves-effect 
                                                                     waves-light"> <i class="fas fa-trash"></i></a>

                                                                     
                                                                    <button type="button" data-emolumentId="<?php echo $result['allocation_id']; ?>" class="btn btn-xs btn-outline-success waves-effect waves-light accomodationViewId" 
                                                                    data-bs-toggle="modal" data-bs-target="#accomodation-detail-modal"><i class="fas fa-eye"></i></i></button>
                                                                <?php
                                                                }else{
                                                                    ?>
                                                                    <button type="button" data-emolumentId="<?php echo $result['allocation_id']; ?>" class="btn btn-xs btn-outline-success waves-effect waves-light accomodationViewId" 
                                                                    data-bs-toggle="modal" data-bs-target="#accomodation-detail-modal"><i class="fas fa-eye"></i></i></button>
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