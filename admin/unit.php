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
                                                <h3>All Units</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-unit-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New Unit</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Department</th>
                                                    <th>Unit Name</th>
                                                    <th>Unit Code</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM units");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                        $getDepartment = getDepartment($result['dept_id']);
                    
                                                ?>
                                                    
                                                            <tr>
                                                               
                                                                <td><?php echo $getDepartment['department_name']; ?></td>
                                                                <td><?php echo $result['unit_name']; ?></td>
                                                                <td><?php echo $result['unit_code']; ?></td>
                                                                
                                                                
                                                                <td align="right">
                                                                    <a href="edit-unit.php?id=<?php echo $result['unit_id']; ?>" class="btn btn-info btn-xs"><i class="fas fa fa-edit"></i> Edit</a>&nbsp;&nbsp;
                                                                    <a href="backend.php?unitDelId=<?php echo $result['unit_id']; ?>" onclick="return confirm('Are you sure you want to delete this Unit?');" class="btn btn-danger btn-xs"><i class="fas fa fa-trash"></i> Delete</a>
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

    