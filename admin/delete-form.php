<div class="modal fade" id="deleteModal" tabindex="1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="deleteModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="appointment-form  mt-4" role="alert" method="POST" action="actions.php" style="width: 100%;  margin-left: auto; margin-right: auto;">
                <div class="modal-body">

                    <p>Are you sure you want to delete this permanently?</p>
                    <input type="hidden" id="delete_id" name="app_id">
                    <input type="hidden" id="pri_id" name="pid">
                    <input type="hidden" id="typeOf" name="type">
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeDelete" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </div>
            </form>

           

        </div>
    </div>

</div>