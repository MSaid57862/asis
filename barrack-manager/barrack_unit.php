<?php 
    include("header.php");
    include("left-sidebar.php");
    $svn = $_SESSION['svc'];
    $commandId = $_SESSION['command_id'];
    $departmentId = $_SESSION['department_id'];
    
    if(isset($_GET['id'])){
        $barrackId = $_GET['id'];
        $getBarrackDetail = getBarrackDetails($barrackId);
        $barrackName = $getBarrackDetail['name'];
    }else{
        echo "<script>location.href='barrack_index.php'</script>";
    }
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
                                                <h3>BARRACKS UNITS (FLAT) INFORMATION  </h3>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light barrackId" data-barrackId="<?php echo $barrackId;?>"  data-barrackName="<?php echo $barrackName;?>" 
                                                    data-bs-toggle="modal" data-bs-target="#new-barrack-unit-modal"><i class="fas fa-plus-circle"></i> ADD UNIT</button>
                                                </div>
                                            </div><!-- end col--> 
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Flat Code</th>
                                                    <th>Flat Name</th>
                                                    <th>Status</th>
                                                    <th>Facilities</th>
                                                    <th>Allocation</th>
                                                    <th>Images</th> 
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                    
                                                    $query = DB::query("SELECT * FROM barrack_unit_information WHERE barrack_id='$barrackId' ORDER BY  barrack_unit_id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            $NoImages = getNumberofUnitImages($result['barrack_unit_id']);
                                                ?>
                                                    
                                                            <tr class="">
                                                               <td><?php echo  $result['unit_code']; ?></td>
                                                                <td><?php echo $result['unit_name']; ?></td>
                                                                <td><?php echo $result['unit_status']; ?></td>
                                                                <td><?php echo $result['facilities']; ?></td>
                                                                <td><?php echo $result['allocation_status']; ?></td>
                                                                <td><?php echo $NoImages; ?></td>
                                                                <td>
                                                                     <a href="barrack_unit_images.php?id=<?php echo $result['barrack_unit_id'];?>" class="btn btn-success btn-xs text-white "><i class="fas fa-eye"></i></i></a>
                                                                     
                                                                     <button type="button" class="btn btn-primary btn-xs waves-effect waves-light barrackUnitImageID" data-barrackId="<?php echo $result['barrack_unit_id'];?>"  data-barrackCode="<?php echo $result['unit_code'];?>" 
                                                                     data-bs-toggle="modal" data-bs-target="#barrack-image-upload-modal"><i class="fas fa-plus-circle"></i></button>
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