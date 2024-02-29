<?php 
    include("header.php");
    include("left-sidebar.php");
?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
<!--  -->
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
                                                <h3>All NCS Commands</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-formation-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <!--<th>Zone</th>-->
                                                    <th>Command</th>
                                                    <th>Command Code</th>
                                                    <!--<th>Location</th>-->
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM command");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                        
                                                ?>
                                                    <tr>
                                                        <td><?php echo $result['command_name']; ?></td>
                                                        <td><?php echo $result['command_code']; ?></td>
                                                        <td align="right">
                                                            <a href="edit-command.php?id=<?php echo $result['command_id']; ?>" class="btn btn-info btn-xs">Edit</a>&nbsp;&nbsp;
                                                            <a href="backend.php?tankDelId=<?php echo $result['command_id']; ?>" onclick="return confirm('Are you sure you want to delete this Tank?');" class="btn btn-danger btn-xs">Delete</a>
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

    