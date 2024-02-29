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
                                                <h3>BARRACKS INFORMATION</h3>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new-barrack-modal"><i class="fas fa-plus-circle"></i> NEW BARRACK</button>
                                                </div>
                                            </div><!-- end col--> 
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Barrack Code</th>
                                                    <th>Barrack/Quarters Name</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Units</th> 
                                                    <th>State</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM barrack_information ORDER BY  barrack_id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            $NoUnits = getNumberofUnits($result['barrack_id']);
                                                            $getState = getState($result['barrack_state']);
                                                            $stateName = $getState['state_name'];
                                                ?>
                                                    
                                                            <tr class="">
                                                               <td><?php echo  $result['barrack_code']; ?></td>
                                                                <td><?php echo $result['name']; ?></td>
                                                                <td><?php echo $result['category']; ?></td>
                                                                <td><?php echo $result['description']; ?></td>
                                                                <td><?php echo $result['barrack_status']; ?></td>
                                                                <td><?php echo $NoUnits; ?></td>
                                                                <td><?php echo $stateName; ?></td>
                                                                <td><?php echo $result['address']; ?></td>
                                                                <td>
                                                                     <a href="barrack_unit.php?id=<?php echo $result['barrack_id'];?>" class="btn btn-success btn-xs text-white "><i class="fas fa-eye"></i></i></a>
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