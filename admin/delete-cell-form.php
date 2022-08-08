<div class="modal fade" id="deleteCellModal" tabindex="1" role="dialog" aria-labelledby="deleteCellModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="deleteCellModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="appointment-form  mt-4" role="alert" method="POST" action="actions.php" style="width: 100%;  margin-left: auto; margin-right: auto;">
                <div class="modal-body">

                    <p>Are you sure you want to delete this permanently?</p>
                    <input type="hidden" id="delete_cid" name="app_id">
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeDelete" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="deleteCell">Delete</button>
                    </div>
                </div>
            </form>

           

        </div>
    </div>

</div>