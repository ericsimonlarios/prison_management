<div class="modal fade" id="editPrisonModal" tabindex="-1" role="dialog" aria-labelledby="editPrisonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editPrisonModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="appointment-form  mt-4" role="alert" method="POST" action="actions.php" style="width: 80%;  margin-left: auto; margin-right: auto;">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="a-cell">Name <span class="text-danger">(Required)</span></label>
                        <input id="editPname" type="text" name="name" placeholder="Name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="a-cell">Status <span class="text-danger">(Required)</span></label>
                        <select class="form-control" id="pStatus" data-live-search="true" name="status" required>
                            
                        </select>   
                    </div>
                </div>
                <input type="hidden" id="type" name="type" value="edit">
                <input type="hidden" id="eid" name="id">
                <input type="hidden" id="ref" name="view">
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="prison-submit">Edit</button>
                </div>
                
            </form>
        </div>
        

    </div>
</div>