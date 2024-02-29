<div id="terminal-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="backend.php" method="post" class="parsley-examples">
                <div class="modal-header bg-light">
                    <h4 class="modal-title">TERMINAL REGISTRATION</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-2">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="terminal" class="form-label">Terminal</label>
                                    <input type="text" name="terminal" onkeyup="this.value = this.value.toUpperCase();" required class="form-control" id="terminal">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="terminalType" class="form-label">Terminal Type</label>
                                    <select class="form-select" name="terminalType" required id="terminalType">
                                        <option value=""> -- Select Terminal Type -- </option>
                                        <option value="Bonded">Bonded</option>
                                        <option value="Unbounded">Unbounded</option>
                                    </select>
                                </div>
                            </div>
                            
                           <div class="col-md-6">
                            <div class="mb-3">
                                <label for="commandId" class="form-label">Command</label>
                                <select class="form-select" name="commandId" required id="commandId">
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
                            
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-terminal" class="btn btn-info waves-effect waves-light">Save</button>
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

