<?php 
    include("header.php");
    include("left-sidebar.php");
    $factoryID = $_SESSION['user_id'];
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
                                                <h3>TERMINAL LIST</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#terminal-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New Terminal</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Terminal</th>
                                                    <th>Type</th>
                                                    <th>Command</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM terminal ORDER BY  terminal_id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            $getFormation = getFormation($result['command']);
                                                        
                                                    
                                                ?>
                                                        <tr class="">
                                                           
                                                            <td><?php echo $result['terminal_name']; ?></td>
                                                            <td><?php echo $result['terminal_type']; ?></td>
                                                            <td><?php echo $getFormation['formation_name']; ?></td>
                                                            <td><?php echo $result['status']; ?></td>
                                                            <td><?php echo date('d-M-y', $result['date_created']); ?></td>
                                                            <td>
                                                                
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