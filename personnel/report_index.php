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


                                            <form action="" method="post" class="parsley-examples">
                                                 <div class="row justify-content-between">
                                                    <div class="col-md-8">
                                                        <h3>GENERATE POSTING REPORT </h3>
                                                    </div>
                                                </div> <!-- end row -->
                                        
                                                <div class="row">
                                                             <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="command" class="form-label">Command</label>
                                                                    <select class="form-select  border-secondary border" data-live-search="true" name="command"  id="command">
                                                                         <option value="">Select Command</option> 
                                                                        <?php
                                                                            $query = DB::query("SELECT * FROM formation ORDER BY formation_id");
                                                                                foreach($query as $result){
                                                                                    echo "<option value='".$result['formation_id']."'>".$result['formation_name']."</option>";
                                                                                }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="reportUnit" class="form-label">Unit</label>
                                                                    <select class="form-select  border-secondary border"  data-live-search="true" name="reportUnit"  id="reportUnit">
                                                                        
                                                                    </select>
                                                                </div>
                                                           </div>
                                                            
                                                             <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <label for="rank" class="form-label">Rank</label>
                                                                    <select class="form-select" name="rank"  id="rank">
                                                                         <option value="">Select Rank</option> 
                                                                        <?php
                                                                            $query = DB::query("SELECT * FROM rank ORDER BY rank_id ASC");
                                                                                foreach($query as $result){
                                                                                    echo "<option value='".$result['rank_id']."'>".$result['rank_code']."</option>";
                                                                                }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <label for="designation" class="form-label">Designation</label>
                                                                    <select class="form-select" name="designation"  id="designation">
                                                                         <option value="">Select Designation</option> 
                                                                        <?php
                                                                            $query = DB::query("SELECT * FROM designation ORDER BY designation_id ASC");
                                                                                foreach($query as $result){
                                                                                    echo "<option value='".$result['designation_id']."'>".$result['designation_name']."</option>";
                                                                                }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                             <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <label for="reportStatus" class="form-label">Status</label>
                                                                    <select class="form-select" name="reportStatus"  id="reportStatus">
                                                                        <option value="">Select Status</option>
                                                                        <option value="Active">Active</option>
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="Post Out">Post Out</option>
                                                                        <option value="Deleted">Deleted</option>
                                                                        <option value="Queried">Queried</option>
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-2 pt-1">
                                                                <div class="mt-0">
                                                                   <button type="submit" name="generate" class="btn btn-info waves-effect waves-light text-left">Generate Report</button> 
                                                                </div>
                                                            </div>
                                                        </div>        
                                                    </form>    
                                                
               
                    
                                                <div class="row">
                                                    <?php
                                                        if (isset($_POST['generate'])){
                                                            $command = $_POST['command'];
                                                            $unit = $_POST['reportUnit'];
                                                            $designation = $_POST['designation'];
                                                            $status = $_POST['reportStatus'];
                                                            $rank = $_POST['rank'];
                                                            $department = $_SESSION['department_id'];
                                                            
                                                            $query =" SELECT * FROM postings";
                                                    		
                                                            if (isset($_POST['generate']) || isset($_POST['command']) || isset($_POST['unit']) || isset($_POST['designation']) || isset($_POST['status'])  || isset($_POST['rank'])) {
                                                        			// code...
                                                        			$query .= " WHERE department='$department' AND ";
                                                        
                                                        			// Command
                                                        			if (isset($_POST['command']) && !empty($_POST['command'])) {
                                                        				// code...
                                                        
                                                        				$query .= " command = '".$command."' AND ";
                                                        				
                                                        				//$tableTitle .= " Age Between " . $minValue ." and " .$maxValue ." Years, ";
                                                        			}
                                                        
                                                        			// Unit
                                                        			if (isset($_POST['unit']) && !empty($_POST['unit'])) {
                                                        				// code...
                                                        
                                                        				$query .= " unit = '".$unit."' AND ";
                                                        				
                                                        			}
                                                        			// Designation
                                                        			if (isset($_POST['designation']) && !empty($_POST['designation'])) {
                                                        				// code...
                                                        
                                                        				$query .= " designation = '".$designation."' AND ";
                                                        				
                                                        			}
                                                        
                                                        			// Status
                                                        			if (isset($_POST['status']) && !empty($_POST['status'])) {
                                                        				// code...
                                                        
                                                        				$query .= " status = '".$status."' AND ";
                                                        				
                                                        			}
                                                        
                                                        			// Rank
                                                        			if (isset($rank) && !empty($rank)) {
                                                        				// code...
                                                        
                                                        				$query .= " rank = '".$rank."' AND ";
                                                        				
                                                        			}
                                                        
                                                        			$query2 = $query. " 1";
                                                        			$queryExecute = DB::query($query2);
                                                        			//echo $query2;
                                                        		
                                                        
                                                        	}else{
                                                        		$query2 = " SELECT * FROM postings ";
                                                        		$queryExecute = DB::query($query2);
                                                        		//echo $query2;
                                                        	}
                                                        if($query2){
                                                                    $i=1;
                                                    ?>
                                                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Staff ORDER</th>
                                                                            <th>SVC</th>
                                                                            <th>Rank</th>
                                                                            <th>Name</th>
                                                                            <th>Command</th>
                                                                            <th>Unit</th>
                                                                            <th>Designation</th>
                                                                            <th>Date Posted</th>
                                                                            <th>Posting Duration</th>
                                                                            <th>Status</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                
                        
                                                                    <tbody>
                                                                        <?php 
                                                                           
                                                                                foreach($queryExecute as $result){
                                                                                $getCommandDetail = getFormation($result['command']);
                                                                                $commandName = $getCommandDetail['formation_name'];
                                                                                $getUnitDetail = getUnit($result['unit']);
                                                                                $unitName = $getUnitDetail['unit_name'];
                                                                                $getRankDetail = getRankDetail($result['rank']);
                                                                                $rankName = $getRankDetail['rank_code'];
                                                                                $staffOrder = $result['posting_ref'];
                                                                                $getDesignationDetail = getDesignation($result['designation']);
                                                                                $designationName = $getDesignationDetail['designation_name'];
                                                                                $datePosted = $result['effective_date'];
                                                                                $status = $result['status'];
                                                                                $getOfficerDetail = getOfficerDetail($result['officer_id']);
                                                                                $svc = $getOfficerDetail['svc'];
                                                                                $surname = $getOfficerDetail['surname'];
                                                                                $initials = $getOfficerDetail['initials'];
                                                                                $fullname = $initials.' '.$surname;
                                                                                $status = $result['status'];
                                                                                
                                                                                if($status=='Pending'){
                                                                                    $duration = 'Not Applicable';
                                                                                }elseif($status=='Deleted'){
                                                                                    $duration = 'Not Applicable';
                                                                                    }else{
                                                                                    $endDate = $result['date_posted_out'];
                                                                                    if($endDate==''){
                                                                                       $endDate = date('Y-M-d', time()); 
                                                                                    }else{
                                                                                         $endDate = date('Y-M-d', $result['date_posted_out']);
                                                                                    }
                                                                                    
                                                                                    $datetime1 = date_create($datePosted);
                                                                                    $datetime2 = date_create($endDate);
                                                                                    $diff = date_diff($datetime1, $datetime2);
                                                                                    $duration = $diff->format("%y Year(s) %m Month(s) %d Day(s)");
                                                                                }
                                                                        ?>
                                                                            
                                                                                    <tr class="">
                                                                                        <td><?php echo $result['posting_ref']; ?></td>
                                                                                        <td><?php echo $svc; ?></td>
                                                                                        <td><?php echo $rankName; ?></td>
                                                                                        <td><?php echo $fullname; ?></td>
                                                                                        <td><?php echo $commandName; ?></td>
                                                                                        <td><?php echo $unitName; ?></td>
                                                                                        <td><?php echo $designationName; ?></td>
                                                                                        <td><?php echo $datePosted; ?></td>
                                                                                        <td><?php echo $duration; ?></td>
                                                                                        <td><?php echo $result['status']; ?></td>
                                                                                        <td>
                                                                                         <a href='staff_order.php?postingId=$postingId' class='btn btn-xs btn-outline-info'><i class='fas fa fa-eye' data-toggle='tooltip' title='View'> </i></a>
                                                                                        </td>
                                                                                    </tr>
                                                                        <?php
                                                                                }
                                                                                
                                                                        ?>          
                                                                </tbody>
                                                            </table>
                                                                        <?php
                                                                            }else{
                                                                                        //No Records Found
                                                                                }
                                                                            
                                                                    }else{
                                                                        //No Field Selected
                                                                    }
                                                                            
                                                                        ?>
                                                             
                                                    </div>
                        
              
                        
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