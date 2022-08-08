<div class="modal fade" id="deleteFamModal" tabindex="1" role="dialog" aria-labelledby="deleteFamModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="deleteFamModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="appointment-form  mt-4" role="alert" method="POST" action="actions.php" style="width: 100%;  margin-left: auto; margin-right: auto;">
                <div class="modal-body">

                    <p>Are you sure you want to delete this permanently?</p>
                    <input type="hidden" id="del_id" name="fam_id">
                    <input type="hidden" id="pr-id" name="prisoner_id" value="<?php echo $prisoner_id?>">
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeDelete" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="deleteFam">Delete</button>
                    </div>
                </div>
            </form>

           

        </div>
    </div>

</div>