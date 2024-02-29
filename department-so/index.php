<?php 
    include("header.php");
    include("left-sidebar.php");
    $factoryID = $_SESSION['user_id'];
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
                                            <div class="col-md-6">
                                                <h3>PERSONNEL NOMINAL ROLL</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#officer-modal"><i class="mdi mdi-plus-circle me-1"></i> Add New Officer</button>
                                                    &nbsp; &nbsp;
                                                     <button type="button" class="btn btn-secondary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addFile-modal"><i class="mdi mdi-file me-1"></i> File Upload</button>
                                                </div>
                                            </div>
                                            <!-- end col-->
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>SVC</th>
                                                    <th>Rank</th>
                                                    <th>Name</th>
                                                    <th>Current Posting</th>
                                                    <th>Posting Date</th>
                                                    <th>Designation</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Total Postings</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    $query = DB::query("SELECT * FROM basic_information WHERE  submission_status='Active' AND department_id='$departmentId' ORDER BY  id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            $getRankDetail = getRankDetail($result['rank']);
                                                            $rank = $result['rank'];
                                                            $rankCode = $getRankDetail['rank_code'];
                                                            $svn = $result['svn'];
                                                             $query2 = DB::queryFirstRow("SELECT * FROM postings WHERE svn='$svn' AND (status='Active'||status='Pass Out') LIMIT 1");
                                                             if($query2){
                                                                 $currentPostingId = $query2['unit'];
                                                                 $designationId = $query2['designation'];
                                                                 $currentPostingDate = date('d-M-y', $query2['date_captured']);
                                                                 $getUnitDetail = getUnit($currentPostingId);
                                                                 $unitName = $getUnitDetail['unit_name'];
                                                                 $getDesignationDetail = getDesignation($designationId);
                                                                 $designationName = $getDesignationDetail['designation_name'];
                                                             }else{
                                                                 $currentPostingDate='N/A';
                                                                 $designationName ='N/A';
                                                                 $unitName = 'N/A';
                                                             }
                                                            $query3 = DB::query("SELECT count(svn) As totalPosting FROM postings WHERE svn='$svn' AND status!='Deleted'");
                                                            if($query3){
                                                                    foreach($query3 as $res){
                                                                    $totalPosting = $res['totalPosting'];
                                                                }
                                                            }else{
                                                                 $totalPosting = '0';
                                                            }
                                                ?>
                                                    
                                                            <tr class="">
                                                               
                                                                <td><?php echo $result['svn']; ?></td>
                                                                <td><?php echo $rankCode; ?></td>
                                                                <td><?php echo $result['initials'].' '.$result['surname']; ?></td>
                                                                <td><?php echo $unitName; ?></td>
                                                                <td><?php echo $currentPostingDate; ?></td>
                                                                <td><?php echo $designationName; ?></td>
                                                                <td><?php echo $result['officer_email']; ?></td>
                                                                <td><?php echo $result['phone']; ?></td>
                                                                <td class="text-center"><?php echo $totalPosting; ?></td>
                                                                <td>
                                                                        <button type="button" data-officerId="<?php echo $result['svn']; ?>" class="btn btn-xs btn-outline-success waves-effect waves-light officerId mr-1" data-bs-toggle="modal" data-bs-target="#posting-detail-modal"><i class="fas fa fa-eye"></i></i></button>
                                                                        &nbsp; &nbsp;
                                                                        <button type="button" data-officerId="<?php echo $result['svn']; ?>" class="btn btn-xs btn-outline-primary waves-effect waves-light officerId ml-1" data-bs-toggle="modal" data-bs-target="#officer-detail-modal"><i class="fas fa fa-edit"></i></i></button>
                                                                    
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