<?php 
    include("header.php");
    include("left-sidebar.php");
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
                                                <h3>All Officers</h3>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addFile-modal"><i class="mdi mdi-file me-1"></i> File Upload</button>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new-user-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Rank</th>
                                                    <th>Fullname</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Pass Change</th>
                                                    <th>User Role</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM users WHERE access_level<>%i AND status=%s", '1', 'Active');
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                        $getDepartment= getDepartment($result['department']);
                                                        $getAccessLevel = getAccessLevel($result['access_level']);
                                                        $getRank = getRank($result['rank_id']);
                                                        $rank = $getRank['rank_code'];
                                                        
                                                        if($result['unit_assessed']!=NULL){
                                                            $role1 = 'Assessor ';
                                                        }else{
                                                            $role1='';
                                                        }
                                                        if($result['unit_validated']!=NULL){
                                                            $role2 = 'Validator ';
                                                        }else{
                                                            $role2='';
                                                        }
                                                        if($result['unit_audited']!=NULL){
                                                            $role3 = 'Auditor ';
                                                        }else{
                                                            $role3='';
                                                        }
                                                        if($result['unit_processed']!=NULL){
                                                            $role4 = 'Processor ';
                                                        }else{
                                                            $role4='';
                                                        }
                                                        $role = $role1.$role2.$role3.$role4;
                                                        if($role==''){
                                                            $userRole = 'N/A';
                                                        }else{
                                                            $userRole = $role;
                                                        }
                                                ?>
                                                    
                                                            <tr class="">
                                                               <td><?php echo $rank; ?></td>
                                                                <td><?php echo $result['fullname']; ?></td>
                                                                <td><?php echo $result['username']; ?></td>
                                                                <td><?php echo $result['phone']; ?></td>
                                                                <td><?php echo $getDepartment['department_name']; ?></td>
                                                                <td><?php echo $userRole; ?></td>
                                                                <td><?php echo $result['pass_change']; ?></td>
                                                                <td><?php echo $getAccessLevel['access_name']; ?></td>
                                                                <td><?php echo $result['status']; ?></td>
                                                                <td>
                                                                    <a href="edit-user.php?userId=<?php echo $result['user_id']; ?>" class="btn btn-secondary-outline fa fa-edit"></a>
                                                                   
                                                                    <a href="backend.php?userDelId=<?php echo $result['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-primary-outline fa fa-trash"></a>
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