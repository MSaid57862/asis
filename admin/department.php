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
                                                <h3>All Departments</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-department-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New Department</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Department</th>
                                                    <th>Dept Code</th>
                                                    <th>HoD</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM department");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            $getRank = getRank($result['department_head']);
                                                            $rank = $getRank['rank_name'];
                                                ?>
                                                    
                                                            <tr>
                                                                <td><?php echo $result['department_name']; ?></td>
                                                                <td><?php echo $result['department_code']; ?></td>
                                                                <td><?php echo $rank;  ?></td>
                                                                <td>
                                                                    <a href="edit-dept.php?id=<?php echo $result['department_id']; ?>" class="btn btn-info btn-xs"><i class="fas fa fa-edit"></i></a>&nbsp;&nbsp;
                                                                    <a href="backend.php?deptDelId=<?php echo $result['department_id']; ?>" onclick="return confirm('Are you sure you want to delete this Department?');" class="btn btn-danger btn-xs"><i class="fas fa fa-trash"></i></a>
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

    