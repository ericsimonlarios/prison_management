<div class="modal fade" id="editRecordModal" tabindex="-1" role="dialog" aria-labelledby="editRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editRecordModalLabel">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="appointment-form  mt-4" role="alert" method="POST" action="actions.php" style="width: 80%;  margin-left: auto; margin-right: auto;">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="a-cell">Date <span class="text-danger">(Required)</span></label>
                        <input id="edate" type="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="b-cell">Action <span class="text-danger">(Required)</span></label>
                        <select class="form-control selectpicker" data-live-search="true" id="b-cell" name="cell" required>
                            <option value="" id="eselect"selected></option>
                        </select>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 mb-3">
                        <label for="address">Remarks <span class="text-danger">(Required)</span></label>
                        <textarea class="resizable_textarea form-control" id="remarks" name="remarks" rows="5"></textarea>
                      </div>
                    </div>
                </div>
                <input type="hidden" id="e_id" name="id">
                <input type="hidden" id="pri-id" name="pid">
                <input type="hidden" id="type" name="type" value="edit">
                <input type="hidden" id="ref" name="view">
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="record-submit">Add</button>
                </div>
                
            </form>
        </div>
        

    </div>
</div>