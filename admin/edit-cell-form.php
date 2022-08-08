<div class="modal fade" id="editCellModal" tabindex="-1" role="dialog" aria-labelledby="editCellModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editCellModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="appointment-form  mt-4" role="alert" method="POST" action="actions.php" style="width: 80%;  margin-left: auto; margin-right: auto;">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="a-cell">Cell Name <span class="text-danger">(Required)</span></label>
                        <input id="ecellName" type="text" name="name" placeholder="Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="p-cell">Prison <span class="text-danger">(Required)</span></label>
                        <select class="form-control selectpicker" data-live-search="true" id="ep-cell" name="p-cell" required>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="a-cell">Status <span class="text-danger">(Required)</span></label>
                        <select class="form-control" id="pStatus" data-live-search="true" name="status" required>
                            
                        </select>   
                    </div>
                </div>
                <input type="hidden" id="type" name="type" value="edit">
                <input type="hidden" id="ecellid" name="id">
                <input type="hidden" id="ref" name="view">
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="cell-submit">Edit</button>
                </div>
                
            </form>
        </div>
        

    </div>
</div>