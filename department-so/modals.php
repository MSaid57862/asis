<div id="officer-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header bg-light">
                    <h4 class="modal-title">OFFICER REGISTRATION</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-2">
                    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="fileRef" class="form-label">File Reference</label>
                                    <input type="text" name="fileRef" onkeyup="this.value = this.value.toUpperCase();" required class="form-control" id="fileRef">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hrdRef" class="form-label">HRD Reference</label>
                                    <input type="text" name="hrdRef" onkeyup="this.value = this.value.toUpperCase();" required class="form-control" id="hrdRef">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hrdDocument" class="form-label">Upload HRD Reference</label>
                                    <input type="file" name="hrdDocument" class="form-control" id="hrdDocument">
                                </div>
                            </div>
                            
                           <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="svc" class="form-label">Service Number</label>
                                    <input type="text" name="svc" onkeyup="this.value = this.value.toUpperCase();" required class="form-control" id="svc">
                                </div>
                            </div>
                            
                           <div class="col-md-4">
                            <div class="mb-3">
                                <label for="rank" class="form-label">Rank</label>
                                <select class="form-select" name="rank" required id="rank">
                                     <option value="">Select Rank</option> 
                                    <?php
                                        $query = DB::query("SELECT * FROM ranks WHERE rank_id <>'1' ORDER BY rank_id");
                                            foreach($query as $result){
                                                echo "<option value='".$result['rank_id']."'>".$result['rank_name']."</option>";
                                            }
                                    ?>
                                </select>
                            </div>
                           </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="initials" class="form-label">Initials</label>
                                    <input type="text" name="initials" required  onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="initials">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="surname" class="form-label">Surname</label>
                                    <input type="text" name="surname" required  onkeyup="this.value = this.value.toUpperCase();"  class="form-control" id="surname">
                                </div>
                            </div>
                          
                          <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">Firstname</label>
                                    <input type="text" name="firstName" required  onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="firstName">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="otherName" class="form-label">Othername</label>
                                    <input type="text" name="otherName"  onkeyup="this.value = this.value.toUpperCase();"  class="form-control" id="otherName">
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" name="gender" required id="gender">
                                        <option value=""> -- Select Gender -- </option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="number" name="phone" required maxlength="11" minlength="11" class="form-control" id="phone">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email [Official only]</label>
                                    <input type="email" name="email" required  onkeyup="this.value = this.value.toLowerCase();" class="form-control" id="email">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" required class="form-control" id="dob">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dfa" class="form-label">Date of First Appointment</label>
                                    <input type="date" name="dfa" required class="form-control" id="dfa">
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="promotion" class="form-label">Date of Current Promotion</label>
                                    <input type="date" name="promotion" required class="form-control" id="promotion">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Current Address</label>
                                    <textarea name="address" required class="form-control"  onkeyup="this.value = this.value.toTitleCase();"  id="address"></textarea>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-officer" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->


<div id="addFile-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples" enctype="multipart/form-data">
                <div class="modal-header bg-secondary">
                    <h4 class="modal-title text-white">File Upload</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-2 py-2">
                    
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="addFile" class="form-label">Select File to Upload</label>
                                    <input type="file" name="addFile" required class="form-control" id="addFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
                                </div>
                            </div>
                            
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btnAdd" class="btn btn-info waves-effect waves-light">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- NEW OFFICER POSTING MODAL-->
<div id="new-posting-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">OFFICER POSTING</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-2">
                    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="svcModal" class="form-label">Service Number</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="svcModal" required id="svcModal">
                                         <option value="">Select Service Number</option> 
                                        <?php
                                             $departmentId = $_SESSION['department_id'];
                                            $query = DB::query("SELECT * FROM basic_information WHERE department_id= '$departmentId' ORDER BY id");
                                                foreach($query as $result){
                                                    $svn = $result['svn'];
                                                    $getOfficeId = getOfficerDetail($svn);
                                                    $initials = $getOfficeId['initials'];
                                                    $surname = $getOfficeId['surname'];
                                                    echo "<option value='".$result['svn']."'>".$result['svn'].' - '.$initials.' '.$surname."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                           </div>
                            
                           <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="rankModal" class="form-label">Rank</label>
                                    <input type="text" name="rankModal" onkeyup="this.value = this.value.toUpperCase();" readonly required class="form-control" id="rankModal">
                                </div>
                            </div>
                            
                           
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="initialsModal" class="form-label">Initials</label>
                                    <input type="text" name="initialsModal" required class="form-control" readonly id="initialsModal">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="surnameModal" class="form-label">Surname</label>
                                    <input type="text" name="surnameModal" required class="form-control" readonly id="surnameModal">
                                </div>
                            </div>
                          
                          <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="firstNameModal" class="form-label">Firstname</label>
                                    <input type="text" name="firstNameModal" required class="form-control" readonly id="firstNameModal">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="otherNameModal" class="form-label">Othername</label>
                                    <input type="text" name="otherNameModal" required class="form-control" readonly id="otherNameModal">
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="genderModal" class="form-label">Gender</label>
                                    <input type="text" name="genderModal" required class="form-control" readonly id="genderModal">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phoneModal" class="form-label">Phone Number</label>
                                    <input type="text" name="phoneModal" required maxlength="11" minlength="11" readonly class="form-control" id="phoneModal">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="emailModal" class="form-label">Email [Official only]</label>
                                    <input type="text" name="emailModal" required readonly  style="text-transform:lowercase;" class="form-control" id="emailModal">
                                </div>
                            </div>
                        </div><!--End of Row-->
                    <div class="row">
                        <div class="col-md-12 bg-secondary">
                            <h4 class="modal-title text-white">OFFICER POSTING</h4>
                        </div>
                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="command" class="form-label">Command</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="command" required id="command">
                                         <option value="">Select Command</option> 
                                        <?php
                                            $query = DB::query("SELECT * FROM command ORDER BY command_id");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['command_id']."'>".$result['command_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                           </div>
                           <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Unit</label>
                                    <select class="form-select  border-secondary border" required data-live-search="true" name="unit" required id="unit">
                                        
                                    </select>
                                </div>
                           </div>
                           
                           <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="effectiveDate" class="form-label">Effective Date</label>
                                    <input type="date" name="effectiveDate" required  class="form-control" id="effectiveDate">
                                </div>
                           </div>
                           
                           <div class="col-md-6">
                               <div class="mb-3">
                                        <label for="designation" class="form-label">Designation</label>
                                        <select class="form-select  border-secondary border" data-live-search="true" name="designation" required id="designation">
                                             <option value="">Select Designation</option> 
                                            <?php
                                                $query = DB::query("SELECT * FROM designation ORDER BY designation_id");
                                                    foreach($query as $result){
                                                        echo "<option value='".$result['designation_id']."'>".$result['designation_name']."</option>";
                                                    }
                                            ?>
                                        </select>
                                </div>
                            </div>
                        </div> <!--End of Row-->
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-posting" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!--History of Officer Posting Modal-->


<div id="posting-detail-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
          
                <div class="modal-header bg-light">
                    <h4 class="modal-title col">RECORD OF OFFICER POSTINGS</h4>
                    <div class="col text-end d-print-none mr-2" >
                        <button onclick="printDiv('posting-detail-modal');" type="button" class="btn btn-default"><i class="fas fa fa-print"></i></button>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-2">
                    
                        <div class="row">
                            <!--Load Officer Retirement Information-->
                            <div class="retirementInfo"></div>
                           
                            <!--Load Table here-->
                            <div class="tbl"></div>
                        </div>
                    
                </div>
            
        </div>
    </div>
</div>

<script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
</script>
<!-- /.modal -->

