<div id="new-user-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">USER REGISTRATION</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rank" class="form-label">Rank</label>
                                    <select class="form-select" name="rank" required id="rank">
                                        <option value="">Select Rank</option>
                                        <?php
                                            $query = DB::query("SELECT * FROM ranks");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['rank_id']."'>".$result['rank_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" name="fullname" required class="form-control" id="fullname">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="serviceNo"  class="form-label">Service Number</label>
                                    <input type="text" class="form-control" required name="serviceNo" id="serviceNo" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email  [Official]</label>
                                    <input type="email" class="form-control" name="email" required id="email">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone"  class="form-label">Phone</label>
                                    <input type="text" data-parsley-type="digits" data-parsley-maxlength="11" data-parsley-minlength="11" class="form-control" required name="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="access_level" class="form-label">Access Level</label>
                                    <select class="form-select" name="access_level" required id="example-select">
                                        <option value="">Select Access Level</option>
                                        <?php
                                            $query = DB::query("SELECT * FROM access_level");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['access_level']."'>".$result['access_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="departmentId" class="form-label">Department</label>
                                    <select class="form-select" name="departmentId" required id="departmentId">
                                        <option value="">Select Department</option>
                                        <?php
                                            $query = DB::query("SELECT * FROM department");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['department_id']."'>".$result['department_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-user" class="btn btn-info waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!--USER SIGNUP BULK UPLOAD-->
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
                                    <input type="file" name="addFile" required class="form-control" id="addFile" accept=".csv" >
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


<!--ADD FORMATION MODAL-->
<div id="add-formation-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">Add Formation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="zoneId" class="form-label">Zone</label>
                                    <select class="form-select" name="zoneId" required id="example-select">
                                        <option value="">Select Zone</option>
                                        <?php
                                            $query = DB::query("SELECT * FROM zone");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['zone_id']."'>".$result['zone_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="formation" class="form-label">Formation</label>
                                    <input type="text" name="formation" required class="form-control" id="formation" placeholder="E.g Command">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="formationCode" class="form-label">Formation Code</label>
                                    <input type="text" name="formationCode" required class="form-control" id="formationCode" placeholder="e.g Command code ">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="location" required class="form-control" id="location" placeholder="Enter Caliber">
                                </div>
                            </div>
                        
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-formation" class="btn btn-info waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!--ADD UNIT MODAL-->
<div id="add-unit-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">Add Unit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="dept" class="form-label">Department</label>
                                    <select class="form-select" name="dept" required id="dept">
                                        <option value="">Select Department</option>
                                        <?php
                                            $query = DB::query("SELECT * FROM department");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['department_id']."'>".$result['department_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Unit</label>
                                    <input type="text" name="unit" required class="form-control" id="unit">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="unitCode" class="form-label">Unit Code</label>
                                    <input type="text" name="unitCode" required class="form-control" id="unitCode">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-unit" class="btn btn-info waves-effect waves-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->


<!--ADD DESIGNATION MODAL-->
<div id="add-designation-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">Add Designation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-select" name="department" required id="department">
                                        <option value="">Select Department</option>
                                        <?php
                                            $query = DB::query("SELECT * FROM department");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['department_id']."'>".$result['department_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" name="designation" required class="form-control" id="designation">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="designationCode" class="form-label">Designation Code</label>
                                    <input type="text" name="designationCode" required class="form-control" id="designationCode">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-designation" class="btn btn-info waves-effect waves-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!--ADD DEPARTMENT MODAL-->
<div id="add-department-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header">
                    <h4 class="modal-title">Add Unit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="departmentName" class="form-label">Department</label>
                                    <input type="text" name="departmentName" required class="form-control" id="departmentName">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="deptCode" class="form-label">Department Code</label>
                                    <input type="text" name="deptCode" required class="form-control" id="deptCode">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="hod" class="form-label">Head of Dept [Rank]</label>
                                     <select class="form-select" name="hod" required id="hod">
                                        <option value="">Select HoD Rank</option>
                                        <?php
                                            $query = DB::query("SELECT * FROM ranks");
                                                foreach($query as $result){
                                                    echo "<option value='".$result['rank_id']."'>".$result['rank_name']."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-department" class="btn btn-info waves-effect waves-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
