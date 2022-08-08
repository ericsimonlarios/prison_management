<div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addRecordModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="appointment-form mt-4" role="alert" method="POST" action="actions.php" style="width: 80%;  margin-left: auto; margin-right: auto;">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="a-cell">Date <span class="text-danger">(Required)</span></label>
                        <input id="actionDate" type="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="a-cell">Action <span class="text-danger">(Required)</span></label>
                        <select class="form-control selectpicker a-cell" data-live-search="true" id="a-cell" name="cell" required>

                        </select>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 mb-3">
                        <label for="address">Remarks <span class="text-danger">(Required)</span></label>
                        <textarea class="resizable_textarea form-control" id="remarks" name="remarks" rows="5"></textarea>
                      </div>
                    </div>
                </div>
                <input type="hidden" id="prisoner_id" name="pid">
                <input type="hidden" id="type" name="type" value="add">
                <input type="hidden" id="ref" name="view">
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="record-submit">Add</button>
                </div>
                
            </form>
        </div>
        

    </div>
</div>