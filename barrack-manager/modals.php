<!-- NEW OFFICER POSTING MODAL-->
<div id="barrack-image-upload-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">BARRACK IMAGE UPLOAD</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-2">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="imageTitle" class="form-label">Image Title</label>
                                    <select class="form-select" name="imageTitle" required id="imageTitle">
                                        <?php
                                            $record = DB::query("SELECT * FROM image_title  ORDER BY image_title_id ASC");
                                                if ($record) {
                                                  echo '<option value=""> -- Select Image Title -- </option>';
                    
                                                  foreach($record as $class) {
                                                    echo '<option value="'.$class['image_title'].'">'
                                                         .$class['image_title'].
                                                      '</option>';
                                                  }
                                                    
                                                  }else{
                                                    echo '<option value="">No Image Title</option>';
                                                  }
                                        ?>
                                    </select>
                                </div>
                           </div>
                         
                           
                      <div class="col-md-12">
                        <div class="mb-3">
                            <input type="hidden" id="barrackUnitImageID" name="barrackUnitImageID">
                            <input type="hidden" id="barrackUnitImageCode" name="barrackUnitImageCode">
                            <label for="barrackUnitImage" class="form-label">Image</label>
                           <input type="file" name="barrackUnitImage" required class="form-control" id="barrackUnitImage" accept=".png, .jpg, .jpeg">
                        </div>
                      </div>
                        
                        <div class="carousel-item col-md-12">
                          <img src="" class="d-block w-100" alt="..." class="imagePreview" width="620px" height="620px">
                        </div>
                        
                        </div><!--End of Row-->
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-barrack-image" class="btn btn-success waves-effect waves-light"><i class="fas fa-upload"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->





<!--NEW BARRACKS MODAL-->
<div id="new-barrack-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">NEW BARRACK REGISTRATION</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackName" class="form-label">Barrack Name</label>
                                    <input type="text" name="barrackName" class="form-control" id="barrackName" text-transform="uppercase" data-parsley-required="true" data-parsley-required-message="Barrack Name is required" oninput="this.value = this.value.toUpperCase();">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackCode" class="form-label">Barrack Code [GEJ/2023/001]</label>
                                    <input type="text" name="barrackCode" class="form-control" id="barrackCode" data-parsley-required="true" data-parsley-required-message="Barrack Code is required" oninput="this.value = this.value.toUpperCase();">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackCategory" class="form-label">Barrack Category [e.g For AC and DC Ranks]</label>
                                   <input type="text" name="barrackCategory" class="form-control" id="barrackCategory" text-transform="uppercase" data-parsley-required="true" data-parsley-required-message="Barrack Category is required" oninput="this.value = this.value.toUpperCase();">
                                </div>
                            </div>
                            
                             <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackDescription" class="form-label">Description [e.g 50 units of 3 Bedroom Fully Detached Duplex]</label>
                                    <textarea name="barrackDescription" class="form-control" id="barrackDescription" text-transform="uppercase" data-parsley-required="true" data-parsley-required-message="Barrack Address is required"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                               <div class="mb-3">
                                <label for="barrackState">State</label>
                                <select name="barrackState" class="form-control" id="barrackState" required="required">
                                  <?php 
                                    $record = DB::query("SELECT * FROM state  ORDER BY state_name ASC");
                                    if ($record) {
                                      echo '<option value=""> -- Select State -- </option>';
        
                                      foreach($record as $class) {
                                        echo '<option value="'.$class['state_id'].'">'
                                             .$class['state_name'].
                                          '</option>';
                                      }
                                        
                                      }else{
                                        echo '<option value="">No State</option>';
                                      } 
                                  ?>
                                </select>
                              </div>
                            </div>
                            
                             <div class="col-md-6">
                               <div class="mb-3">
                                <label for="barrackLGA">LGA</label>
                                <select name="barrackLGA" class="form-control" id="barrackLGA" required="required">
                                  
                                </select>
                              </div>
                        </div>
                        
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackAddress" class="form-label">Address</label>
                                    <textarea name="barrackAddress" class="form-control" id="barrackAddress" data-parsley-required="true" data-parsley-required-message="Barrack Address is required"></textarea>
                                </div>
                            </div>
                            
                             <div class="col-md-12">
                               <div class="mb-3">
                                <label for="barrackStatus">Barrack Status</label>
                                <select name="barrackStatus" class="form-control" id="barrackStatus" required="required">
                                  <?php 
                                    $record = DB::query("SELECT * FROM barrack_status  ORDER BY barrack_status ASC");
                                    if ($record) {
                                      echo '<option value=""> -- Select Status -- </option>';
        
                                      foreach($record as $class) {
                                        echo '<option value="'.$class['barrack_status'].'">'
                                             .$class['barrack_status'].
                                          '</option>';
                                      }
                                        
                                      }else{
                                        echo '<option value="">No Status</option>';
                                      } 
                                  ?>
                                </select>
                              </div>
                            </div>
                        </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="new-barrack" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->


<!--NEW BARRACKS UNIT MODAL-->
<div id="new-barrack-unit-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">NEW BARRACK UNIT (FLAT) REGISTRATION</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="border border-success mr-4">
                    <h2></h2><strong><span class="barrackName text-success"></span></strong></h2>
                </div>
                <div class="modal-body p-4">
                    
                        <div class="row">
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackUnitName" class="form-label">Unit Name [Block 74]</label>
                                    <input type="hidden" name="barrackId" id="barrackId">
                                    <input type="text" name="barrackUnitName" class="form-control" id="barrackUnitName" text-transform="uppercase" data-parsley-required="true" data-parsley-required-message="Barrack Name is required" oninput="this.value = this.value.toUpperCase();">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackUnitCode" class="form-label">Unit Code [GEJ/B74]</label>
                                    <input type="text" name="barrackUnitCode" class="form-control" id="barrackUnitCode" data-parsley-required="true" data-parsley-required-message="Barrack Code is required" oninput="this.value = this.value.toUpperCase();">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="mb-3">
                                    <label for="barrackFacilities" class="form-label">Barrack Facilties [e.g 4 Air Conditioner, Refregirator, Gas Burner, Kitchen cabinet, Dinner Table etc]</label>
                                   <input type="text" name="barrackFacilities" class="form-control" id="barrackFacilities" text-transform="uppercase" data-parsley-required="true" data-parsley-required-message="Barrack Category is required" oninput="this.value = this.value.toUpperCase();">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="mb-3">
                                <label for="barrackUnitStatus">Barrack Status</label>
                                <select name="barrackUnitStatus" class="form-control" id="barrackUnitStatus" required="required">
                                  <?php 
                                    $record = DB::query("SELECT * FROM barrack_status WHERE id !='4' ORDER BY barrack_status ASC");
                                    if ($record) {
                                      echo '<option value=""> -- Select Status -- </option>';
        
                                      foreach($record as $class) {
                                        echo '<option value="'.$class['barrack_status'].'">'
                                             .$class['barrack_status'].
                                          '</option>';
                                      }
                                        
                                      }else{
                                        echo '<option value="">No Status</option>';
                                      } 
                                  ?>
                                </select>
                              </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="mb-3">
                                <label for="barrackUnitAllocationStatus">Allocation Status</label>
                                <select name="barrackUnitAllocationStatus" class="form-control" id="barrackUnitAllocationStatus" required="required">
                                  <option value="">Select Allocation Status</option>
                                  <option value="Occuptied">Occupied</option>
                                  <option value="Available">Available</option>
                                </select>
                              </div>
                            </div>
                            
                        </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="new-barrack-unit" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </form>
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

