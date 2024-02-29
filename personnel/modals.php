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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rank" class="form-label">Rank</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="rank" required id="rank">
                                         <option value="">Select Rank</option> 
                                        <?php
                                            $record = DB::query("SELECT * FROM ranks  ORDER BY rank_id ASC");
                                                if ($record) {
                                                  echo '<option value=""> -- Select Rank -- </option>';
                    
                                                  foreach($record as $class) {
                                                    echo '<option value="'.$class['rank_id'].'">'
                                                         .$class['rank_name'].
                                                      '</option>';
                                                  }
                                                    
                                                  }else{
                                                    echo '<option value="">No Rank</option>';
                                                  }
                                        ?>
                                    </select>
                                </div>
                           </div>
                        
                            
                           
                          <div class="col-md-6">
                           <div class="mb-3">
                            <label for="commandPost">Station</label>
                            <select name="commandPost" class="form-control" id="commandPost" required="required">
                              <?php 
                                $record = DB::query("SELECT * FROM command  ORDER BY command_name ASC");
                                if ($record) {
                                  echo '<option value=""> -- Select Command -- </option>';
    
                                  foreach($record as $class) {
                                    echo '<option value="'.$class['command_id'].'">'
                                         .$class['command_name'].
                                      '</option>';
                                  }
                                    
                                  }else{
                                    echo '<option value="">No Command</option>';
                                  } 
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-6 unit-div">
                            <div class="mb-3">
                            <label for="unit">Unit</label>
                            <select name="unit" class="form-control" id="unit">
                              
                            </select>
                          </div>
                      </div>  
                           
                      <div class="col-md-6">
                        <div class="mb-3">
                            <label for="effectiveDate" class="form-label">Posting/Effective/Reporting Date</label>
                            <input type="date" name="effectiveDate" required  class="form-control" id="effectiveDate">
                        </div>
                       </div>
                        
                        <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="department" required id="department">
                                         <option value="">Select Department</option> 
                                        <?php
                                            $query = DB::query("SELECT * FROM department ORDER BY department_id");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['department_id']."'>".$result['department_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="designation" required id="designation">
                                         
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="datePostedOut" class="form-label">Date Posted Out [Optional]</label>
                                    <input type="date" name="datePostedOut"  class="form-control" id="datePostedOut">
                                </div>
                           </div>
                            
                            
                        </div><!--End of Row-->
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


<!-- NEW EMOLUMENT MODAL-->
<div id="new-emolument-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">NEW EMOLUMENT</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-2">
                    
                        <div class="row">
                             <div class="col-md-6">
                           <div class="mb-3">
                            <label for="rank">Rank</label>
                            <select name="rank" class="form-control" id="rank" required="required">
                              <?php 
                                $record = DB::query("SELECT * FROM ranks  ORDER BY rank_id ASC");
                                if ($record) {
                                  echo '<option value=""> -- Select Rank -- </option>';
    
                                  foreach($record as $class) {
                                    echo '<option value="'.$class['rank_id'].'">'
                                         .$class['rank_name'].
                                      '</option>';
                                  }
                                    
                                  }else{
                                    echo '<option value="">No Rank</option>';
                                  } 
                              ?>
                            </select>
                          </div>
                      </div>
                            
                           
                          <div class="col-md-6">
                           <div class="mb-3">
                            <label for="commandPostEmolument">Station</label>
                            <select name="commandPostEmolument" class="form-control" id="commandPostEmolument" required="required">
                              <?php 
                                $record = DB::query("SELECT * FROM command  ORDER BY command_name ASC");
                                if ($record) {
                                  echo '<option value=""> -- Select Command -- </option>';
    
                                  foreach($record as $class) {
                                    echo '<option value="'.$class['command_id'].'">'
                                         .$class['command_name'].
                                      '</option>';
                                  }
                                    
                                  }else{
                                    echo '<option value="">No Command</option>';
                                  } 
                              ?>
                            </select>
                          </div>
                      </div>
                      
                      <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="bank" class="form-label">Bank Name</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="bank" required id="bank">
                                         <option value="">Select Bank Name</option> 
                                        <?php
                                            $query = DB::query("SELECT * FROM bank ORDER BY bank_id");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['bank_id']."'>".$result['bank_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                      <div class="col-md-6 unitEmolument-div">
                            <div class="mb-3">
                            <label for="unitEmolument">Unit/Department</label>
                            <select name="unitEmolument" class="form-control" id="unitEmolument" >
                              
                            </select>
                          </div>
                      </div>  
                           
                        
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="accountNumber" class="form-label">Bank Account Number [1234567890]</label>
                                    <input type="text" name="accountNumber" required maxLength="10" minLength="10"  class="form-control" id="accountNumber">
                                </div>
                            </div>
                            
                             <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="pfa" class="form-label">Pension Fund Administration</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="pfa" required id="pfa">
                                         <option value="">Select Pension Fund Administration</option> 
                                        <?php
                                            $query = DB::query("SELECT * FROM pfa ORDER BY pfa_id");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['pfa_id']."'>".$result['pfa_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="pfaNumber" class="form-label">PFA Number[PEN123456789000]</label>
                                    <input type="text" name="pfaNumber" required maxLength="18" minLength="15" class="form-control" id="pfaNumber">
                                </div>
                            </div>
                            
                           
                            
                            
                             <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barracks" class="form-label">Quartered?</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="barracks" required id="barracks">
                                        <option value="NO">NO</option> 
                                        <option value="YES">YES</option> 
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 barracks-div">
                               <div class="mb-3">
                                    <label for="dateQuartered" class="form-label">Date Quartered</label>
                                    <input type="date" name="dateQuartered"  class="form-control" id="dateQuartered">
                                </div>
                            </div>
                            
                             <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="interdicted" class="form-label">Interdicted?</label>
                                    <select class="form-select  border-secondary border" data-live-search="true" name="interdicted" required id="interdicted">
                                        <option value="NO">NO</option> 
                                        <option value="YES">YES</option> 
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 interdicted-div">
                               <div class="mb-3">
                                    <label for="dateInterdicted" class="form-label interdicted-div">Date Interdicted</label>
                                    <input type="date" name="dateInterdicted"   class="form-control" id="dateInterdicted">
                                </div>
                            </div>
                        </div><!--End of Row-->
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-emolument" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!--ASSESSOR REJECTION-->
<div id="emolument-reject-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">Reject Emolument</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                        <div class="row">
                           <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="rejectionReason" class="form-label interdicted-div">Reason</label>
                                    <textarea name="rejectionReason"   class="form-control" id="rejectionReason"></textarea>
                                    <input type="text" name="rejectEmolId" name="rejectEmolId" >
                                </div>
                            </div> 
                        </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="reject-emolument" class="btn btn-info waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!--VIEW EMOLUMENT MODAL-->
<div id="view-emolument-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">Officer Emolument</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                        <div class="row">
                               <div class="col-md-12">
                                    <div class="text-center">
                                          <div id="image-container"></div>
                                    </div>
                                </div>
                                
                                 <div class="col-md-4">
                               <div class="mb-3">
                                    <input type="hidden" name="emolId" id="emolId" >
                                    <label for="modalRank" class="form-label">Rank</label>
                                    <input type="text" name="modalRank"  class="form-control" id="modalRank">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalSVN" class="form-label">Service Number</label>
                                    <input type="text" name="modalSVN"  class="form-control" id="modalSVN">
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalInitials" class="form-label">Initials</label>
                                    <input type="text" name="modalInitials"  class="form-control" id="modalInitials">
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalName" class="form-label">Name</label>
                                    <input type="text" name="modalName"  class="form-control" id="modalName">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalPhone" class="form-label">Phone</label>
                                    <input type="text" name="modalPhone"  class="form-control" id="modalPhone">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalEmail" class="form-label">Email</label>
                                    <input type="text" name="modalEmail"  class="form-control" id="modalEmail">
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalStation" class="form-label">Station</label>
                                    <input type="text" name="modalStation"  class="form-control" id="modalStation">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalUnit" class="form-label">Unit</label>
                                    <input type="text" name="modalUnit"  class="form-control" id="modalUnit">
                                </div>
                            </div>
                             
                             <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalQuartered" class="form-label">Date Quartered</label>
                                    <input type="text" name="modalQuartered"  class="form-control" id="modalQuartered">
                                </div>
                            </div>
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalInterdicted" class="form-label">Date Interdicted</label>
                                    <input type="text" name="modalInterdicted"  class="form-control" id="modalInterdicted">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalBank" class="form-label">Bank</label>
                                    <input type="text" name="modalBank"  class="form-control" id="modalBank">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalAccountNumber" class="form-label">Account Number</label>
                                    <input type="text" name="modalAccountNumber"  class="form-control" id="modalAccountNumber">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalPFA" class="form-label">Pension Fund Administrator</label>
                                    <input type="text" name="modalPFA"  class="form-control" id="modalPFA">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalRSApin" class="form-label">RSA PIN</label>
                                    <input type="text" name="modalRSApin"  class="form-control" id="modalRSApin">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                               <div class="mb-3">
                                    <label for="modalStatus" class="form-label">Status</label>
                                    <input type="text" name="modalStatus"  class="form-control" id="modalStatus">
                                </div>
                            </div>
                            
                        </div>                   
                </div>
                
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->


<!--SCHEDULE EMOLUMENT MODAL-->
<div id="schedule-emolument-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">SCHEDULE EMOLUMENT PERIOD</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                        <div class="row">
                                 <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="dateStarted" class="form-label">Proposed Start Date</label>
                                    <input type="date" name="dateStarted" required class="form-control" id="dateStarted">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="dateEnded" class="form-label">Proposed End Date</label>
                                    <input type="date" name="dateEnded" required class="form-control" id="dateEnded">
                                </div>
                            </div>
                        </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="schedule-emolument" class="btn btn-info waves-effect waves-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!--TERMINATE EMOLUMENT MODAL-->
<div id="view-emolument-schedule-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">END SCHEDULED EMOLUMENT</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                               <div class="mb-3">
                                   <input type="hidden" name="emolumentTerminationId" id="emolumentTerminationId">
                                    <label for="emolumentDate" class="form-label">End Scheduled Emolument</label>
                                    <input type="date" name="emolumentDate"  class="form-control" id="emolumentDate">
                                </div>
                            </div>
                        </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="end-emolument" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->


<!--EDIT EMOLUMENT MODAL-->
<div id="edit-emolument-schedule-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">EDIT SCHEDULED EMOLUMENT PERIOD</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="editStartDate" class="form-label">Start Date</label>
                                    <input type="hidden" name="editEmolumentId" id="editEmolumentId">
                                    <input type="date" name="editStartDate"  class="form-control" id="editStartDate">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="editEndDate" class="form-label">End Date</label>
                                    <input type="date" name="editEndDate"  class="form-control" id="editEndDate">
                                </div>
                            </div>
                        </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit-emolument" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->


<!--NEW BARRACKS APPLICATION MODAL-->
<div id="new-allocation-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">NEW BARRACK APPLICATION</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                        <div class="row border border-success border-shadow mb-2" style="box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackNameSelect" class="form-label">Barrack Name</label>
                                    <select class="form-select" name="barrackNameSelect" required id="barrackNameSelect">
                                         <option value="">Select Barrack</option> 
                                        <?php
                                            $query = DB::query("SELECT * FROM barrack_information ORDER BY barrack_id");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['barrack_id']."'>".$result['barrack_code']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackUnitSelect" class="form-label">Flat/Unit Code</label>
                                    <select class="form-select"  name="barrackUnitSelect" required id="barrackUnitSelect">
                                        
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row barrack_allocation_div">
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackCode" class="form-label">Barrack Code</label>
                                    <input type="text" name="barrackCode" readonly class="form-control" id="barrackCode" text-transform="uppercase">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackCategory" class="form-label">Barrack Category</label>
                                   <input type="text" name="barrackCategory" readonly class="form-control" id="barrackCategory" text-transform="uppercase">
                                </div>
                            </div>
                            
                             <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackUnitName" class="form-label">Barrack Unit Name</label>
                                    <input type="text" name="barrackUnitName" readonly class="form-control" id="barrackUnitName" text-transform="uppercase">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackUnitCode" class="form-label">Barrack Unit Code</label>
                                    <input type="text" name="barrackUnitCode" readonly class="form-control" id="barrackUnitCode" text-transform="uppercase">
                                </div>
                            </div>
                            
                             <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackUnitStatus" class="form-label">Barrack Unit Status</label>
                                    <input type="text" name="barrackUnitStatus" readonly class="form-control" id="barrackUnitStatus" text-transform="uppercase">
                                </div>
                            </div>
                            
                             <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackAllocationStatus" class="form-label">Allocation Status</label>
                                    <input type="text" name="barrackAllocationStatus" readonly class="form-control" id="barrackAllocationStatus" text-transform="uppercase">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                    <label for="barrackState">State</label>
                                    <input type="text" name="barrackState" readonly class="form-control" id="barrackState" text-transform="uppercase">
                                </div>
                            </div>
                            
                             <div class="col-md-6">
                               <div class="mb-3">
                                <label for="barrackLGA">LGA</label>
                               <input type="text" name="barrackLGA" readonly class="form-control" id="barrackLGA" text-transform="uppercase">
                              </div>
                        </div>
                        
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackAddress" class="form-label">Address</label>
                                    <input type="text" name="barrackAddress" readonly class="form-control" id="barrackAddress" text-transform="uppercase">
                                </div>
                            </div>
                            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="new-allocation-application" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> Apply</button>
                </div> 
                
                </div>
               
            </form>
        </div>
    </div>
</div>
</div>
<!-- /.modal -->


<!--BARRACKS UNIT IMAGES MODAL-->
<div id="barrack-unit-images-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">BARRACK UNIT IMAGES</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="carouselExampleCaptions" class="carousel slide text-success" data-bs-ride="carousel">
                      <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="7" aria-label="Slide 8"></button>
                      </div>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="" class="d-block w-100" alt="..." class="image1" id="image1" width="620px" height="620px">
                          <div class="carousel-caption d-none d-md-block bg-dark font-18">
                            <p><span class="imageTitle1"></span></p>
                          </div>
                        </div>
                        
                        <div class="carousel-item">
                          <img src="" class="d-block w-100" alt="..." class="image2" id="image2" width="620px" height="620px">
                          <div class="carousel-caption d-none d-md-block bg-dark font-18">
                            <p><span class="imageTitle2"></span></p>
                          </div>
                        </div>
                        
                        <div class="carousel-item">
                          <img src="" class="d-block w-100" alt="..." class="image3" id="image3" width="620px" height="620px">
                          <div class="carousel-caption d-none d-md-block bg-dark font-18">
                            <p><span class="imageTitle3"></span></p>
                          </div>
                        </div>
                        
                        <div class="carousel-item">
                          <img src="" class="d-block w-100" alt="..." class="image4" width="620px" height="620px">
                          <div class="carousel-caption d-none d-md-block bg-dark font-18">
                            <p><span class="imageTitle4"></span></p>
                          </div>
                        </div>
                        
                        <div class="carousel-item">
                          <img src="" class="d-block w-100" alt="..." class="image5" width="620px" height="620px">
                          <div class="carousel-caption d-none d-md-block bg-dark font-18">
                            <p><span class="imageTitle5"></span></p>
                          </div>
                        </div>
                        
                        <div class="carousel-item">
                          <img src="" class="d-block w-100" alt="..." class="image6" width="620px" height="620px">
                          <div class="carousel-caption d-none d-md-block bg-dark font-18">
                            <p><span class="imageTitle6"></span></p>
                          </div>
                        </div>
                        
                        <div class="carousel-item">
                          <img src="" class="d-block w-100" alt="..." class="image7" width="620px" height="620px">
                          <div class="carousel-caption d-none d-md-block bg-dark font-18">
                            <p><span class="imageTitle7"></span></p>
                          </div>
                        </div>
                        
                        <div class="carousel-item">
                          <img src="" class="d-block w-100" alt="..." class="image8" width="620px" height="620px">
                          <div class="carousel-caption d-none d-md-block bg-dark font-18">
                            <p><span class="imageTitle8"></span></p>
                          </div>
                        </div>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                      </button>
                    </div>
        </div>
    </div>
</div>
</div>
<!-- /.modal -->


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

