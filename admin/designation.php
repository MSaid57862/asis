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
                                                <h3>All Designations</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-designation-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New Designation</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Designation</th>
                                                    <th>Designation Code</th>
                                                    <th>Department</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM designation");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                        $getDepartment = getDepartment($result['department_id']);
                                                        $dept = $getDepartment['department_name'];
                    
                                                ?>
                                                    
                                                            <tr>
                                                               
                                                                <td><?php echo $result['designation_name']; ?></td>
                                                                <td><?php echo $result['designation_code']; ?></td>
                                                                <td><?php echo $dept; ?></td>
                                                                
                                                                
                                                                <td align="right">
                                                                    <a href="edit-designation.php?id=<?php echo $result['designation_id']; ?>" class="btn btn-info btn-xs"><i class="fas fa fa-edit"></i> Edit</a>&nbsp;&nbsp;
                                                                    <a href="backend.php?desigelId=<?php echo $result['designation_id']; ?>" onclick="return confirm('Are you sure you want to delete this Designation?');" class="btn btn-danger btn-xs"><i class="fas fa fa-trash"></i> Delete</a>
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

    