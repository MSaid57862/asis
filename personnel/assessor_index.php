<?php 
    include("header.php");
    include("left-sidebar.php");
    $svn = $_SESSION['svc'];
    $unit = $_SESSION['unit_assessed'];
    $year = date('Y')+1;
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
                                 <form action="backend.php" method="post" class="parsley-examples">
                                        <div class="row justify-content-between">
                                            <div class="col-md-8">
                                                <h3>RECORDS OF <?php echo date('Y')+1 ;?> EMOLUMENT</h3>
                                            </div>
                                            
                                        </div> <!-- end row -->
                                        
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>SVN</th>
                                                    <th>Rank</th>
                                                    <th>Name</th>
                                                    <th>Station</th>
                                                    <th>Unit</th>
                                                    <th>Status</th>
                                                    <th>Quartered</th>
                                                    <th>Interdicted</th>
                                                    <th>Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                        

                                            <tbody>
                                                <?php 
                                                 $query = DB::queryFirstRow("SELECT svn FROM emolument WHERE svn='$svn' AND emolument_year='$year' AND (status<>'Deleted' || status<>'Cancalled' || status<>'Rejected') LIMIT 1");
                                                    if($query){
                                                    $query = DB::query("SELECT * FROM emolument WHERE status='Submitted' AND (unit='$unit' || command='$unit') ORDER BY  id DESC");
                                                    if($query){
                                                        $i=1;
                                                        foreach($query as $result){
                                                            $emolumentId = $result['id'];
                                                            $getCommandDetail = getCommand($result['command']);
                                                            $commandName = $getCommandDetail['command_name'];
                                                            $unit = $result['unit'];
                                                            if($unit=='0'){
                                                                $unitName='Not Applicable';
                                                            }else{
                                                                $getUnitDetail = getUnit($result['unit']);
                                                                $unitName = $getUnitDetail['unit_name'];
                                                            }
                                                            $getRank = getRank($result['rank']);
                                                            $rank = $getRank['rank_code'];
                                                            
                                                            $getOfficer = getOfficerDetail($result['svn']);
                                                            $name = $getOfficer['initials']. ' '. $getOfficer['surname'];
                                                ?>
                                                    
                                                            <tr class="">
                                                               <td><?php echo  $result['svn']; ?></td>
                                                                <td><?php echo $rank; ?></td>
                                                                <td><?php echo $name; ?></td>
                                                                <td><?php echo $commandName; ?></td>
                                                                <td><?php echo $unitName; ?></td>
                                                                <td><?php echo $result['status']; ?></td>
                                                                <td><?php echo $result['quartered']; ?></td>
                                                                <td><?php echo $result['interdicted']; ?></td>
                                                                <td><?php echo date('d-M-Y', $result['date_created']); ?></td>
                                                                <td class="text-center">
                                                                        <input class="form-check-input rounded-circle" type="checkbox" name="emolumentId[]" value="<?php echo $result['id'];?>" id="customckeck11">
                                                                        &nbsp; &nbsp;
                                                                        <button type="button" data-emolumentId="<?php echo $result['id']; ?>" id="viewEmolument" name="viewEmolument" class="btn btn-sm btn-outline-primary waves-effect waves-light viewEmolument" data-bs-toggle="modal" data-bs-target="#view-emolument-modal"><i class="fas fa-eye"></i></button>
                                                                        &nbsp; &nbsp;
                                                                        <button type="button" data-emolumentId2="<?php echo $result['id']; ?>" id="rejectEmolument" name="rejectEmolument" class="btn btn-sm btn-outline-danger waves-effect waves-light rejectEmolument" data-bs-toggle="modal" data-bs-target="#emolument-reject-modal"><i class="fas fa-thumbs-down"></i></button>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                    }else{
                                                        //Assessor have no records of Emolument for the current Year
                                                       //echo $comment = 'You have NO ACTIVE '. date('Y')+1 .' Emolument Records. Kindly Submit your Emolument Records or Contact the System Administrator';
                                                    }
                                                ?>
                                                
                                                
                                            </tbody>
                                        </table>
                                        <div class="col-md-12">
                                              <!--  <span><h3><?php //if($comment==''){}else{echo $comment;}?></h3></span>-->
                                        </div><!-- end col-->
                                        
                                      <div class="row">
                                            
                                            <div class="col-md-12 text-end">
                                                <button type="submit" name="approve-emolument" class="btn btn-xl btn-success waves-effect waves-light"><i class="fas fa-thumbs-up"></i> APPROVE EMOLUMENT</button>
                                            </div>
                                    </div>
                                        
                                </form>
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